<?php

//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}
$item=new Item($myconnection);
$item->connection=($myconnection);

$item_category=new ItemCategory($myconnection);
$item_category->connection=($myconnection);

$array_item_category=$item_category->get_list_array();
$get_item=$item->get_list_array();
if($get_item!=false){
	$count = count($get_item);
}
$bill_status='';
if(isset($_SESSION['bill_id']) && $_SESSION['bill_id']>0){
$mybills=new Bills($myconnection);
$mybills->connection=($myconnection);
$mybills->id=$_SESSION['bill_id'];
$mybills->exist();
$bill_status=$mybills->bill_status_id;
}

if(isset($_POST['bill_number'])){
if(isset($_SESSION['bill_number']) && $_SESSION['bill_number']>0){
print $_SESSION['bill_number'];
exit();
}else{
print '0';
exit();
}
}

$item->item_category_id=1;
$get_item_sub=$item->get_items_by_category();
//$array_item=$item->get_array();

if(isset($_POST['session'])){
if(isset($_SESSION['bill_id']) && $_SESSION['bill_id']>0){
print 1;
exit();
}else{
print 0;

exit();
}
}

?>
