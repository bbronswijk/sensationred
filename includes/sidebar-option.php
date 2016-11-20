<?php
// REGISTER METABOX
function sidebar_add_post_meta_boxes() {
  add_meta_box(
    'choose_sidebar_box',    
    esc_html__( 'Select Sidebar', 'my-theme' ),    
    'sidebar_post_class_html',  
    'page', 
    'side',
    'default'     
  );
}

// SETUP METABOXES ON PAGE LOAD
function sidebar_post_meta_boxes_setup() {
  add_action( 'add_meta_boxes', 'sidebar_add_post_meta_boxes' );
  add_action( 'save_post', 'sidebar_save_post_class_meta', 10, 2 );
}

add_action( 'load-post.php', 'sidebar_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'sidebar_post_meta_boxes_setup' );

// HTML OUTPUT INPUT FIELD
function sidebar_post_class_html( $object, $box ) {
	wp_nonce_field( basename( __FILE__ ), 'sidebar_post_class_nonce' ); 
	?>	
	
		<select name="choose-sidebar-box" id="choose-sidebar-box" >
		  <option value="default" <?php if( esc_attr(get_post_meta( $object->ID, 'choose_sidebar_box', true )) == 'default' ) echo 'selected="selected"'; ?> >Default</option>
		  <option value="default-alternative" <?php if( esc_attr(get_post_meta( $object->ID, 'choose_sidebar_box', true )) == 'default-alternative' ) echo 'selected="selected"'; ?> >Alternative</option>
		</select>
		
	<?php 
}

// SAVE INPUT FIELD ON SAVE POST
function sidebar_save_post_class_meta( $post_id, $post ) {
	// CHECK NONCE
	if ( !isset( $_POST['sidebar_post_class_nonce'] ) || !wp_verify_nonce( $_POST['sidebar_post_class_nonce'], basename( __FILE__ ) ) )
    	return $post_id;

	$post_type = get_post_type_object( $post->post_type );

	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    	return $post_id;

	$new_meta_value = ( isset( $_POST['choose-sidebar-box'] ) ? sanitize_html_class( $_POST['choose-sidebar-box'] ) : '' );
	$meta_key = 'choose_sidebar_box';
	$meta_value = get_post_meta( $post_id, $meta_key, true );
	
	// CLEAN WAY TO SAVE POST META
	if ( $new_meta_value && '' == $meta_value )
    	add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
}
