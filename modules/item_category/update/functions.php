<?php

function validate($myconnection)
{  
	$msg="";
	if(trim($_POST['name'])==""){
		$msg.="Name field is empty";
	}
	
	$parent_category = New ItemCategory($myconnection);
	$parent_category->connection=$myconnection;
	$parent_category->id=$_POST['lstitem_category'];
	$chk=$parent_category->get_details();
	if($chk!=false){
		if($_POST['name']==$parent_category->name){
			$msg.="Invalid Entry";
		}
	}

	if(trim($msg)==""){
		return true;
	}else{
		return false;
	}

}

?>