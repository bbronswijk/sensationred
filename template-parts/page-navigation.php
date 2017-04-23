<div class="page_navigation">
		<?php if ( get_previous_posts_link()): ?>
			<div class="nav_button nav_button_left"><?php previous_posts_link('&laquo; Next posts'); ?></div>
		<?php endif; if ( get_next_posts_link()): ?>
			<div class="nav_button nav_button_right"><?php next_posts_link('Previous posts &raquo;'); ?></div>
		<?php endif; ?>					 
</div> 