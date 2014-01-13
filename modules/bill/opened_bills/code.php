<?php

//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}

if(isset($_POST['opened'])){
$holded_bills='';
$div_content='';
$mybills=new Bills($myconnection);
$mybills->connection=($myconnection);
$mybills->bill_status_id=BILL_STATUS_HOLD;
$mybills->counter_id=$_SESSION[SESSION_TITLE.'counter_userid'];
$mybills->bill_date=CURRENT_DATE;
$holded_bills=$mybills->get_details_of_holded_bills();
if($holded_bills!=false){
$div_content='<fieldset>
    <legend>Opened Bills</legend><div class="row"><div class="small-12 columns">';
for($index_holded_bills=0;$index_holded_bills<count($holded_bills);$index_holded_bills++){
$div_content.='<div class="small-2 columns"><a href="#" class="tiny button fixed success opened_bill_id" id="bill_id'.$holded_bills[$index_holded_bills]['id'].'" bill_id="'.$holded_bills[$index_holded_bills]['id'].'" >Bill id :'.$holded_bills[$index_holded_bills]['id'].' <br>Rate   : '.$holded_bills[$index_holded_bills]['amount'].'<br>Time : '.$holded_bills[$index_holded_bills]['bill_time'].'</a></div>';
}
$div_content.='</div></div></fieldset><a class="close-reveal-modal">&#215;</a>';
print $div_content;
exit();
}else{
print '<fieldset>
    <legend>No opened bills</legend></fieldset><a class="close-reveal-modal">&#215;</a>';
exit();
}
}


if(isset($_POST['bill_id'])){
$mybills=new Bills($myconnection);
$mybills->connection=($myconnection);
if(isset($_SESSION['bill_id']) && $_SESSION['bill_id']>0){
$mybills->id=$_SESSION['bill_id'];
$mybills->get_detail();
if($mybills->bill_status_id!=BILL_STATUS_PAID){
$mybills->bill_status_id=BILL_STATUS_HOLD;
$mybills->update();
}
}
$_SESSION['bill_id']=$_POST['bill_id'];
$mybills->id=$_SESSION['bill_id'];
$mybills->get_detail();
$last_bill_number=$mybills->get_last_bill_number();
$_SESSION['bill_number']=$last_bill_number+1;

$mybills->bill_status_id=BILL_STATUS_BILLED;
$mybills->update();
print '0';
exit();
}
?>
