<div class="sidebar">
	<?php
	
		global $post;
		$post = $wp_query->post;
		$page_id = $post->ID;
		
		if( get_post_meta( $page_id , 'choose_sidebar_box', true) )
			$sidebar = get_post_meta( $page_id , 'choose_sidebar_box', true);
		
		if( empty($sidebar) )
			$sidebar = 'default';
		
		if ( is_active_sidebar( $sidebar ) )
			dynamic_sidebar( $sidebar ) ;

	?>
</div><!-- sidebar -->