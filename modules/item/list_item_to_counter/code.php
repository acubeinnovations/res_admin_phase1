<?php

//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}
$item=new Item($myconnection);
$item->connection=($myconnection);

$item_category=new ItemCategory($myconnection);
$item_category->connection=($myconnection);

if(isset($_POST['item_id'])){
$item->item_category_id=$_POST['item_id'];
$get_item=$item->get_items_by_category();
}else{

}

if($get_item!=false){
	$count = count($get_item);
	$item_index=0;
	$div_content='';
	while($item_index<$count){
	$div_content.='<a href="#" class="tiny button items " item_id="'.$get_item[$item_index]["id"].'" item_details="'.$get_item[$item_index]["name"].'/'.$get_item[$item_index]["rate"].'/'.$get_item[$item_index]["tax"].'"><font size="3"><b>'.$get_item[$item_index]["name"].'<br>  Rs .'.$get_item[$item_index]["rate"].'</b></font></a>&nbsp;';
	$item_index++;
	 } 

print $div_content;
exit();
}else{
	print '1';
	exit();
}

print_r($get_item);
?>
