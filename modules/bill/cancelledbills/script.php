<!--

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

$( document ).on("click", ".print_bill_button", function() {
	
	var  bill_id=$(this).attr('bill_id');
	var print='print';
	var success_post = $.post('list_bill.php',
		{
			print:print,
			bill_id:bill_id,
		});

	success_post.done(function(data){
		$('#printable-area').html(data);
		});
	
});

$( document ).on("click", "#print_summary_bill_button", function() {
	var bill_date = $("#bill_date").val();

		var success_post = $.post('list_summary_bill.php',
		{
			bill_date:bill_date,
			
		});

	success_post.done(function(data){
		$('#printable-area').html(data);
		$("print_bill").foundation('reveal','open','#');
		});

});
	
	$( document ).on("click", "#print_div", function() {
	printDiv('printable-area');
	
	});
	function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
	}

	});
 -->
