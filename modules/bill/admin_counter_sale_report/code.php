<?php

//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}
$admin_sale_counter=new CounterReport($myconnection);
$admin_sale_counter->connection=($myconnection);

if(isset($_GET['counter_id'])){
	$admin_sale_counter->counter_id=$_GET['counter_id'];
}

if(isset($_GET['report_type'])){
if($_GET['report_type']=='1'){
if(isset($_GET['bill_date'])){
	$admin_sale_counter->bill_date=$_GET['bill_date'];

}else{
		$admin_sale_counter->bill_date=date('d-m-Y');
}
$array_sales_counter=$admin_sale_counter->datewise_sales_report();
}
else{
$admin_sale_counter->bill_date_from=date("Y-m-d H:i:s",strtotime($_GET['bill_date_from']));
$admin_sale_counter->bill_date_to= date("Y-m-d H:i:s",strtotime($_GET['bill_date_to']));
$array_sales_counter=$admin_sale_counter->periodwise_counter_sale_report();
}

}else{
$admin_sale_counter->bill_date=date('d-m-Y');
$array_sales_counter=$admin_sale_counter->datewise_sales_report();

}

if($array_sales_counter!=false){
	$count_sales_report=count($array_sales_counter);
}else{
	$count_sales_report=0;
}







?>
