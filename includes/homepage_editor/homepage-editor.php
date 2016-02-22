<?php
/**
 * Plugin Name: Homepage editor
 * Description: Een plugin om de homepage van het sensation red theme aan te kunnen passen
 * Version: 1.0
 * Author: B Bronswijk
 */

// include the dbDelta function
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	require_once(plugin_dir_path( __FILE__ ).'setup_database.php');
	require_once(plugin_dir_path( __FILE__ ).'admin_settings.php');

define('HE_POSTS', $wpdb->prefix . 'homepage_posts');

// update this number when the database needs to be updated
define('HE_DB_VERSION','1.1');

add_option('he_db_version'); 

// call install function to create tables
add_action('after_switch_theme','install_he_db');

// call uninstall function to drop the tables
register_uninstall_hook(__FILE__, 'uninstall_he_db');

// loads required scripts
function he_enqueue_files() {
   		wp_enqueue_media();	
		wp_enqueue_script( 'media_upload_script',get_template_directory_uri() .'/includes/homepage_editor/upload_script.js' );
		// for some reason wordpress doesn't load the jquery ui so this has to be done manually. It's to enable dragging 
		wp_enqueue_script( 'jquery_ui', get_template_directory_uri() . '/includes/homepage_editor/jquery-ui.js');
		// includes css files in admin area
		wp_enqueue_style('he_admin_style', get_template_directory_uri() .'/includes/homepage_editor/admin_style.css',1);
		wp_enqueue_style('he_font_awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
} 

// include css files for plugin
function he_stylesheets() {
  if(!is_admin()){
  	if(is_front_page()){
    	wp_enqueue_style('he_style', get_template_directory_uri().'/includes/homepage_editor/style.css');   
	}
  } 
}	add_action('wp_enqueue_scripts', 'he_stylesheets',11);


// create admin pages in admin area
function he_admin_pages() {
    $hook_suffix = add_menu_page('Homepage', 'Homepage', 'publish_posts', 'he_setting_page','he_setting_page','dashicons-admin-home','17.2');
	add_action( 'load-' . $hook_suffix, 'he_enqueue_files' );
}	add_action('admin_menu', 'he_admin_pages');

// save post to database using ajax
function save_homepage_post_db(){
	global $wpdb;
	$box_id 	= $_POST['box_id'];
	$box_type	= $_POST['box_type'];
	$src		= $_POST['src'];
	$img_top	= $_POST['img_top'];
	$img_left	= $_POST['img_left'];
	$img_class 	= $_POST['img_class'];
	$img_id 	= $_POST['img_id'];
	$content	= $_POST['content'];
	$page_url	= $_POST['page_url'];
	
	$wpdb->update(HE_POSTS,array(
		'type'			=> 	$box_type,
		'img_url'		=> 	$src,
		'img_id'		=>	$img_id,
		'img_class'		=> 	$img_class,
		'margin_top'	=> 	$img_top,
		'margin_left'	=> 	$img_left,
		'content'		=>	$content,
		'url_to_page'	=>	$page_url
		),array('id'=>$box_id));

	die();
}add_action('wp_ajax_save_box_db','save_homepage_post_db');

function reset_homepage_post_db(){
	global $wpdb;
	$box_id 	= $_POST['box_id'];
	$wpdb->update(HE_POSTS,array(
		'type'			=> 	'',
		'img_id'		=> 	'',
		'img_url'		=> 	'',
		'img_class'		=> 	'',
		'margin_top'	=> 	'',
		'margin_left'	=> 	'',
		'content'		=>	'',
		'url_to_page'	=>	''
		),array('id'=>$box_id));

	die();
}add_action('wp_ajax_reset_box_db','reset_homepage_post_db');


?>