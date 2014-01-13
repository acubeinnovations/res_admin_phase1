<br>
<div class="row">
	<div class="large-12 columns">
		<div class="large-1 columns">Order</div>
		<div class="large-6 columns">Items</div>
		<div class="large-4 columns">Action</div>
	</div>
</div>
<?php
	if($array_bills != false){
	$bill_index=0;
	if ($count>0)
	while($bill_index<count($array_bills)){
  ?>

<div class="row">
	<div class="large-12 columns">
	<div class="large-1 columns">Order <?php echo $array_bills[$bill_index]["bill_number"] ?></div>

	 <div class="large-6 columns">
	<?php

		$mybillitems=new BillItems($myconnection);
		$mybillitems->connection=($myconnection);
		$mybillitems->bill_id = $array_bills[$bill_index]["id"];
		$mybillitems->bill_item_status_id = BILL_ITEM_STATUS_ACTIVE;
		//$mybillitems->bill_kitchen_status_id = BILL_KITCHEN_STATUS_TO_KITCHEN;
		$array_bill_items = $mybillitems->get_list_array_bylimit();
		$slno=1;
		$bill_item_index = 0;

		while($bill_item_index<count($array_bill_items)){
		?>
		<?php if($array_bill_items[$bill_item_index]['bill_kitchen_status_id']==BILL_KITCHEN_STATUS_FINISHED){?>
		  		<a class ="tiny button success" href="#" ><?php if (isset( $array_item[$array_bill_items[$bill_item_index]['item_id']])) echo $array_item[$array_bill_items[$bill_item_index]['item_id']]?> (<?php echo $array_bill_items[$bill_item_index]['quantity']?>)</a>
		<?php } else {?>
		  		<a class="tiny button alert" href="update_kitchen_item_status.php?id=<?php echo $array_bill_items[$bill_item_index]["id"] ?>"><?php if (isset( $array_item[$array_bill_items[$bill_item_index]['item_id']])) echo $array_item[$array_bill_items[$bill_item_index]['item_id']]?> (<?php echo $array_bill_items[$bill_item_index]['quantity']?>)</a>
		<?php }?>
		<?php
			$slno++;
			$bill_item_index++;
		}
		?>
	</div>
	<div class="large-5 columns">
		 <a href="update_kitchen_status.php?id=<?php echo $array_bills[$bill_index]["id"] ?>" class="button tiny">Finish</a>
	</div>
	</div>
</div>


 	<?php
		$bill_index++;

	}
	}
	?>
