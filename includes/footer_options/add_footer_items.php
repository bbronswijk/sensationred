<?php
    add_action( 'admin_menu', 'my_footer_menu' );
	
	
	function my_footer_menu() {
		add_theme_page( 'Footer options', 'Footer', 'manage_options', 'footer_options', 'add_footer_options'); 
		
	}
	
	function add_footer_options() {
		// check if user is admin
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.', 'sensationred' ) );
		}
		else{
			wp_enqueue_script( 'script_add_footer_option', get_template_directory_uri() . '/includes/footer_options/script_add_footer_option.js' );
		    // Read in existing option value from database
		    $opt_number_val = get_option( 'm_footer_number' );
		    
			if( empty($opt_number_val) ){
		    	$opt_number_val = '1';
		    }

			// Show message if input is saved
			if( isset($_POST[ 'm_link_hidden1' ]) && $_POST[ 'm_link_hidden1' ] == 'Y' ) {
				?><div class="updated"><p><strong>settings saved</strong></p></div><?php
				if( !isset($_POST[ 'm_footer_show_copy']) ) {				
			  		$opt_show_copy = '';
					update_option( 'm_footer_show_copy', $opt_show_copy );			
				}
			}
			
			if( isset($_POST[ 'number_of_items']) ) {
				        $opt_number_val = $_POST[ 'number_of_items'];
				        update_option( 'm_footer_number', $opt_number_val );
			}		
			
			if( isset($_POST[ 'm_footer_show_copy']) ) {				
			  		$opt_show_copy = $_POST[ 'm_footer_show_copy'];
					update_option( 'm_footer_show_copy', $opt_show_copy );		
			}

			?>
			
			<div class="wrap">
				    <h2>Footer settings</h2>
					<form name="form1" method="post" action="">
						<input class="number_of_items" type="hidden" name="number_of_items" value="<?php echo $opt_number_val; ?>">
						<p>Voeg items toe aan de footer. Wanneer de qtranslate plugin is geactiveerd kunnen vertaling worden toegevoegd door de tags [:nl] en [:en] te gebruiken.</p>
						<p>voorbeeld: [:nl]Algemene voorwaarden[:en]Terms and conditions</p>
			<?php
			
				for ( $counter = 1; $counter <= $opt_number_val; $counter += 1) {
					$opt_name_val = get_option( 'm_footer_item_name'.$counter );
					$opt_link_val = get_option( 'm_footer_item_link'.$counter );	
					
					
					    // See if the user has posted us some information
					    // If they did, this hidden field will be set to 'Y'
					    if( isset($_POST[ 'm_name_hidden'.$counter ]) && $_POST[ 'm_name_hidden'.$counter ] == 'Y' ) {
					        $opt_name_val = $_POST[ 'm_footer_item_name'.$counter ];
					        update_option( 'm_footer_item_name'.$counter, $opt_name_val );
					    }
						if( isset($_POST[ 'm_link_hidden'.$counter ]) && $_POST[ 'm_link_hidden'.$counter ] == 'Y' ) {
					        $opt_link_val = $_POST[ 'm_footer_item_link'.$counter ];
					        update_option( 'm_footer_item_link'.$counter, $opt_link_val );
					    }
						
					
				    	?>
				    		<p>item <?php echo $counter ?>: 
								<input type="hidden" name="m_name_hidden<?php echo $counter ?>" value="Y">
								<input type="text" name="m_footer_item_name<?php echo $counter ?>" value="<?php echo $opt_name_val; ?>" size="20" placeholder="link name">
								
								<input type="hidden" name="m_link_hidden<?php echo $counter ?>" value="Y">
								<input type="text" name="m_footer_item_link<?php echo $counter ?>" value="<?php echo $opt_link_val; ?>" size="60" placeholder="http://www.example.com">
							</p>
		    <?php
		    		
				}
		    ?>
		    			<p><input type="checkbox" name="m_footer_show_copy" value="show" <?php if(get_option('m_footer_show_copy')=="show"){ echo "checked='checked'"; }  ?>/>      Laat de copyright gegevens van de DSRV Laga zien.  </p>
						<hr />
						
						<p class="submit">
						<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes', 'sensationred') ?>" />
						<input type="submit" name="Submit" class="button-primary extra_item" value="<?php esc_attr_e('New item', 'sensationred') ?>" />
						<input type="submit" name="Submit" class="button-primary remove_last_item" value="<?php esc_attr_e('Remove last item', 'sensationred') ?>" />
						</p>
					
					</form>
				</div>
		    
		    <?php
		    
		}
	}
?>