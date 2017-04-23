<?php
	
	// theme wordt standaard in het engels geschreven, vervolgens wordt het naar het nederlands vertaald
	// Dit is nodig voor de engelse versie van de Ringvaart en de Damen Raceroei Regatta
	load_theme_textdomain( 'sensationred', get_template_directory() . '/languages' );

	// registreer alle css en javascript files
	function add_theme_script() {
			// id, src, dependencies, version, footer
			wp_deregister_script('jquery');
			wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js','','3.2.1', true);
			wp_enqueue_style('font_awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
			wp_enqueue_style('open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700'); 

			wp_enqueue_style('content_stylesheet', get_template_directory_uri().'/css/content.css','', wp_get_theme()->get('Version') );
			wp_enqueue_style('theme_stylesheet', get_template_directory_uri().'/style.css','', wp_get_theme()->get('Version') );
			wp_enqueue_style('query_stylesheet', get_template_directory_uri().'/css/queries.css','', wp_get_theme()->get('Version') );
			wp_enqueue_style('nav_stylesheet', get_template_directory_uri().'/css/nav.css','',wp_get_theme()->get('Version') );
			
			wp_enqueue_script('sponsor_fadein_script', get_template_directory_uri() . '/js/sponsor_fadein.js','',wp_get_theme()->get('Version'), true);
			wp_enqueue_script('theme_script', get_template_directory_uri() . '/js/main.js','',wp_get_theme()->get('Version'), true);
						
			// double tap to go is een script dat dropdown menu's mogelijk maakt op touch devices. Dit is voor ipad belangrijk!!
			wp_enqueue_script( 'doubletaptogo', get_template_directory_uri() . '/js/doubletaptogo.js','','', true);
			
			if ( is_page_template( 'sponsor-page.php' ) || is_page_template( 'charity-page.php' ) )
				wp_enqueue_script( 'sponsor_script', get_template_directory_uri() . '/js/sponsoren.js','','', true);
			
			// include stylesheet for floating social bar
			if ( is_plugin_active( 'floating-social-bar/floating-social-bar.php' ) )
			  wp_enqueue_style( 'floating-social-bar', get_template_directory_uri() . '/css/floating_social_bar.css');
			
			
			if( is_category() )
				wp_enqueue_script( 'masonry-js', get_template_directory_uri().'/js/masonry.pkgd.min.js', array('jquery'), '1.1.0', true );
			
			// include stylesheet for woocommerce
			if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) 
				wp_enqueue_style( 'woocommerce-theme-style', get_template_directory_uri() . '/css/woocommerce.css');			
			
	} add_action('wp_enqueue_scripts', 'add_theme_script');
		
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
	} add_action( 'init', 'register_my_menus' );
	
	//register sidebars	
	function sensation_red_sidebar_init() {
		if ( function_exists('register_sidebar') ){
			register_sidebar(array(
			  'name' => __( 'default', 'sensationred' ),
			  'id' => 'default',
			  'description' => __( 'Default sidebar, gets displayed at the left of almost every page', 'sensationred' ),
			));
			register_sidebar(array(
					'name' 		=> __( 'Alternative Default ', 'my-theme' ),
					'id' 			=> 'default-alternative',
					'description' => __( 'Alternative Default sidebar', 'my-theme' ),
			));
			register_sidebar(array(
			  'name' => __( 'footer', 'sensationred' ),
			  'id' => 'footer',
			  'description' => __( 'Display widgets in the footer. Maximum of three widgets.', 'sensationred' ),
			));
			if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
				register_sidebar(array(
				  'name' => __( 'Woocommerce Cart', 'sensationred' ),
				  'id' => 'woocommerce',
				  'description' => __( 'This sidebar displays the cart widget in the header of the website', 'sensationred' ),
				));
			}
		}
	} add_action( 'widgets_init', 'sensation_red_sidebar_init' );
			 	
	// enable featured image
	add_theme_support('post-thumbnails' );
	
	// enable title tag
	add_theme_support( "title-tag" );
	
	// enable header image
	$header_args = array(
			'default-image' => get_template_directory_uri() . '/images/lagaLogorood.png',
			'header-text' => false,
	);
	add_theme_support( 'custom-header', $header_args );
	
	// declare Woocommerce support
	function woocommerce_support() {
		add_theme_support( 'woocommerce' );
	} add_action( 'after_setup_theme', 'woocommerce_support' );
	
	// style the editor 
	add_editor_style('css/content.css');

	// hide alle onnodige shit
	require_once 'includes/wordpress-reset.php';
	
	// customizer settings
	require_once 'includes/social-customizer.php';
	require_once 'includes/banner-customizer.php';
	
	// create countdown shortcode
	require_once 'includes/countdown.php';
	
	// register dashboard widget
	require_once 'includes/dashboard-widget.php';
	
	// register dashboard welkom widget 
	require_once 'includes/dashboard-welcome-widget.php';
	
	// create option to set a default post image
	require_once 'includes/default_post_img/default_post_img.php';	
	
	// shorten very long post titles of the page navigation on signle posts
	require_once 'includes/shorten_page_nav.php';	
	
	// add footer options
	require_once 'includes/footer_options/add_footer_items.php';
		
	// recent newspost widget
	require_once 'includes/recent_newspost/recentnewspost.php';
	
	// custom homepage post
	require_once 'includes/homepage_editor/homepage-editor.php';
	
	// register sidebar option for page editor
	require_once 'includes/sidebar-option.php';
	
	// IT commissie support --> alleen wanneer de gebruiker is ingelogd
	require_once 'includes/post-types.php';
	
	// IT commissie support --> alleen wanneer de gebruiker is ingelogd
	require_once 'includes/support/support.php';
	
	// IT commissie support --> alleen wanneer de gebruiker is ingelogd
	require_once 'includes/mega-menu.php';
	
	// gebruik de Github repository om updates uit te voeren	
	// add personal access token
	add_filter( 'github_updater_token_distribution', function (){
        return array( 'sensationred' => 'ad7d38ac2a719f549ff1e959158efab380bb3a52' );
    });
	 	
	// hide option page github update
	add_filter( 'github_updater_hide_settings', '__return_true' );
			
	// Set length of recent posts at homepage
	function custom_excerpt_length( $length ) {
		return 15;
	}	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
	
	function new_excerpt_more( $more ) {
		return '...';
	}	add_filter('excerpt_more', 'new_excerpt_more');
	

	// custom admin login logo
	function custom_login_logo() {
		echo '<style type="text/css">
		.login a{color:#ea1a35 !important;}
		h1 a { background-image: url('.get_template_directory_uri().'/images/login_logo.png) !important; width:160px !important; height:80px !important; background-size: 160px 80px !important;}
		</style>';
	}
	add_action('login_head', 'custom_login_logo');
