<?php
//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}
	if(isset($_GET['id'])){
		$mybillitems=new BillItems($myconnection);
		$mybillitems->connection=($myconnection);
		$mybillitems->id=$_GET['id'];
		$mybillitems->update_kitchen_status();

		header('location:dashboard.php');
		exit();
		
	}
	else{
		//donothing
	}
		
?>