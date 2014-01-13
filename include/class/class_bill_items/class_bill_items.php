<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class BillItems {
    var $connection;
    var $id 			= gINVALID;
    var $bill_id		= "";
	 var $counter_id		= "";
    var $item_id 	= "";
    var $quantity		= "";
    var $rate 	= "";
    var $tax		= "";
    var $discount			= "";
    var $bill_item_status_id = "";
	var $bill_kitchen_status_id		= "";
    var $created 	= "";
    var $updated	= "";
   	
    var $error 			= false;
    var $error_number	= gINVALID;
    var $error_description= "";
    //for pagination
    var $total_records	= "";


    function __construct()
    {

    }
function set_defaults(){
$this->amount=0;
$this->credit=0;
$this->commision=0;
$this->discount=0;
$this->valid_from=gINVALID;
$this->valid_to=gINVALID;
$this->voucher_bill_item_status_id=gINVALID;
$this->number_of_vouchers=gINVALID;
$this->bill_kitchen_status_id= "";
}


    function update(){
        if ( $this->id == "" || $this->id == gINVALID) {
			$created=CURRENT_DATETIME;
		
              $strSQL = "INSERT INTO bill_items (bill_id,counter_id,item_id, quantity,rate,tax,discount,bill_item_status_id,bill_kitchen_status_id,created,updated) ";
              $strSQL .= "VALUES ('".addslashes(trim($this->bill_id))."','";
			  $strSQL .= addslashes(trim($this->counter_id))."','";
				$strSQL .= addslashes(trim($this->item_id))."','";
              $strSQL .= addslashes(trim($this->quantity))."','";
              $strSQL .= addslashes(trim($this->rate))."','";
              $strSQL .= addslashes(trim($this->tax))."','";
			  $strSQL .= addslashes(trim($this->discount))."','";
			  $strSQL .= addslashes(trim($this->bill_item_status_id))."','";
			  $strSQL .= addslashes(trim($this->bill_kitchen_status_id))."','";
			  $strSQL .= addslashes(trim($created))."','";
			  $strSQL .= addslashes(trim($this->updated))."')";
             
			 //try{
				
		      $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
			// throw new Exception((mysql_error(). $strSQL ));
				 
				//}
				//catch(Exception $e){
				
				//return false;
				//}
              if ( mysql_affected_rows($this->connection) > 0 ){
                    $this->id = mysql_insert_id();
		    		return true;
              }
              else{
                $this->error_description = "Voucher bill adding failed.Please Try Again.";
                return false;
              }

        }
        elseif($this->id > 0 ) {
        $strSQL = "UPDATE bill_items SET ";
	    if($this->rate!=''){
	    $strSQL .= "rate = '".addslashes(trim($this->rate))."',";
	    }
		if($this->quantity!=''){
            $strSQL .= "quantity = '".addslashes(trim($this->quantity))."',";
		}
		if($this->tax!=''){
            $strSQL .= "tax = '".addslashes(trim($this->tax))."',";
	     }
		if($this->discount!=''){
	    	$strSQL .= "discount = '".addslashes(trim($this->discount))."',";
		}
		if($this->bill_item_status_id!=''){
	    $strSQL .= "bill_item_status_id = '".$this->bill_item_status_id."',";
	    }
		if($this->packing_rate!=''){
	    $strSQL .= "packing_rate = '".$this->packing_rate."',";
	    }
		if($this->packing_quantity!=''){
	    $strSQL .= "packing_quantity = '".$this->packing_quantity."',";
	    }
		if($this->packing_amount!=''){
	    $strSQL .= "packing_amount = '".$this->packing_amount."',";
	    }
		if($this->packing_id!=''){
	    $strSQL .= "packing_id = '".$this->packing_id."',";
	    }
		if($this->bill_kitchen_status_id!=''){
	    $strSQL .= "bill_kitchen_status_id = '".addslashes(trim($this->bill_kitchen_status_id))."',";
	    }
		if($this->updated!=''){
            $strSQL .= "updated = '".addslashes(trim($this->updated))."'";
		}
					
	    $strSQL .= " WHERE id = ".$this->id;
		
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) >= 0 ) {
		$this->error_description = "Updated data Successfuly";                    
		return true;
            }
        else{
             $this->error_description = "Update data Failed";
             return false;
            }
        }

    }



    function exist(){
        $strSQL = "SELECT id FROM bill_items WHERE bill_id = '".$this->bill_id."'"; 
  		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
		$this->id = mysql_result($rsRES,0,'id');
            return true;
        }
        else{
            return false;
        }
    }



    function get_detail(){
		$strcondition='';
        $strSQL = "SELECT * FROM bill_items WHERE id = '".$this->id."'";//
		
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');
                $this->bill_id = mysql_result($rsRES,0,'bill_id');
				$this->counter_id = mysql_result($rsRES,0,'counter_id');
                $this->item_id= mysql_result($rsRES,0,'item_id');
				$this->discount = mysql_result($rsRES,0,'discount');
				$this->packing_rate = mysql_result($rsRES,0,'packing_rate');
				$this->packing_quantity = mysql_result($rsRES,0,'packing_quantity');
				$this->packing_amount = mysql_result($rsRES,0,'packing_amount');
				$this->packing_id = mysql_result($rsRES,0,'packing_id');
                $this->rate= mysql_result($rsRES,0,'rate');
				$this->quantity = mysql_result($rsRES,0,'quantity');
                $this->tax = mysql_result($rsRES,0,'tax');
                $this->created = mysql_result($rsRES,0,'created');
		        $this->updated = mysql_result($rsRES,0,'updated');
				$this->bill_item_status_id = mysql_result($rsRES,0,'bill_item_status_id');
				$this->bill_kitchen_status_id= mysql_result($rsRES,0,'bill_kitchen_status_id');
               
                return true;
        }
        else{
            return false;
        }
    }




function get_array_bill_item_status_id(){
        $bill_items_statuses = array();
        $strSQL = "SELECT id,name FROM bill_item_statuses ORDER BY id";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
          $bill_items_statuses[$id] = $name;
        }
        return $bill_items_statuses;
        }
        else{
        $this->error_number = 4;
        $this->error_description="Can't list bill_items";
        return false;
        }
}




 
    function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array(); 
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT id,item_id,bill_id,rate,tax,quantity,bill_item_status_id,bill_kitchen_status_id,packing_quantity FROM bill_items WHERE 1";
		if($this->id!='' && $this->id!=gINVALID){
           $strSQL .= " AND id = '".addslashes(trim($this->id))."'";
      	 }
        if ($this->bill_id!='') { 
       	$strSQL .= " AND bill_id = '".addslashes(trim($this->bill_id))."'";  
        }
		
	
				
	 if ($this->bill_item_status_id!='') { 
        $strSQL .= " AND bill_item_status_id = '".addslashes(trim($this->bill_item_status_id))."'";  
        }
		
         $strSQL .= " ORDER BY id";
		

		$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
            } else {
				
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
                $this->total_records = mysql_num_rows($all_rs);
            }
			while (list ($id,$item_id,$bill_id,$rate,$tax,$quantity,$bill_item_status_id,$bill_kitchen_status_id,$packing_quantity) = mysql_fetch_row($rsRES) ){
		          $limited_data[$i]["id"] = $id;
					$limited_data[$i]["item_id"]=$item_id;
				  $limited_data[$i]["bill_id"]=$bill_id;
					$limited_data[$i]["bill_kitchen_status_id"]=$bill_kitchen_status_id;
		          $limited_data[$i]["rate"] = $rate;
		          $limited_data[$i]["tax"] = $tax;
				  $limited_data[$i]["quantity"] = $quantity;
				  $limited_data[$i]["bill_item_status_id"]=$bill_item_status_id;
				  $limited_data[$i]["packing_quantity"]=$packing_quantity;
				  $i++;
		    }
        	return $limited_data;
        }
        else{
        	return false;
        }
    }

function update_statuses(){
    	
        $strSQL = " UPDATE bill_items SET updated='".CURRENT_DATETIME."'";
		if($this->bill_item_status_id!=''){	
		$strSQL.=", bill_item_status_id='".$this->bill_item_status_id."'";
		}
		if($this->bill_kitchen_status_id!=''){	
		$strSQL.=", bill_kitchen_status_id='".$this->bill_kitchen_status_id."'";
		}
	
		$strSQL.=" WHERE bill_id = '".$this->bill_id."' AND bill_item_status_id='".BILL_ITEM_STATUS_ACTIVE."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't update status";
            return  false;
        }
    }



function delete(){
    if($this->id > 0 ) {
        $strSQL = " DELETE FROM bill_items WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't delete this User";
            return  false;
        }
    }
}
function get_tot_packing_amount(){
$packing_amounts=0;
$strSQL = "SELECT packing_amount FROM bill_items WHERE bill_id = '".$this->bill_id."' AND bill_item_status_id='".BILL_ITEM_STATUS_ACTIVE."'"; 
	  		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
          if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($packing_amount) = mysql_fetch_row($rsRES) ){
          $packing_amounts=$packing_amounts+$packing_amount;
		
        }
	 return $packing_amounts;
}

}



function bill_item_check(){
		$strSQL = "SELECT id FROM bill_items WHERE bill_id = '".$this->bill_id."' AND item_id =".$this->item_id; 
  		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
		$this->id = mysql_result($rsRES,0,'id');
        return true;
        }
        else{
            return false;
        }

}

function update_kitchen_status(){
    	
        $strSQL = " UPDATE bill_items SET bill_kitchen_status_id='".BILL_KITCHEN_STATUS_FINISHED."' WHERE id='".$this->id."'";
		//echo $strSQL; exit();
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't update status";
            return  false;
        }
    }
function get_tot_tax(){
$taxes=0;
$strSQL = "SELECT tax FROM bill_items WHERE bill_id = '".$this->bill_id."' AND bill_item_status_id='".BILL_ITEM_STATUS_ACTIVE."'"; 
	  		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
          if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($tax) = mysql_fetch_row($rsRES) ){
          $taxes=$taxes+$tax;
		
        }
	 return $taxes;
}
}
function get_tot_amount(){
$rate_array='';
$strSQL = "SELECT rate FROM bill_items WHERE bill_id = '".$this->bill_id."' AND bill_item_status_id='".BILL_ITEM_STATUS_ACTIVE."'"; 
	
  		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
          if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($rate) = mysql_fetch_row($rsRES) ){
          $rate_array=$rate_array+$rate;
		
        }
        return $rate_array;

}
}
function get_tot_bill_amount_array(){
	$rate_array=0;
	$i=0;
	$tax=0;
    $packing_charge=0;
	$discount=0;
	$Strcondition='';
	$strSQL='';
	$strSQL_bill = "SELECT tax,discount FROM bills WHERE id = '".$this->bill_id."' AND (bill_status_id='".BILL_STATUS_BILLED."'  OR bill_status_id='".BILL_STATUS_PAID."')";
	$rsRES_bill = mysql_query($strSQL_bill,$this->connection) or die(mysql_error(). $strSQL_bill );
          if ( mysql_num_rows($rsRES_bill) > 0 ){
        $tax=mysql_result($rsRES_bill,0,'tax');
		$discount=mysql_result($rsRES_bill,0,'discount');
        
        }
	$strSQL = "SELECT rate,packing_amount FROM bill_items WHERE bill_id = '".$this->bill_id."' AND bill_item_status_id='".BILL_ITEM_STATUS_ACTIVE."'"; 
	if($this->bill_kitchen_status_id==BILL_KITCHEN_STATUS_FINISHED ){
	$Strcondition=" AND bill_kitchen_status_id=".$this->bill_kitchen_status_id;
	}
	if($Strcondition!=''){
	$strSQL.=$Strcondition;
	}
  		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
          if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($rate,$packing_rate) = mysql_fetch_row($rsRES) ){
          $rate_array=$rate_array+$rate;
			$packing_charge=$packing_charge+$packing_rate;
        }
		$rate_array=($rate_array+$tax+$packing_charge)-$discount;
        return $rate_array;
        }
        else{
            return false;
        }

}
}
?>
