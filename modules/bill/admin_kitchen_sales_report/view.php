<form id="form" name="form" method="GET" action="">
	<fieldset>

		<div class="small-6  medium-6 large-6 column">
			<div class="row">
				<div class="small-6  medium-6 large-6 column">
				<div class="report-option-container">
	<input type="radio" name="report_type" class="report_type" value="1" checked ><label>Date Wise</label><br><input type="radio" name="report_type"  value="2" class="report_type"><label>Period Wise</label>

	
	</div>
				</div>

				<div class="small-6  medium-6 large-6 column"><?php if(!isset($_GET['counter_id'])){ ?>Counter : <?php echo populate_array("listcounter", $array_counter, $admin_kitchen_report->counter_id,$disable=false); }else{?><input name="counter_id" type="hidden" id="counter_id" value="<?php echo $_GET['counter_id']; ?>"/><?php } ?>
					
				</div>	
			</div>
			
		</div>
	<div class="row">
		<div class="small-12  medium-12 large-12 column">
			<div class="datewise">
	<b>Select Date <input name="date" class="mydatepicker" id="date" readonly="readonly" value="<?php if(isset($admin_kitchen_report->date)){ echo $admin_kitchen_report->date; } ?>"> </b> &nbsp; <input class = "tiny button" type="submit" value="search"/>
   	</div>

<div class="periodwise" style="display:none;">
    <b>From : <input name="date_from" class="mydatepicker" id="date_from" readonly="readonly" value=""> </b> &nbsp;&nbsp; &nbsp;&nbsp;
   
	 <b>To : <input name="date_to" class="mydatepicker" id="date_to" readonly="readonly" value=""> </b> &nbsp; <input class = "tiny button" type="submit" value="search"/>
    <input name="kitchen_id" type="hidden" id="kitchen_id" value="<?php echo $admin_kitchen_report->kitchen_id; ?>"/>
	</div>
		</div>
	</div>
		<div id="printable-div">
		<table width="800" hight="68" align="center" border="0">
			<?php if(isset($_GET['date_from']) &&$_GET['date_from']!='' && isset($_GET['date_to']) && $_GET['date_to']!=''){ ?>
			<tr>
				
				<td><b>From:</b></td>
				<td width="200"><b><?php if(isset($_GET['date_from'])){ echo $_GET['date_from']; }?></b></td>
				<td width="200"><b>To :</b></td>
				<td><b><?php if(isset($_GET['date_to'])) { echo $_GET['date_to']; }?></b></td>
			</tr>
			<?php }else if(isset($_GET['date']) && $_GET['date']!=''){ ?>
			<tr>
				
				<td><b>Date :<?php echo $_GET['date']; ?></b></td>
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
			if($array_kitchen_report==false){
				?>
			<tr>
				<td>No Records Found</td>
			</tr>
			<?php } else {?>
			<tr>
			
				<td>Item</td>
				<td width="200">Kitchen Quantity</td>
				<td width="200">Sales Quantity</td>
				<td>Balance</td>
			</tr>
			<?php
			$i=0;
			while($i<$count_admin_kitchen) { ?>
				<tr>
					
						<td ><?php echo $array_kitchen_report[$i]['name'];?></td>
						<td ><?php echo $array_kitchen_report[$i]['counter_quantity'];?></td>
						<td ><?php echo $array_kitchen_report[$i]['bill_quantity'];?></td>
						<td><?php echo ($array_kitchen_report[$i]['counter_quantity'] - $array_kitchen_report[$i]['bill_quantity']);?></td>
						<td></td>

					</tr>
	<?php 
	$i++;
	}
	}
	?>							
		</table>
		</div>
		
	</fieldset>
</form>
