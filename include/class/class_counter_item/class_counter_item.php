<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class CounterItem{

	var $connection="";
	var $id  =gINVALID;
	var $counter_id = gINVALID;
	var $kitchen_id = gINVALID;	
	var $item_id = gINVALID; 
	var $date ="";
	var $quantity = 0;
	var $bill_item_total_quantity=0;

	function update(){
			if ( $this->id == "" || $this->id == gINVALID) {
			$strSQL = "INSERT INTO counter_items (item_id,counter_id,kitchen_id,date, quantity) VALUES ('";
			$strSQL .= addslashes(trim($this->item_id)) ."','";
			$strSQL .= addslashes(trim($this->counter_id)) . "','";
			$strSQL .= addslashes(trim($this->kitchen_id)) . "','";
			$strSQL .= addslashes(trim($this->date)) . "','";
			$strSQL .= addslashes(trim($this->quantity)) . "')";
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

          if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
        		}else{
              $this->error_number = 3;
              $this->error_description="Can't insert Counter Item ";
              return false;
                 		}
         	}
  	}

	function get_first_counter_id(){
	$counter_id='';
	$strSQL = "SELECT id FROM counters LIMIT 0,1 ";
			 
		$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		 if(mysql_num_rows($rsRES) > 0){
		
				$counter_id =mysql_result($rsRES,0,'id');
				return $counter_id;
			}


	}
	
	function get_item_quantity_today(){
	
		$available_quantity=0;
	
		$strSQL = "SELECT sum(quantity) as total_quantity FROM counter_items WHERE  DATE_FORMAT(date,'%Y-%m-%d') = '".date("Y-m-d")."' AND counter_id = '".$this->counter_id."'"." AND item_id = '".$this->item_id."'";
			 $strSQL1 = "SELECT sum(quantity) as bill_item_total_quantity FROM bill_items WHERE  created LIKE '".date("Y-m-d")."%' AND counter_id = '".$this->counter_id."'"." AND item_id = '".$this->item_id. "' AND bill_item_status_id='".BILL_ITEM_STATUS_ACTIVE."'";
	
		$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		$rsRES1	= mysql_query($strSQL1,$this->connection) or die(mysql_error().$strSQL1);
		 if(mysql_num_rows($rsRES) > 0){
		
				$this->quantity =mysql_result($rsRES,0,'total_quantity');
				$this->bill_item_total_quantity =mysql_result($rsRES1,0,'bill_item_total_quantity');
				$available_quantity=0;
				$available_quantity=($this->quantity)-($this->bill_item_total_quantity);
				return $available_quantity;
			}else{
				$this->quantity = 0;
				return false;
			}
		
		
	
	}	

    function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array(); 
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT id,counter_id,kitchen_id,item_id,date FROM counter_items WHERE 1";
		if($this->id!='' && $this->id!=gINVALID){
           $strSQL .= " AND id = '".addslashes(trim($this->id))."'";
      	 }
        if ($this->counter_id!='') { 
       	$strSQL .= " AND counter_id = '".addslashes(trim($this->counter_id))."'";  
        }
		
	
				
	 if ($this->kitchen_id!='') { 
        $strSQL .= " AND kitchen_id = '".addslashes(trim($this->kitchen_id))."'";  
        }
		
         $strSQL .= " GROUP BY counter_id ORDER BY id";
		

		$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
            } else {
				
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
                $this->total_records = mysql_num_rows($all_rs);
            }
			while (list ($id,$counter_id,$kitchen_id,$item_id,$date) = mysql_fetch_row($rsRES) ){
		          $limited_data[$i]["id"] = $id;
				  $limited_data[$i]["counter_id"]=$counter_id;
				  $limited_data[$i]["kitchen_id"]=$kitchen_id;
				  $limited_data[$i]["item_id"]=$item_id;
		          $limited_data[$i]["date"] = $date;
				  $i++;
		    }
        	return $limited_data; 
        }
        else{
        	return false;
        }
    }
	
	
	
	
	
	   
  }             

   
   
          
       
    
