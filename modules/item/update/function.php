<?php
function validate($myconnection)
{   $msg="";
	if(trim($_POST['name']=="")){
		$msg="Item is empty";
	}
	$item=new Item($myconnection);
	$item->connection=$myconnection;
	$item->id=$_POST['listitem'];
	$chk=$item->get_details();
	if($chk!=false){
		$_POST['listitem']=$item->name;
		$msg="Invalid Entry";
	}
	if(trim($msg)==""){
		return true;
	}else{
		return false;
	}

}
?>