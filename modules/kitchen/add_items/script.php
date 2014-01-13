<!--

var current_url = "<?php echo $current_url; ?>";
 
$(document).ready(function(){
	var refresh="refresh";
	var success_post = $.post('page_refresh_bill.php',
		{
			refresh:refresh,
		});
	success_post.done(function(data){
		if(data!='1'){
			$(".bill").html(data);
		}else{
			$(".bill").html('&nbsp');
		}
		});
	var total="total";
	var success_post = $.post('total_bill_amount.php',
		{
			total:total,
			
		});
	success_post.done(function(data){
		if(data!='error'){
			var val="Rs ."+data;
			$('#tot_button_val').text(val);
		}else{
			$('#tot_button_val').text("Rs .0");
		}
	});
	


	$( document ).on( "click", ".item_category", function() {
	var item_id=$(this).attr('item_id');
	var success_post = $.post('item_by_category.php',
		{
			item_id:item_id,
		});
	success_post.done(function(data){
		if(data!='1'){
			$(".items").html(data);
		}else{
			$(".items").html("&nbsp;");
		}
		});
	
	});
	
	$( document ).on("click", ".items", function() {
	
	var item_id='';
    var counter_id='';
	item_id=$(this).attr('item_id');
    counter_id = $("#h_counter_id").val();
    
	var success_post = $.post('get_items.php',{counter_id:counter_id, item_id:item_id});
	success_post.done(function(data){
		if(data!=''){
			if (data.indexOf('!@#$%*') >= 0){
				var item =data.split('!@#$%*');
				$('#lblitemname').html(item[1]);
                $('#h_item_id').val(item_id);
                $('#txtavailablequantity').val(item[3]);
                $('#txtquantity').val(item[2]);
				$('#txtaddquantity').val(item[4]);
                $('#counter_item_form').show();
			}else{
			//alert("No Items Selected");
			
			}
		}else{
			//alert("No Items Selected");
		}
		});
	});
	
	$("select[name='lstcounter']").change(function(){
	var session_counter_id=$("select[name='lstcounter']").val();
	var success_post = $.post(current_url,{ session_counter_id:session_counter_id});
	success_post.done(function(data){
	if(data==1){
	location.reload();
	}
	});
	});

	$( document ).on("click", "#buttonupdate", function() {
		item_id = $("#h_item_id").val();
		if($("#h_counter_id").val()!=''){    	
		counter_id = $("#h_counter_id").val();
		}else if( $("select[name='lstcounter']").val()!=-1){ 
		counter_id = $("select[name='lstcounter']").val(); 
		}else{
		popup_alert("Please select counter","#","close","false");
		return false;
		}
        kitchen_id = $("#h_kitchen_id").val();
		quantity = $("#txtaddquantity").val();
		var success_post = $.post('add_counter_item.php',{ item_id:item_id , counter_id:counter_id, kitchen_id:kitchen_id,quantity:quantity});
		success_post.done(function(data){
	    popup_alert(data,"add_items.php","Ok","false");	
		
        $('#counter_item_form').hide();
		});	});


	$( document ).on("focus", ".item_quantity", function() {
	item_id=$(this).attr('item_id');
	$(".calculater").show();
	$("#item_id_hidden").val(item_id);
	});
	
	$( document ).on("click", ".calc_button", function() {
	item_id=$("#item_id_hidden").val();
	button_value=$(this).attr('button_value');
	var qty='';
	if($('#item_quantity'+item_id).val()!=''){
	var old_qty=$('#item_quantity'+item_id).val();
	qty=(old_qty*10)+Number(button_value);
	}else{
	qty=qty+Number(button_value);
	}
		$('#item_quantity'+item_id).val(qty);
	});

	$( document ).on("click", ".clear", function() {
	item_id=$("#item_id_hidden").val();
	$('#item_quantity'+item_id).val('');
	});
	
	$( document ).on("click", ".ok", function() {
	item_id=$("#item_id_hidden").val();
	if($('#item_quantity'+item_id).val()=='' || $('#item_quantity'+item_id).val()==0 ){
	$('.myalert').html('Item quantity should be greater than zerol.<a href="#" class="close">&times;</a>');
	$('.myalert').show();
	}else{
	var qty=$('#item_quantity'+item_id).val();
	var success_post = $.post('add_to_bill.php',
		{
			item_id:item_id,
			qty:qty,
		});
	success_post.done(function(data){
		if(data!=''){
			if (data.indexOf('!@#$%*') >= 0){
			var bill_items=data.split('!@#$%*');
			$('#item_quantity'+bill_items[0]).val(bill_items[1]);
			$('#item_rate'+bill_items[0]).html(bill_items[2]);
			}
	}
	});
	$(".calculater").hide();
	var total="total";
	var success_post = $.post('total_bill_amount.php',
		{
			total:total,
			
		});
	success_post.done(function(data){
		if(data!='error'){
			var val="Rs ."+data;
			$('#tot_button_val').text(val);
		}else{
			$('#tot_button_val').text("Rs .0");
		}
	});
	
	}
	
	});
	
	$( document ).on("click", ".close_button", function() {
	$(".calculater").hide();
	});
	$( document ).on("click", ".hold_button", function() {
	var hold='hold';
	var success_post = $.post('hold_bill.php',
		{
			hold:hold,
		});
	success_post.done(function(data){
		if(data=='1'){
			$(".bill").html('&nbsp');
			$('#tot_button_val').text("Rs .0");
			alert("bill holded");
		}else{
			alert("bill cannot be holded");
		}
		});
	
	});
	

$(function()
{
    var api = $('.categories').jScrollPane().data('jsp');
    $('#scroll_up').bind(
        'click',
        function()
        {
            api.scrollByY(-300);
            return false;
        }
    );
    $('#scroll_down').bind(
        'click',
        function()
        {
            api.scrollByY(300);
            return false;
        }
    );
});

	

	
	
	

	





	
});

 -->
