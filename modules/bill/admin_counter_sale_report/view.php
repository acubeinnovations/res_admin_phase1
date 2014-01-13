<form id="form2" name="form2" method="GET" action="">
  <fieldset>
    <legend> Sales Report </legend>
<div class="report-option-container">
	<input type="radio" name="report_type" class="report_type" value="1" checked ><label>Date Wise</label><br><input type="radio" name="report_type"  value="2" class="report_type"><label>Period Wise</label>
	</div>
	<div class="datewise">
	<b>Select Date <input name="bill_date" class="mydatepicker" id="bill_date" readonly="readonly" value="<?php echo $admin_sale_counter->bill_date; ?>"></b> &nbsp; <input class = "tiny button" type="submit" value="search"/>
   	</div>
	<div class="periodwise" style="display:none;">
    <b>From : <input name="bill_date_from" class="mydatepicker" id="bill_date_from" readonly="readonly" value=""></b> &nbsp;&nbsp; &nbsp;&nbsp;
    <input name="counter_id" type="hidden" id="counter_id" value="<?php echo $admin_sale_counter->counter_id; ?>"/>
	 <b>To : <input name="bill_date_to" class="mydatepicker" id="bill_date_to" readonly="readonly" value=""></b> &nbsp; <input class = "tiny button" type="submit" value="search"/>
    <input name="counter_id" type="hidden" id="counter_id" value="<?php echo $admin_sale_counter->counter_id; ?>"/>
	</div>
	<div id="printabel_area">
  <table width="800" hight="68" align="center" border="0">
	<?php if(isset($_GET['bill_date_from']) &&$_GET['bill_date_from']!='' && isset($_GET['bill_date_to']) && $_GET['bill_date_to']!=''){ ?>
			<tr>
				
				<td><b>From:</b></td>
				<td width="200"><b><?php if(isset($_GET['bill_date_from'])){ echo $_GET['bill_date_from']; }?></b></td>
				<td width="200"><b>To :</b></td>
				<td><b><?php if(isset($_GET['bill_date_to'])) { echo $_GET['bill_date_to']; }?></b></td>
			</tr>
			<?php }else if(isset($_GET['bill_date']) && $_GET['bill_date']!=''){ ?>
			<tr>
				
				<td><b>Date :<?php echo $_GET['bill_date'];?></b></td>
				<td width="200"></td>
				<td width="200"></td>
				<td></td>
			</tr>
			<?php 
			}else{
			?>
			<tr>
				
				<td><b>Date :<?php echo  date('d-m-Y');  ?></b></td>
				<td width="200"></td>
				<td width="200"></td>
				<td></td>
			</tr>
			<?php 
			}
		?>
  	<tr>
  		<td> Item </td>
  		<td> Rate </td>
  		<td> Sales Quantity </td>
  		<td> Amount </td>
  	</tr>
	
  	<?php
  	if($array_sales_counter==false){
  	?>
 	 	<tr>
  		<td> NO Records Found</td></tr>
 	 	</tr>

 	 <?php } else{
  		$i=0;
      $j=0;
      $bill_total_amount=0;
    
  		while($i<$count_sales_report){?>
  	<tr>

	     <td><?php echo $array_sales_counter[$i]['item_name']; ?></td>
		<td><?php echo $array_sales_counter[$i]['rate'];?></td>
        <td><?php echo $array_sales_counter[$i]['quantity'];?></td>
        <td><?php echo $array_sales_counter[$i]['amount'];?></td>
  </tr>
    
      <?php 
        $bill_total_amount=$bill_total_amount+$array_sales_counter[$j]['amount'];
      
       

    $j++;
    $i++;
    }?>
<tr>
    <td align="Right" colspan="4"><b>Total Amount: </b><?php echo  $bill_total_amount; ?></td></tr>
<?php 
  }
?>
  

  	<table>
	</div>
  	</fieldset>
  </form>

