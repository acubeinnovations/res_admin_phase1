<?php
if(!defined('CHECK_INCLUDED')){
		exit();
}
$mysync=new Sync($myconnection);
$mysync->connection=($myconnection);
/*
if(isset($_POST['query'])){
$mysync->query=$_POST['query'];
$mysync->sync();
if($chk==true){
print 1;
}else{
print 0;
}
}
*/

if(isset($_FILES["sql"]["size"]) && $_FILES["sql"]["size"] > 0) { 
 $sqlfile=$_FILES["sql"]["tmp_name"];
		/*
		$folder_name="sync-".date('Y-m-d H:i:s');
		mkdir(ROOT_PATH.'files/DB/'.$folder_name, 0777);
		
		$name = $_FILES["sql"]["name"];
		move_uploaded_file($sqlfile, ROOT_PATH.'files/DB/'.$folder_name.'/'.$name);
	*/
		$delimiter="!@#$%*";
		$handle = fopen($sqlfile,"r");
	 	while ($line= fgets ($handle)) {

		$data=explode($delimiter,$line);
		for($index_sync=0;$index_sync<count($data);$index_sync++){
		$mysync->query=$data[$index_sync];
		$mysync->sync();
		if($chk==true){
		}
		}
		}
}



?>
