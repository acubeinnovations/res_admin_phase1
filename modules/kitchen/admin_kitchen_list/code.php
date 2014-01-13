<?php

if(!defined('CHECK_INCLUDED')){
	exit();
}

$admin_kitchen = new Kitchen($myconnection);
$admin_kitchen->connection=$myconnection;


$array_kitchen=$admin_kitchen->get_list_array_bylimit();
if($array_kitchen!=false){
	$count=count($array_kitchen);
}else{}

?>