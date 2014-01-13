<a href="index.php">Home</a>
<?php
if(isset($_SESSION[SESSION_TITLE.'counter_userid']) && $_SESSION[SESSION_TITLE.'counter_userid'] > 0 ){
?>
<a href="logout.php">logout</a>
<?php 
}else{
	
	?>
    <a href="index.php">Login</a>
    <?php
	
	}
?>