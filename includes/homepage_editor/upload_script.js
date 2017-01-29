/**
 * @author Bram Bronswijk
 */

jQuery(document).ready(function($){
	
    var custom_uploader;
 
    var qtranslate_active = false;
    
    $editor = $('.editor');
   
    
    if( $('#homepage_form').hasClass('qtranslate_active') )
    	qtranslate_active = true;
    
    $('.he_upload_image_button').click(function(e) {
 		upload_field_id = jQuery(this).attr('id').replace ( /[^\d.]/g, '' );
 		
        e.preventDefault();
        
        // If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        // Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Kies afbeelding',
            button: {
                text: 'Kies afbeelding'
            },
            multiple: false
        });
 
        // When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
        	// Reset fields
        	$editor.find('#img_class').val('');
        	$editor.find('#img_id').val('');
        	
            attachment = custom_uploader.state().get('selection').first().toJSON();
            var img_id = attachment.id;
            
            // set image id in field
            $editor.find('#img_id').val(img_id);
            
            var uploaded_image = {};
            
            if( upload_field_id == 1){
            	$preview_image = $('#he_full_img_preview'); // moveable image in editor
            } else if( upload_field_id == 2 ){
            	$preview_image = $('#he_mixed_img_preview');
            }
            
            // prepare preview image
       		$preview_image.attr('src',attachment.url);
       		$preview_image.css({"left": "0","top": "0"});
			$preview_image.removeClass('vertical horizontal');
       		$preview_image.fadeIn(300);
				
			// set values
			uploaded_image.org_width = attachment.width; 
			uploaded_image.org_height = attachment.height;
			uploaded_image.ratio = (uploaded_image.org_width / uploaded_image.org_height);
            
			$preview_image.attr('src',attachment.url);
        	$preview_image.fadeIn(300);

            // FULL IMAGE POST
           	if( upload_field_id == 1){           		
 
				// als de afbeelding hoger is dan de post 
				if( 0.823 > uploaded_image.ratio){						
						$preview_image.addClass('vertical');
						$editor.find('#img_class').val('vertical');
						uploaded_image.type = 'vertical';
						
						calibrate_vertical()
					}
				// als de afbeelding breder is dan de post 	
				else if( 0.824 < uploaded_image.ratio){
						// set variables
						$preview_image.addClass('horizontal');
						$editor.find('#img_class').val('horizontal');
						uploaded_image.type = 'horizontal';
						
						calibrate_horizontal()
					}
			}
        	
        	// MIXED POST
            if( upload_field_id == 2){
            	console.log()
            	if( 1.61539 >= uploaded_image.ratio){ 
            		$preview_image.addClass('vertical');
					$('.editor #img_class').val('vertical');
					uploaded_image.type = 'vertical';
					
					calibrate_vertical(); 
            	}
            	else{
            		$preview_image.addClass('horizontal');
            		$('.editor #img_class').val('horizontal');
            		uploaded_image.type = 'horizontal';
            		
					calibrate_horizontal()
            	}
        	}
            
        });
 
        //Open the uploader dialog
        custom_uploader.open();
        
 
    });
    
    // when scrolling the draggable function needs to be recalibrated 
    $( window ).scroll(function() {
    	if($('#he_full_img_preview').is('.vertical') && $('#he_full_img_preview').is(":visible")){
			$recentpost = $editor.find('#choice_1 .recent_post');
    	} else if($('#he_mixed_img_preview').is('.vertical') && $('#he_mixed_img_preview').is(":visible")){
			$recentpost = $editor.find('#choice_3 .recent_post');
    	} else{
    		return false;
    	}
    	
    	if( $recentpost.find('img').hasClass('vertical') )
		    calibrate_vertical();   
    	
    	if( $recentpost.find('img').hasClass('horizontal') )
		    calibrate_horizontal();
	});
	
    // example http://jsfiddle.net/DerNa/364/
	// when scrolling the draggable function needs to be recalibrated 
	function calibrate_vertical(){
		
		var safetymarge = 2;
		
		if($('#he_full_img_preview').is('.vertical') && $('#he_full_img_preview').is(":visible")){
			$recentpost = $editor.find('#choice_1 .recent_post');
			var img_height = $('#he_full_img_preview').height();
			var container_height = 255;
		}
		else if($('#he_mixed_img_preview').is('.vertical') && $('#he_mixed_img_preview').is(":visible")){
			$recentpost = $editor.find('#choice_3 .recent_post');
			var img_height = $('#he_mixed_img_preview').height();
			var container_height = 130;
		}
		
		var constraint_top =  $recentpost.offset().top;
				
		var constraint_3 = constraint_top - ( img_height - container_height ) + safetymarge;
		var constraint_4 = constraint_top  - safetymarge;
		
			$('.vertical').draggable({
				axis:"y",
				containment: [0, constraint_3, 0, constraint_4]
			});
	}
	
	// when scrolling the draggable function needs to be recalibrated 
	function calibrate_horizontal(){
		
		var safetymarge = 5;
		
		// Get with of images
		if($('#he_full_img_preview').is('.horizontal') && $('#he_full_img_preview').is(":visible")){
			$recentpost = $editor.find('#choice_1 .recent_post');
			img_width = $('#he_full_img_preview').width();
						
		} else if($('#he_mixed_img_preview').is('.horizontal') && $('#he_mixed_img_preview').is(":visible")){
			$recentpost = $editor.find('#choice_3 .recent_post');
			img_width = $('#he_mixed_img_preview').width();			
		}
				
		// get position left
		var constraint_left = $recentpost.offset().left; 
		
		// calculate constraints
		var constraint_1 = constraint_left - ( img_width - $recentpost.width() ) + safetymarge;
		var constraint_2 = constraint_left  - safetymarge;
		
		$('.horizontal').draggable({
			axis:"x",
			containment: [constraint_1, 0 , constraint_2, 0]
		});
		
	}
	


	// fire up the editor
	$('.edit_post').live("mousedown",function(){		
			$editor.fadeIn(300);
			$('.editor_bg').fadeIn(300);
			
			
			box_id = $(this).attr('id').replace ( /[^\d.]/g, '' );
			$box = $('#'+box_id);
			
			// Set input field box_id 
			$('.editor #box_id').val(box_id);			
		
			// if post has custom class
			var post_class = $box.attr('class').replace('recent_post','').replace('clickable','').replace('empty_post','').trim();
			$('#custom_class').val(post_class);
			

			// if post was clickable set field
			if($box.hasClass('clickable') ){
	    		url_to_page = $box.find('a').attr('href');
	    		$('#page_url').val(url_to_page);
	    	}	
			
			// POST TYPE : FULL POST CONTENT = ROOD BLOK
			if( $box.find('.content .full_post_content').length){
				// red box with text
				$('.editor #box_type').val('text');
		 		$('#choice_2').fadeIn(300);
		 		$('#submit_post').fadeIn(300);
		 		
		 		// Set the content in the 
		 		if ($('.full_text_ta').is(':visible') ){ 	
		 			content = $box.find('.content .full_post_content').html().trim(); 	
		    		$('.full_text_ta').val(content);
		    	}
		    	if ($('.full_text_ta').is(':hidden') ){ 
		    		content = $box.find('.content .full_post_content').html();
		    		$('.editor .full_post_content').html(content);	
		    	}
		 		
			} else if($('#'+box_id+' .content .post_thumb').length){
				// POST TYPE MIXED POST
				img_id = $('#'+box_id+' .content img').attr('id').replace ( /[^\d.]/g, '' );
				
				// Show options
				$('.editor #img_id').val(img_id);
				$('.editor #box_type').val('mixed');
		 		$('#choice_3').fadeIn(300);
		 		$('#submit_post').fadeIn(300);
		 		
		 		// Get variabls image
		 		src = $('#'+box_id+' .content .post_thumb img').attr('src');
		 		img_class = $('#'+box_id+' .content .post_thumb img').attr('class');
		 		img_top = $('#'+box_id+' .content .post_thumb img').css('top');
				img_left = $('#'+box_id+' .content .post_thumb img').css('left');
				
				// Set image
				$mixed_img = $('#he_mixed_img_preview');
				
				$mixed_img.css('top',img_top);
				$mixed_img.css('left',img_left);
				$mixed_img.attr('src',src);
				$mixed_img.fadeIn(300);
				$mixed_img.attr('class',img_class);
				
		 		$editor.find('#img_class').val(img_class);
		 		
		 		// Enable draggable image
		 		if(img_class == 'horizontal'){
		 			setTimeout(function () { calibrate_horizontal(); }, 300);
		 		} 
		    	else if(img_class == 'vertical'){
		 			setTimeout(function () { calibrate_vertical(); }, 300);
		 		} 
		 		
		 		// SET CONTENT
		 		if ($('.mixed_ad_ta').is(':visible') ){ 	
		 			content = $box.find('.content .post_content').html(); 	
		    		$('.mixed_ad_ta').val(content);
		    	}
		    	if ($('.mixed_ad_ta').is(':hidden') ){ 
		    		content =  $box.find('.content .post_content').html();
		    		$editor.find('.post_content').html(content);	
		    	}
		 			 		
			}
			else if($('#'+box_id+' .content img').length){
				// POST TYPE FULL IMAGE
				img_id = $box.find('.content img').attr('id').replace ( /[^\d.]/g, '' );
				
				// Show options
				$('.editor #img_id').val(img_id);
				$('.editor #box_type').val('image');
		 		$('#choice_1').fadeIn(300);
		 		$('#submit_post').fadeIn(300);
		 		
		 		// Get variables image
		 		$content_img = $box.find('.content img'); // from clicked post
		 		src = $content_img.attr('src');
		 		img_class = $content_img.attr('class');
		 		img_top = $content_img.css('top');
				img_left = $content_img.css('left');
				
				$img_preview = $('#he_full_img_preview');
				$img_preview.css('top',img_top);
				$img_preview.css('left',img_left);
				$img_preview.attr('src',src);
				$img_preview.fadeIn(300);
				$img_preview.attr('class',img_class);
				
		 		$editor.find('#img_class').val(img_class);
		 		
		 		// Enable draggable image
		 		if(img_class == 'horizontal'){
		 			setTimeout(function () { calibrate_horizontal(); }, 300);
		 		} 
		    	else if(img_class == 'vertical'){
		 			setTimeout(function () { calibrate_vertical(); }, 300);
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
			// fade editor and overlay out
			$editor.fadeOut(300);
			$('.editor_bg').fadeOut(300);
			// reset fields
			$editor.find('#box_type').val('');
			$editor.find('#img_class').val('');	
			$editor.find('#img_id').val('');
			$editor.find('#page_url').val('');
			// reset steps
			$editor.find('.choice').fadeOut(300);
			$editor.find('.step1').fadeOut(300);
			$editor.find('#submit_post').hide();			
	}
	
	// when choice is made
	$('.step1 img').click(function(){
		
		 	choice = $(this).attr('class').replace ( /[^\d.]/g, '' );
		 	
		 	if( choice == 1 ){
		 		$editor.find('.recent_post img').attr('src','');
		 		$editor.find('.recent_post img').hide();
		 		$editor.find('.step1').fadeOut(300);
		 		$editor.find('#box_type').val('image');
		 		$editor.find('#choice_1').delay(300).fadeIn(300);
		 	}
		 	if( choice == 2 ){
		 		$editor.find('.step1').fadeOut(300);
		 		$editor.find('#box_type').val('text');
		 		$editor.find('#choice_2').delay(300).fadeIn(300);		
		 	}
		 	
		 	if( choice == 3 ){
		 		$editor.find('.recent_post img').attr('src','');
		 		$editor.find('.recent_post img').hide();
		 		$editor.find('.step1').fadeOut(300);
		 		$editor.find('#box_type').val('mixed');
		 		$editor.find('#choice_3').delay(300).fadeIn(300);
		 	}
		 	
		 	$('#submit_post').delay(300).fadeIn(300);
	 	
	});
	
	// VISUAL HTML EDITOR SWITCHING BUTTONS
	
	// html full text
	$(".full_button_html").live("mousedown",function() {
			update_full_post_content_text();
		    if ($('.full_text_ta').is(':hidden') ){ 	    		
		    		$('.button_h1').hide();
		    		$editor.find('.full_post_content').hide();
		    		$editor.find('.full_text_ta').show();
		    		$editor.find('.qtranxs-lang-switch-wrap').show();
		    		$('.full_button_html').css("background","#fff");
		    		$('.full_button_visual').css("background","#EBEBEB");
		    		$('.full_button_visual').css("color","#555");
		    	}
	});
	
	// visual full text
	$(".full_button_visual").live("mousedown",function() {
		
		    if ($('.full_text_ta').is(':visible') ){ 	    		
		    		$('.button_h1').fadeIn(500);
		    		$editor.find('.full_post_content').fadeIn(500);
		    		$editor.find('.full_text_ta').hide();
		    		$editor.find('.qtranxs-lang-switch-wrap').hide();
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
		    		$editor.find('.post_content').hide();
		    		$('.mixed_ad_ta').show();
		    		$('.button_html').css("background","#fff");
		    		$('.button_visual').css("background","#EBEBEB");
		    	}
	});
	
	// visual image text
	$(".button_visual").live("mousedown",function() {
		    if ($('.button_visual').is(':visible') ){ 
		    		$('.button_h2').fadeIn(500);
		    		$editor.find('.post_content').show();
		    		$('.mixed_ad_ta').hide();
		    		$('.button_html').css("background","#EBEBEB");
		    		$('.button_visual').css("background","#fff");
		    		$editor.find('.post_content').html($('.mixed_ad_ta').val());
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
	
	/* LIVE UPDATE TEXTAREAS FROM CONTENT EDITABLE DIV */
	
	// update the textarea of the mixedbox with the content of the editable div
	function update_post_content_text(){
	        var content = $editor.find('.post_content').html();
	        $('.mixed_ad_ta').val(content);
	        
	        var stripped_content = $('.mixed_ad_ta').val().replace("&lt;/h2&gt;","</h2>").replace("&lt;h2&gt;","<h2>").replace(/<\/div>/g,"").replace(/<div>/g,"<br>");    
	        var new_stripped_content = stripped_content.replace(/<p>/g,'').replace(/<\/p>/g,"").replace(/<br><br><br>/g,"<br><br>");
	        
			$('.mixed_ad_ta').val(new_stripped_content);
	        $(".editor .post_content:contains('h2')").html($('.mixed_ad_ta').val());
	}

	// update the textarea of the redbox with the content of the editable div
	function update_full_post_content_text(){
		
	        var content = $editor.find('.full_post_content').html().trim();
	      
	        $('.full_text_ta').val(content);	        
	        $('.full_post_content > p').contents().unwrap(); // remove parent p
	        	        
	        // convert html elements in textarea
	        var stripped_content = $('.full_text_ta').val().replace("&lt;/h1&gt;","</h1>").replace("&lt;h1&gt;","<h1>").replace(/<\/div>/g,"").replace(/<div>/g,"<br>");    
	        var new_stripped_content = stripped_content.replace(/<p>/g,"").replace(/<\/p>/g,"").replace(/<br><br><br>/g,"<br><br>").trim();   
	        	        
	        // set content html editor and visual editor
			$('.full_text_ta').val(new_stripped_content);
	        $(".full_post_content:contains('h1')").html($('.full_text_ta').val());
	}
	
	// synch visual editor with textarea
	function sync_visual_editor(){
		if ( $editor.find('.post_content').is(':visible') && $('.mixed_ad_ta').is(':hidden')){ 
			update_post_content_text();
		}
		if( $editor.find('.full_post_content').is(':visible') && $('.full_text_ta').is(':hidden')){
			update_full_post_content_text();
		}
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
				content = $editor.find('.full_text_ta').val();
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
		sync_visual_editor();
		
		box_id = $('.editor #box_id').val();
		box_type = $('.editor #box_type').val();
		page_url = $('.editor #page_url').val();
		custom_class = $('.editor #custom_class').val();
		
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
				custom_class: 	custom_class,
				page_url	: 	page_url
			};
		}
		else if(box_type == 'text'){
			
			if(qtranslate_active === false){
				content = $('.full_text_ta').val();
			} else{
				
				content = '';
				
				// get current language
				var cur_lang = $editor.find('.qtranxs-lang-switch.active').attr('lang');
				
				if( cur_lang === 'nl'){
					var other_lang = 'en';
				} else{
					var other_lang = 'nl';
				}
				
				
				// Wanneer de visual editor open staat wordt de qtranslate input niet geupdate 
				// daarom moet je de content uit het textarea pakken
				
				if( $('.full_text_ta').is(':visible') ){
					if( $("input[name='qtranslate-fields[full_text_ta]["+cur_lang+"]']").val().length > 0 )
						content = '[:'+cur_lang+']' + $("input[name='qtranslate-fields[full_text_ta]["+cur_lang+"]']").val()
										
				}else{
					content = '[:'+cur_lang+']' + $('.full_text_ta').val();
				}				
									
				if( $("input[name='qtranslate-fields[full_text_ta]["+other_lang+"]']").val().length > 0)
					content += '[:'+other_lang+']' + $("input[name='qtranslate-fields[full_text_ta]["+other_lang+"]']").val()
				
				// als de content nog steeds leeg is pak alles uit het openstaande textarea
				if( content.length == 0 ){
					content = $('.full_text_ta').val();
				}
				
			}
			
			data = { 
				action 		: 	'save_box_db',
				box_id 		: 	box_id,
				box_type	: 	box_type,
				content 	:	content,
				custom_class: 	custom_class,
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
				custom_class: 	custom_class,
				content		: 	content
			};
		}
		
		
		jQuery.post(ajaxurl,data,function(response){
			
			sync_editor();
			close_editor();
		});

	});
	
	// qtranslate-X
	$('.qtranxs-lang-switch').live('click',function(){
				
    });
 
	
 
});