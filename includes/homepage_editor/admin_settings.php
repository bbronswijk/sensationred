<?php
    
    function he_setting_page() {
		// check if user is admin
		if ( !current_user_can( 'publish_posts' ) )  {
			wp_die( __( 'Je hebt niet voldoende rechten om deze pagina te bekijken, log opnieuw in of neem even contact op met de bazen van de IT', 'sensationred' ) );
		}
		else{
			
			install_he_db();
			if(isset($_POST[ 'submit'])){
				if( isset($_POST[ 'he_show_movie']) ) {				
				  		$opt_show_movie = $_POST[ 'he_show_movie'];
						update_option( 'he_show_movie', $opt_show_movie );		
				} else {				
				  		$opt_show_movie = '';
						update_option( 'he_show_movie', $opt_show_copy );			
					}
				if ( isset($_POST[ 'he_movie_url']) ) {				
				  		$opt_movie_url = $_POST[ 'he_movie_url'];
						update_option( 'he_movie_url', $opt_movie_url );		
				}
					
			}
			
			
			?>
			<div class="wrap">
				<h2>Homepage </h2>				
				<?php 
		    				$frontpage_id = get_option('page_on_front');
							$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $frontpage_id ), full );
				?>
				<form name="he_movie_form" method="post" action="">
					
					<p style="max-width: 700px">Bewerk op deze pagina de posts op de homepage. Klik op een post om deze aan te passen. Je kunt ook een youtube of vimeo filmpje op de homepage plaatsen. Copy paste de url van het filmpje in het veld hieronder:</p>
					<p> Bekijk ook de <a href="#" class="toggle_example">voorbeelden <img src="<?php echo get_template_directory_uri(); ?>/includes/homepage_editor/examples.png" class="examples"/></a></p>
					<input type="checkbox" name="he_show_movie" value="show" <?php if(get_option('he_show_movie')=="show"){ echo "checked='checked'"; }  ?>/> 
					<input type="text" name="he_movie_url" id="he_movie_url" class="he_movie_url"  value="<?php echo $opt_movie_url; ?>" size="60" placeholder="vb: http://youtu.be/_zbm8pwy3vo"/>
							     
					<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('opslaan', 'sensationred') ?>" />
				</form>		
		    			
				<div class="homepage_container"> 
					<div class="background_container">
						<img class="background" src="<?php echo get_background_image(); ?>"/>	
			    		<div class="header_gradient">Gradient</div>
					</div>	
					<div class="main_container">	
					<?php 
						$translate_active_class = '';
									   		
						if ( is_plugin_active( 'qtranslate-x/qtranslate.php' ) ) {
							$translate_active_class = 'qtranslate_active';
						}	   		
									   
					?>
					<form id="homepage_form" class="<?php echo $translate_active_class; ?>" name="homepage_form" method="post" action="">
									
									<div class="editor">
									   
											<div id="close_editor"></div>
											<h1>Bewerk post</h1>
											<hr>
											
											<input id="box_id" name="box_id" type="hidden"/>
											<input id="box_type" name="box_type" type="hidden"/>
											<input id="img_class" name="img_class" type="hidden"/>
											<input id="img_id" name="img_id" type="hidden"/>
											
											<!-- eerste keuze menu --> 
											<div class="step1">
												<img class="choice1" src="<?php echo get_template_directory_uri(); ?>/includes/homepage_editor/fullimg.png"/ >
												<img class="choice2" src="<?php echo get_template_directory_uri(); ?>/includes/homepage_editor/fulltext.png"/>
												<img class="choice3" src="<?php echo get_template_directory_uri(); ?>/includes/homepage_editor/imgtext.png"/>
												<p>selecteer een type</p>
											</div>
											
											<div id="choice_1" class="choice full_image">
												<!-- image --> 
												<div class="recent_post">
													<img id="he_full_img_preview" src="" />
												</div>	
												<!-- image upload button --> 
												<div class="buttons">
													<input id="he_upload_image_button_1" class="he_upload_image_button button-secondary " type="button" value="Upload Image" />
												</div>
												
											</div>
											
											<div id="choice_2" class="choice full_text">
												<!-- buttons for full text to switch between visual en text--> 
												<div class="full_button_visual full_view_tab">visual</div><div class="full_button_html full_view_tab">html</div>
												<div class="recent_post">
													<div class="full_post_content" contenteditable="true"></div>
													<!-- textarea full text --> 
							               			<textarea class="full_text_ta i18n-multilingual" name="full_text_ta" type="text" ></textarea>
												</div>
							               		<!-- full text small text --> 
								          		<div class="buttons">
								          		
													<div class="extra-uitleg">
														<h1>Richtlijnen</h1>
														<hr>
														<p>Bij deze optie is het de bedoeling dat je begint met een grote tekst en afsluit met een kleinere subtekst. Je moet even een beetje spelen met de juiste woorden zodat het vlak gelijkmatig wordt gevuld.</p> 
														<img src="<?php echo get_template_directory_uri(); ?>/includes/homepage_editor/example.jpg" />
														<p> Bekijk ook de <a href="#" class="toggle_example">voorbeelden <img src="<?php echo get_template_directory_uri(); ?>/includes/homepage_editor/examples.png" class="examples"/></a></p>					
													</div>
													<p>Kleine tekst weergeven? Selecteer de tekst en klik op de onderstaande knop</p>
													<div class="button_h1 button-secondary"><strong>Kleine tekst</strong></div>
												</div>
												
											</div>
											
											<div id="choice_3" class="choice mixed_ad">
												<!-- buttons for full text to switch between visual en text--> 
												<div class="recent_post">
													<div class="post_thumb">
														<img id="he_mixed_img_preview" src="" />
													</div>
													<div class="button_visual view_tab">visual</div><div class="button_html view_tab">html</div>
													<div class="post_content homepagepost" contenteditable="true" ></div>
													<!-- textarea full text --> 
													<textarea class="mixed_ad_ta" name="mixed_ad_ta" type="text" ></textarea>
												</div>
																							
												<div class="buttons">
													<!-- image upload button --> 
													<input id="he_upload_image_button_2" class="he_upload_image_button full_image button-secondary" type="button" value="Upload Image" />											
													<div class="button_h2 button-secondary"><strong>Kop</strong></div>
												</div>
												
											</div>											
											<div id="submit_post">
											
												<div class="extra_option">
													<hr>
													<h3>Redirect url</h3>
													<p>Redirect naar pagina wanneer de gebruiker op het bericht klikt.</p>
													<input id="page_url" name="url" type="text" placeholder="link to page"/>
													<hr>
													
													<h3>Custom Class</h3>
													<p>Past de tekst net niet lekker in het blok? Geef het blok de custom class 'small'. Accepteert ook andere classes!</p>
													<input id="custom_class" name="custom_class" type="text" placeholder="vb: small"/>
													<hr>
												</div>
												
												<div class="submit_buttons">
													<hr>
													<div class="button-secondary box_back">terug</div>
													<div class="button-secondary box_reset submitdelete ">verwijder</div>
													<div class="save_box button-primary">voeg toe</div>
												</div>
											</div>
										
									</div>
									<div class="editor_bg">hoi</div>
						    			
		    			<img class="header_logo" src="<?php echo $thumbnail[0]; ?>" alt="" />	
		    			<div class="default_nav"><?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'main_nav', 'container' => 'nav','depth'=> 1, )); ?> </div>  		
			   			<div class="content_container">
			   				
			   				
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
									<div id="<?php echo $i ?>" class="recent_post <?php echo $post['class'].' '; if( !empty($post['url_to_page'])){ echo 'clickable'; } if(empty($post['type'])){ echo 'empty_post'; } ?>">
										<input type="hidden" class="i18n-multilingual" name="trans_content_<?php echo $i ?>" value="<?= __($post['content'] ); ?>">
										<div id="edit_post_<?php echo $i ?>" class="edit_post"><i class="fa fa-pencil-square-o"></i></div>
										<?php if( !empty($post['url_to_page'])){ ?>
										<a href="<?php echo $post['url_to_page']; ?>">
											<?php } ?>
											<div class="content">
												<?php if( $post['type'] == 'image'){ ?>
													<img id="img_id_<?php echo $post['img_id']; ?>'" src="<?php echo $post['img_url']; ?>" class="<?php echo $post['img_class']; ?>"  style="position: absolute; left: <?php echo $post['margin_left']; ?>; top: <?php echo $post['margin_top']; ?>" />
												<?php } ?>
												<?php if( $post['type'] == 'text'){ ?>		
																																												
													<div class="full_post_content i18n-multilingual-display">																																						
														<?=  __( $post['content'] ); ?>													
													</div>
												<?php } ?>
												<?php if( $post['type'] == 'mixed'){ ?>
													<div class="post_thumb">
														<img id="img_id_<?php echo $post['img_id']; ?>'" src="<?php echo $post['img_url']; ?>" class="<?php echo $post['img_class']; ?>"  style="position: absolute; left: <?php echo $post['margin_left']; ?>; top: <?php echo $post['margin_top']; ?>" />
													</div>
													<div class="post_content">													
														<?php echo stripslashes ($post['content']); ?>
													</div>
												<?php } ?>
											</div>
											<?php if( !empty($post['url_to_page'])){ ?>
										</a>
										<?php } ?>
									</div>
									
									
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
									
									$post = $wpdb->get_row( "SELECT * FROM ".HE_POSTS." WHERE id= ".$i."",ARRAY_A); ?>
									<!-- homepage post --> 
									<div id="<?php echo $i ?>" class="recent_post <?php echo $post['class'].' '; if( !empty($post['url_to_page'])){ echo 'clickable'; } if(empty($post['type'])){ echo 'empty_post'; } ?>">
										<input type="hidden" class="i18n-multilingual" name="trans_content_<?php echo $i ?>" value="<?= __($post['content'] ); ?>">
										<div id="edit_post_<?php echo $i ?>" class="edit_post">
										<i class="fa fa-pencil-square-o"></i>
										</div>
										<?php if( !empty($post['url_to_page'])){ ?>
										<a href="<?php echo $post['url_to_page']; ?>">
										<?php } ?>
										<div class="content">
											
											<?php if( $post['type'] == 'image'){ ?>
												<img id="img_id_<?php echo $post['img_id']; ?>'" src="<?php echo $post['img_url']; ?>" class="<?php echo $post['img_class']; ?>"  style="position: absolute; left: <?php echo $post['margin_left']; ?>; top: <?php echo $post['margin_top']; ?>" />
											<?php } ?>
											<?php if( $post['type'] == 'text'){ ?>
												<div class="full_post_content i18n-multilingual-display">
													<?php echo __($post['content']); ?>
												</div>
											<?php } ?>
											<?php if( $post['type'] == 'mixed'){ ?>
												<div class="post_thumb">
													<img id="img_id_<?php echo $post['img_id']; ?>'" src="<?php echo $post['img_url']; ?>" class="<?php echo $post['img_class']; ?>"  style="position: absolute; left: <?php echo $post['margin_left']; ?>; top: <?php echo $post['margin_top']; ?>" />
												</div>
												<div class="post_content">
													<?php echo stripslashes ($post['content']); ?>
												</div>
											<?php } ?>
										</div>
										<?php if( !empty($post['url_to_page'])){ ?>
										</a>
										<?php } ?>
									
									</div>
									
								<?php } ?>
								
							</div>
													
						</div>
						</form>
		    		</div>	<!-- Main container -->
		    			
						    			
				</div>
				
				
			

			</div>
			<?php
		}
	}
    
?>