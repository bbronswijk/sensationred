/**
 * @author Bram Bronswijk
 */

jQuery(document).ready(function($){
	
    var custom_uploader;

    $('.he_upload_image_button').click(function(e) {
 		upload_field_id = jQuery(this).attr('id').replace ( /[^\d.]/g, '' );
 		
        e.preventDefault();
        
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
        	$('.editor #img_class').val('');
        	 $('.editor #img_id').val('');
            attachment = custom_uploader.state().get('selection').first().toJSON();
            img_id = attachment.id;
            $('.editor #img_id').val(img_id);
            // full image post
           	if( upload_field_id == 1){
           		$('#he_full_img_preview').attr('src',attachment.url);
            	$('#he_full_img_preview').fadeIn(300);
	
	            // calculate ratio of image
	            width_img = attachment.width;
				height_img = attachment.height;
				ratio = width_img/height_img;
				
	           	$('#he_full_img_preview').css({"left": "0","top": "0"});
				$('#he_full_img_preview').removeClass('vertical horizontal');
	
				if( 0.823 > ratio){	

						$('#he_full_img_preview').addClass('vertical');
						$('.editor #img_class').val('vertical');
						height = $('#he_full_img_preview').height();
						
						position = jQuery('.editor').position();
			  	 		height_img = (attachment.height*210)/attachment.width;
			  	 		
						constraint_top = jQuery('.editor').offset().top + 287 + 66 - height_img;
						
						constraint_bottom = jQuery('.editor').offset().top + 30 + 66;
						
						$('.vertical').draggable({
							axis:"y",
							containment: [0, constraint_top, 0, constraint_bottom]
							});
					}
					
				else if( 0.824 < ratio){
						$('#he_full_img_preview').addClass('horizontal');
						$('.editor #img_class').val('horizontal');
						position = jQuery('.editor').position();
			  	 		width_img = (attachment.width*255)/attachment.height;
			  	 		
						constraint_left = position.left + 30 + 210 - 179 - width_img;
						constraint_right = position.left + 30 - 180;
						$('.horizontal').draggable({
							axis:"x",
	    					containment: [constraint_left, 0 , constraint_right, 0]
							});
					}
					
			}
        	
        	// mixed post
            if( upload_field_id == 2){
           		$('#he_mixed_img_preview').attr('src',attachment.url);
            	$('#he_mixed_img_preview').fadeIn(300);
            	
            	// calculate ratio of image
	            width_img = attachment.width;
				height_img = attachment.height;
				ratio = width_img/height_img;
				
	           	$('#he_mixed_img_preview').css({"left": "0","top": "0"});
				$('#he_mixed_img_preview').removeClass('vertical horizontal');
            	
            	if( 1.61539 >= ratio){
            			$('#he_mixed_img_preview').addClass('vertical');
						$('.editor #img_class').val('vertical');
						position = jQuery('.editor').position();
			  	 		height_img = (attachment.height*210)/attachment.width;
			  	 		
						constraint_top = jQuery('.editor').offset().top + 287 - 125 + 66 - height_img;
						
						constraint_bottom = jQuery('.editor').offset().top + 30 + 66;
						
						$('.vertical').draggable({
							axis:"y",
							containment: [0, constraint_top, 0, constraint_bottom]
							});
            	}
            	else{
            		$('#he_mixed_img_preview').addClass('horizontal');
						$('.editor #img_class').val('horizontal');
						position = jQuery('.editor').position();
			  	 		width_img = (attachment.width*130)/attachment.height;
			  	 		
						constraint_left = position.left + 30 + 210 - 175 - width_img;
						constraint_right = position.left + 30 - 180;
						
						$('.horizontal').draggable({
							axis:"x",
	    					containment: [constraint_left, 0 , constraint_right, 0]
							});
            	}
        	}
            
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
    
    // when scrolling the draggable function needs to be recalibrated 
    $( window ).scroll(function() {
		    recalibrate_vertical();   
		    recalibrate_horizontal();
	});
	
	// when scrolling the draggable function needs to be recalibrated 
	function recalibrate_vertical(){
		if($('#he_full_img_preview').is('.vertical') && $('#he_full_img_preview').is(":visible")){
		    			height = $('#he_full_img_preview').height();
						
						position = jQuery('.editor').position();
			  	 		
						constraint_top = jQuery('.editor').offset().top + 287 + 66 - height;
						
						constraint_bottom = jQuery('.editor').offset().top + 30 + 66;
						
						$('.vertical').draggable({
							axis:"y",
							containment: [0, constraint_top, 0, constraint_bottom]
							});
		    }
		    else if($('#he_mixed_img_preview').is('.vertical') && $('#he_mixed_img_preview').is(":visible")){
		    			height = $('#he_mixed_img_preview').height();
		    			
						position = jQuery('.editor').position();
			  	 		
						constraint_top = jQuery('.editor').offset().top + 287 - 125 + 66 - height;
						
						constraint_bottom = jQuery('.editor').offset().top + 30 + 66;
						
						$('.vertical').draggable({
							axis:"y",
							containment: [0, constraint_top, 0, constraint_bottom]
							});
		    }
	}
	
	// when scrolling the draggable function needs to be recalibrated 
	function recalibrate_horizontal(){
		
		if($('#he_full_img_preview').is('.horizontal') && $('#he_full_img_preview').is(":visible")){
						
		    			width = $('#he_full_img_preview').width();
						
						position = jQuery('.editor').position();
			  	 		
						
						constraint_left = position.left + 30 + 210 - 179 - width;
						constraint_right = position.left + 30 - 180;
						$('.horizontal').draggable({
							axis:"x",
	    					containment: [constraint_left, 0 , constraint_right, 0]
							});
		    }
		 else if($('#he_mixed_img_preview').is('.horizontal') && $('#he_mixed_img_preview').is(":visible")){
		    			width = $('#he_mixed_img_preview').width();
						
						position = jQuery('.editor').position();
			  	 		
			  	 		
						constraint_left = position.left + 30 + 210 - 175 - width;
						constraint_right = position.left + 30 - 180;
						
						$('.horizontal').draggable({
							axis:"x",
	    					containment: [constraint_left, 0 , constraint_right, 0]
							});
		    }
	}
	


	// fire up the editor
	$('.edit_post').live("mousedown",function(){
			$('.editor').fadeIn(300);
			$('.editor_bg').fadeIn(300);
			box_id = $(this).attr('id').replace ( /[^\d.]/g, '' );
			$('.editor #box_id').val(box_id);
			
			if($('#'+box_id+' .content .full_post_content').length){
				// red box with text
				$('.editor #box_type').val('text');
		 		$('#choice_2').fadeIn(300);
		 		$('#submit_post').fadeIn(300);
		 		if ($('.full_text_ta').is(':visible') ){ 	
		 			content = $('#'+box_id+' .content .full_post_content').html(); 	
		    		$('.full_text_ta').val(content);
		    		}
		    	if ($('.full_text_ta').is(':hidden') ){ 
		    		content = $('#'+box_id+' .content .full_post_content').html();
		    		$('.editor .full_post_content').html(content);	
		    		}
		    	if($(this).parent().hasClass('clickable') ){
		    		url_to_page = $('#'+box_id+' a').attr('href');
		    		$('#page_url').val(url_to_page);
		    	}
		 		
			}
			else if($('#'+box_id+' .content .post_thumb').length){
				// mixed post
				img_id = $('#'+box_id+' .content img').attr('id').replace ( /[^\d.]/g, '' );
				$('.editor #img_id').val(img_id);
				$('.editor #box_type').val('mixed');
		 		$('#choice_3').fadeIn(300);
		 		$('#submit_post').fadeIn(300);
		 		src = $('#'+box_id+' .content .post_thumb img').attr('src');
		 		img_class = $('#'+box_id+' .content .post_thumb img').attr('class');
		 		img_top = $('#'+box_id+' .content .post_thumb img').css('top');
				img_left = $('#'+box_id+' .content .post_thumb img').css('left');
				$('#he_mixed_img_preview').css('top',img_top);
				$('#he_mixed_img_preview').css('left',img_left);
		 		$('#he_mixed_img_preview').attr('src',src);
		 		$('#he_mixed_img_preview').fadeIn(300);
		 		$('#he_mixed_img_preview').attr('class',img_class);
		 		$('.editor #img_class').val(img_class);
		 		if(img_class == 'horizontal'){
		 			setTimeout(function () { recalibrate_horizontal(); }, 300);
		 		} 
		    	else if(img_class == 'vertical'){
		 			setTimeout(function () { recalibrate_vertical(); }, 300);
		 		} 
		 		if ($('.mixed_ad_ta').is(':visible') ){ 	
		 			content = $('#'+box_id+' .content .post_content').html(); 	
		    		$('.mixed_ad_ta').val(content);
		    		}
		    	if ($('.mixed_ad_ta').is(':hidden') ){ 
		    		content = $('#'+box_id+' .content .post_content').html();
		    		$('.editor .post_content').html(content);	
		    		}
		 		if($(this).parent().hasClass('clickable') ){
		    		url_to_page = $('#'+box_id+' a').attr('href');
		    		$('#page_url').val(url_to_page);
		    	}		 		
			}
			else if($('#'+box_id+' .content img').length){
				// big image
				img_id = $('#'+box_id+' .content img').attr('id').replace ( /[^\d.]/g, '' );
				$('.editor #img_id').val(img_id);
				$('.editor #box_type').val('image');
		 		$('#choice_1').fadeIn(300);
		 		$('#submit_post').fadeIn(300);
		 		src = $('#'+box_id+' .content img').attr('src');
		 		img_class = $('#'+box_id+' .content img').attr('class');
		 		img_top = $('#'+box_id+' .content img').css('top');
				img_left = $('#'+box_id+' .content img').css('left');
				$('#he_full_img_preview').css('top',img_top);
				$('#he_full_img_preview').css('left',img_left);
		 		$('#he_full_img_preview').attr('src',src);
		 		$('#he_full_img_preview').fadeIn(300);
		 		$('#he_full_img_preview').attr('class',img_class);
		 		$('.editor #img_class').val(img_class);
		 		if(img_class == 'horizontal'){
		 			setTimeout(function () { recalibrate_horizontal(); }, 300);
		 		} 
		    	else if(img_class == 'vertical'){
		 			setTimeout(function () { recalibrate_vertical(); }, 300);
		 		} 
				if($(this).parent().hasClass('clickable') ){
		    		url_to_page = $('#'+box_id+' a').attr('href');
		    		$('#page_url').val(url_to_page);
		    	}
			}
			else{
				$('.step1').fadeIn(300);
			}
	});
	
	// close the editor
	$('.editor_bg').click(function(){
			close_editor();
	});
	
	$('#close_editor').click(function(){
			close_editor();
	});
	$('.box_back').click(function(){
			$('.choice').hide();
			$('#submit_post').hide();
			$('.step1').fadeIn(300);
			
	});
	$('.box_reset').click(function(){
			$('.choice').hide();
			$('#submit_post').hide();
			$('.step1').fadeIn(300);			
			$('.editor #box_type').val('');
			box_id = $('.editor #box_id').val();
			$('#'+box_id).addClass('empty_post');
			$('#'+box_id).html('<div id="edit_post_'+box_id+'" class="edit_post"><i class="fa fa-pencil-square-o"></i></div><div class="content"></div>');
			data = { 
				action 		: 	'reset_box_db',
				box_id 		: 	box_id,
			};
			$.post(ajaxurl,data,function(response){
				
			});
	});
	
	function close_editor(){
			$('.editor #box_type').val('');
			$('.editor #img_class').val('');	
			$('.editor #img_id').val('');
			$('#page_url').val('');
			$('.editor').fadeOut(300);
			$('.editor_bg').fadeOut(300);
			$('.choice').fadeOut(300);
			$('.step1').fadeOut(300);
			$('#submit_post').hide();
			
	}
	
	// when choice is made
	$('.step1 img').click(function(){
		
		 	choice = jQuery(this).attr('class').replace ( /[^\d.]/g, '' );
		 	
		 	if( choice == 1 ){
		 		$('.editor .recent_post img').attr('src','');
		 		$('.editor .recent_post img').hide();
		 		$('.step1').fadeOut(300);
		 		$('.editor #box_type').val('image');
		 		$('#choice_1').delay(300).fadeIn(300);
		 	}
		 	if( choice == 2 ){
		 		$('.step1').fadeOut(300);
		 		$('.editor #box_type').val('text');
		 		$('#choice_2').delay(300).fadeIn(300);		
		 	}
		 	
		 	if( choice == 3 ){
		 		$('.editor .recent_post img').attr('src','');
		 		$('.editor .recent_post img').hide();
		 		$('.step1').fadeOut(300);
		 		$('.editor #box_type').val('mixed');
		 		$('#choice_3').delay(300).fadeIn(300);
		 	}
		 	$('#submit_post').delay(300).fadeIn(300);
	 	
	});
	
	
	// html full text
	$(".full_button_html").live("mousedown",function() {
			update_full_post_content_text();
		    if ($('.full_text_ta').is(':hidden') ){ 	    		
		    		$('.button_h1').hide();
		    		$('.editor .full_post_content').hide();
		    		$('.editor .full_text_ta').show();
		    		$('.full_button_html').css("background","#fff");
		    		$('.full_button_visual').css("background","#EBEBEB");
		    		$('.full_button_visual').css("color","#555");
		    	}
	});
	
	// visual full text
	$(".full_button_visual").live("mousedown",function() {
		
		    if ($('.full_text_ta').is(':visible') ){ 	    		
		    		$('.button_h1').fadeIn(500);
		    		$('.editor .full_post_content').fadeIn(500);
		    		$('.editor .full_text_ta').hide();
		    		$('.full_button_html').css("background","#EBEBEB");
		    		$('.full_button_visual').css("background","#ea1a35");
		    		$('.full_button_visual').css("color","#fff");
		    		$('.editor .full_post_content').html($('.full_text_ta').val());
		    	}
	});
	
	// html image text
	$(".button_html").live("mousedown",function() {
			update_post_content_text();
		    if ($('.button_html').is(':visible') ){ 	    		
		    		$('.button_h2').hide();
		    		$('.editor .post_content').hide();
		    		$('.mixed_ad_ta').show();
		    		$('.button_html').css("background","#fff");
		    		$('.button_visual').css("background","#EBEBEB");
		    	}
	});
	
	// visual image text
	$(".button_visual").live("mousedown",function() {
		    if ($('.button_visual').is(':visible') ){ 
		    		$('.button_h2').fadeIn(500);
		    		$('.editor .post_content').show();
		    		$('.mixed_ad_ta').hide();
		    		$('.button_html').css("background","#EBEBEB");
		    		$('.button_visual').css("background","#fff");
		    		$('.editor .post_content').html($('.mixed_ad_ta').val());
		    	}
	});
	
	
	//Grab selected text
	function getSelectedElem(){
		    if(window.getSelection){
		        return $(window.getSelection().anchorNode);
		    }
		    else if(document.getSelection){
		        return $(document.getSelection().anchorNode)
		    }
		    else if(document.selection){
		        //todo figure out what to return here:
		        return document.selection.createRange().text;
		    }
		    return $([]);
	}
	
	
	
	// style text
	$(".button_h2").live("mousedown",function() {
		    var sel = getSelectedElem();
		    
		    if( sel.parent( ".editor .post_content" ).length > 0 ){
			    if($.trim(sel.text()).length >= 1) {
			        sel.wrap('<h2>');		        
			    }
		    }
		    else if( sel.parent().parent( ".editor .post_content" ).length > 0 ){
			    if($.trim(sel.text()).length >= 1) {
			        sel.wrap('<h2>');		        
			    }
		    }
	});
	
	$(".button_h1").live("mousedown",function() {
		    var sel = getSelectedElem();
		    if( sel.parent( ".editor .full_post_content" ).length > 0 ){
			    if($.trim(sel.text()).length >= 1) {	
			        sel.wrap('<h1>');		        
			    }
		    }	
		    else if( sel.parent().parent( ".editor .full_post_content" ).length > 0 ){
			    if($.trim(sel.text()).length >= 1) {
			        sel.wrap('<h1>');		        
			    }
		    }	
	});
	
	// update the textarea of the mixedbox with the content of the editable div
	function update_post_content_text(){
	        var content = jQuery('.editor .post_content').html();
	        $('.mixed_ad_ta').val(content);
	        
	        var stripped_content = $('.mixed_ad_ta').val().replace("&lt;/h2&gt;","</h2>").replace("&lt;h2&gt;","<h2>").replace(/<\/div>/g,"").replace(/<div>/g,"<br>");    
	        var new_stripped_content = stripped_content.replace(/<p>/g,'').replace(/<\/p>/g,"").replace(/<br><br><br>/g,"<br><br>");
	        
			$('.mixed_ad_ta').val(new_stripped_content);
	        $(".editor .post_content:contains('h2')").html($('.mixed_ad_ta').val());
	}

	// update the textarea of the redbox with the content of the editable div
	function update_full_post_content_text(){
	        var content = jQuery('.editor .full_post_content').html();
	        $('.full_text_ta').val(content);	        
	        $('.full_post_content > p').contents().unwrap();
	        
	        var stripped_content = $('.full_text_ta').val().replace("&lt;/h1&gt;","</h1>").replace("&lt;h1&gt;","<h1>").replace(/<\/div>/g,"").replace(/<div>/g,"<br>");    
	        var new_stripped_content = stripped_content.replace(/<p>/g,"").replace(/<\/p>/g,"").replace(/<br><br><br>/g,"<br><br>");   
	        
			$('.full_text_ta').val(new_stripped_content);
	        $(".full_post_content:contains('h1')").html($('.full_text_ta').val());
	}
	
	// synchronize the editor with the actual posts
	function sync_editor(){
			type = $('#box_type').val();
			id = $('#box_id').val();
			$('#'+id).removeClass('empty_post');
			
			if(type=='image'){	
				img_id = $('.editor #img_id').val();
				src= $('#he_full_img_preview').attr('src');
				img_top = $('#he_full_img_preview').css('top');
				img_left = $('#he_full_img_preview').css('left');
				img_class = $('.editor #img_class').val();
				$('#'+id+' .content').html('<img id="img_id_'+img_id+'" src="'+src+'" class="'+img_class+'"  style="position: absolute; left: '+img_left+'; top: '+img_top+';" />');
				if($('#page_url').val()){
					$('#'+id).addClass('clickable');
					page_url = $('#page_url').val();
					$('#'+id+' .content').wrap('<a href="'+page_url+'"></a>');
				}
				else{
					$('#'+id).removeClass('clickable');
					if($('#'+id+' .content').parent('a').length > 0){
						$('#'+id+' .content').unwrap();
					}
				}
			}
			if(type=='text'){
				content = $('.editor .full_text_ta').val();
				$('#'+id+' .content').html('<div class="full_post_content">'+content+'</div>');
				if($('#page_url').val()){
					$('#'+id).addClass('clickable');
					page_url = $('#page_url').val();
					$('#'+id+' .content').wrap('<a href="'+page_url+'"></a>');
				}
				else{
					$('#'+id).removeClass('clickable');
					if($('#'+id+' .content').parent('a').length > 0){
						$('#'+id+' .content').unwrap();
					}
				}
			}
			if(type=='mixed'){
				
				img_id = $('.editor #img_id').val();
				src= $('#he_mixed_img_preview').attr('src');
				img_top = $('#he_mixed_img_preview').css('top');
				img_left = $('#he_mixed_img_preview').css('left');
				img_class = $('.editor #img_class').val();
				content = $('.mixed_ad_ta').val();
				html = '<div class="post_thumb"><img id="img_id_'+img_id+'" src="'+src+'" class="'+img_class+'"  style="position: absolute; left: '+img_left+'; top: '+img_top+';" /></div><div class="post_content">'+content+'</div>';
				$('#'+id+' .content').html(html);
				if($('#page_url').val()){
					$('#'+id).addClass('clickable');
					page_url = $('#page_url').val();
					$('#'+id+' .content').wrap('<a href="'+page_url+'"></a>');
				}
				else{
					$('#'+id).removeClass('clickable');
					if($('#'+id+' .content').parent('a').length > 0){
						$('#'+id+' .content').unwrap();
					}
					
				}
			}
	}

	// save everything to the database
	$('.save_box').click(function(){
		if ($('.mixed_ad_ta').is(':hidden')){ 
				update_post_content_text();
			}
		if($('.full_text_ta').is(':hidden')){
				update_full_post_content_text();
			}
		box_id = $('.editor #box_id').val();
		box_type = $('.editor #box_type').val();
		page_url = $('.editor #page_url').val();
		
		if(box_type == 'image'){
			src= $('#he_full_img_preview').attr('src');
			img_top = $('#he_full_img_preview').css('top');
			img_left = $('#he_full_img_preview').css('left');
			img_class = $('.editor #img_class').val();
			img_id = $('.editor #img_id').val();
			
			data = { 
				action 		: 	'save_box_db',
				box_id 		: 	box_id,
				box_type 	: 	box_type,
				src 		: 	src,
				img_id		: 	img_id,
				img_top		: 	img_top,
				img_left	: 	img_left,
				img_class	: 	img_class,
				page_url	: 	page_url
			};
		}
		else if(box_type == 'text'){
			content = $('.full_text_ta').val();
			
			data = { 
				action 		: 	'save_box_db',
				box_id 		: 	box_id,
				box_type	: 	box_type,
				content 	:	content,
				page_url	: 	page_url
			};
		}
		else if(box_type == 'mixed'){
			src= $('#he_mixed_img_preview').attr('src');
			img_top = $('#he_mixed_img_preview').css('top');
			img_left = $('#he_mixed_img_preview').css('left');
			img_class = $('.editor #img_class').val();
			img_id = $('.editor #img_id').val();
			content = $('.editor .mixed_ad_ta').val();
			
			data = { 
				action 		: 	'save_box_db',
				box_id 		: 	box_id,
				box_type 	: 	box_type,
				src 		: 	src,
				img_id		: 	img_id,
				img_top		: 	img_top,
				img_left	: 	img_left,
				img_class	: 	img_class,
				page_url	: 	page_url,
				content		: 	content
			};
		}
		
		
		jQuery.post(ajaxurl,data,function(response){
			
			sync_editor();
			close_editor();
		});
			
			
			
	});
 
 
});