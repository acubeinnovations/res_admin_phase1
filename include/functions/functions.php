<?php 
// Function to populate values in a dropdown list
function populatelist ($lstname, $str_query, $str_firstvalue="-1", $str_firstoption = "", $str_selected = "", $bln_disabled = false, $str_event = "", $str_style = "") {

    $rsRES = mysql_query($str_query) or die (mysql_error() . $str_query);
    $str_disable = "";
    if ($bln_disabled == true){
        $str_disable = "disabled";
    }
    echo '<select name="' . $lstname . '"' . $str_disable . ' ' . $str_event .  ' ' . $str_style . '>';
    if ( trim($str_firstoption) != "" && is_null($str_firstoption) == false ) {
        if ( $str_selected == $str_firstvalue ) {
            echo '<option selected="selected" value="' . $str_firstvalue . '">';
            echo $str_firstoption;
            echo '</option>';
        }
        else {
            echo '<option value="' . $str_firstvalue . '">' . $str_firstoption . '</option>';
        }
    }
    while ($arrRES = mysql_fetch_array($rsRES)) {
        if ( $str_selected == $arrRES[0] ) {
            echo '<option selected="selected" value="' . $arrRES[0] . '">';
            echo $arrRES[1];
            echo '</option>';
        }
        else {
            echo '<option value="' . $arrRES[0] . '">' . $arrRES[1] . '</option>';
        }
    }
    echo '</select>';
}


function populate_list_array($objname, $array_list, $value_array, $display_array, $defaultvalue=-1,$disable=false){ 
// function used to populate list from associative array  
GLOBAL $g_obj_select_default_text;
?>	
<select  name="<?php echo $objname; ?>" <?php if ($disable == true){?> disabled="true"<?php } ?> >
	<option selected="selected" value="-1"><?php echo $g_obj_select_default_text ?></option>
	<?php foreach ($array_list as $value) { ?><option <?php if( $defaultvalue == $value[$value_array]){ ?> selected="selected"<?php } ?> value="<?php echo $value[$value_array]; ?>"><?php echo $value[$display_array]; ?></option>
	<?php } //--end for ?>

</select>
	
<?php }	

	function populate_array($objname, $data_array, $defaultvalue=-1,$disable=false, $default_message = true,$options='class = "select styled hasCustomSelect" '){ 
		// function used to populate list from  array 
		GLOBAL $g_obj_select_default_text;
		($disable == true)?$disabled = 'disabled="true"':$disabled='';
		$list = '<select name="'.$objname.'" '.$disabled.'" '.$options.'>';
		$list .= ($default_message == true)?'<option selected="selected" value="-1">'.$g_obj_select_default_text.'</option>' : "";		
		if($data_array == false){
			// Do Nothing
		}else{
			foreach ($data_array as $key => $value) {
				($defaultvalue == $key)?$selected='selected="selected"':$selected="";
				$list .= '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
			}
		}
			$list .= '</select>';
			echo  $list;
	}



function get_filenames($dir_name,$ext="",$file_end_with="",$from_dir="",$recur=false){

$files = array();
$i = 0;
$dirs = dir ($dir_name);
if ( $i == NULL ) {$i = 0;}
$j=0;$k=0;
while ( ( $file = $dirs->read() ) != false ){
    //For recursive calling in the case of subdirectories
    if ( is_dir($dir_name."/".$file) && $recur == true ) {
            //to avoid parent dirs
            if( $file == "." || $file == ".." ){
            }
            else{

							$subfiles = get_filenames($dir_name."/".$file,$ext,$file_end_with,$from_dir,$recur);
							$files = array_merge($files,$subfiles);
							$i = sizeof($files);

				}
    }
    //
    else{
		$ext1 = explode('.', $file);

		$curr_dir = explode('/', $dir_name);
		$curr_dir = $curr_dir[count($curr_dir)-1];
	
		if($from_dir !="" ){
			if($curr_dir==$from_dir){

				if ( $ext != "" && $file_end_with !="" ){
							if ( stristr($ext1[0],$file_end_with) != false ){
									$ext1 = $ext1[count($ext1)-1];
									if (strcasecmp($ext,$ext1) == 0){
									$files[$i] = $dir_name."/".$file; $i++;
								}
							}
				}
				elseif ( $file_end_with !="" ){
							if ( stristr($ext1[0],$file_end_with) != false ){
									$files[$i] = $dir_name."/".$file; $i++;
							}
				}
				elseif ( $ext != "" ){
								$ext1 = $ext1[count($ext1)-1];
								if (strcasecmp($ext,$ext1) == 0){
									$files[$i] = $dir_name."/".$file; $i++;
								}
				}
				else{
					$files[$i] = $file; $i++;
				}
		
				}
			}else{
	
		
				if ( $ext != "" && $file_end_with !="" ){
							if ( stristr($ext1[0],$file_end_with) != false ){
									$ext1 = $ext1[count($ext1)-1];
								if (strcasecmp($ext,$ext1) == 0){
									$files[$i] = $dir_name."/".$file; $i++;
								}
							}
				}
				elseif ( $file_end_with !="" ){
							if ( stristr($ext1[0],$file_end_with) != false ){
									$files[$i] = $dir_name."/".$file; $i++;
							}
				}
				elseif ( $ext != "" ){
								$ext1 = $ext1[count($ext1)-1];
								if (strcasecmp($ext,$ext1) == 0){
									$files[$i] = $dir_name."/".$file; $i++;
								}
				}
				else{
					$files[$i] = $file; $i++;
				}
		
	
		}




    }
}


$dirs->close();

return $files;
}



function time_array (){
$time_array = array();$i=0;
	/* -- Time Range 12:00 AM - 11:00 PM -- */
    $time_array[$i]["time"] = "12:00 AM"; 
    $i++;
	for ( $i=1; $i <= 11; $i++) {
		$time_array[$i]["time"] =  $i . ":00 AM"; 
	}
	$time_array[$i]["time"] = "12:00 PM"; 
    $i++;
	for ( $i=13; $i <= 23; $i++) {
		$time_array[$i]["time"]  = ($i%12) . ":00 PM";
	}
  return $time_array;
}
 


function weekdays_array (){
$weekdays_array = array();$i=0;
    $weekdays_array[$i]["day"] = "Sunday"; $i++;
    $weekdays_array[$i]["day"] = "Monday"; $i++;
    $weekdays_array[$i]["day"] = "Tuesday"; $i++;
    $weekdays_array[$i]["day"] = "Wednesday"; $i++;
    $weekdays_array[$i]["day"] = "Thursday"; $i++;
    $weekdays_array[$i]["day"] = "Friday"; $i++;
    $weekdays_array[$i]["day"] = "Saturday"; $i++;
return $weekdays_array;
}
 
function time_zone_array (){
$time_zone_array = array();$i=0;
    $time_zone_array[$i]["zone"] = "Pacific Standard Time (PST)"; $i++;
    $time_zone_array[$i]["zone"] = "Mountain Standard Time (MST)"; $i++;
    $time_zone_array[$i]["zone"] = "Central Standard Time (CST)"; $i++;
    $time_zone_array[$i]["zone"] = "Eastern Standard Time(EST)"; $i++;
    $time_zone_array[$i]["zone"] = "Atlantic Standard Time (AST)"; $i++;
    $time_zone_array[$i]["zone"] = "Other Time Zones"; $i++;
return $time_zone_array;
}




function loadlanguage($lstname, $firstvalue=-1, $firstoption="Select Language", $selectedvalue,$disable=false, $strevent="" ){
    $query = "SELECT id, name FROM  languages WHERE publish='".CONF_PUBLISH."' ORDER BY id" ;
    populatelist ($lstname, $query, $firstvalue, $firstoption, $selectedvalue, $disable,$strevent);
}


function loadlanguage_admin($lstname, $firstvalue=-1, $firstoption="Select Language", $selectedvalue,$disable=false, $strevent="" ){
    $query = "SELECT id, name FROM  languages ORDER BY id" ;
    populatelist ($lstname, $query, $firstvalue, $firstoption, $selectedvalue, $disable,$strevent);
}


function loadcontenttypes($lstname, $firstvalue=-1, $firstoption="Select content Type", $selectedvalue,$disable=false, $strevent="" ){
    $query = "SELECT id, name FROM  contenttypes ORDER BY id" ;
    populatelist ($lstname, $query, $firstvalue, $firstoption, $selectedvalue, $disable,$strevent);
}

?>
