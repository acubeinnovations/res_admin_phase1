<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', '../');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_page/class_page.php');	// new Page Class

$page = new Page;
	$page->root_path = ROOT_PATH;
	$page->current_url = $current_url;	// current url for pages
	$page->title = "Acube MVC";	// page Title
	$page->page_name = 'addtobill';		// page name for menu and other purpose
	$page->layout = 'null.html';		// layout name


    $page->conf_list = array("conf.php");
    $page->menuconf_list = array("menu_conf.php");
	$page->connection_list = array("connection.php");

	$page->function_list = array("functions.php");
	$page->class_list = array("class_counter_session.php","class_item.php","class_bill_items.php","class_bill.php","class_itemcategory.php");

	$page->access_list = array("MASTER_KITCHEN","KITCHEN");
	$page->script_list = array("jquery.min.js");
	
	 
	
	
	$page->module_path 	= '/modules/kitchen/';
	$page->module		= 'add_items';



	$page->display(); //completed page with dynamic cintent will be displayed
?>
    

