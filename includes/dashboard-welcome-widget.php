<?php // Mind this opening PHP tag

/**
 *	Adds hidden content to admin_footer, then shows with jQuery, and inserts after welcome panel
*
*	@author Ren Ventura <EngageWP.com>
*	@see http://www.engagewp.com/how-to-create-full-width-dashboard-widget-wordpress
*/

function rv_custom_dashboard_widget() {

	// Bail if not viewing the main dashboard page
	if ( get_current_screen()->base !== 'dashboard' ) {
		return;
	}

	?>

	<div id="custom-id" class="welcome-panel" style="display: none; overflow: hidden; padding-bottom: 20px;">
		<div class="welcome-panel-content">
			<h2>Welkom bij Laga WordPress!</h2>
			<p class="about-description">Gebruik de onderstaande links om eenvoudig de verschillende onderdelen van de website aan te passen.</p>
			<div class="welcome-panel-column-container">
				<div class="welcome-panel-column welcome-panel-last" style="width: 32% !important;">
					<h3>Veel gebruikte opties</h3>
					<ul>
						<li><a href="<?php echo admin_url(); ?>nav-menus.php" class="welcome-icon welcome-view-site">Bewerk Menu's</a></li>
						<li><a href="<?php echo admin_url(); ?>admin.php?page=he_setting_page" class="welcome-icon welcome-edit-page">Bewerk homepage</a></li>
						<li><a href="<?php echo admin_url(); ?>edit.php?post_type=sponsoren" class="welcome-icon welcome-add-page">Bewerk sponsoren</a></li>
						<li><a href="<?php echo admin_url(); ?>widgets.php" class="welcome-icon welcome-widgets-menus">Bewerk footer</a></li>
					</ul>
				</div>
				<div class="welcome-panel-column ">
					<h3>Tutorial</h3>
					<ul>
						<li><a href="http://wordpress.laga.nl/wordpress-101/" class="welcome-icon welcome-learn-more" target="_blank">Wordpress 101</a></li>
						<li><a href="http://wordpress.laga.nl/mega-menu/" class="welcome-icon welcome-learn-more" target="_blank">Mega menu dropdown</a></li>
						<li><a href="http://wordpress.laga.nl/foto-album/" class="welcome-icon welcome-learn-more" target="_blank">Plaats een gallery op website</a></li>
						<li><a href="http://wordpress.laga.nl/veel-gestelde-vragen/" class="welcome-icon welcome-learn-more" target="_blank">Veel gestelde vragen</a></li>
						
					</ul>
				</div>
				<div class="welcome-panel-column" style="padding-right: 50px; box-sizing: border-box;">
					<h3 style="margin-bottom: 10px;">Hulp nodig?</h3>
					<a class="button button-primary" href="http://wordpress.laga.nl/wordpress-tutorials/" target="_blank">Tutorials Laga wordpress</a>
					<p>Is dit de eerste keer dat je een wordpress website beheert? Bekijk dan eerst even deze chille korte tutorials.</p>
					<!--  <p>Na het doorlopen van de tutorials nog steeds vragen? Probeer voordat je de IT commissie een mailtje stuurt, <a href="http://localhost:8888/uw-website/wp-admin/themes.php">eerst eens de volgende stappen..</a></p>
					-->
				</div>
				
				
			</div>
			<img src="<?php echo get_template_directory_uri(); ?>/images/laga_gray.png" style="position:absolute; height: 60px; right: 20px; bottom: 0px; opacity: 0.5; z-index: 1;"/>
		</div>
	</div>
	<script>
		jQuery(document).ready(function($) {
			$('#welcome-panel').after($('#custom-id').show());
			$('#welcome-panel').hide();
		});
	</script>

<?php } add_action( 'admin_footer', 'rv_custom_dashboard_widget' );