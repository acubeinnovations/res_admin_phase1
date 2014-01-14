<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Sync {
    var $connection;
    var $id 			= gINVALID;
	var $query= "";
	

    var $error 			= false;
    var $error_number	= gINVALID;
    var $error_description= "";
    //for pagination
    var $total_records	= "";




    function sync(){
        if($this->query!=''){
		$strSQL =$this->query;
		    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
              if ( mysql_affected_rows($this->connection) > 0 ){
                    $this->id = mysql_insert_id();
					return true;
              }
              else{
                $this->error_description = "Sychronizing failed.Please Try Again.";
                return false;
              }

        }

    }

	
}
?>
