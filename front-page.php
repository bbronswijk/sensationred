	<?php get_header(); ?>
	<div class="main_home container">	
		<div class="wrapper <?php if(get_option('he_show_movie')=="show"){ echo movie; } ?>">	
			<div id="column1" class="column">
			   					<div class="shortcut_menu">
									<div class="title">
										<h1><?php bloginfo( 'name' ); ?></h1>	
									</div>
									<?php wp_nav_menu( array( 'theme_location' => 'shortcut-menu', 'container_class' => 'list_nav') ); ?> 
									<div class="bg_sc_menu">background</div>
								</div>
								
								
								<?php 
								for( $i = 1; $i <= 4; $i++ ){
									global $wpdb;	
									
									$post = stripslashes_deep($wpdb->get_row( "SELECT * FROM ".HE_POSTS." WHERE id= ".$i."",ARRAY_A)); ?>
									<!-- homepage post --> 
									<?php if( !empty($post['url_to_page'])){ ?>
										<a href="<?php echo $post['url_to_page']; ?>">
									<?php } ?>
									<div id="recent_post<?php echo $i; ?>" class="recent_post <?php if( !empty($post['url_to_page'])){ echo 'clickable'; } ?>">
											<?php if( $post['type'] == 'image'){ ?>
												<?php $image_attributes =  wp_get_attachment_image_src( $post['img_id'] , $size='medium'); ?>
												<img src="<?php echo $image_attributes[0]; ?>" class="<?php echo $post['img_class']; ?>"  style="position: absolute; left: <?php echo $post['margin_left']; ?>; top: <?php echo $post['margin_top']; ?>" />
											<?php } ?>
											<?php if( $post['type'] == 'text'){ ?>
												<div class="full_post_content">
													<?php echo __($post['content']); ?>
												</div>
											<?php } ?>
											<?php if( $post['type'] == 'mixed'){ ?>
												<div class="post_thumb">
													<?php $image_attributes =  wp_get_attachment_image_src( $post['img_id'] , $size='medium'); ?>
													<img src="<?php echo $image_attributes[0]; ?>" class="<?php echo $post['img_class']; ?>"  style="position: absolute; left: <?php echo $post['margin_left']; ?>; top: <?php echo $post['margin_top']; ?>" />
												</div>
												<div class="post_content">
													<?php echo __(stripslashes ($post['content'])); ?>
												</div>
											<?php } ?>
									</div>
									<?php if(!empty($post['url_to_page'])){ ?>
										</a>
									<?php } ?>
								<?php } ?>
								
								
								
								
			   				</div>
			   				
			   				<?php if(get_option('he_show_movie')=="show"): ?>
				   				<div class="event_trailer">
				   					<?php 
										$url = get_option('he_movie_url');
				   						
										if(strpos($url, 'youtu') !== false){
											$url = str_replace('http://youtu.be/','',$url);
											$url = str_replace('https://youtu.be/','',$url);
											$url = str_replace('https://www.youtube.com/watch?v=','',$url);
											$url = str_replace('&feature=youtu.be','',$url);
											$url = '//www.youtube.com/embed/'.$url.'?rel=0&amp;controls=0&amp;showinfo=0';
										} 
										if(strpos($url, 'vimeo') !== false){
											$url = str_replace('https://vimeo.com/','https://player.vimeo.com/video/',$url);
											$url = $url.'?title=0&byline=0&portrait=0';
										}
									 ?>
				   					<iframe width="453" height="255"  src="<?php echo $url; ?>" frameborder="0" allowfullscreen></iframe>
				   				</div>
			   				<?php endif; ?>
			   				
			   				<div id="column2" class="column">
								<div class="recent_posts">
								<?php 
									$showposts = ( get_option('he_show_movie')=="show" ? 2 : 3);
								
									query_posts('showposts='.$showposts);	
									$args = array(
										'posts_per_page'   => $showposts,
										'post_type'        => 'post'
									);
									$posts_array = get_posts( $args );
																		
									
									if ( have_posts() ) {
											while ( have_posts() ) {
												the_post(); 
												?>
												<a href="<?php the_permalink() ?>">
													<article class="recent_post clickable ">
														<?php
														
														global $more;
														$more = 0;
														?>
														<div class="post_thumb">
															<?php
															
															if ( has_post_thumbnail() ) {
																the_post_thumbnail('medium');
															} 
															else if(get_option( 'default_thumbnail' )){
																?><img src='<?php echo get_option( 'default_thumbnail' ) ?>'/><?php
															}
															else{
																?><img src='<?php echo get_template_directory_uri() ?>/images/stempel.png'/><?php
															}
															?>
														</div> <!-- post thumb -->											
														<div class="post_content"> 
															<h2><?php the_title(); ?></h2>
															<p><?php 
															$length_line = 27;
															$words = explode(' ', get_the_title());
															$number_of_title_lines = 1;
															foreach($words as $word){
																$word_length = strlen($word);
																if( $length_line - $word_length - 1 > 0 ){
																	$length_line = $length_line - $word_length - 1;
																}
																else{
																	$number_of_title_lines = $number_of_title_lines  + 1;	
																	$length_line = 27;
																	$length_line = $length_line - $word_length - 1;
																}
															}
															
															$max_number_of_text_lines = 5 - $number_of_title_lines;
															$length_line = 30;
															$words = explode(' ', get_the_excerpt());
															$number_of_text_lines = 1;
															foreach($words as $word){
																if( $number_of_text_lines <= $max_number_of_text_lines ){
																	$word_length = strlen($word);
																	if( $length_line - $word_length - 1 >= 0 ){
																		$length_line = $length_line - $word_length - 1;
																		echo $word.' ' ;
																	}
																	else{
																		$number_of_text_lines = $number_of_text_lines  + 1;	
																		$length_line = 30;
																		$length_line = $length_line - $word_length - 1;
																		if( $number_of_text_lines <= $max_number_of_text_lines ){
																			echo $word.' ' ;
																		} 
																	}
																}
																
															}
															?>...</p>
															<div class="read_more">
																<p><?php _e( 'To newspost','sensationred') ?></p>
															</div>
														</div> <!-- post content -->
														
													</article> <!-- recent_post -->
												</a>
												 <?php
												//
											
											} // end while
											
						
										} // end if
									?>
								</div>
							</div>	
							<div id="column3" class="column">
								
								<?php 
								$aa = ( get_option('he_show_movie')=="show" ? 6 : 7);
								
								for( $i = 5; $i <= $aa; $i++ ){
									global $wpdb;	
									
									$post = stripslashes_deep($wpdb->get_row( "SELECT * FROM ".HE_POSTS." WHERE id= ".$i."",ARRAY_A)); ?>
									<!-- homepage post --> 
									<?php if( !empty($post['url_to_page'])){ ?>
										<a href="<?php echo $post['url_to_page']; ?>">
									<?php } ?>
									<div id="recent_post<?php echo $i; ?>" class="recent_post <?php if( !empty($post['url_to_page'])){ echo 'clickable'; } ?>">
											<?php if( $post['type'] == 'image'){ ?>
												<?php $image_attributes =  wp_get_attachment_image_src( $post['img_id'] , $size='medium'); ?>
												<img src="<?php echo $image_attributes[0]; ?>" class="<?php echo $post['img_class']; ?>"  style="position: absolute; left: <?php echo $post['margin_left']; ?>; top: <?php echo $post['margin_top']; ?>" />
											<?php } ?>
											<?php if( $post['type'] == 'text'){ ?>
												<div class="full_post_content">
													<?php echo __($post['content']); ?>
												</div>
											<?php } ?>
											<?php if( $post['type'] == 'mixed'){ ?>
												<div class="post_thumb">
													<?php $image_attributes =  wp_get_attachment_image_src( $post['img_id'] , $size='medium'); ?>
													<img src="<?php echo $image_attributes[0]; ?>" class="<?php echo $post['img_class']; ?>"  style="position: absolute; left: <?php echo $post['margin_left']; ?>; top: <?php echo $post['margin_top']; ?>" />
												</div>
												<div class="post_content">
													<?php echo __(stripslashes ($post['content'])); ?>
												</div>
											<?php } ?>
									</div>
									<?php if(!empty($post['url_to_page'])){ ?>
										</a>
									<?php } ?>
								<?php } ?>
								
							</div>
		</div> <!-- wrapper -->
	</div><!-- container --> 
	


	
	<?php get_footer(); ?>