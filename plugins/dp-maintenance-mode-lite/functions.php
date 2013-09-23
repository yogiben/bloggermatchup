<?php
function dpMaintenance_admin_url( $query = array() ) {
	global $plugin_page;

	if ( ! isset( $query['page'] ) )
		$query['page'] = $plugin_page;

	$path = 'admin.php';

	if ( $query = build_query( $query ) )
		$path .= '?' . $query;

	$url = admin_url( $path );

	return esc_url_raw( $url );
}

function dpMaintenance_plugin_url( $path = '' ) {
	global $wp_version;
	if ( version_compare( $wp_version, '2.8', '<' ) ) { // Using WordPress 2.7
		$folder = dirname( plugin_basename( __FILE__ ) );
		if ( '.' != $folder )
			$path = path_join( ltrim( $folder, '/' ), $path );

		return plugins_url( $path );
	}
	return plugins_url( $path, __FILE__ );
}


function dpMaintenance_read_folders($path, $exclude = ".|..") {
    $path = rtrim($path, "/") . "/";
    $folder_handle = opendir($path);
    $exclude_array = explode("|", $exclude);
    $result = array();
    while(false !== ($filename = readdir($folder_handle))) {
        if(!in_array(strtolower($filename), $exclude_array)) {
            if(is_dir($path . $filename . "/")) {
				$result[] = $filename;
            }
        }
    }
    return $result;
}

function dpMaintenance_activate(){
	global $dpMaintenance;
	
	dpMaintenance_deactivate_timer();
	//login message
	$msg = '<div id="login_error"><p>'.__('The Maintenance Mode is activated.').'</p></div>';
	add_filter( 'login_message', create_function( '', 'return \'' . $msg . '\';' ));
	
	//back-end message
	$settings_msg = "<a href='".get_bloginfo('url')."/wp-admin/options-general.php?page=dpMaintenanceLite-settings'>Settings</a>";
	$msg = '<div class="error"><p>' . __("The Maintenance Mode is activated.") . ' '.$settings_msg. '</p></div>';
	add_action('admin_notices', $c = create_function('', 'echo "' . addcslashes($msg,'"') . '";')); 
	
	if( strstr($_SERVER['PHP_SELF'],    'wp-login.php') 
		|| strstr($_SERVER['PHP_SELF'], 'async-upload.php') // Otherwise media uploader does not work 
		|| strstr(htmlspecialchars($_SERVER['REQUEST_URI']), '/plugins/') 		// So that currently enabled plugins work while in maintenance mode.
		|| strstr($_SERVER['PHP_SELF'], 'upgrade.php')		
		|| strstr($_SERVER['PHP_SELF'], 'wp-admin')		
	){ 
		return; // exit function dpMaintenance_activate()
	}
	
	if(!is_array($dpMaintenance['user_roles'])) { $dpMaintenance['user_roles'] = array(); }
	if ( ! is_user_logged_in() || (is_user_logged_in() && in_array(dpMaintenance_get_user_role(), $dpMaintenance['user_roles']))) {	
		
		dpMaintenance_show_page();	
	
	}	
}

function dpMaintenance_show_page(){		
	global $dpMaintenance;
	
	$file_path = dirname(__FILE__) . '/templates/'.$dpMaintenance['theme'].'/index.php';
		
	// fix for Super Cache plugin	
	if( defined( 'WPCACHEHOME' ) ) {ob_end_clean();	}

	//header
	nocache_headers();

	header("HTTP/1.1 503 Service Temporarily Unavailable");
	header("Status: 503 Service Temporarily Unavailable");
	header("Retry-After: 3600");

	include($file_path);	
	exit();	
}

function dpMaintenance_deactivate_timer(){
	global $dpMaintenance;
	$auto_deactive = $dpMaintenance['auto_deactive'];
	
	if($dpMaintenance['active'] && $dpMaintenance['auto_deactive']){
		$expiration_date = explode("/", $dpMaintenance['expiration_date']);		
		$expiration_month = $expiration_date[0];
		$expiration_day = $expiration_date[1];
		$expiration_year = $expiration_date[2];
		$expiration_hour = $dpMaintenance['expiration_date_hh'];
		$expiration_minute = $dpMaintenance['expiration_date_mm'];
		
		//get current time from WP
		$blogtime = current_time('mysql'); 
		//$blogtime = gmdate('Y-m-d h:i:s'); 
		
		list( $today_year, $today_month, $today_day, $hour, $minute, $second ) = split( '([^0-9])', $blogtime );
		
		$todayDay=$today_year."-".$today_month."-".$today_day." ".$hour.":".$minute.":".$second;
		$todayDay=strtotime($todayDay);
		
		$setDay=$expiration_year."-".$expiration_month."-".$expiration_day." ".$expiration_hour.":".$expiration_minute.":00";
		$setDay=strtotime($setDay);
		$timeDif=$setDay-$todayDay;	
		
		
		if($timeDif<=0){
			$dpMaintenance['active'] = false;
			delete_option('dpMaintenance_options');	 
			update_option('dpMaintenance_options',$dpMaintenance);
		}
	}	
}

function dpMaintenance_get_user_role() {
	global $current_user;

	$user_roles = $current_user->roles;
	$user_role = array_shift($user_roles);

	return $user_role;
}

function dpMaintenance_updateNotice(){
    echo '<div class="updated">
       <p>Updated Succesfully.</p>
    </div>';
}

if(@$_GET['settings-updated'] && ($_GET['page'] == 'dpMaintenanceLite-settings')) {
	add_action('admin_notices', 'dpMaintenance_updateNotice');
}
?>