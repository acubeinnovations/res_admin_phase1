<?php

//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}
$item=new Item($myconnection);
$item->connection=($myconnection);
$item_rate=$item->get_array_item_rate();
$item_name=$item->get_array_item_name();
$item_tax= $item->get_array_item_tax();
$item_packing_ids= $item->get_array_item_packing_id();
$item_category=new ItemCategory($myconnection);
$item_category->connection=($myconnection);

if(isset($_POST['paid_change_refresh']) && isset($_SESSION['bill_id']) && $_SESSION['bill_id']>0){
$mybills=new Bills($myconnection);
$mybills->connection=($myconnection);
$mybills->id=$_SESSION['bill_id'];
$mybills->get_detail();
print $mybills->paid.'!@#$%*'.$mybills->balance;
exit();
}
if(isset($_POST['paid']) && isset($_SESSION['bill_id']) && $_SESSION['bill_id']>0){
$bill_amount='';
$mybills=new Bills($myconnection);
$mybills->connection=($myconnection);
$mybills->id=$_SESSION['bill_id'];
$mybills->get_detail();
$mybillitems=new BillItems($myconnection);
$mybillitems->connection=($myconnection);
$mybillitems->bill_id=$_SESSION['bill_id'];
$mybillitems->bill_item_status_id=BILL_ITEM_STATUS_ACTIVE;
$bill_amount=$mybillitems->get_tot_bill_amount_array();
$mybills->paid=$_POST['paid'];
$mybills->balance=$mybills->paid-$bill_amount;
if($mybills->bill_status_id==BILL_STATUS_BILLED){
$chk=$mybills->update();
if($chk==true){
print $mybills->balance;
exit();
}else{
print '-1';
exit();
}
}else{
print '-1';
exit();
}
}


if(isset($_POST['discount']) && isset($_SESSION['bill_id']) && $_SESSION['bill_id']>0){
$mybills=new Bills($myconnection);
$mybills->connection=($myconnection);
$mybills->id=$_SESSION['bill_id'];
$mybills->get_detail();
if($mybills->bill_status_id==BILL_STATUS_BILLED){
$mybills->discount=$_POST['discount'];
$chk=$mybills->update();
if($chk==true){
print $mybills->discount;
exit();
}else{
print 0;
exit();
}
}else{
print 0;
exit();
}
}
if(isset($_POST['parcel']) && isset($_POST['item_id']) && isset($_POST['bill_item_id']) && isset($_SESSION['bill_id']) && $_SESSION['bill_id']>0){
$item_id=$_POST['item_id'];
$bill_item_id=$_POST['bill_item_id'];
$mybills=new Bills($myconnection);
$mybills->connection=($myconnection);

$mypacking=new Packing($myconnection);
$mypacking->connection=($myconnection);
$packing_rate=$mypacking->get_array_rates();

$mybillitems=new BillItems($myconnection);
$mybillitems->connection=($myconnection);
$mybillitems->id=$_POST['bill_item_id'];
$mybillitems->get_detail();
$mybillitems->packing_rate=$packing_rate[$item_packing_ids[$item_id]];
$mybillitems->packing_quantity=$_POST['parcel'];
$mybillitems->packing_amount=$mybillitems->packing_rate*$mybillitems->packing_quantity;
$mybillitems->packing_id=$item_packing_ids[$item_id];
$mybillitems->update();


$mybills->id=$_SESSION['bill_id'];
$mybills->get_detail();
if($mybills->bill_status_id!=BILL_STATUS_PAID){

//added by rajesh
$mybills->update();
$mybills->id=$_SESSION['bill_id'];
$mybills->get_detail();

	
	$mybillitems->bill_id=$_SESSION['bill_id'];
	$mybillitems->bill_item_status_id=BILL_ITEM_STATUS_ACTIVE;
	$bill_amount=$mybillitems->get_tot_bill_amount_array();
	$packing_amount=$mybillitems->get_tot_packing_amount();
	$mybills->packing_charge=$packing_amount;
	$mybills->amount=$bill_amount;
if($mybills->paid>0){
	$mybills->balance=($mybills->paid-$bill_amount);
}
//
$mybills->update();
exit();
}
}

if(isset($_POST['discount_refresh']) && isset($_SESSION['bill_id']) && $_SESSION['bill_id']>0){
$mybills=new Bills($myconnection);
$mybills->connection=($myconnection);
$mybills->id=$_SESSION['bill_id'];
$mybills->get_detail();
print $mybills->discount;
exit();
}


if(isset($_POST['item_id'])){
$mybills=new Bills($myconnection);
$mybills->connection=($myconnection);

$mybillitems=new BillItems($myconnection);
$mybillitems->connection=($myconnection);
if(isset($_SESSION['bill_id']) && $_SESSION['bill_id']>0){
$mybillitems->item_id=$_POST['item_id'];
$mybillitems->bill_id=$_SESSION['bill_id'];
$chk=$mybillitems->bill_item_check();
if($chk==true){
$mybills->id=$_SESSION['bill_id'];
$mybills->get_detail();
if($mybills->bill_status_id!=BILL_STATUS_PAID){
$mybillitems->get_detail();
if($mybillitems->bill_item_status_id==BILL_ITEM_STATUS_CANCELLED){
$mybillitems->quantity=1;
$mybillitems->bill_item_status_id=BILL_ITEM_STATUS_ACTIVE;
$mybillitems->rate=($item_rate[$mybillitems->item_id])*$mybillitems->quantity;
$mybillitems->tax=$mybillitems->rate*($item_tax[$mybillitems->item_id])/100;
$mybillitems->updated=CURRENT_DATETIME;
$mybillitems->counter_id=$_SESSION[SESSION_TITLE.'counter_userid'];
$mybillitems->update();
$mybillitems->bill_id=$_SESSION['bill_id'];
$tax=$mybillitems->get_tot_tax();
$mybills->tax=$tax;
$mybills->update();
$div_content='<div class="row row_bill_items" id="bill_item_row'.$mybillitems->id.'"><div class="medium-12 columns"><div class="medium-3 columns"><a href="#" class="bill_items" id="item_bill'.$mybillitems->item_id.'" item_id="'.$mybillitems->item_id.'" bill_item_id="'.$mybillitems->id.'">'.$item_name[$mybillitems->item_id].'</a></div><div class="medium-3 columns"><input type="text" value="'.$mybillitems->quantity.'" class="item_quantity" id="item_quantity'.$mybillitems->item_id.'" item_id="'.$mybillitems->item_id.'" bill_item_id="'.$mybillitems->id.'" /></div><div class="medium-2 columns"><a href="#" class="bill_items" id="item_rate'.$mybillitems->item_id.'" item_id="'.$mybillitems->item_id.'" bill_item_id="'.$mybillitems->id.'">'.$mybillitems->rate.'</a></div><div class="medium-2 columns"><a href="#" class="bill_item_cancel button tiny alert" id="item_cancel'.$mybillitems->item_id.'" item_id="'.$mybillitems->item_id.'" bill_item_id="'.$mybillitems->id.'"><b>X</b></a></div><div class="medium-2 columns"><a href="#" class="tiny  button parcel" id="parcel'.$mybillitems->item_id.'" item_id="'.$mybillitems->item_id.'" bill_item_id="'.$mybillitems->id.'" select_id="bill_parcel"><strong>P</strong></a></div></div/></div/>';
print $div_content;
exit();
}else{
if(isset($_POST['qty']) && $_POST['qty']!=''){
$mybillitems->quantity=$_POST['qty'];
}else{
$mybillitems->quantity=$mybillitems->quantity+1;

}
$mybillitems->rate=($item_rate[$mybillitems->item_id])*$mybillitems->quantity;
$mybillitems->tax=$mybillitems->rate*($item_tax[$mybillitems->item_id])/100;
$mybillitems->updated=CURRENT_DATETIME;
$mybillitems->update();
$mybills->id=$_SESSION['bill_id'];
$mybills->get_detail();
$mybillitems->bill_id=$_SESSION['bill_id'];
$tax=$mybillitems->get_tot_tax();
$mybills->tax=$tax;
$mybills->update();
print $mybillitems->item_id.'!@#$%*'.$mybillitems->quantity.'!@#$%*'.$mybillitems->rate;
exit();
}
}
}else{
$mybills->id=$_SESSION['bill_id'];
$mybills->get_detail();
if($mybills->bill_status_id!=BILL_STATUS_PAID){
$mybillitems->bill_id=$_SESSION['bill_id'];
$mybillitems->item_id=$_POST['item_id'];
$mybillitems->rate=$item_rate[$mybillitems->item_id];
$mybillitems->bill_item_status_id=BILL_ITEM_STATUS_ACTIVE;
$mybillitems->quantity=1;
$mybillitems->counter_id=$_SESSION[SESSION_TITLE.'counter_userid'];
$mybillitems->tax=$mybillitems->rate*$item_tax[$mybillitems->item_id]/100;

$mybillitems->update();
$mybills->id=$_SESSION['bill_id'];
$mybills->get_detail();
$mybillitems->bill_id=$_SESSION['bill_id'];
$tax=$mybillitems->get_tot_tax();
$mybills->tax=$tax;
$mybills->update();
$div_content='<div class="row row_bill_items" id="bill_item_row'.$mybillitems->id.'"><div class="medium-12 columns"><div class="medium-3 columns"><a href="#" class="bill_items" id="item_bill'.$mybillitems->item_id.'" item_id="'.$mybillitems->item_id.'" bill_item_id="'.$mybillitems->id.'">'.$item_name[$mybillitems->item_id].'</a></div><div class="medium-3 columns"><input type="text" value="'.$mybillitems->quantity.'" class="item_quantity" id="item_quantity'.$mybillitems->item_id.'" item_id="'.$mybillitems->item_id.'" bill_item_id="'.$mybillitems->id.'" /></div><div class="medium-2 columns"><a href="#" class="bill_items" id="item_rate'.$mybillitems->item_id.'" item_id="'.$mybillitems->item_id.'" bill_item_id="'.$mybillitems->id.'">'.$mybillitems->rate.'</a></div><div class="medium-2 columns"><a href="#" class="bill_item_cancel button tiny alert" id="item_cancel'.$mybillitems->item_id.'" item_id="'.$mybillitems->item_id.'" bill_item_id="'.$mybillitems->id.'"><b>X</b></a></div><div class="medium-2 columns"><a href="#" class="tiny  button parcel" id="parcel'.$mybillitems->item_id.'" item_id="'.$mybillitems->item_id.'" bill_item_id="'.$mybillitems->id.'" select_id="bill_parcel"><strong>P</strong></a></div></div/></div/>';
print $div_content;
exit();
}
}
}else{
$mybills->counter_id=$_SESSION[SESSION_TITLE.'counter_userid'];

$mybills->bill_date=CURRENT_DATETIME;
$mybills->bill_status_id=BILL_STATUS_BILLED;
$mybills->update();
$last_bill_number=$mybills->get_last_bill_number();
$_SESSION['bill_number']=$last_bill_number+1;
$_SESSION['bill_id']=$mybills->id;
$mybillitems->counter_id=$_SESSION[SESSION_TITLE.'counter_userid'];
$mybillitems->bill_id=$mybills->id;
$mybillitems->item_id=$_POST['item_id'];
$mybillitems->rate=$item_rate[$mybillitems->item_id];
$mybillitems->bill_item_status_id=BILL_ITEM_STATUS_ACTIVE;
$mybillitems->quantity=1;
$mybillitems->tax=$mybillitems->rate*$item_tax[$mybillitems->item_id]/100;

$mybillitems->update();
$mybills->get_detail();
$mybills->tax=$mybillitems->tax;
$mybills->update();
$div_content='<div class="row row_bill_items" id="bill_item_row'.$mybillitems->id.'"><div class="medium-12 columns"><div class="medium-3 columns"><a href="#" class="bill_items" id="item_bill'.$mybillitems->item_id.'" item_id="'.$mybillitems->item_id.'" bill_item_id="'.$mybillitems->id.'">'.$item_name[$mybillitems->item_id].'</a></div><div class="medium-3 columns"><input type="text" class="item_quantity" value="'.$mybillitems->quantity.'" item_id="'.$mybillitems->item_id.'" bill_item_id="'.$mybillitems->id.'" id="item_quantity'.$mybillitems->item_id.'" /></div><div class="medium-2 columns"><a href="#" class="bill_items" id="item_rate'.$mybillitems->item_id.'" item_id="'.$mybillitems->item_id.'" bill_item_id="'.$mybillitems->id.'">'.$mybillitems->rate.'</a></div><div class="medium-2 columns"><a href="#" class="bill_item_cancel button tiny alert" id="item_cancel'.$mybillitems->item_id.'" item_id="'.$mybillitems->item_id.'" bill_item_id="'.$mybillitems->id.'"><b>X</b></a></div><div class="medium-2 columns"><a href="#" class="tiny  button parcel" id="parcel'.$mybillitems->item_id.'" item_id="'.$mybillitems->item_id.'" bill_item_id="'.$mybillitems->id.'" select_id="bill_parcel"><strong>P</strong></a></div></div></div>';
print $div_content;
exit();
}



}
?>
