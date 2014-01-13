<?php
//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}
	if(isset($_GET['id'])){
		$mybillitems=new BillItems($myconnection);
		$mybillitems->connection=($myconnection);
		$mybills=new Bills($myconnection);
		$mybills->connection=($myconnection);
		$mybillitems->bill_id=$_GET['id'];
		$mybillitems->update_kitchen_status();
		$mybills->id=$_GET['id'];
		$mybills->update_bill_kitchen_status();
		header('location:dashboard.php');
		exit();
		
	}
	else{
		//donothing
	}
		
?>