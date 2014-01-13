<?php
//User Types
define("ADMINISTRATOR", 999);
define("COUNTER", 100);
define("KITCHEN", 200);
define("MASTER_KITCHEN", 300);

// Status
define("STATUS_ACTIVE", 1);
define("STATUS_INACTIVE", 2);


$g_ARRAY_LIST_STATUS = array();
$g_ARRAY_LIST_STATUS[0]["id"] = 1;
$g_ARRAY_LIST_STATUS[0]["name"] = "Active";
$g_ARRAY_LIST_STATUS[1]["id"] = 2;
$g_ARRAY_LIST_STATUS[1]["name"] = "Inactive";



$g_ARRAY_STATUS = array();
$g_ARRAY_STATUS[1] = "Active";
$g_ARRAY_STATUS[2] = "Inactive";


//timezone
date_default_timezone_set('Asia/Kolkata');
define("CURRENT_DATETIME",date('Y-m-d H:i:s'));
define("CURRENT_DATE",date('Y-m-d'));
define("CURRENT_TIME",date('H:i:s'));

GLOBAL $g_msg_unauthorized_request;
$g_msg_unauthorized_request = "<strong>Unauthorized Page Request</strong><br/> <br/> You are not authorized to access this page. This attempt will be reported to the system Administrator. ";

GLOBAL $g_msg_unauthorized_request_redirect_page;
$g_msg_unauthorized_request_redirect_page = "index.php";

GLOBAL $g_obj_select_default_text;
$g_obj_select_default_text = "Choose from list..";


//Email
define("EMAIL_NO_REPLY", "noreply@restaurant_admin.local");
define("EMAIL_INFO", "noreply@restaurant_admin.local");
define("EMAIL_SUPPORT", "noreply@restaurant_admin.local");


define("WEB_URL", "http://restaurant_admin.local");
define("ADMIN_URL", "http://restaurant_admin.local/admin");
define("COUNTER_URL", "http://restaurant_admin.local/counter");
define("KITCHEN_URL", "http://restaurant_admin.local/kitchen");
define("WEB_NAME", "restaurant_admin.local");
define("ORG_NAME", "restaurant_admin");
?>
