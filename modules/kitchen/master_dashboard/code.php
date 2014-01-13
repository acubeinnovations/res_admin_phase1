<?php

//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}
$mybills=new Bills($myconnection);
$mybills->connection=($myconnection);

$mycounteritem= new CounterItem($myconnection);
$mycounteritem->connection=($myconnection);

$mybills->counter_id=$_SESSION[SESSION_TITLE.'counter_id']; 
$mybills->bill_status_id = BILL_STATUS_PAID;
$mybills->bill_kitchen_status_id = BILL_KITCHEN_STATUS_TO_KITCHEN;
$array_bills=$mycounteritem->get_list_array_bylimit();
$count=count($array_bills);

$myitems=new item($myconnection);
$myitems->connection=($myconnection);


$array_item = $myitems->get_array();


	$mybillitems=new BillItems($myconnection);
	$mybillitems->connection=($myconnection);

?>