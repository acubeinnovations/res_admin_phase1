<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
	$msg="";
	$item_category =new ItemCategory($myconnection);
	$item_category->connection=$myconnection;

	
	$arr_item_category=$item_category->get_list_array();
	if($arr_item_category==false){
	$arr_item_category=array();
	}

	if(isset($_POST['submit']) && $_POST['submit']=="submit" ){
 	$chk=validate($myconnection);//echo $chk;
 	if($chk==true){
 	$item_category->id=$_POST['h_id'];
 	$item_category->name=$_POST['name'];
	$item_category->status_id=$_POST['lststatus'];
	$item_category->parent_id=$_POST['lstitem_category'];
	$item_category->update();
	header("location: item_categories.php");
	exit();
	 }else{
	 $msg="Invalid Entry";

 }


}


if(isset($_GET['id'])){
	$item_category->id=$_GET['id'];
	$item_category->get_details();
}


?>
