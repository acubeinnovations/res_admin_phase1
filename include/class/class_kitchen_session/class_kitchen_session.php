<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class KitchenSession{

var $connection;
var $id=gINVALID;
var $counter_id="";
var $username;
var $password;
var $name;
var $image;
var $sec_que_id = gINVALID;
var $answer = "";
var $lastlogin;
var $last_bill_number="";
var $status_id="";
var $created = "";
var $updated = "";
var $record_user_id= gINVALID;

var $error= false;
var $error_number=gINVALID;
var $error_description="";

 function __construct($username,$password,$connection)
    {
			$this->username =$username;
			$this->password =$password;
			$this->connection =$connection;
    }



    function login()
    {
          $strSQL = "SELECT * FROM kitchen WHERE username = '".mysql_real_escape_string($this->username);
          $strSQL .= "' AND password='".$this->password."'";
          $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
          if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');
                $this->username = mysql_result($rsRES,0,'username');
                $this->password = mysql_result($rsRES,0,'password');
                $this->name = mysql_result($rsRES,0,'name');
                $this->counter_id = mysql_result($rsRES,0,'counter_id');
                $this->lastlogin = mysql_result($rsRES,0,'lastlogin');
				// if nit master fail
				if($this->counter_id > 0){
					return false;
				}else{
                	return true;
				}
      		}else{
            $this->error_description = "Login Failed";
            return false;
     		 }
    	}

    	 function register_login(){
           $_SESSION[SESSION_TITLE.'kitchen_userid'] = $this->id;
           $_SESSION[SESSION_TITLE.'kitchen_username'] = $this->username;
           $_SESSION[SESSION_TITLE.'counter_id'] = $this->counter_id;
           if($_SESSION[SESSION_TITLE.'counter_id']>0){
         	  $_SESSION[SESSION_TITLE.'user_type'] = KITCHEN;
       		}else{
       			 $_SESSION[SESSION_TITLE.'user_type'] = MASTER_KITCHEN;
       			

       			}


			$strSQL = "UPDATE kitchen SET lastlogin=now() WHERE id='".$this->id."'";
			mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            return true;
    }

function logout(){
        $chk = session_destroy();
        if ($chk == true){
            return true;
        	}else{
                return false;
       			 }
  }

function get_details()
{
	if($this->id >0){
		  $strSQL = "SELECT counter_id FROM kitchen WHERE id = '".$this->id."'";
		  $rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		 if(mysql_num_rows($rsRES) > 0){
			$user 	= mysql_fetch_assoc($rsRES);
			$this->counter_id 	= $user['counter_id'];

			return true;
			}else{
			return false;
			}			
			}else{
			return false;
			}
}

}
?>
