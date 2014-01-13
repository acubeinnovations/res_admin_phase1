<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Counter{

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
              $strSQL = "INSERT INTO counters(username,password,name,registrationdate,securityquestion_id,answer,created) ";
              $strSQL .= "VALUES ('".addslashes(trim($this->username))."','";
              $strSQL .= md5(addslashes(trim($this->password)))."','";
              $strSQL .= addslashes(trim($this->name))."',";
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
		    }elseif($this->id > 0 ) {
        	
            $strSQL = "UPDATE counters SET ";
            $strSQL .= "name = '".addslashes(trim($this->name))."',";
            $strSQL .= "securityquestion_id = '".addslashes(trim($this->securityquestion_id))."',";
            $strSQL .= "answer = '".addslashes(trim($this->answer))."',";
            $strSQL .= "updated = now(), ";
			       $strSQL .= "registrationdate = '".addslashes(trim($this->registrationdate))."'";
            $strSQL .= " WHERE id = ".$this->id;
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }else{
              $this->error_description = "Update data Failed";
              return false;
                }
            
        }
}


function change_password($newpasswd,$oldpasswd){
      $strSQL = "UPDATE counters SET ";
      $strSQL .= "password = '" .mysql_real_escape_string($newpasswd). "' ";
      $strSQL .= "WHERE id = '" . $this->id . "' AND password = '".mysql_real_escape_string($oldpasswd)."'";
      $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
      if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
             }else{
                return false;
                $this->error_description = "Incorrect password";       
                 }    
                    
    	}

 function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array();
        $i=0;
        $str_condition = "";
        $strSQL = "SELECT id,username,name,lastlogin,status_id FROM counters WHERE 1 ";
         if($this->id!='' && $this->id!=gINVALID){
           $strSQL .= " AND id = '".addslashes(trim($this->id))."'";
         }
     
      $strSQL .= "ORDER BY id";
      $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
      $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);
    if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id,$username,$name,$lastlogin,$status_id) = mysql_fetch_row($rsRES) ){
              $limited_data[$i]["id"] = $id;
              $limited_data[$i]["username"] = $username;
              $limited_data[$i]["name"] = $name;
              $limited_data[$i]["lastlogin"] = date('m/d/Y H:i:s', strtotime($lastlogin));
               $limited_data[$i]["status_id"] = $status_id;
              $i++;
          }return $limited_data;
          }else{
          return false;
           }
       
 }
 
 
function get_array(){
       $users = array();
       $strSQL = "SELECT id,username FROM counters ORDER BY username";
       $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
       if ( mysql_num_rows($rsRES) > 0 ){
       while ( list ($id,$username) = mysql_fetch_row($rsRES) ){
         $users[$id] = $username;
       }
       return $users;
       }
       else{
       $this->error_number = 4;
       $this->error_description="Can't list users";
       return false;
       }
} 
 
 
    
  }             

   
   
          
       
    
