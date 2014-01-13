<?php

//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}

if(isset($_POST['print']) || isset($_POST['payment']) && isset($_SESSION['bill_id'])){
$item_rate='';
$item_name='';
$bill_tot_amount='';
$item=new Item($myconnection);
$item->connection=($myconnection);
$item_name=$item->get_array_item_name();
$item_rate=$item->get_array_item_rate();
$mybills=new Bills($myconnection);
$mybills->connection=($myconnection);
$bill_status=$mybills->get_array_statuses();
$mybillitems=new BillItems($myconnection);
$mybillitems->connection=($myconnection);

if(isset($_SESSION['bill_id']) && $_SESSION['bill_id']>0){
$mybillitems->bill_id=$_SESSION['bill_id'];
$data_bill_items=$mybillitems->get_list_array_bylimit();

if(isset($_POST['payment'])){
$mybills->id=$_SESSION['bill_id'];
$mybills->get_detail();

$mybills->bill_status_id=BILL_STATUS_PAID;
$mybillitems->bill_id=$_SESSION['bill_id'];
$mybillitems->bill_item_status_id==BILL_ITEM_STATUS_ACTIVE;
$mybillitems->bill_kitchen_status_id==BILL_KITCHEN_STATUS_FINISHED;
$bill_amount=$mybillitems->get_tot_bill_amount_array();
$mybills->amount=$bill_amount;
$mybills->payment_date=CURRENT_DATETIME;
$mybills->update();

}
$mybills->id=$_SESSION['bill_id'];
$mybills->get_detail();
$bill_item_index=0;

$div_content='<table>
  <thead>
    <tr>
	  <th width="30">Slno</th>
      <th width="400">Item</th>
      <th width="200">Quantity</th>
      <th width="250">Rate</th>
      <th width="250">Total Amount</th>
    </tr>
  </thead>
 <tbody>';
$slno=1;
while($bill_item_index<count($data_bill_items)){
$div_content.='<tr>
	   <td>'.$slno.'</td>
      <td>'.$item_name[$data_bill_items[$bill_item_index]['item_id']].'</td>
      <td>'.$data_bill_items[$bill_item_index]['quantity'].'</td>
      <td>'.$item_rate[$data_bill_items[$bill_item_index]['item_id']].'</td>
      <td>'.$data_bill_items[$bill_item_index]['rate'].'</td>
    </tr>';
$bill_tot_amount=$bill_tot_amount+$data_bill_items[$bill_item_index]['rate'];
$bill_item_index++;
$slno++;
}
$div_content.='<tr>
	   <td></td>
      <td></td>
      <td></td>
      <td>STATUS:'.$bill_status[$mybills->bill_status_id].'</td>
      <td>Total :'.$bill_tot_amount.'</td>
    </tr></tbody>
</table><a href="#" class="tiny button  print_div" id= "print_div">PRINT</a><a class="close-reveal-modal">&#215;</a>';
print $div_content;
exit();
}else{
print 'Some errors occured.please try after some time.<a class="close-reveal-modal">&#215;</a>';
exit();
}
}else{
print 'No Bill Selected.<a class="close-reveal-modal">&#215;</a>';
exit();
}


?>
