<?php
//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}

	if( isset($_POST['item_id']) && isset($_POST['counter_id']) && isset($_POST['kitchen_id']) && isset($_POST['quantity'])){

		
		$mycounteritems=new CounterItem($myconnection);
		$mycounteritems->connection=($myconnection);
		$mycounteritems->item_id = $_POST['item_id'];
		$mycounteritems->counter_id = $_POST['counter_id'];
		$mycounteritems->kitchen_id = $_POST['kitchen_id'];
		$mycounteritems->date = date("Y-m-d");
		$mycounteritems->quantity = $_POST['quantity'];
		$check = $mycounteritems->update();	
		$_SESSION[SESSION_TITLE.'counter_id']= $_POST['counter_id'];
		if ($check == true){
			echo "Stock updated"; 
		}else{
			echo "Unable to update Data";
		}
		
		
		exit();
		
	}
	else{
		//donothing
	}
		
?>
