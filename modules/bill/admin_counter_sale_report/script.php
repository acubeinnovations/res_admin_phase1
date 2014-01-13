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

});

 -->
