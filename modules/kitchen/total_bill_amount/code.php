<?php

//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}

if(isset($_POST['total']) && isset($_SESSION['bill_id'])){
$bill_amount='';
$mybillitems=new BillItems($myconnection);
$mybillitems->connection=($myconnection);
$mybillitems->bill_id=$_SESSION['bill_id'];
$bill_amount=$mybillitems->get_tot_bill_amount_array();
if($bill_amount!=false){
print $bill_amount;
exit();
}else{
print "error";
exit();
}
}else{
print "error";
exit();
}

?>
