<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class item{
	var $connection ="";
	var $id  =  gINVALID;
	var $name ="";
	var $item_category_id="";
	var $rate ="";
	var $tax= "";
	var $status_id="";
	var $from_master_kitchen="";
	var $packing_id = gINVALID;
	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

 function update()
		{
			if ( $this->id == "" || $this->id == gINVALID) {
			$strSQL = "INSERT INTO items (name,item_category_id,rate,tax,status_id,packing_id,from_master_kitchen) VALUES ('";
			$strSQL .= addslashes(trim($this->name)) ."','";
			$strSQL .= addslashes(trim($this->item_category_id)) . "','";
			$strSQL .= addslashes(trim($this->rate)) . "','";
			$strSQL .= addslashes(trim($this->tax)) . "','";
			$strSQL .= addslashes(trim($this->status_id)) . "','";
			$strSQL .= addslashes(trim($this->packing_id)) . "','";
			$strSQL .= addslashes(trim($this->from_master_kitchen)) . "')";
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

          if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
        		}else{
              $this->error_number = 3;
              $this->error_description="Can't insert Item ";
              return false;
                 		}
         	}

			elseif($this->id > 0 ) {
			$strSQL = "UPDATE items SET name = '".addslashes(trim($this->name))."',";
			$strSQL .= "item_category_id = '".addslashes(trim($this->item_category_id))."',";
			$strSQL .= "rate = '".addslashes(trim($this->rate))."',";
			$strSQL .= "tax = '".addslashes(trim($this->tax))."',";
		 	$strSQL .= "status_id = '".addslashes(trim($this->status_id))."',";
			$strSQL .= "packing_id = '".addslashes(trim($this->packing_id))."',";
		 	$strSQL .= "from_master_kitchen = '".addslashes(trim($this->from_master_kitchen))."'";
			$strSQL .= " WHERE id = ".$this->id;
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );

            if ( mysql_affected_rows($this->connection) >= 0 ) {
                   return true;
           	     }else{
               	 $this->error_number = 3;
              	 $this->error_description="Can't update Item";
               	return false;
           		 }
    		}
  	}

function get_details()
{
	if($this->id >0){
		$strSQL = "SELECT id,name,item_category_id,rate,tax,status_id,packing_id, from_master_kitchen FROM items WHERE id = '".$this->id."'";
		$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		 if(mysql_num_rows($rsRES) > 0){
			$user 	= mysql_fetch_assoc($rsRES);
			$this->id 		= $user['id'];
			$this->name 	= $user['name'];
			$this->item_category_id= $user['item_category_id'];
			$this->rate= $user['rate'];
			$this->tax= $user['tax'];
			$this->status_id = $user['status_id'];
			$this->packing_id = $user['packing_id'];
			$this->from_master_kitchen= $user['from_master_kitchen'];
			return true;
			}else{
			return false;
			}
			}else{
			return false;
			}
}

function get_list_array()
	{
		$items = array();$i=0;
		$strSQL = "SELECT  id,name,item_category_id,rate,tax,status_id, packing_id, from_master_kitchen FROM items";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
					{
					while ( list ($id,$name,$item_category_id,$rate,$tax,$status_id,$packing_id,$from_master_kitchen) = mysql_fetch_row($rsRES) ){
						$items[$i]["id"] =  $id;
						$items[$i]["name"] = $name;
						$items[$i]["item_category_id"] = $item_category_id;
						$items[$i]["rate"] = $rate;
						$items[$i]["tax"] = $tax;
						$items[$i]["status_id"] = $status_id;
						$items[$i]["packing_id"] = $packing_id;
						$items[$i]["from_master_kitchen"] = $from_master_kitchen;
						$i++;
           		 	}
            return $items;
       		}else{
			$this->error_number = 4;
			$this->error_description="Can't list item";
			return false;
    			}
		}




function get_array()

		{
        	$items = array();
			$i=0;
			$strSQL = "SELECT  id,name,item_category_id,rate,tax,from_master_kitchen FROM items";
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
			if ( mysql_num_rows($rsRES) > 0 )
				 {
					while ( list ($id,$name,$item_category_id,$rate,$tax) = mysql_fetch_row($rsRES) ){
						$items[$id] =  $name;

           		 	}
            		return $items;
       				}else{
					$this->error_number = 4;
					$this->error_description="Can't list item";
					return false;
    				}
			}



function get_items_by_category(){
		$items = array();
			$i=0;
			$strSQL = "SELECT  id,name,item_category_id,rate,tax,from_master_kitchen FROM items WHERE item_category_id=".$this->item_category_id;
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
			if ( mysql_num_rows($rsRES) > 0 )
				 {
					while ( list ($id,$name,$item_category_id,$rate,$tax,$from_master_kitchen) = mysql_fetch_row($rsRES) ){
						$items[$i]['id'] =  $id;
						$items[$i]['name'] =  $name;
						$items[$i]['item_category_id'] =$item_category_id;
						$items[$i]['rate'] =  $rate;
						$items[$i]['tax'] =  $tax;
						$items[$i]['from_master_kitchen'] =  $from_master_kitchen;

						$i++;
           		 	}
            		return $items;
       				}else{
					$this->error_number = 4;
					$this->error_description="Can't list item";
					return false;
    				}
			}

function get_array_item_rate(){
		$items = array();
			$i=0;
			$strSQL = "SELECT  id,rate FROM items";
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
			if ( mysql_num_rows($rsRES) > 0 )
				 {
					while ( list ($id,$rate) = mysql_fetch_row($rsRES) ){
						$items[$id] =  $rate;

           		 	}
            		return $items;
       				}else{
					$this->error_number = 4;
					$this->error_description="Can't list item";
					return false;
    				}



}

function get_array_item_packing_id(){
		$items_packing_id = array();
			$i=0;
			$strSQL = "SELECT  id,packing_id FROM items";
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
			if ( mysql_num_rows($rsRES) > 0 )
				 {
					while ( list ($id,$packing_id) = mysql_fetch_row($rsRES) ){
						$items_packing_id[$id] =  $packing_id;

           		 	}
            		return $items_packing_id;
       				}else{
					$this->error_number = 4;
					$this->error_description="Can't list item";
					return false;
    				}



}

function get_array_item_name(){
		$names = array();
			$i=0;
			$strSQL = "SELECT  id,name FROM items ";
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
			if ( mysql_num_rows($rsRES) > 0 )
				 {
					while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
						$names[$id] =  $name;

           		 	}
            		return $names;
       				}else{
					$this->error_number = 4;
					$this->error_description="Can't list item";
					return false;
    				}



}
function get_array_item_tax(){
		$taxes = array();
			$i=0;
			$strSQL = "SELECT  id,tax FROM items";
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
			if ( mysql_num_rows($rsRES) > 0 )
				 {
					while ( list ($id,$tax) = mysql_fetch_row($rsRES) ){
						$taxes[$id] =  $tax;

           		 	}
            		return $taxes;
       				}else{
					$this->error_number = 4;
					$this->error_description="Can't list tax";
					return false;
    				}



}


  function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $items = array();
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT id,name,item_category_id,rate,tax,status_id,packing_id, from_master_kitchen FROM items WHERE 1";
		if($this->id!='' && $this->id!=gINVALID){
           $strSQL .= " AND id = '".addslashes(trim($this->id))."'";
      	 }
        if ($this->name!='') {
       	$strSQL .= " AND name LIKE '%".addslashes(trim($this->name))."%'";
        }
		 if ($this->item_category_id!='') {
       	$strSQL .= " AND item_category_id LIKE '%".addslashes(trim($this->item_category_id))."%'";
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
			while ( list ($id,$name,$item_category_id,$rate,$tax,$status_id,$packing_id,$from_master_kitchen) = mysql_fetch_row($rsRES) ){
						$items[$i]["id"] =  $id;
						$items[$i]["name"] = $name;
						$items[$i]["item_category_id"] = $item_category_id;
						$items[$i]["rate"] = $rate;
						$items[$i]["tax"] = $tax;
						$items[$i]["status_id"] = $status_id;
						$items[$i]["packing_id"] = $packing_id;
						$items[$i]["from_master_kitchen"] = $from_master_kitchen;
						$i++;}
						 	return $items;
        }
        else{
        	return false;
        }
    }


}
?>
