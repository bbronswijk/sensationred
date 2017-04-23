<?php 

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
	wp_insert_category(array('cat_name' => 'leverancier', 'taxonomy' => 'sponsor_type'));

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