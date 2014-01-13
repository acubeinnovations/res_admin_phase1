<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Packing {
    var $connection;
    var $id = gINVALID;
    var $name;
    var $rate = 0;


    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";


function get_id(){
    $strSQL = "SELECT * FROM packing  WHERE name = '".$this->name."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->name = mysql_result($rsRES,0,'name');
        $this->rate = mysql_result($rsRES,0,'rate');
        return $this->id;
    }else{
        $this->error_number = 1;
        $this->error_description="This Packing doesn't exist";
        return false;
    }
}

function get_detail(){
    $strSQL = "SELECT  * FROM packing  WHERE id = '".$this->id."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->name = mysql_result($rsRES,0,'name');
        $this->rate = mysql_result($rsRES,0,'rate');
        return true;
    }else{
        $this->error_number = 2;
        $this->error_description="This Packing doesn't exist";
        return false;
    }
}


function update(){
    if ( $this->id == "" || $this->id == gINVALID) {
		$strSQL = "INSERT INTO packing (name,rate) VALUES ('";
		$strSQL .= addslashes(trim($this->name)) ."','";
		$strSQL .= addslashes(trim($this->rate)) . "')";
		$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
		if ( mysql_affected_rows($this->connection) > 0 ) {
		  $this->id = mysql_insert_id();
		  return $this->id;
		}else{
		  $this->error_number = 3;
		  $this->error_description="Can't insert this Packing";
		  return false;
		}
    }elseif($this->id > 0 ) {
		$strSQL = "UPDATE packing SET name = '".addslashes(trim($this->name))."',";
		$strSQL .= "rate = ".addslashes(trim($this->rate))."";
		$strSQL .= " WHERE id = ".$this->id;
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) >= 0 ) {
                return true;
        }
        else{
            $this->error_number = 3;
            $this->error_description="Can't update this Packing";
            return false;
        }
    }
}
function delete(){
    $strSQL = "DELETE FROM packing WHERE id =".$this->id;
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
	if ( mysql_affected_rows($this->connection) > 0 ) {
			return true;
	}
	else{
		$this->error_description = "Can't Delete This Packing";
		return false;
	}
}

function get_list_array(){
    $cities = array();$i=0;

    $strSQL = "SELECT * FROM packing";
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id,$name,$rate) = mysql_fetch_row($rsRES) ){
            $packing[$i]["id"] =  $id;
            $packing[$i]["name"] = $name;
            $packing[$i]["rate"] = $rate;
            $i++;
        }
        return $packing;
    }else{
    $this->error_number = 4;
    $this->error_description="Can't list packing";
    return false;
    }
}

function get_array_rates(){
    $cities = array();$i=0;

    $strSQL = "SELECT id,rate FROM packing";
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id,$rate) = mysql_fetch_row($rsRES) ){
            $packing[$id] =  $rate;

            $i++;
        }
        return $packing;
    }else{
    $this->error_number = 4;
    $this->error_description="Can't list packing";
    return false;
    }
}


function get_array(){
    $cities = array();$i=0;

    $strSQL = "SELECT * FROM packing";
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id,$name,$rate) = mysql_fetch_row($rsRES) ){
            $packing[$id] =  $name;

            $i++;
        }
        return $packing;
    }else{
    $this->error_number = 4;
    $this->error_description="Can't list packing";
    return false;
    }
}


function get_list_array_bylimit($start_record = 0,$max_records = 25){

        $limited_data = array();
        $i=0;
        $str_condition = "";
        $strSQL = "SELECT id AS id,language_name,publish FROM packing ";
        if (trim($this->name) != "" ) {
            if (trim($str_condition) =="") {
                $str_condition = " name  LIKE '%" . $this->name . "%'" ;
            }else{
                $str_condition .= " AND name  LIKE '%" . $this->name . "%'" ;
            }
        }

        if (trim($str_condition) !="") {
            $strSQL .= " WHERE  " . $str_condition . "  ";
        }
        $strSQL .= "ORDER BY name";
        //taking limit  result of that in $rsRES .$start_record is starting record of a page.$max_records num of records in that page
        $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
        $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {

            } else {
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
                $this->total_records = mysql_num_rows($all_rs);
            }

            while ( $row = mysql_fetch_assoc($rsRES) ){
                $limited_data[$i]["id"] = $row["id"];
                $limited_data[$i]["name"] = $row["name"];
                $limited_data[$i]["rate"] = $row["rate"];
                $i++;
            }
            return $limited_data;
        }else{
            $this->error_number = 5;
            $this->error_description="Can't get limited data";
            return false;
        }
}
}
?>
