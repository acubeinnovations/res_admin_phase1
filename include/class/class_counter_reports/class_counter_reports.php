<?php


class CounterReport{


	var $connection="";
	var $bill_date  ="";
	var $counter_id =gINVALID;
	var $kitchen_id =gINVALID;
	var $item_id    =gINVALID;
	var $bill_status_id=2; //BILL_STATUS_PAID
	var $bill_item_status_id =1;//BILL_ITEM_STATUS_ACTIVE
	var $bill_date_from='';
	var $bill_date_to='';

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';





	function datewise_sales_report($start_record = 0,$max_records = 25){
        $limited_data = array(); 
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT DATE_FORMAT(B.bill_date,'%d/%m/%Y') AS bill_date_formated,B.bill_status_id,BI.item_id ,I.name AS item_name,BI.rate As rate, SUM(BI.quantity) AS quantity ,BI.counter_id FROM `bills` B,bill_items BI,items I WHERE  B.id=BI.bill_id AND BI.item_id=I.id ";

      
		
	  if ($this->counter_id>0 ) { 
       	$strSQL .= " AND B.counter_id = '".addslashes(trim($this->counter_id))."'";  
        }
				
	 if ($this->bill_date!='') { 
      	  $strSQL .= " AND  DATE_FORMAT(B.bill_date,'%d-%m-%Y')= '".addslashes(trim($this->bill_date))."'";  
        }
		
		 if ($this->bill_status_id!='') { 
      	  $strSQL .= " AND   B.bill_status_id= '".addslashes(trim($this->bill_status_id))."'";  
        }

         if ($this->bill_status_id!='') { 
      	  $strSQL .= " AND   BI.bill_item_status_id= '".addslashes(trim($this->bill_item_status_id))."'";  
        }
		
         $strSQL .= " GROUP BY BI.item_id,BI.counter_id";
		

		$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
            } else {
				
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
                $this->total_records = mysql_num_rows($all_rs);
            }
			while ($row = mysql_fetch_assoc($rsRES) ){
		          $limited_data[$i]["item_name"]=$row["item_name"];
		          $limited_data[$i]["rate"]=$row["rate"];
		          $limited_data[$i]["quantity"]=$row["quantity"];
		           $limited_data[$i]["amount"]=$row["quantity"]*$row["rate"];
				  $i++;
		    }
        	return $limited_data; 
        }
        else{
        	return false;
        }
    }


	
	function periodwise_counter_sale_report($start_record = 0,$max_records = 25){
       
        $limited_data = array(); 
        $i=0;
        $str_condition = "";
         $strSQL = "SELECT DATE_FORMAT(B.bill_date,'%d/%m/%Y') AS bill_date_formated,B.bill_status_id,BI.item_id ,I.name AS item_name,BI.rate As rate, SUM(BI.quantity) AS quantity ,BI.counter_id FROM `bills` B,bill_items BI,items I WHERE  B.id=BI.bill_id AND BI.item_id=I.id ";
             

    
    if($this->counter_id!=gINVALID){
            
   $str_condition .= " AND B.counter_id = '".addslashes(trim($this->counter_id))."'";  
    }
 
     if($this->bill_date_from!='' && $this->bill_date_to!=''){
        if($str_condition){
            $str_condition .= " AND";
            }
        $str_condition .= "  DATE_FORMAT(B.bill_date,'%Y-%m-%d') BETWEEN '".addslashes(trim($this->bill_date_from))."' AND '".addslashes(trim($this->bill_date_to))."'";
         }
	/*
     elseif ($this->from_date!='' && $this->to_date=='') {
        if($str_condition){
            $str_condition .= " AND";
            }
       $str_condition .= "  DATE_FORMAT(CI.date,'%d-%m-%Y')>= '".($this->from_date)."'";
     }
     elseif($this->from_date=='' && $this->to_date!=''){
        if($str_condition){
            $str_condition .= " AND";
            }
        $str_condition .= "  DATE_FORMAT(CI.date,'%d-%m-%Y')<= '".($this->to_date)."'";
     }*/
        
     if($str_condition!=''){
        $strSQL .= $str_condition;
     }

  $strSQL .= " GROUP BY BI.item_id,BI.counter_id";

		
        $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
        $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
            } else {
                
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
                $this->total_records = mysql_num_rows($all_rs);
            }
            while ($row = mysql_fetch_assoc($rsRES) ){
                    $limited_data[$i]["item_name"]=$row["item_name"];
		          $limited_data[$i]["rate"]=$row["rate"];
		          $limited_data[$i]["quantity"]=$row["quantity"];
		           $limited_data[$i]["amount"]=$row["quantity"]*$row["rate"];
                   
            
                  $i++;
            }


            return $limited_data; 
        }
        else{
            return false;
        }






    }










} 
?>
