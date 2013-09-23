<?php 

//admin settings
function dpMaintenance_admin_scripts() {

	if ( is_admin() ){ // admin actions
		// Settings page only
		if ( isset($_GET['page']) && ('dpMaintenanceLite-settings' == $_GET['page'] )  ) {
			wp_register_script('jquery', false, false, false, false);
			wp_enqueue_script( 'jquery-ui-tabs' );
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_register_script('dpMaintenance-upload', dpMaintenance_plugin_url('js/upload.js'), array('jquery','media-upload','thickbox'));
			wp_enqueue_script('dpMaintenance-upload');

			wp_enqueue_script( 'jquery-ui-datepicker', dpMaintenance_plugin_url( 'ui/jquery.ui.datepicker.js' ),
			array('jquery'), DPMAINTENANCE_VER, false); 
		};
  	}
}

function dpMaintenance_admin_styles() {
	if ( is_admin() ){ // admin actions
		// Settings page only
		if ( isset($_GET['page']) && ('dpMaintenanceLite-settings' == $_GET['page'] )  ) {
			wp_enqueue_style('thickbox');
			wp_enqueue_style( 'jquery-ui-all', dpMaintenance_plugin_url( 'themes/base/jquery.ui.all.css' ),
				false, DPMAINTENANCE_VER, 'all' );
			wp_enqueue_style( 'dpMaintenance_admin_head_css', dpMaintenance_plugin_url( 'css/admin-styles.css' ),
				false, DPMAINTENANCE_VER, 'all');
		};
  	}
}


if ( isset($_GET['page']) && 'dpMaintenanceLite-settings' == $_GET['page'] ) {
	add_action( 'admin_init', 'dpMaintenance_admin_scripts' );
	add_action( 'admin_init', 'dpMaintenance_admin_styles' );
}

function dpMaintenance_admin_head() {
	global $dpMaintenance;
	if ( is_admin() ){ // admin actions
	   
	  	// Messages page only
		if ( isset($_GET['page']) && 'dpMaintenanceLite-settings' == $_GET['page'] ) {
			wp_print_scripts( 'farbtastic' );
			wp_print_styles( 'farbtastic' );
		?>
			<script type="text/javascript">
				// <![CDATA[
						
			jQuery(function() {
				jQuery( ".datepicker" ).datepicker({
					showOn: "button",
					buttonImage: "<?php echo dpMaintenance_plugin_url( 'images/admin/calendar.gif' )?>",
					buttonImageOnly: false,
					minDate: 0
				});
			});
			//]]>
			</script>
	<?php
	   } //Message page only
	   
	 }//only for admin
}
add_action('admin_head', 'dpMaintenance_admin_head');
?>