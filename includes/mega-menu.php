<?php 
class Menu_With_Description extends Walker_Nav_Menu {
	function start_el($output, $item, $depth, $args) {

	    global $wp_query;
	
	    $indent = ( $depth ) ? str_repeat( "", $depth ) : '';
	
	    $class_names = $value = '';
	
	    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
	
	    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
	    $class_names = ' class="' . esc_attr( $class_names ) . '"';
	
	    $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
	
	    //$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	   // $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	
	    if($depth == 1 && get_the_post_thumbnail( $item->object_id ) ){
	    	$attributes .= ' style="background-image:url(';
	    	$attributes .= apply_filters( 'menu_item_thumbnail' , get_the_post_thumbnail_url( $item->object_id ) );
	    	$attributes .= ')"';
	    }
	    
	    
	    // get user defined attributes for thumbnail images
	    $attr_defaults = array( 'class' => 'nav_thumb' , 'alt' => esc_attr( $item->attr_title ) , 'title' => esc_attr( $item->attr_title ) );
	    $attr = isset( $args->thumbnail_attr ) ? $args->thumbnail_attr : '';
	    $attr = wp_parse_args( $attr , $attr_defaults );
	
	    $item_output = $args->before;
	    $item_output .= '<a'. $attributes .'>';
	    
	    
	    
	    // menu description output based on depth
	    if($depth == 1 && get_the_post_thumbnail( $item->object_id ) ){		    	
	    	
	    		//$item_output .= apply_filters( 'menu_item_thumbnail' , get_the_post_thumbnail( $item->object_id ) );       
	    		$item_output .= '<h3>'. apply_filters( 'the_title', $item->title, $item->ID ) . '</h3>';
	    } elseif($depth == 1){
	    	$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
	    	$item_output .= ( $args->desc_depth >= $depth ) ? '<span class="sub">' . $item->description . '</span>' : '';
	    }else{
	    	$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
	    }
	
	    // close menu link anchor
	    $item_output .= '</a>';
	    $item_output .= $args->after;
	
	    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
} 

function my_add_menu_descriptions( $args ) {
    $args['walker'] = new Menu_With_Description;
    $args['desc_depth'] = 1;
    $args['thumbnail'] = true;
    $args['thumbnail_link'] = true;
    //$args['thumbnail_size'] = false;
    $args['thumbnail_attr'] = array( 'class' => 'nav_thumb' , 'alt' => 'niews'  );

    return $args;
} add_filter( 'wp_nav_menu_args' , 'my_add_menu_descriptions' );
