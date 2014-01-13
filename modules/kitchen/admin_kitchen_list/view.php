<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<form id="form2" name="form2" method="post" action="">
  <fieldset>
    <legend> Kitchen List</legend>

  <table width="500" height="68" align="center">


    <tr>
        <th>Slno</th>
        <th>User Name</th>
        <th>Name </th>
        <th colspan="2">Last Login</th>
         <!--<th>Status</th>-->
      
    </tr>

     <?php
      	if($array_kitchen==false)
	       {
	   ?>

    <tr>
      <td colspan="7" >No records found </td>
    </tr>

       <?php } else {

		    $i=0;
			  while($i<$count){
		     ?>

     <tr>
      <td><?php echo $array_kitchen[$i]['id']?></td>
      <td><?php echo $array_kitchen[$i]['username']?></td>
         <td colspan="2"> <?php echo $array_kitchen[$i]['name'] ;?></td>
          <td> <?php echo $array_kitchen[$i]['lastlogin'] ;?></td>
           <td colspan="2"> <?php if(isset($g_ARRAY_STATUS[$array_kitchen[$i]['status_id']])){ echo $g_ARRAY_STATUS[$array_kitchen[$i]['status_id']];}?></td>
            <td colspan="4"><a href="admin_kitchen_sales_report.php?kitchen_id=<?php echo $array_kitchen[$i]['id']; if(isset($array_kitchen[$i]['counter_id']) && $array_kitchen[$i]['counter_id'] >0) { ?>&counter_id=<?php echo $array_kitchen[$i]['counter_id']; }?>">View Report</a></td>

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
