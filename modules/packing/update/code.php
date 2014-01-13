<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$packing = new Packing($myconnection);
$packing->connection=$myconnection; 

$msg="";

if(isset($_POST['submit']) && $_POST['submit']=='submit'){
	$packing->id=$_POST['h_id'];
	$packing->name=$_POST['name'];
	$packing->rate=$_POST['rate'];
	$packing->update();
	header("Location:packing.php");
	
	}else{
	$msg="Invalid Entry";
	}

if(isset($_GET['id'])){
		$packing->id=$_GET['id'];
		$packing->get_detail();
	}




?>