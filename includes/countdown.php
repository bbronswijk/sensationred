<?php

	//enqueue scripts
	function enqueue_countdown_script() {
		wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/countdown.js' );
	} add_action( 'wp_enqueue_scripts', 'enqueue_countdown_script' );

	// register options in general
	function register_options() {
		/* Orgineel geschreven voor de campagne website van oras, daarom election variabelen */
		add_settings_section('countdown_election','Countdown naar evenement','countdown_section_callback','general');
		register_setting( 'general', 'date_elections', 'esc_attr' );
		
		add_settings_field('title_elections', '<label for="title_elections">Titel countdown. </br>(vb. Sluiting inschrijving)</label>' ,'title_html' , 'general', 'countdown_election' );
		register_setting( 'general', 'title_elections', 'esc_attr' );
		
		add_settings_field('date_elections', '<label for="date_elections">Datum start evenement</label>' ,'date_html' , 'general', 'countdown_election' );
		register_setting( 'general', 'time_elections', 'esc_attr' );
		
		add_settings_field('time_elections', '<label for="time_elections">Tijd start evenement</label>' , 'time_html' , 'general', 'countdown_election' );	
	}	add_action('admin_init', 'register_options');
	
	
	function countdown_section_callback(){
		echo "<p>Je kunt een countdown klok op de homepage plaatsen met onderstaande instellingen. </br>De klok telt af naar onderstaande tijd. Als de tijd is verlopen verdwijnt de klok.</p>";
	}
	
	function title_html() {
		$title = get_option( 'title_elections', '' );
		echo '<input type="text" id="title_elections" name="title_elections" value="' . $title . '" />';
	}
	
	function date_html() {
		$date = get_option( 'date_elections', '' );
		echo '<input type="date" id="date_elections" name="date_elections" value="' . $date . '" />';
	}
	
	function time_html() {
		$time = get_option( 'time_elections', '' );
		echo '<input type="text" id="time_elections" name="time_elections" value="' . $time . '" placeholder="vb. 10:00"/>';
	}
	
	
