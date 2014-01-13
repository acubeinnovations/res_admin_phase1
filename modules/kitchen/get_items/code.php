<?php
//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}

	if(isset($_POST['item_id'])){

		$myitems=new item($myconnection);
		$myitems->connection=($myconnection);
		$myitems->id=$_POST['item_id'];
		$myitems->get_details();
	
	
		$mycounteritems=new CounterItem($myconnection);
		$mycounteritems->connection=($myconnection);
		$mycounteritems->item_id = $_POST['item_id'];
		$mycounteritems->counter_id = $_SESSION[SESSION_TITLE.'counter_id'];
		$available_quantity=$mycounteritems->get_item_quantity_today();	
		echo $myitems->id."!@#$%*".$myitems->name."!@#$%*".$mycounteritems->quantity."!@#$%*".$available_quantity;
		
		exit();
		
	}
	else{
		//donothing
	}
		
?>