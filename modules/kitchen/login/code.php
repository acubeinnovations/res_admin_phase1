<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
  if(isset($_SESSION[SESSION_TITLE.'kitchen_userid']) && $_SESSION[SESSION_TITLE.'kitchen_userid'] > 0 && isset($_SESSION[SESSION_TITLE.'kitchen_userid']) ) {
	if($_SESSION[SESSION_TITLE.'user_type'] == KITCHEN){
		header ("Location: dashboard.php");
	}elseif($_SESSION[SESSION_TITLE.'user_type'] == MASTER_KITCHEN){ 
		header ("Location: master_dashboard.php");
	}else{
		header ("Location: logout.php");
	}
	exit();
}

$login_error = "";
if (isset($_POST['submit'])){
      if ( $_POST['loginname'] == "" ){
      $login_error .= "Empty Login name";
}
if ( $_POST['password'] == "" ){
    $login_error .= "<br/> Empty Password";
}
if ( $login_error == "" ){
      $username = trim($_POST['loginname']);
      $password = md5(trim($_POST['password']));
      $myuser = new KitchenSession($username,$password,$myconnection);
          $chk = $myuser->login();
            if ($chk == true){
              $chk = $myuser->register_login();
			   //print_r($_SESSION);  exit();
			if($_SESSION[SESSION_TITLE.'user_type'] == KITCHEN){
				header ("Location: dashboard.php");
			}elseif($_SESSION[SESSION_TITLE.'user_type'] == MASTER_KITCHEN){ 
				header ("Location: master_dashboard.php");
			}else{
				header ("Location: logout.php");
			}
              exit();
            }else{
	         $login_error .= "Invalid Login name/Password.";
                 }
	     
       }
}



?>