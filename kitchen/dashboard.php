<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', '../');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_page/class_page.php');	// new Page Class

$page = new Page;
	$page->root_path = ROOT_PATH;
	$page->current_url = $current_url;	// current url for pages
	$page->title = "Restaurant";	// page Title
	$page->page_name = 'dashboard';		// page name for menu and other purpose
	$page->layout = 'restaurant.html';		// layout name


    $page->conf_list = array("conf.php");
    $page->menuconf_list = array("menu_conf.php");
	$page->connection_list = array("connection.php");

	$page->function_list = array("functions.php");
	$page->class_list = array("class_counter_session.php","class_bill.php","class_item.php","class_bill_items.php");

	$page->access_list = array("MASTER_KITCHEN","KITCHEN");
	$page->script_list = array("jquery.min.js");



    $index=0;

	$content_list[$index]['file_name']='kitchen/inc_right_menu.php';
    $content_list[$index]['var_name']='right_menu';
    $index++;


	$page->content_list = $content_list;

	$page->module_path = 'modules/kitchen/'; 
    $page->module = 'active_orders';

	$page->display(); //completed page with dynamic cintent will be displayed
?>
