<?php
if(!defined('CHECK_INCLUDED')){;
	exit();
}	
	$admin_kitchen_report=new KitchenReport($myconnection);
	$admin_kitchen_report->connection=($myconnection);

	$my_counter =new Counter();
	$my_counter->connection=$myconnection;
	$array_counter=$my_counter->get_array();
	
	if(isset($_GET['listcounter'])){
		$admin_kitchen_report->counter_id=$_GET['listcounter'];

	}else if(isset($_GET['counter_id'])){
		$admin_kitchen_report->counter_id=$_GET['counter_id'];
    }

if(isset($_GET['report_type'])){
	if($_GET['report_type']=='1'){
		if(isset($_GET['date'])){
			$admin_kitchen_report->date=$_GET['date'];

		}else{
			 $admin_kitchen_report->date=date('d-m-Y');
		}
		if(isset($_GET['id'])){
			  $admin_kitchen_report->kitchen_id=$_GET['id'];
		}
			  $array_kitchen_report=$admin_kitchen_report->datewise_sales_report();
		}
	else{
		$admin_kitchen_report->from_date=date("Y-m-d H:i:s",strtotime($_GET['date_from']));
		$admin_kitchen_report->to_date= date("Y-m-d H:i:s",strtotime($_GET['date_to']));
		$array_kitchen_report=$admin_kitchen_report->periodwise_kitchen_sale_report();
		}

}else{
	$admin_kitchen_report->date=date('d-m-Y');
	$array_kitchen_report=$admin_kitchen_report->datewise_sales_report();

}

	if($array_kitchen_report!=false){
	$count_admin_kitchen=count($array_kitchen_report);
	}else{

	$count_admin_kitchen=0;
}

?>
