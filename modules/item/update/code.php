<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$item=new item($myconnection);
$item->connection=$myconnection;

$item_category=new ItemCategory($myconnection);
$item_category->connection=$myconnection;

$arr_item_category=$item_category->get_list_array();
if($arr_item_category==false){
	$arr_item_category=array();
}


$packing=new Packing($myconnection);
$packing->connection=$myconnection;

$arr_packing=$packing->get_list_array();
if($arr_packing==false){
	$arr_packing=array();
}


$msg="";

if(isset($_POST['submit']) && $_POST['submit']=='submit'){
		if(isset($_POST['chkmaster'])){
		$chkvalue=$_POST['chkmaster'];
		}else{
		$chkvalue=0;
		}

	$item->id= $_POST['h_id'];
	$item->name= $_POST['name'];
	$item->rate = $_POST['rate'];
	$item->tax =  $_POST['tax'];

	$item->item_category_id=$_POST['lisitemcategory'];
	$item->status_id= $_POST['lststatus'];
	$item->packing_id= $_POST['lstpacking'];

	$item->from_master_kitchen= $chkvalue;
	$item->update();
	header("location: items.php");
	exit();
	}else{
	$msg="Invalid Entry";

}

	if(isset($_GET['id'])){
		$item->id=$_GET['id'];
		$item->get_details();
	}



?>
