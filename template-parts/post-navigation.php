<div class="page_navigation">
	<?php if(get_next_post_link('%link', '%title', true)) {?>
			<?php	next_post_link('<div class="next_post_button">%link</div>', __('&larr; to next post','sensationred'), true); ?>
			<div class="next_blog_link"><?php	next_post_link('%link', '%title', true); ?></div>						
	<?php } if(get_previous_post_link('%link', '%title', true)){ ?>
			<?php previous_post_link('<div class="previous_post_button">%link</div>', __('to previous post &rarr;','sensationred'), TRUE); ?> 
			<div class="previous_blog_link"><?php previous_post_link('%link', '%title', TRUE); ?></div>
	<?php }?>
</div>

