<div class="footer_widgets">
	<li class="widget">
		<img src="<?php echo get_template_directory_uri(); ?>/images/laga.png" alt="laga"/>		
	</li>
	<?php if( get_option('facebook-url') ): ?>
	<li class="widget social-media">
		<h2 class="widgettitle">Social Media</h2>	
		<?php if( get_option('facebook-url') ): ?>
			<a href="<?php echo get_option('facebook-url'); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
		<?php endif; if( get_option('instagram-url') ): ?>
			 <a href="<?php echo get_option('instagram-url'); ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
		<?php endif; if( get_option('vimeo-url') ): ?>
			 <a href="<?php echo get_option('vimeo-url'); ?>" target="_blank"><i class="fa fa-vimeo" aria-hidden="true"></i></a>	   
		<?php endif; if( get_option('twitter-url') ): ?>
			 <a href="<?php echo get_option('twitter-url'); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
		<?php endif; if( get_option('linkedin-url') ): ?>
			 <a href="<?php echo get_option('linkedin-url'); ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
		<?php endif; ?>					
	</li>
	<?php endif; ?>	
	<?php
		if ( function_exists( dynamic_sidebar('footer') ) ){
			dynamic_sidebar('footer')  ;
		}
	?>
</div>	<!-- footer_widgets --> 
