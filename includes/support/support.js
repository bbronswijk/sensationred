jQuery(document).ready(function($){ 
	function itSupport(){
		
		var base_url = window.location.origin.replace('#', '');
		
		if( base_url === 'http://127.0.0.1:4001' )
			base_url = 'http://127.0.0.1:4001/wordpress';
		
		var base_url = base_url + '/wp-admin/';
		
		// deze is for the default customizer wanneer geen specifiek panel of section is gedefined
		var customizer_url = ($('#wp-admin-bar-customize a').attr('href') != null )? $('#wp-admin-bar-customize a').attr('href').replace(base_url,'') : '';
			
		var support = {
				header_logo: {
								location : '.header_logo:has(.header_logo)',
								admin : 'customize.php?autofocus[section]=header_image'
							},
				featured_img : {
								location : '.header_logo:has(.attachment-post-thumbnail), .page-template-default .content',
								admin : $('#wp-admin-bar-edit a').attr('href').replace(base_url,''),
							},
				main_navigation: {
								location : '.main_nav',
								admin : 'nav-menus.php',
							},	
				shortcut_titel: {
								location : '.shortcut_menu',
								admin : 'options-general.php',
							},	
				shortcut_menu: {
								location : '.shortcut_menu .list_nav',
								admin : 'nav-menus.php',
							},
				news_posts: {
								location : '#column2, #blog-container',
								admin : 'edit.php',
							},
				columns_homepage: {
									location : '#recent_post1, #column3, .event_trailer',
									admin : 'admin.php?page=he_setting_page',
							},	
				gallery : {
								location : '.ngg-albumoverview, .ngg-galleryoverview',
								admin : 'admin.php?page=nextcellent-gallery-nextgen-legacy',
								tut : 'http://wordpress.laga.nl/foto-album/'
							},	
				sponsoren_overview : {
								location : '.page-template-sponsor-page .content.sponsoren_overview',
								admin : 'edit.php?post_type=sponsoren',
							},	
				sponsoren : {
								location : '.sponsoren',
								admin : 'edit.php?post_type=sponsoren',
							},	
				charity_overview : {
								location : '.page-template-charity-page .content.sponsoren_overview',
								admin : 'edit.php?post_type=charity',
							},							
				faq : {
								location : '.faq',
								admin : 'admin.php?page=faq_page',
								tut : 'http://wordpress.laga.nl/foto-album/'
							},	
				social_media : {
								location : '.widget.social-media',
								admin : 'customize.php?autofocus[section]=social_section',
								css_class : 'social-media'
							},	
				footer_widget : {
								location : '.widget.widget_text, .sidebar',
								admin : 'widgets.php',
							},	
				footer_menu : {
								location : '.widget.widget_nav_menu',
								admin : 'nav-menus.php',
							},
				footer : {
								location : 'footer',
								admin : 'themes.php?page=footer_options',
								css_class : 'support-footer'
							}
			};
		
		// show hide button
		
		var hide_btn_class =( $('body').hasClass('show-support-buttons'))? 'dashicons-hidden' : 'dashicons-visibility';
			 
		
		$hide_btn = $('<span class="support-btn toggle-support dashicons-before '+hide_btn_class+'"></span>').insertAfter('#wpadminbar');
		
		// hide all buttons
		$hide_btn.on('click',function(){
			// show the buttons
			if( $(this).hasClass('dashicons-visibility') ){			
				if($('a.support-btn').hasClass('support-animation')){
					$('a.support-btn').not(this).show();
	 			} else{
	 				$('a.support-btn').addClass('support-animation'); 	 			}
				
			} else{
				$('a.support-btn').not(this).toggle();				
			}			

			// change icon 
			$(this).toggleClass('dashicons-visibility').toggleClass('dashicons-hidden');
		});
				
		
		function init(){
			$.each(support,function(i){
				
				var admin_url = base_url+support[i].admin;
				var tut_url = support[i].tut;
				
				var css_class = ( support[i].css_class == null )? '' : support[i].css_class;
				
				
				if( admin_url != null ){
					var $admin_btn = '<a href="'+admin_url+'" class="support-btn support-admin dashicons-before dashicons-edit '+css_class+'"></a>'
					$(support[i].location).prepend($admin_btn);
					
				}
				
				if( tut_url != null ){
					var $tut_btn = '<a href="'+tut_url+'" class="support-btn support-tut '+css_class+'" target="_blank">?</a>'
					$(support[i].location).prepend($tut_btn);
				}
				
			});
					
			// display and animate buttons 
			if( $('body').hasClass('show-support-buttons'))
				$('a.support-btn').addClass('support-animation'); 
		}
		

		init();

		
	}
	
	itSupport();
});