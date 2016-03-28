/**
 * @author Bram Bronswijk
 */
jQuery(document).ready(function($){
	
	$('.sponsor_posts').on('click', function () {
		
		var element = $(this);
		var content = element.find('.sponsor_post_content');
		var wrapper = $('.wrapper');
		
		// When open sponsor is clicked close it
		if( content.is(":visible") ){
			content.slideToggle(100);
			return; // exit rest of function
		}		
		
		// Calculate horizontal position of triangle
		pos_wrapper = wrapper.offset().left;
		width_wrapper = wrapper.width();
		pos_sponsor= element.offset().left;
		offset_sponsor =  pos_sponsor - pos_wrapper;
				
		margin = (( offset_sponsor / width_wrapper ) * 100) + 4 +'%' ;
		
		// Toggle andere sponsor die open is			
		$('.sponsor_post_content:visible').slideToggle(200);			
			
		// Toggle sponsor
		content.slideToggle(100, function() {
			element.find('.box').css('margin-left', margin);
		});
     	
	});
	
});