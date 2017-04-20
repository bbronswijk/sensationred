/*
* Basic Count Down to Date and Time
* Author: @mrwigster / trulycode.com
*/

jQuery(document).ready(function($){
	
	if($('#clock').length){
		countdown();
	}
		
	function countdown(){
		var dateString  =  $('input.countdown_date').val();
		var year        = dateString.substring(0,4);
		var month       = dateString.substring(5,7) - 1; // js months start from 0 
		var day         = dateString.substring(8,10);

		var time_array = $('input.countdown_time').val().split(':');
		
		var eventDate = new Date(year, month, day, time_array[0],time_array[1]); 
		var currentDate = new Date();
		
		if (eventDate <= currentDate) {
			clearTimeout(timer); // alles naar 0
			
			return
		}

		    var difference = eventDate.getTime() - currentDate.getTime();
		 
		    var days = Math.floor(difference/1000/60/60/24);
		    difference -= days*1000*60*60*24
		 
		    var hours = Math.floor(difference/1000/60/60);
		    difference -= hours*1000*60*60
		 
		    var minutes = Math.floor(difference/1000/60);
		    difference -= minutes*1000*60
		 
		    var secondsDifference = Math.floor(difference/1000);
		 

		
		$('.days').text(days);
		$('.hours').text(hours);
		$('.minutes').text(minutes);
		$('.seconds').text(secondsDifference);
		
		timer = setTimeout(countdown,1000);
	}

	
	
	
	
});