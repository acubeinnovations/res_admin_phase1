<?php

//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}


$item_category=new ItemCategory($myconnection);
$item_category->connection=($myconnection);
$array_item_category=$item_category->get_array();

$pagination = new Pagination(10);


$item=new Item($myconnection);
$item->connection=($myconnection);
$item->total_records = $pagination->total_records;
if(isset($_GET['submit'])){
	$item->name=$_GET['search'];
}else{

}


$array_items=$item->get_list_array_bylimit($pagination->start_record,$pagination->max_records);
if($array_items!=false){
	$count_items = count($array_items);
}else{
	$count_items=0;
}
$pagination->total_records = $item->total_records;
$pagination->paginate();
//$array_item=$item->get_array();
?>
