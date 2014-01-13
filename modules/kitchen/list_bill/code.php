<?php

//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}

if(isset($_POST['print'])  && isset($_POST['bill_id'])){
$item_rate='';
$item_name='';
$bill_amount='0';
$item=new Item($myconnection);
$item->connection=($myconnection);
$item_name=$item->get_array_item_name();
$item_rate=$item->get_array_item_rate();
$mybills=new Bills($myconnection);
$mybills->connection=($myconnection);
$bill_status=$mybills->get_array_statuses();
$mybillitems=new BillItems($myconnection);
$mybillitems->connection=($myconnection);

$mybillitems->bill_id=$_POST['bill_id'];

$data_bill_items=$mybillitems->get_list_array_bylimit();

$mybills->id=$_POST['bill_id'];
$mybills->get_detail();

$mybillitems->bill_id=$_POST['bill_id'];
$mybillitems->bill_item_status_id=BILL_ITEM_STATUS_ACTIVE;

$bill_amount=$mybillitems->get_tot_bill_amount_array();
if($bill_amount==false){
$bill_amount=0;
}
$bill_item_index=0;

$div_content='<table>
  <thead>
    <tr>
	  <th width="30">Slno</th>
      <th width="400">Item</th>
      <th width="200">Quantity</th>
      <th width="250">Rate</th>
      <th width="250">Total Amount</th>
    </tr>
  </thead>
 <tbody>';
$slno=1;
while($bill_item_index<count($data_bill_items)){
$div_content.='<tr>
	   <td>'.$slno.'</td>
      <td>'.$item_name[$data_bill_items[$bill_item_index]['item_id']].'</td>
      <td>'.$data_bill_items[$bill_item_index]['quantity'].'</td>
      <td>'.$item_rate[$data_bill_items[$bill_item_index]['item_id']].'</td>
      <td>'.$data_bill_items[$bill_item_index]['rate'].'</td>
    </tr>';

$bill_item_index++;
$slno++;
}
$div_content.='<tr>
	   <td></td>
      <td></td>
      <td></td>
      <td>STATUS:'.$bill_status[$mybills->bill_status_id].'</td>
      <td>Total :'.$bill_amount.'</td>
    </tr></tbody>
</table><a href="#" class="tiny button  print_div" id= "print_div">PRINT</a><a class="close-reveal-modal">&#215;</a>';
print $div_content;
exit();

}else{
print 'No Bill Selected.<a class="close-reveal-modal">&#215;</a>';
exit();
}


?>
