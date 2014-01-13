<?php

//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}
$item=new Item($myconnection);
$item->connection=($myconnection);

$item_category=new ItemCategory($myconnection);
$item_category->connection=($myconnection);

$array_category=$item_category->get_list_array();
//$array_item=$item->get_items_by_category();

if($array_category!=false){
	$count_category=count($array_category);
	$i=0;
	while($i<$count_category){
		$item->item_category_id=$array_category[$i]["id"];
		$array_category[$i]["items"]=$item->get_items_by_category();
	$i++;
	}

}else {
	$count_category=0;
}





//$array_item=$item->get_array();
?>
