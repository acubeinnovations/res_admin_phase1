<?php
//prevent execution direct call by browser
if(!defined('CHECK_INCLUDED')){
		exit();
}
?>

    <form data-abide target="_self" method="post" action="<?php echo $current_url?>" name="frmlogin">
       <fieldset>
        <legend> Category</legend>
            <div class="row">
            <div class="large-4 columns">
           <small><?php echo $msg;?></small>
    </div>
  </div>

  <div class="row">
    <div class="large-4 columns">
       <label for="Category Name">Category Name<small>required</small></label>
      <input placeholder=""  required pattern="[a-zA-Z]+"  type="text" name="name" id="name" value="<?php echo $item_category->name;?>">
       <small class="error">Enter Category</small>
    </div>
  </div>


    <div class="row">
    <div class="large-4 columns">
      <label for ="status_id">Status</label>
      <?php echo populate_list_array("lststatus", $g_ARRAY_LIST_STATUS, 'id', 'name', $item_category->status_id,$disable=false);?>

     </div>
  </div>
     <!--  <div class="row">
      <div class="large-4 columns">
       <label for="lstitem_category">Parent Category <small>required</small></label>
         <small class="error">Select Item.</small>
     <?php echo populate_list_array("lstitem_category", $arr_item_category, 'id', 'name', $item_category->parent_id,$disable=false);
?>
  </div>
  </div>-->


   

  <div class="row">
    <div class="large-4 columns">
      <input class="small button" value="submit" type="submit" name="submit" id="submit" >
     <input value="<?php echo $item_category->id;?>" type="hidden" name="h_id" >
    </div>
  </div>

</fieldset>
</form>




</div>
