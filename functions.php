<?php	
	// translate theme
	load_theme_textdomain( 'sensationred', get_template_directory() . '/languages' );
 
	// custom admin login logo
	function custom_login_logo() {
		echo '<style type="text/css">		
		.login a{color:#ea1a35 !important;}
		h1 a { background-image: url('.get_template_directory_uri().'/images/login_logo.png) !important; width:160px !important; height:80px !important; background-size: 160px 80px !important;}
		</style>';
	}
	add_action('login_head', 'custom_login_logo');
    
    // navigation menu
	function register_my_menus() {
	  register_nav_menus(
	  array(
	  'header-menu' => __( 'Header Menu', 'sensationred' ),
	  'footer-menu1' => __( 'Footer Menu1', 'sensationred' ),
	  'footer-menu2' => __( 'Footer Menu2', 'sensationred' ),
	  'shortcut-menu' => __( 'Shortcut menu Homepage', 'sensationred' )
	  )
	  );
	}
	add_action( 'init', 'register_my_menus' );
	
	function add_theme_script() {
			wp_enqueue_script('jquery');
			if ( is_page_template( 'sponsor-page.php' ) || is_page_template( 'charity-page.php' ) ){
				wp_enqueue_script( 'sponsor_script', get_template_directory_uri() . '/js/sponsoren.js');
			}			
			wp_enqueue_script( 'sponsor_fadein_script', get_template_directory_uri() . '/js/sponsor_fadein.js');
			wp_enqueue_script( 'mobile_nav_script', get_template_directory_uri() . '/js/header.js');
			wp_enqueue_style('default_stylesheet', get_template_directory_uri().'/style.css');
			
			if(!is_front_page()){
				wp_enqueue_style('nav_stylesheet', get_template_directory_uri().'/css/nav.css');
			} 
			// double tap to go is een script dat dropdown menu's mogelijk maakt op touch devices. Dit is voor ipad belangrijk!!
			wp_enqueue_script( 'doubletaptogo', get_template_directory_uri() . '/js/doubletaptogo.js', array(), '1.0.0', true);
	}add_action('wp_enqueue_scripts', 'add_theme_script');
	
	
	// enable header image
	$args = array(
		'default-image' => get_template_directory_uri() . '/images/lagaLogorood.png',
		'header-text' => false,
	);
	add_theme_support( 'custom-header', $args );
	
		
	//register sidebars
	if ( function_exists('register_sidebar') ){
		register_sidebar(array(
		  'name' => __( 'default', 'sensationred' ),
		  'id' => 'default',
		  'description' => __( 'Default sidebar, gets displayed at the left of almost every page', 'sensationred' ),
		));
		register_sidebar(array(
		  'name' => __( 'footer', 'sensationred' ),
		  'id' => 'footer',
		  'description' => __( 'Display widgets in the footer. Maximum of five widgets.', 'sensationred' ),
		));
	}
	
	// hide all unnecessary widgets
	function remove_default_widgets() {
	     unregister_widget('WP_Widget_Pages');
	     unregister_widget('WP_Widget_Calendar');
	     unregister_widget('WP_Widget_Archives');
	     unregister_widget('WP_Widget_Links');
	     unregister_widget('WP_Widget_Meta');
	     unregister_widget('WP_Widget_Search');
	     unregister_widget('WP_Widget_Categories');
	     unregister_widget('WP_Widget_Recent_Posts');
	     unregister_widget('WP_Widget_Recent_Comments');
	     unregister_widget('WP_Widget_RSS');
	     unregister_widget('WP_Widget_Tag_Cloud');
	 }
	 add_action('widgets_init', 'remove_default_widgets',11);
	
	// enable featured image
	add_theme_support('post-thumbnails' );
	
	// enable title tag
	add_theme_support( "title-tag" );
	
	// Set length of recent posts at homepage 	
	function custom_excerpt_length( $length ) {
		return 15;
	}	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
	
	function new_excerpt_more( $more ) {
		return '...';
	}	add_filter('excerpt_more', 'new_excerpt_more');
	
	// style the editor 
	add_editor_style('css/editor_style.css'); 

	// create option to set a default post image
	require_once('includes/default_post_img/default_post_img.php');	
	
	// shorten very long post titles of the page navigation on signle posts
	require_once('includes/shorten_page_nav.php');	
	
	// add footer options
	require_once('includes/footer_options/add_footer_items.php');
		
	// recent newspost widget
	require_once('includes/recent_newspost/recentnewspost.php');
	
	// custom homepage post
	require_once('includes/homepage_editor/homepage-editor.php');
	
	//
	/*
	 * Theme update checker by kernl.us
	 * Is replaced by the githup update plugin
	 * alernative for kernl is iThemes sync
	 * 
	 * require_once('theme_update_check.php');
	 * $MyUpdateChecker = new ThemeUpdateChecker(
	 * 		'sensationred',
	 * 		'https://kernl.us/api/v1/theme-updates/56bd1052080f047d06fa86d1/'
	 * );
	 */
	// add personal access token
	add_filter( 'github_updater_token_distribution',
    function () {
        return array( 'sensationred' => 'ad7d38ac2a719f549ff1e959158efab380bb3a52' );
    } );
	 	
	// hide option page github update
	add_filter( 'github_updater_hide_settings', '__return_true' );
		
	function customize_background( $wp_customize ) {
		// verwijder de opties die standaard staan ingesteld. 	 
	  	$wp_customize->remove_control('background_repeat');
	  	$wp_customize->remove_control('background_position_x');
	  	$wp_customize->remove_control('background_attachment');	  
	} add_action('customize_register','customize_background');
	
	// add post type and add default categories 
	function create_new_posttypes() {
		register_post_type( 'sponsoren', array(
				'hierarchical' => true,
				'labels' => array(
					'name' => __( 'Sponsoren', 'sensationred' ),
					'singular_name' => __( 'Sponsor', 'sensationred' )
				),
				'public' => true,
				'menu_icon'=> 'dashicons-portfolio',
				'rewrite' => array('slug' => 'sponsoren'),			
				'supports' => array( 'title', 'editor', 'thumbnail' ),
				'has_archive' => true,
			)
		);
		
		register_taxonomy('sponsor_type',array('sponsoren'), array(
		    'hierarchical' => true,
		    'labels' => array(
				'name' => 'type'
			),
		    'show_ui' => true,
		    'query_var' => true,
		    'show_in_nav_menus' => true,
		    'rewrite' => array('slug' => 'sponsor_type'),
		  )); 
		  
		  
		// Create the category hoofdsponsor
		wp_insert_category(array('cat_name' => 'hoofdsponsor', 'taxonomy' => 'sponsor_type'));
		wp_insert_category(array('cat_name' => 'partner', 'taxonomy' => 'sponsor_type'));	
		wp_insert_category(array('cat_name' => 'news', 'taxonomy' => 'post'));
		if(get_option('charity_option')=="show"){  	
			register_post_type( 'charity', array(
					'labels' => array(
						'name' => __( 'doede doelen', 'sensationred' ),
						'singular_name' => __( 'Goed doel', 'sensationred' )
					),
					'menu_icon'=> 'dashicons-heart',
					'public' => true,
					'supports' => array( 'title', 'editor', 'thumbnail' ),
					'has_archive' => true,
					'rewrite' => array('slug' => 'charity'),
				)
			);
		}
		
	}	add_action( 'init', 'create_new_posttypes' );

	
	// checkbox option goede doelen
	function register_charity_fields() {
	        register_setting( 'general', 'charity_option', 'esc_attr' );
	        add_settings_field('charity_option', '<label for="charity_option">Enable Charity </label>' ,'charity_option_html','general' );
	} add_filter( 'admin_init' , 'register_charity_fields' );
	
	function charity_option_html() {
			if(get_option('charity_option')=="show"){
				 $checked =  "checked='checked'"; 
			} else{
				$checked = "";
			}
			echo '<input type="checkbox" name="charity_option" value="show"'.$checked.'/> Deze optie wordt alleen gebruikt voor goede doelen op de ringvaart website';
	}

	// custom background
	function change_custom_background_bram() {
	    $background = get_background_image();
	 
	    if ( ! $background ){
	    	return;
	    } else { 
	        $image = " background-image: url('$background');";
	    }
		?>
		<style id="custom-bg" type="text/css">
			.custom-bg { <?php echo trim( $image ); ?> }
		</style>
		<?php
	} add_theme_support( 'custom-background', array( 'wp-head-callback' => 'change_custom_background_bram' ) );
	
	