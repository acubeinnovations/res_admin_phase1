<?php
//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}
if (isset($_POST['bill_date']) && trim($_POST['bill_date']) != ""){
//	echo "selected";
	$mybills=new Bills($myconnection);
	$mybills->connection=($myconnection);
	$mybills->bill_date=$_POST['bill_date'];
	$data_bill_items=$mybills->get_consoldated_items_datewise();
	$bill_item_index=0;
	$total_amount=0;
	$total_tax=0; 
	$total_packing_charges=0;
$div_content='
<table>
	<tr>
    	<td align="center" colspan="6" style="line-height:18px;">
			<font size="2"><b>
				KELLY\'S RESTAURANT</b><br/>
				Sea Port Airport Road, <br/>
				Near Sunrise Hospital, <br/>
				Kakkanad<br/>
				Phone: 0484 2145678, 9496155000<br/>
				* Consoldated- '.$_POST['bill_date'].' *
			</font>
		</td>
	</tr>
	
	<tr>

		<td align="right" colspan="6">
			<font size="1">Date: '.$_POST['bill_date'].'</font> 
		</td>
	</tr>	
	<tr>
	  <td style="border-bottom:1px #000 dotted;border-top:1px #000 dotted;" colspan="2" ><font size="1">Item</font></td>
	  <td style="border-bottom:1px #000 dotted;border-top:1px #000 dotted;"><font size="1">Qty</font></td>
	  <td style="border-bottom:1px #000 dotted;border-top:1px #000 dotted;" ><font size="1">Rate</font></td>
	  <td style="border-bottom:1px #000 dotted;border-top:1px #000 dotted;" ><font size="1">Tax</font></td>
	  <td style="border-bottom:1px #000 dotted;border-top:1px #000 dotted;"><font size="1">Amt</font></td>
	</tr>
 <tbody>';
$slno=1;
$total_packing_charges=$mybills->packing_charge;
while($bill_item_index<count($data_bill_items)){
	$amount = $data_bill_items[$bill_item_index]['rate']*$data_bill_items[$bill_item_index]['total_quantity'];
	$total_amount = $total_amount + $amount;
	$total_tax=$total_tax + $data_bill_items[$bill_item_index]['total_tax'];
	//$total_packing_charges=$total_packing_charges+$data_bill_items[$bill_item_index]['total_packing_amount'];
	
$div_content.='<tr>
      <td colspan="2"><font size="1">'.substr($data_bill_items[$bill_item_index]['name'],0,12).'</font></td>
      <td><font size="1">'.$data_bill_items[$bill_item_index]['total_quantity'].'</font></td>
      <td><font size="1">'.$data_bill_items[$bill_item_index]['rate'].'</font></td>
	 <td><font size="1">'.$data_bill_items[$bill_item_index]['total_tax'].'</font></td>
      <td><font size="1">'.$amount.'</font></td>
    </tr>';

$bill_item_index++;
$slno++;
}
$div_content.='<tr>
	   <td colspan="2" style="border-top:1px #000 dotted;"><font size="1">Total Amount :</font></td>
	  
      <td style="border-top:1px #000 dotted;"></td>
      <td style="border-top:1px #000 dotted;"></td>
      <td style="border-top:1px #000 dotted;"></td>
	 
      <td style="border-top:1px #000 dotted;"><font size="1">'.$total_amount.'</font></td>
    </tr>
	<tr>
	   <td><font size="1">Total Tax :</font></td>
      <td></td>
      <td></td>
      <td></td>
	  <td></td>
      <td><font size="1">'.$total_tax.'</font></td>
    </tr>
	<tr>
	   <td><font size="1">Pkg Chgs:</font></td>
      <td></td>
      <td></td>
      <td></td>
	  <td></td>
      <td><font size="1">'.$total_packing_charges.'</font></td>
    </tr>	
	<tr>
	   <td colspan="4"><b><font size="2">Grand Total :</font></b></td>
     
      

      <td colspan="2" align="right"><b><font size="2">Rs. '.($total_tax+$total_amount+$total_packing_charges).'</font></b></td>
    </tr>
	<tr>
	   <td colspan="6">&nbsp;</td>
    </tr>

	
	</tbody>
</table>';
print $div_content;
exit();



}
else {
	echo "NO date selected"; 
}

?>
