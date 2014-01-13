<?php
//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}
?>
<form data-abide target="_self" method="post" action="" name="">
	<fieldset>
    <legend>Packing</legend>
	<div class="row">
		<div class="large-4 columns">
		</div>
	</div>
<div class="row">
		<div class="large-4 columns">

		   <label for="packing">Item <small>required</small></label>
		  <input placeholder=""  required pattern="[a-zA-Z]+"  type="text" name="name" value="<?php echo $packing->name; ?>"/ >
		  <small class="error">Please Enter Item.</small>
		</div>
	</div>

	<div class="row">
		<div class="large-4 columns">
			<label for="rate">Rate </label>
		  <input placeholder=""  type="text" name="rate" value="<?php echo $packing->rate; ?>" id= "rate"/ >
		  <small class="error">Please Enter Rate.</small>
		</div>
	</div>

	<div class="row">
		<div class="large-4 columns">
			<input class="small button" value="submit" type="submit" name="submit" >
			<input type="hidden" name="h_id" value ="<?php echo $packing->id; ?>"
		</div>
		</div>

	</fieldset>
</form>	