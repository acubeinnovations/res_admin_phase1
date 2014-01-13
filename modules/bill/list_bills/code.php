<?php

//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}
$mybills=new Bills($myconnection);
$mybills->connection=($myconnection);
$bill_statuses=$mybills->get_array_statuses();

$bills='';
$mybills->counter_id=$_SESSION[SESSION_TITLE.'counter_userid'];
$mybills->bill_status_id=BILL_STATUS_PAID;
if(isset($_POST["bill_date"])) {
	$mybills->bill_date = $_POST["bill_date"];
}else{
	$mybills->bill_date = date("d-m-Y");
}
$bills=$mybills->get_list_array_bylimit();

	if($bills==false) {
		$billcount=0;
	}else{
		$billcount=count($bills);
	}
					
?>
