<!--

var current_url = "<?php echo $current_url; ?>";

$(document).ready(function() {

	$('.report_type').click(function(){
	var val=$(this).val();
	if(val==1){
	$('.periodwise').hide();
	$('.datewise').show();
	}else{
	$('.datewise').hide();
	$('.periodwise').show();
	}
	});


$( document ).on("click", "#print_div", function() {
		
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

});

 -->
