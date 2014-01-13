<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="" method="get">
  <table>
   <tr>
    <td> Search By Category :<input type="text" name="search"  value="<?php if(isset($_GET['search'])) {echo $_GET['search']; }?>"/>
      <input type="submit" name="submit" value="Submit" /></td>
    </tr>
      </table>
      </form>
      
<form id="form2" name="form2" method="post" action="">
  <fieldset>
    <legend> Category</legend>

  <table width="500" height="68" align="left">


    <tr>
        <th>Slno</th>
        <th>Category</th>
       <!-- <th>Parent Category</th>-->
        <th>Status</th>
    </tr>

     <?php
      	if($array_item_categories==false)
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
      <td><?php echo $array_item_categories[$i]['id']?></td>
      <td colspan="3"><a href="item_category.php?id=<?php echo $array_item_categories[$i]['id']?>"><?php echo $array_item_categories[$i]['name']?></a></td>
   <!--<td><?php if(isset($array_category[$array_item_categories[$i]['parent_id']])){echo $array_category[$array_item_categories[$i]['parent_id']];}?></td>-->
     <td >
      <?php if(isset($g_ARRAY_STATUS[$array_item_categories[$i]['status_id']])){ echo $g_ARRAY_STATUS[$array_item_categories[$i]['status_id']];}?>
      </td>
      </tr>

     <?php
		  $i++;
		  }
		   } ?>
	<tr><td colspan="6">
<?php  $category_pagination->pagination_style1();?>
<td>
</tr>

    </table>
    </form>
   </body>
   </html>
