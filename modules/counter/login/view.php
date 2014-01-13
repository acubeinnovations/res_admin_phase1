<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
?>

		<form data-abide target="_self" method="post" action="<?php echo $current_url?>" name="frmlogin">

<fieldset>
    <legend>Counter Login</legend>
	<div class="row">
		<div class="large-4 columns">
		<small><font color="red"> <?php if(isset($myuser->error_description)){ echo $myuser->error_description; }else{
	if(isset($login_error)) echo $login_error ; }?> </small></font>
		</div>
	</div>

	<div class="row">
		<div class="large-4 columns">
		   <label for="loginname">User Name <small>required</small></label>
		  <input placeholder=""  required pattern="[a-zA-Z]+"  type="text" name="loginname"  >
		  <small class="error">Please Enter Your User Name.</small>
		</div>
	</div>

	<div class="row">
		<div class="large-4 columns">
		  <label for="password">Password <small>required</small></label>
		  <input placeholder="" required type="password" name="passwd"  >
			<small class="error">Passwords must be at least 8 characters with 1 capital letter, 1 number.</small>
		</div>
	</div>

	<div class="row">
		<div class="large-4 columns">
			<input class="small button" value="<?php echo $submit_sign_in ?>" type="submit" name="submit" >
			<input name="h_id" value="<?php if(isset($h_id))echo $h_id; ?>" type="hidden">
			<input name="h_login" value="pass" type="hidden">
		</div>
	</div>

</fieldset>
</form>




</div>
