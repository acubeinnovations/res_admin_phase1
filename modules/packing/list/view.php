<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form2" name="form2" method="post" action="">
<fieldset>
    <legend>Packing List</legend>
     <table width="500" height="68" align="center">

    <tr>
      <th>Slno</th>
      <th>Item</th>
      <th colspan="2">Rate</th>
    </tr>

	<?php
	if($array_packing_list==false){
	?>

	<tr>
	<td> No Recodes Found </td>
	</tr>

	<?php } else { 
		$i = 0;
		while($i<$count){
	?>

	<tr> 
	<td><?php echo $array_packing_list[$i]['id'] ?></td>
	<td colspan="2"><a href="packing.php?id=<?php echo $array_packing_list[$i]['id'] ?>"><?php echo $array_packing_list[$i]['name']?></a></td>
    <td colspan="2"> <?php echo $array_packing_list[$i]['rate'] ?></td>
	</tr>

    <?php $i++;
          }
          }
           ?>

 </table>
    </form>
   </body>
   </html>
