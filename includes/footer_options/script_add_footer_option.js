/**
 * @author Bram Bronswijk
 */


jQuery(document).ready(function( $ ) {
	
	
	$('.extra_item').live('click', function () {
	       
	      if($('input.number_of_items').val()){
	      	$('input.number_of_items').val(parseInt($('input.number_of_items').val())+1);
	      }
	      else{
	      	$('input.number_of_items').val(1);
	      }

	});
	
	$('.remove_last_item').live('click', function () {
		if($('input.number_of_items').val()){
	      	$('input.number_of_items').val(parseInt($('input.number_of_items').val())-1);
	      }
	});

});