<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Kitchen{

	var $connection="";
	var $id  =gINVALID;
	var $username;
    var $password;
    var $emailid;
    var $registrationdate;
    var $lastlogin;
    var $securityquestion_id = gINVALID;
    var $answer = "";

    var $created = "";
    var $updated = "";
    var $record_user_id= gINVALID;

    var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";


     function update(){

        if ( $this->id == "" || $this->id == gINVALID) {
              $strSQL = "INSERT INTO kitchen(username,password,emailid,registrationdate,securityquestion_id,answer,created) ";
              $strSQL .= "VALUES ('".addslashes(trim($this->username))."','";
              $strSQL .= md5(addslashes(trim($this->password)))."','";
              $strSQL .= addslashes(trim($this->emailid))."',";
              $strSQL .= "now(),";
              $strSQL .= addslashes(trim($this->securityquestion_id)).",'";
              $strSQL .= addslashes(trim($this->answer))."',";
              $strSQL .= "now())";

              $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
              if ( mysql_affected_rows($this->connection) > 0 ){
                    $this->id = mysql_insert_id();;
                    return true;
                }
              else{
                $this->error_description = "Insert data Failed";
                return false;
              	}
			}
        	elseif($this->id > 0 ) {
            $strSQL = "UPDATE kitchen SET ";
            $strSQL .= "emailid = '".addslashes(trim($this->emailid))."',";
            $strSQL .= "securityquestion_id = '".addslashes(trim($this->securityquestion_id))."',";
            $strSQL .= "answer = '".addslashes(trim($this->answer))."',";
            $strSQL .= "updated = now(), ";
			$strSQL .= "record_user_id = '".addslashes(trim($this->record_user_id))."'";
            $strSQL .= " WHERE id = ".$this->id;
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_description = "Update data Failed";
                return false;
            }
        }
}


function change_password($newpasswd,$oldpasswd){
                    $strSQL = "UPDATE kitchen SET ";
                    $strSQL .= "password = '" .mysql_real_escape_string($newpasswd). "' ";
                    $strSQL .= "WHERE id = '" . $this->id . "' AND password = '".mysql_real_escape_string($oldpasswd)."'";
                    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
                    if ( mysql_affected_rows($this->connection) > 0 ) {
                        return true;
                    }
                    else{
                        return false;
                        $this->error_description = "Incorrect password";
                    }
    	}


 function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array();
        $i=0;
        $str_condition = "";
        $strSQL = "SELECT id,username,name,lastlogin,status_id ,counter_id FROM kitchen WHERE 1 ";
         if($this->id!='' && $this->id!=gINVALID){
           $strSQL .= " AND id = '".addslashes(trim($this->id))."'";
         }
     
      $strSQL .= "ORDER BY id";
      $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
      $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);
    if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id,$username,$name,$lastlogin,$status_id,$counter_id) = mysql_fetch_row($rsRES) ){
              $limited_data[$i]["id"] = $id;
              $limited_data[$i]["username"] = $username;
              $limited_data[$i]["name"] = $name;
              $limited_data[$i]["lastlogin"] = date('m/d/Y H:i:s', strtotime($lastlogin));
               $limited_data[$i]["status_id"] = $status_id;
               $limited_data[$i]["counter_id"] = $counter_id;
              $i++;
          }return $limited_data;
          }else{
          return false;
           }
       
 }
        

}