<?php
	// enable default thumbnail option
	function default_thumbnail_option(){
		add_settings_section('default_thumbnail_section','Standaard featured image','default_thumbnail_section_callback','media');	
		add_settings_field('default_thumbnail', '', 'default_thumbnail_callback', 'media','default_thumbnail_section');
		register_setting( 'media', 'default_thumbnail');
				
	}add_action('admin_init', 'default_thumbnail_option');
	
	// include required scripts 
	function dp_enqueue_scripts(){
		wp_enqueue_media();	
		wp_enqueue_script( 'media_uploader', get_template_directory_uri() . '/includes/default_post_img/script.js');
		wp_enqueue_style('dp_admin_style', get_template_directory_uri() .'/includes/default_post_img/admin_styles.css',1);
	}	add_action( 'dp_load_scripts', 'dp_enqueue_scripts');
	
	function default_thumbnail_section_callback(){
		do_action( 'dp_load_scripts');
		
		echo "<p>Selecteer hier een vervangende afbeelding die wordt weergegeven als er geen featured image aan een nieuwsbericht wordt toegewezen. 
				<br> Ideaal formaat voor de afbeelding is een resolutie van 130 px bij 210 px</p>";
		if(get_option( 'default_thumbnail' )){
			$img_url = get_option( 'default_thumbnail' );
		}else{
			$img_url = get_template_directory_uri().'/images/stempel.png';
		}
		echo "<table class='form-table'><tbody><tr><th>Standaard featured image</th><td> <div id='dp_preview_img_container'><img id='dp_preview_img' src='".$img_url."'/></div></td></tr></tbody></table>";
	}
	
	function default_thumbnail_callback(){
		echo "<input id='default_thumbnail' name='default_thumbnail' type='hidden' value='".get_option( 'default_thumbnail' )."' />";
		echo "<input id='dp_upload_image_button' name='default_thumbnail' class='dp_upload_image_button button-secondary' type='button' value='upload image' />";
		echo " <input id='reset_dp' class='button-secondary' type='submit' value='reset image' />";
											
	}
?>