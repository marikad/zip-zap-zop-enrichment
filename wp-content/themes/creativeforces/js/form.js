var defaultValue = 50; 

$(document).ready(function() {
	
$('#donation-amount').keyup(function() {
	  	this.value = this.value.replace(/[^0-9\.]/g,'');
	  	
	  if($(this).val()) {
         $('#display-amount').text($(this).val());
    } else {
       $('#display-amount').text('--');
       $("#btn2").removeClass('active');
       $("#btn3").removeClass('active');
    }
});

	 $( ".selectvalue" ).click(function() {
	 	$('#display-amount').text($(this).val());
	 });

	$(".buttons .btn").click(function(){
	    $(".buttons .btn").removeClass('active');
	    $(this).toggleClass('active'); 
	  $('#donation-amount').css("background-color","") 
	});
$("#donation-amount").click(function() {

         if ($(this).hasClass('inpt-first')) {

             $(this).css("background-color", "#c97e06");
             $("#default").removeClass('active');
             $("#btn2").removeClass('active');
             $("#btn3").removeClass('active');
             $('.donation-amount').val("");
			$('#display-amount').text('--');
         } 

        else{
            $("#default").addClass('active');   

        }

    });
$('#donation-amount').blur(function() {
  $(this).attr('style', '');
  if($(this).val() == null || $(this).val() == 'Custom') {
    $('#default').addClass('active');
    $('#display-amount').text(50);
  }
});

	$('#display-amount').text($('#default').val());

});