<div id="openedbills" class="reveal-modal" data-reveal>  </div>
<div id="print_bill" class="reveal-modal" data-reveal><a class="close-reveal-modal" id="close-print-div">&#215;</a><div id='printable-area'></div> <a href="#" class="tiny button  print_div" id= "print_div">PRINT</a> </div>
<div class="row parent">
	
		<div class="large-12 columns"><br><br>
<form action="" method="post"><b>Select Date <input name="bill_date" class="mydatepicker" id="bill_date" readonly="readonly" value="<?php echo $mybills->bill_date; ?>"></b> &nbsp; <input class = "tiny button" type="submit" value="search"/>
<a class = "tiny button alert" type="button"  style="float:right;  margin-right:10px;"  href="cancelledbills.php"/>View Cancelled Bills</a></form>


			<table>
			<tbody bgcolor="#D6D6D6">

				</tbody>
				  <thead >
					<tr>
					  <th width="30"  bgcolor="#89CAE2"><font color="#FFFFFF">Slno</font></th>
					 <th width="150"  bgcolor="#89CAE2"><font color="#FFFFFF">Bill Number</font></th>
					  <th width="250"  bgcolor="#89CAE2"><font color="#FFFFFF">Bill Date</font></th>
					  <th width="250"  bgcolor="#89CAE2"><font color="#FFFFFF">Payment Date</font></th>
					  <th width="250"  bgcolor="#89CAE2"><font color="#FFFFFF">Bill status</font></th>
						<th width="250"  bgcolor="#89CAE2"><font color="#FFFFFF">Amount</font></th>
						<th width="100" align="center"   bgcolor="#89CAE2"><font color="#FFFFFF">Print</font></th>
					</tr>
				  </thead>
				 <tbody>
				<?php
				$slno=1;
				$bill_index=0;
				$bill_total_amount=0;
				while($bill_index<count($bills)){  if(isset($bills[$bill_index]['id'])){ ?>
				<tr>
						<td align="center"><?php echo $slno?></td>
						<td align="center"><?php echo $bills[$bill_index]['bill_number']?></td>
						<td><?php echo $bills[$bill_index]['bill_date']?></td>
						<td><?php echo $bills[$bill_index]['payment_date']?></td>
						<td><?php echo $bill_statuses[$bills[$bill_index]['bill_status_id']]?></td>
						<td><?php echo $bills[$bill_index]['amount']?></td>
						<td align="center"><a href="#" data-reveal-id="print_bill" id="print_bill_button<?php echo $bills[$bill_index]['id']?>" class="tiny button  print_bill_button" bill_id="<?php echo $bills[$bill_index]['id']?>" >PRINT</a></td>
				</tr>
				<?php
				$bill_total_amount=$bill_total_amount+$bills[$bill_index]['amount'];
			}
				$bill_index++;
				$slno++;
				}?>
				</tbody>
 				<tbody>

					<tr height="1" bgcolor="#89CAE2">
						<td colspan="3"><font size="4" color="#FFFFFF">&nbsp;Total Number of Bills : <?php echo $billcount;?> </font> </td>
						<td></td>
						<td colspan="1"></td>
						<td><font size="4" color="#FFFFFF">&nbsp;Total Amount : <?php echo $bill_total_amount; ?></font> </td>
						<td align="center" ><a style="vertical-align:middle" href="#" data-reveal-id="print_bill" id="print_summary_bill_button" class="tiny button alert">PRINT</a></td>
					</tr>
				</tbody>				
			</table>

		</div>

	
	</div>


