<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$packing_list=new Packing($myconnection);
$packing_list->connection=$myconnection;

if(isset($_SESSION['id'])){
	$packing_list->id=$_SESSION['id'];
	$packing_list->get_details();
	}else{}	
	
	
	$array_packing_list=$packing_list->get_list_array();
	if($array_packing_list!=false){
	$count=count($array_packing_list);
}


?>