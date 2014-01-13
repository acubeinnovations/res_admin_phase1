<?php

//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}


if(isset($_POST['to_kitchen']) && $_SESSION['bill_id']>0){
$bill_amount='';
$mybills=new Bills($myconnection);
$mybills->connection=($myconnection);
$mybills->id=$_SESSION['bill_id'];
$mybills->bill_number=$_SESSION['bill_number'];
$mybillitems=new BillItems($myconnection);
$mybillitems->connection=($myconnection);
$mybillitems->bill_id=$_SESSION['bill_id'];
$bill_amount=$mybillitems->get_tot_bill_amount_array();
$mybillitems->bill_item_status_id='';
$mybillitems->bill_kitchen_status_id=BILL_KITCHEN_STATUS_TO_KITCHEN;
$mybillitems->update_statuses();
$mybills->get_detail();
$mybills->bill_kitchen_status_id=BILL_KITCHEN_STATUS_TO_KITCHEN;
$mybills->amount=$bill_amount;
$mybills->update();
print '1';
exit();
}

?>
