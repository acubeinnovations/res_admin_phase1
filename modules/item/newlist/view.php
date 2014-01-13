

    <?php
	for ($i=0; $i < $count_category; $i++) { 
	echo '<div class="small-2 columns">';
	echo '<h3>';
	echo $array_category[$i]["name"];
	echo '</h3>';
	$array_items=$array_category[$i]["items"];
	$count_items=count($array_items);
	for ($j=0; $j <$count_items ; $j++) { 
		echo '<div class="row">';
		echo '<a href="item.php?id='. $array_items[$j]['id'].'" class = "button tiny item_button " >';
		echo $array_items[$j]['name'];
		echo '</a>';
		echo '</div>';
	}
	echo "</div>";
}




    ?>







    
 
     
    
       
   
      


