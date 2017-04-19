<?php 
function add_theme_dashboard_widgets() {

	wp_add_dashboard_widget(
			'theme_dashboard_widget',         // Widget slug.
			'Mededeling: Uploaden afbeeldingen',         // Title.
			'theme_dashboard_widget_output' // Display function.
			);

} add_action( 'wp_dashboard_setup', 'add_theme_dashboard_widgets' );

function theme_dashboard_widget_output() {
	echo '<p>Grote afbeeldingen maken de website erg traag. Zorg daarom dat je afbeeldingen <strong>Maxixmaal 1 MB</strong> zijn voordat je ze upload naar de website. </p>';
	echo '<p>Het is good-practice om afbeeldingen eerst te comprimeren voordat je ze upload naar de website. Dit kan eenvoudige via de volgende website:</p>';
	echo '<a href="http://tinypng.com/" class="button button-primary" target="_blank">Comprimeer Afbeeldingen</a>';
	
}