<!--

var current_url = "<?php echo $current_url; ?>";

 var global_idle="";
function refresh() {
		global_idle="false";
     location.reload();

}

var timer;
function start() {
 timer = setTimeout(function(){refresh()}, 240000);
}

$(document).ready(function() {

start();
       $("body").mousemove(function( event ) {
               if(global_idle==""){
		clearTimeout(timer);
               start();
	}

       });
$(document).scroll(function() {
 if(global_idle==""){
clearTimeout(timer);
 start();
}
});

$(document).keypress(function(e) {
	 if(global_idle==""){
               clearTimeout(timer);
               start();
	}
       });

 $( document ).bind("touchmove", function (event) {
        if(global_idle==""){
               clearTimeout(timer);
               start();
    }
    });


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
			var val="TOTAL : Rs ."+parseFloat(Math.round(data * 100) / 100).toFixed(2);
			$('#tot_button_val').text(val);
		}else{
			$('#tot_button_val').text("TOTAL : Rs .0");
		}
	});
	var discount_refresh='discount';
	var success_post = $.post('add_to_bill.php',
		{
			discount_refresh:discount_refresh,

		});
	success_post.done(function(data){
		if(data>0){
		var val="Discount : Rs ."+data;
			$('.discount').text(val);
		}else{
			$('.discount').text("Discount : Rs .0");
		}

	});
	var paid_change_refresh='paid_change_refresh';
	var success_post = $.post('add_to_bill.php',
		{
			paid_change_refresh:paid_change_refresh,

		});
	success_post.done(function(data){
		if (data.indexOf('!@#$%*') >= 0){
			var paid_change=data.split('!@#$%*');
			$('.paid').text('Paid : Rs.'+paid_change[0]);
			$('.change').text('Change:'+paid_change[1]);
		}else{
			$('.paid').text('Paid : Rs.0');
			$('.change').text('Change:Rs.0');
		}

	});
	var bill_number="bill_number";
	var success_post = $.post(current_url,
			{
				bill_number:bill_number,
			});
	success_post.done(function(data){
			if(data!='0'){
				var val='BILL :'+data;
				$(".bill_number").text(val);
				$(".bill_number").show();
			}else{
				$(".bill_number").hide();
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
	item_id=$(this).attr('item_id');

	var success_post = $.post('add_to_bill.php',
		{
			item_id:item_id,
		});
	success_post.done(function(data){
		if(data!=''){
			if (data.indexOf('!@#$%*') >= 0){
			var bill_items=data.split('!@#$%*');
			$('#item_quantity'+bill_items[0]).val(bill_items[1]);
			$('#item_rate'+bill_items[0]).html(bill_items[2]);
			}else{
			$(".bill").append(data);
			var bill_number="bill_number";
			var success_post = $.post(current_url,
				{
					bill_number:bill_number,
				});
			success_post.done(function(data){
				if(data!='0'){
				var val='BILL :'+data;
				$(".bill_number").text(val);
				$(".bill_number").show();
				}else{
					$(".bill_number").hide();
				}
				});
			}
		}else{
			$(".bill").html("");
		}
		});
		var total="total";
	var success_post = $.post('total_bill_amount.php',
		{
			total:total,

		});
	success_post.done(function(data){
		if(data!='error'){
			var val="TOTAL : Rs ."+parseFloat(Math.round(data * 100) / 100).toFixed(2);
			$('#tot_button_val').text(val);
		}else{
			$('#tot_button_val').text("TOTAL : Rs .0");
		}
	});

	});

	$( document ).on("focus click", ".item_quantity", function() {
	item_id=$(this).attr('item_id');
	$('#item_quantity'+item_id).val('');
	$("#calculater_modal").trigger('click');
	$("#item_id_hidden").val(item_id);
	});
	$('.discount').click(function(){
	select_id=$(this).attr('select_id');
	$('.select_id').val(select_id);
	$('.bill_discount').val('');
	$("#discount_calculater_modal").trigger('click');
	});

	$('.paid').click(function(){
	select_id=$(this).attr('select_id');
	$('.select_id').val(select_id);
	$('.bill_paid_div').show();
	$('.bill_parcel_div').hide();
	$('.bill_paid').val('');
	$("#discount_calculater_modal").trigger('click');

	});

	$( document ).on("focus click", ".parcel", function() {
	
	select_id=$(this).attr('select_id');
	item_id=$(this).attr('item_id');
	bill_item_id=$(this).attr('bill_item_id');
	$('.select_id').val(select_id);
	$('.bill_parcel_div').show();
	$('.bill_paid_div').hide();
	$('.bill_parcel').val('');
	$("#discount_calculater_modal").trigger('click');
	$("#item_id_hidden").val(item_id);
	$("#bill_item_id_hidden").val(bill_item_id);
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


	$( document ).on("click", ".discount_calc_button", function() {

	button_value=$(this).attr('button_value');
	var qty='';
	select_id=$('.select_id').val();
	if($('.'+select_id).val()!=''){
	var old_qty=$('.'+select_id).val();
	qty=(old_qty*10)+Number(button_value);
	}else{
	qty=qty+Number(button_value);
	}
		$('.'+select_id).val(qty);
	});

	$( document ).on("click", ".clear", function() {
	item_id=$("#item_id_hidden").val();
	$('#item_quantity'+item_id).val('');
	});

	$(".clear_val").click(function() {
		select_id=$('.select_id').val();
		$('.'+select_id).val('');
		});

	


	$( document ).on("click", ".ok_discount", function() {
	select_id=$('.select_id').val();
	if(select_id=='bill_discount'){
	var discount=$('.bill_discount').val();
    if(discount!=''){
	var success_post = $.post('add_to_bill.php',
		{
			discount:discount,

		});
	success_post.done(function(data){
		if(data!='0'){
		var val="Discount : Rs ."+data;
			$('.discount').text(val);
		}else{
			$('.discount').text("Discount : Rs .0");
		}

	});
	$("#close_calc_modal").trigger('click');
	var total="total";
	var success_post = $.post('total_bill_amount.php',
		{
			total:total,

		});
	success_post.done(function(data){
		if(data!='error'){
			var val="TOTAL : Rs ."+parseFloat(Math.round(data * 100) / 100).toFixed(2);
			$('#tot_button_val').text(val);
		}else{
			$('#tot_button_val').text("TOTAL : Rs .0");
		}
	});

    }else{

    $('.discount').text("Discount : Rs .0");
    }
    }else {
    if(select_id=='bill_paid'){
	    var paid='';
	    var session='session';
		    var success_post = $.post(current_url,
				{
					session:session,

				});
			success_post.done(function(data){
		    if(data>0){
				var paid=$('.bill_paid').val();
				 if(paid!=''){
			var success_post = $.post('add_to_bill.php',
				{
					paid:paid,

				});
			success_post.done(function(data){
				if(data!='-1'){
				var val="Change:"+data;
					$('.change').text(val);
					$('.paid').text('Paid : Rs.'+paid);
				}else{
					$('.change').text("Change:0");
				}
				});
				$("#close_calc_modal").trigger('click');
				}
				}else{

			$("#close_calc_modal").trigger('click');

				}
				$('.bill_paid_div').hide();
			$('.bill_paid').val('');
				});

}else{
	var item_id=$("#item_id_hidden").val();
	var bill_item_id=$("#bill_item_id_hidden").val();
	var parcel=$('.bill_parcel').val();
	var item_qty=$('#item_quantity'+item_id).val();
	if(item_qty==''){
		popup_alert("item quantity is null","");
	}else if(Number(item_qty) < Number(parcel)){
			popup_alert("selected item quatity is less than of parcel quantity","");
	}else{
		var success_post = $.post('add_to_bill.php',
		{
				item_id:item_id,			
				parcel:parcel,
				bill_item_id:bill_item_id,

		});

		var total="total";
	var success_post = $.post('total_bill_amount.php',
		{

			total:total,

		});
	success_post.done(function(data){
		if(data!='error'){
			var val="TOTAL : Rs ."+parseFloat(Math.round(data * 100) / 100).toFixed(2);
			$('#tot_button_val').text(val);
		}else{
			$('#tot_button_val').text("TOTAL : Rs .0");
		}
		$("#close_calc_modal").trigger('click');
		$('.bill_parcel_div').hide();
		});


}
}
}
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
	$("#close_calc_modal").trigger('click');
	var total="total";
	var success_post = $.post('total_bill_amount.php',
		{
			total:total,

		});
	success_post.done(function(data){
		if(data!='error'){
			var val="TOTAL : Rs ."+parseFloat(Math.round(data * 100) / 100).toFixed(2);
			$('#tot_button_val').text(val);
		}else{
			$('#tot_button_val').text("TOTAL : Rs .0");
		}
	});

	}

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
			$('#tot_button_val').text("TOTAL : Rs .0");
			popup_alert("Bill holded","dashboard.php","Ok","false");
			//location.reload();
			
		}else{
			popup_alert("Bill cannot be holded","");
		}
		});

	});

	$("#opened_bills").click(function() {

	var opened='opened';
	var success_post = $.post('opened_bills.php',
		{
			opened:opened,
		});
	success_post.done(function(data){
		$('#openedbills').html(data);
		});


	});

	$( document ).on("click", ".opened_bill_id", function() {
	var bill_id=$(this).attr('bill_id');
	var success_post = $.post('opened_bills.php',
		{
			bill_id:bill_id,
		});
	success_post.done(function(data){
		if(data==0){
		location.reload();
		}
		});


	});

	$("#print_bill_button").click(function() {

	var print='print';
	var success_post = $.post('print_bill.php',
		{
			print:print,
		});
	success_post.done(function(data){
		$('#printable-area').html(data);
		$('#printable-div').append(data);
		$('#printable-div').append(data);
		
		});


	});



	$( document ).on("click", "#print_div", function() {
		$('#close-print-div').trigger('click');
		printDiv('printable-div');
		
	});

	function printDiv(divName) {
	 window.print();
	
   var new_bill='new_bill';
       var success_post = $.post('cancel.php',
               {
                       new_bill:new_bill,
               });
       success_post.done(function(data){
               if(data==1){
				popup_alert("Order Placed..!","dashboard.php","Ok","false");
               
               }
               });

	}


	$("#payment_button").click(function() {

	var payment='payment';
	var success_post1 = $.post('print_bill.php',
		{
			payment:payment,
		});

		var to_kitchen='to_kitchen';
	var success_post = $.post('kitchen_statuses.php',
		{
			to_kitchen:to_kitchen,
		});
	success_post.done(function(data){
		if(data==1){
		location.reload();
		}
		});
		/*success_post1.done(function(data){
		$('#print_bill').html(data);
		});*/


	});
$( document ).on("click", ".bill_item_cancel", function() {
var  bill_item_id=$(this).attr('bill_item_id');

	var success_post = $.post('cancel.php',
		{
			bill_item_id:bill_item_id,
		});
	success_post.done(function(data){
	if(data!=-1){
		if(data>0){
var val="TOTAL : Rs ."+parseFloat(Math.round(data * 100) / 100).toFixed(2);
			$('#tot_button_val').text(val);
		}else{
			$('#tot_button_val').text("TOTAL : Rs .0");
		}
		$('#bill_item_row'+bill_item_id).remove();
		}else{

		}
		});

});


$(".cancel_button").click(function() {
var cancel='cancel';
var success_post = $.post('cancel.php',
		{
			cancel:cancel,
		});
	success_post.done(function(data){
		if(data==1){
		location.reload();
		}
		});
});

$(".new_bill").click(function() {
var new_bill='new_bill';
var success_post = $.post('cancel.php',
		{
			new_bill:new_bill,
		});
	success_post.done(function(data){
		if(data==1){
		location.reload();
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
