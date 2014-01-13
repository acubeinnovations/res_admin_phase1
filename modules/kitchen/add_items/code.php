<?php
//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}
$item=new Item($myconnection);
$item->connection=($myconnection);

$mycounter=new Counter($myconnection);
$mycounter->connection=($myconnection);

$item_category=new ItemCategory($myconnection);
$item_category->connection=($myconnection);

$counteritem=new CounterItem($myconnection);
$counteritem->connection=($myconnection);
if(!isset($_SESSION[SESSION_TITLE.'counter_id'])){
$counter_id=$counteritem->get_first_counter_id();
if($counter_id>0){
$_SESSION[SESSION_TITLE.'counter_id']=$counter_id;
}
}

$array_item_category=$item_category->get_list_array();
$get_item=$item->get_list_array();
if($get_item!=false){
	$count = count($get_item);
}

$item->item_category_id=1;
$get_item_sub=$item->get_items_by_category();

$getcounters=$mycounter->get_array();

if(isset($_POST['session_counter_id']) && $_POST['session_counter_id']>0){
$_SESSION[SESSION_TITLE.'counter_id']=$_POST['session_counter_id'];
print 1;
exit();
}

//$array_item=$item->get_array();

//$counteritem->counter_id=1;	
//$counteritem->item_id=4;	
//$get_quantity=$counteritem->get_item_quantity_today();
//print_r($get_quantity);
//print_r($_SESSION);
//echo $_SESSION[SESSION_TITLE.'kitchen_username'];
?>
