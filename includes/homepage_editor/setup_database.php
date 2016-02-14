<?php
/**
 *  Setup database tables on plugin activation
 */
 
function install_he_db(){
	
	$current_db_version = get_option('he_db_version');
	
	if( $current_db_version != HE_DB_VERSION){
		
		global $wpdb;		
		
		$wpdb->query("DROP TABLE IF EXISTS ".HE_POSTS);
		
		$sql = "CREATE TABLE ".HE_POSTS."(
		  id int NOT NULL AUTO_INCREMENT,
		  type text NOT NULL,
		  img_id int,
		  img_url text,
		  img_class text,
		  margin_top text,
		  margin_left text,
		  content text,
		  url_to_page text,
		  UNIQUE KEY id (id)
		)";
		
		dbDelta( $sql );
		update_option('he_db_version',HE_DB_VERSION);
		
		for( $i = 0; $i < 7; $i++ ){
			$wpdb->insert(HE_POSTS, 
				array( 
					'type' => '', 
				) 
			);
		}
	}	
}

/**
 *  Drop database tables on plugin deinstallation
 */
function uninstall_he_db() {
	global $wpdb;

	$wpdb->query("DROP TABLE IF EXISTS ".HE_POSTS);
	
	delete_option('he_db_version'); 

}
?>