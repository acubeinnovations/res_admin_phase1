<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>



<form id="form2" name="form2" method="post" action="">
  <fieldset>
    <legend> Counter List</legend>

  <table width="500" height="68" align="center">


    <tr>
        <th>Slno</th>
        <th colspan="5">User Name</th>
        <th colspan="5">Name </th>
        <th colspan="4">Last Login</th>
      <!--   <th>Status</th>-->
      
    </tr>

     <?php
      	if($array_admin_counter==false){
	     ?> 
	   

    <tr>
      <td colspan="7" >No records found </td>
    </tr>

       <?php } else {

		    $i=0;
			  while($i<$count){
		     ?>

     <tr>
    
      <td><?php echo $array_admin_counter[$i]['id']?></td>
      <td colspan="5"><?php echo $array_admin_counter[$i]['username']?></td>
          <td colspan="5"> <?php echo $array_admin_counter[$i]['name'] ;?></td>
          <td colspan="4"> <?php echo $array_admin_counter[$i]['lastlogin'] ;?></td>
          <td colspan=""><?php if(isset($g_ARRAY_STATUS[$array_admin_counter[$i]['status_id']])){ echo $g_ARRAY_STATUS[$array_admin_counter[$i]['status_id']];}?> </td>
          <td colspan="4"> <a href="admin_counter_sale_report.php?counter_id=<?php echo $array_admin_counter[$i]['id']?>" >View Sales Report</a></td>
      </td>
      </tr>

     <?php
		  $i++;
		  }
		   } ?>
    </table>
    </form>
   </body>
   </html>
