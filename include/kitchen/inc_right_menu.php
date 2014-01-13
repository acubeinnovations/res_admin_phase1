    <section class="top-bar-section">
	    <!-- Left Nav Section -->
      <ul class="left">
	  <li><a href="#"  ><?php if(isset($_SESSION[SESSION_TITLE.'kitchen_username']) && trim($_SESSION[SESSION_TITLE.'kitchen_username']) !=""){  echo "Logged in as ".$_SESSION[SESSION_TITLE.'kitchen_username']; }?></a></li>
	  </ul>
      <!-- Right Nav Section -->
      <ul class="right">

				
					<?php if(isset($_SESSION[SESSION_TITLE.'kitchen_userid']) && $_SESSION[SESSION_TITLE.'kitchen_userid'] > 0){ ?>

        <li class="divider"></li>
<?php if($this->page_name == "dashboard"){?> <li class="active"> <a href="dashboard.php" >Dash Board</a></li> <?php  }else{ ?> <li> <a href="dashboard.php" >Dash Board</a></li> <?php } ?>
<!--	
<?php if($this->page_name == "vieworders"){?> <li class="active"> <a href="view_orders.php" >All Orders</a></li> <?php  }else{ ?> <li> <a href="view_orders.php" >All Orders</a></li> <?php } ?>	
-->

<?php if($this->page_name == "additems"){?> <li class="active"> <a href="add_items.php" >Add Stock </a></li> <?php  }else{ ?> <li> <a href="add_items.php" >Add Stock</a></li> <?php } ?>			

        <li class="divider"></li>

        <li class="has-dropdown">
          <a href="#">Kitchen&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
          <ul class="dropdown">
            <li><a href="change_password.php">Change Password</a></li>
            <li class="divider"></li>

          </ul>
        </li>


        <li class="divider"></li>

          <?php } ?>

        <li class="divider"></li>
         <?php if(isset($_SESSION[SESSION_TITLE.'kitchen_userid']) && $_SESSION[SESSION_TITLE.'kitchen_userid'] > 0){ ?>
			   <li><a href="logout.php"  >Logout</a></li>
	   
			   
         <?php } else {?>
          <li><a href="index.php"  >Login</a></li>

          <?php }?>


      </ul>
    </section>
