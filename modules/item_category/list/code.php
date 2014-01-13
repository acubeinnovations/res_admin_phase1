<?php

//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}

$itemcategory = new Itemcategory($myconnection);
$itemcategory->connection=($myconnection);
$array_category=$itemcategory->get_array();

$category_pagination = new Pagination(10);

$itemcategory->total_records=$category_pagination->total_records;
if(isset($_GET['submit'])){
$itemcategory->name=$_GET['search'];
}else{
}

$array_item_categories=$itemcategory->get_list_array_bylimit($category_pagination->start_record,$category_pagination->max_records);
if($array_item_categories!=false){
$count=count($array_item_categories);
}
$category_pagination->total_records = $itemcategory->total_records;
$category_pagination->paginate();

?>