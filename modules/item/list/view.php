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
    <td> Search by Item:<input type="text" name="search"  value="<?php if(isset($_GET['search'])) { echo $_GET['search'];}?>"/>
      <input type="submit" name="submit" value="Submit" /></td>
    </tr>
  </table>
      </form>


<fieldset>
    <legend>Item List</legend>

   <table width="500" height="68" align="left">

    <tr>
      <th>Slno</th>
      <th>Item</th>
      <th colspan="3"> Category</th>
      <th>Rate</th>
      <th>Tax</th>
     <!-- <th colspan="3">Status</th>-->
    </tr>

        <?php
            if($array_items==false)
          { ?>

      <tr>
        <td> No Records Found</td>
      </tr>

       <?php } else {
        $i=0;
        while($i<$count_items){
         ?>

   <tr>
      <td><?php echo $array_items[$i]['id'] ?></td>
      <td><a href="item.php?id=<?php echo $array_items[$i]['id'] ?>"><?php echo $array_items[$i]['name']?></a></td>
      <td colspan="2"><?php if(isset($array_item_category[$array_items[$i]['item_category_id']])){echo $array_item_category[$array_items[$i]['item_category_id']] ;}?></td>
      <td colspan="2"> <?php echo $array_items[$i]['rate'] ;?></td>
      <td colspan="2"><?php echo $array_items[$i]['tax'] ;?></td>
      <!--  <td colspan="2"><?php if(isset($g_ARRAY_STATUS[$array_items[$i]['status_id']])) { echo $g_ARRAY_STATUS[$array_items[$i]['status_id']]; }?></td>-->
                    
   </tr>

    <?php $i++;
          }
          }
           ?>

<tr><td colspan="6">
<?php  $pagination->pagination_style1();?>
<td>
</tr>

</table>


   </body>
   </html>
