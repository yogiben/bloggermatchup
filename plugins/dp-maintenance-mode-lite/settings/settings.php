<?php 
// Hook for adding admin menus
if ( is_admin() ){ // admin actions
  add_action( 'admin_menu', 'dpMaintenanceLite_settings');
  add_action( 'admin_init', 'dpMaintenanceLite_register_mysettings' ); 
} 

// function for adding settings page to wp-admin
function dpMaintenanceLite_settings() {
    // Add a new submenu under Settings:
	add_menu_page( 'DP Maintenance Lite', 'Maintenance Lite', 'manage_options','dpMaintenanceLite-settings', 'dpMaintenanceLite_settings_page', dpMaintenance_plugin_url( 'images/dpMaintenance_icon.gif' ) );
	add_submenu_page('dpMaintenanceLite-settings', 'Settings', 'Settings', 'manage_options', 'dpMaintenanceLite-settings', 'dpMaintenanceLite_settings_page');
}
// This function displays the page content for the Settings submenu
function dpMaintenanceLite_settings_page() {
global $dpMaintenance, $wpdb;
?>

<script type="text/javascript">
	function DP_ChangeMenu(id, menu) {
		jQuery('#menu li a').removeClass('active');
		jQuery(menu).addClass('active');
		
		jQuery('#rightSide').children().each(function(i) {
			if(jQuery(this).css('display') != 'none') {
				jQuery(this).fadeOut('fast', function() { 
					jQuery('#'+id).fadeIn('fast');
				});
			}
		});
		
	}
	
	function MailChimp_getList() {
		jQuery('#div_mailchimp_list').hide();
		
		if(jQuery('#mailchimp_api_key').val() != "") {
			jQuery.post("<?php echo dpMaintenance_plugin_url('ajax/MailChimp_getLists.php')?>", { mailchimp_api: jQuery('#mailchimp_api_key').val() },
			   function(data) {
				 jQuery('#mailchimp_list').html(data);
				 jQuery('#div_mailchimp_list').show();
			   }
			);
			
		}
	}
</script>

<div class="wrap" style="clear:both;" id="dp_options">

<h2></h2>
<div class="updated">
   <p>Get <a href="http://wpunderconstruction.com/" target="_blank">DP Maintenance PRO</a> for more themes and widgets.</p>
</div>
<?php $url = dpMaintenance_admin_url( array( 'page' => 'dpMaintenance-admin' ) );?>

<form method="post" action="options.php" enctype="multipart/form-data">
<?php settings_fields('dpMaintenance-group'); ?>
<div style="clear:both;"></div>
 <!--end of poststuff --> 
	
    <div id="dp_ui_content">
    	
        <div id="leftSide">
        	<div id="dp_logo"></div>
            <p>
                Version: Lite <?php echo DPMAINTENANCE_VER?><br />
            </p>
            <ul id="menu" class="nav">
                <li><a href="javascript:void(0);" title="" onclick="DP_ChangeMenu('menu_general_settings', this);" class="active"><span><?php _e('General Settings','dpMaintenance'); ?></span></a></li>
                <li><a href="javascript:void(0);" title="" onclick="DP_ChangeMenu('menu_timer_widget', this);"><span><?php _e('Timer Widget','dpMaintenance'); ?></span></a></li>
                <li><a href="javascript:void(0);" title="" onclick="DP_ChangeMenu('menu_progress_bar_widget', this);"><span><?php _e('Progress Bar Widget','dpMaintenance'); ?></span></a></li>
                <li><a href="javascript:void(0);" title="" onclick="DP_ChangeMenu('menu_social_widget', this);"><span><?php _e('Social Widget','dpMaintenance'); ?></span></a></li>
                <li><a href="javascript:void(0);" title="" onclick="DP_ChangeMenu('menu_twitter_feed_widget', this);"><span><?php _e('Twitter Feed Widget','dpMaintenance'); ?></span></a></li>
                <li><a href="javascript:void(0);" title="" onclick="DP_ChangeMenu('menu_newsletter_widget', this);"><span><?php _e('Newsletter Widget','dpMaintenance'); ?></span></a></li>
                <li><a href="javascript:void(0);" title="" onclick="DP_ChangeMenu('menu_contact_form_widget', this);"><span><?php _e('Contact Form Widget','dpMaintenance'); ?></span></a></li>
                <li><a href="javascript:void(0);" title="" onclick="DP_ChangeMenu('menu_form_validations', this);"><span><?php _e('Form Validations','dpMaintenance'); ?></span></a></li>
            </ul>
            
            <div class="clear"></div>
		</div>     
        
        <div id="rightSide">
        	<div id="menu_general_settings">
                <div class="titleArea">
                    <div class="wrapper">
                        <div class="pageTitle">
                            <h5><?php _e('General Settings','dpMaintenance'); ?></h5>
                            <span></span>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                </div>
                
                <div class="wrapper">
                	
                    <div class="option option-checkbox">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Active:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type="checkbox" name="dpMaintenance_options[active]" id="dpMaintenance_active" class="checkbox" <?php if($dpMaintenance['active']) {?> checked="checked" <?php }?> value="1" />
                                    <br>
                                </div>
                                <div class="desc"><?php _e('On/Off the Maintenance mode','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Theme:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <select name='dpMaintenance_options[theme]'>
                                        <?php 
                                        $dpMaintenance_read_folders = dpMaintenance_read_folders(dirname(__FILE__).'/../templates');
                                        foreach($dpMaintenance_read_folders as $value){
                                            $selected=($dpMaintenance['theme']==$value)?'selected="selected"':null;
                                            echo "<option ".$selected."value='".$value."'>".ucfirst($value)."</option>";
                                        }?>
                                    </select>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Select the theme style.','dpMaintenance'); ?><br /><strong><?php _e('If you want more theme styles, you may want the PRO version of this plugin: ','dpMaintenance'); ?></strong><a href="http://wpunderconstruction.com/" target="_blank"><?php _e('DP Maintenance PRO','dpMaintenance'); ?></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Logo:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input id="dpMaintenance_options_logo" type="text" size="36" name="dpMaintenance_options[logo]" value="<?php echo $dpMaintenance['logo']?>" />
                                    <input id="upload_image_button" type="button" class="button" value="Upload Image" style="width:auto; padding:auto; font-weight:normal;" />
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Enter an URL or upload an image for the logo.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Maintenance Message:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[maintenance_message]' value="<?php echo $dpMaintenance['maintenance_message']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the main message.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('User Roles:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <select name='dpMaintenance_options[user_roles][]' multiple="multiple" class="multiple">
                                       <?php 
									   $user_roles = '';
                                       $editable_roles = get_editable_roles();

								       foreach ( $editable_roles as $role => $details ) {
								           $name = translate_user_role($details['name'] );
								           if ( in_array($role, $dpMaintenance['user_roles']) ) // preselect specified role
								               $user_roles .= "\n\t<option selected='selected' value='" . esc_attr($role) . "'>$name</option>";
								           else
								               $user_roles .= "\n\t<option value='" . esc_attr($role) . "'>$name</option>";
								       }
									   echo $user_roles;
									   ?>
                                    </select>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Select the user role that will see the maintenance mode.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select no_border">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Footer Text:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[text_footer]' value="<?php echo $dpMaintenance['text_footer']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the text in the footer.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            
            <div id="menu_timer_widget" style="display:none;">
                <div class="titleArea">
                    <div class="wrapper">
                        <div class="pageTitle">
                            <h5><?php _e('Timer Widget','dpMaintenance'); ?></h5>
                            <span></span>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                </div>
                
                <div class="wrapper">
                    <div class="option option-checkbox">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Active:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type="checkbox" name="dpMaintenance_options[show_timer]" id="dpMaintenance_show_timer" class="checkbox" <?php if($dpMaintenance['show_timer']) {?> checked="checked" <?php }?> value="1" />
                                    <br>
                                </div>
                                <div class="desc"><?php _e('On/Off the timer widget','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Title:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input name='dpMaintenance_options[timer_widget_title]' value="<?php echo $dpMaintenance['timer_widget_title']?>"  />
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the title above the timer.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('"Days" Translation:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input name='dpMaintenance_options[timer_widget_days]' value="<?php echo $dpMaintenance['timer_widget_days']?>"  />
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the "Days" word translation.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('"Hours" Translation:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input name='dpMaintenance_options[timer_widget_hours]' value="<?php echo $dpMaintenance['timer_widget_hours']?>"  />
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the "Hours" word translation.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('"Minutes" Translation:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input name='dpMaintenance_options[timer_widget_minutes]' value="<?php echo $dpMaintenance['timer_widget_minutes']?>"  />
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the "Minutes" word translation.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('"Seconds" Translation:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input name='dpMaintenance_options[timer_widget_seconds]' value="<?php echo $dpMaintenance['timer_widget_seconds']?>"  />
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the "Seconds" word translation.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Expiration Date:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type="text" name="dpMaintenance_options[expiration_date]" readonly="readonly" style="width:100px;" id="dpMaintenance_expiration_date" class="large-text datepicker" value="<?php echo $dpMaintenance['expiration_date']?>" />
                                    <input type="number" min="00" max="23" style="width:40px;" name="dpMaintenance_options[expiration_date_hh]" value="<?php echo $dpMaintenance['expiration_date_hh'] != "" ? $dpMaintenance['expiration_date_hh'] : '00'?>" /> : 
                                    <input type="number" min="00" max="59" style="width:40px;" name="dpMaintenance_options[expiration_date_mm]" value="<?php echo $dpMaintenance['expiration_date_mm'] != "" ? $dpMaintenance['expiration_date_mm'] : '00'?>" />
                                    <br>
                                </div>
                                <div class="clear"></div>
                                <div class="desc"><?php _e('Select the Expiration Date','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-checkbox option_w no_border">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Deactive when timer expired?:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='checkbox' name='dpMaintenance_options[auto_deactive]' value="1" class="checkbox" <?php if($dpMaintenance['auto_deactive']) {?> checked="checked" <?php }?>/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Set if you want deactivate the maintenance mode automatically using the expiration date.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="errorCustom"><p>Notice: If you select to deactive the plugin when time expires and the Expiration Date is a date in the past, the maintenance page will not be displayed.</p></div>
                </div>
            </div>
            
            <div id="menu_progress_bar_widget" style="display:none;">
                <div class="titleArea">
                    <div class="wrapper">
                        <div class="pageTitle">
                            <h5><?php _e('Progress Bar Widget','dpMaintenance'); ?></h5>
                            <span></span>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                </div>
                
                <div class="wrapper">
                    <div class="option option-checkbox">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Active:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type="checkbox" name="dpMaintenance_options[show_loading_bar]" id="dpMaintenance_show_loading_bar" class="checkbox" <?php if($dpMaintenance['show_loading_bar']) {?> checked="checked" <?php }?> value="1" />
                                    <br>
                                </div>
                                <div class="desc"><?php _e('On/Off the progress bar widget','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w no_border">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Percentage Completed:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type="number" min="0" max="100" name="dpMaintenance_options[percentage]" value="<?php echo $dpMaintenance['percentage']?>" /> %
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Set the percentage completed of the maintenance.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w no_border">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('"Completed" Translation:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type="text" name="dpMaintenance_options[completed_translation]" value="<?php echo $dpMaintenance['completed_translation']?>" /> 
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the "Completed" word translation.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            
            <div id="menu_social_widget" style="display:none;">
                <div class="titleArea">
                    <div class="wrapper">
                        <div class="pageTitle">
                            <h5><?php _e('Social Widget','dpMaintenance'); ?></h5>
                            <span></span>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                </div>
                
                <div class="wrapper">
                    <div class="option option-checkbox">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Active:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type="checkbox" name="dpMaintenance_options[show_social]" id="dpMaintenance_show_social" class="checkbox" <?php if($dpMaintenance['show_social']) {?> checked="checked" <?php }?> value="1" />
                                    <br>
                                </div>
                                <div class="desc"><?php _e('On/Off the social widget','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Title:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[social_widget_title]' value="<?php echo $dpMaintenance['social_widget_title']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the title of the social widget.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Twitter URL:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[twitter_url]' value="<?php echo $dpMaintenance['twitter_url']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce your twitter url.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Facebook URL:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[facebook_url]' value="<?php echo $dpMaintenance['facebook_url']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce your facebook url.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Google + URL:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[google_url]' value="<?php echo $dpMaintenance['google_url']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce your google+ url.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Linkedin URL:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[linkedin_url]' value="<?php echo $dpMaintenance['linkedin_url']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce your linkedin url.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Skype Username:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[skype_url]' value="<?php echo $dpMaintenance['skype_url']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce your skype username.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Youtube URL:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[youtube_url]' value="<?php echo $dpMaintenance['youtube_url']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce your youtube url.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Vimeo URL:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[vimeo_url]' value="<?php echo $dpMaintenance['vimeo_url']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce your vimeo url.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Forrst URL:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[forrst_url]' value="<?php echo $dpMaintenance['forrst_url']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce your forrst url.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Tumblr URL:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[tumblr_url]' value="<?php echo $dpMaintenance['tumblr_url']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce your tumblr url.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w no_border">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Email:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[email_url]' value="<?php echo $dpMaintenance['email_url']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce your email.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            
            <div id="menu_twitter_feed_widget" style="display:none;">
                <div class="titleArea">
                    <div class="wrapper">
                        <div class="pageTitle">
                            <h5><?php _e('Twitter Feed Widget','dpMaintenance'); ?></h5>
                            <span></span>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                </div>
                
                <div class="wrapper">
                    <div class="option option-checkbox">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Active:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type="checkbox" name="dpMaintenance_options[show_twitter_widget]" id="dpMaintenance_show_twitter_widget" class="checkbox" <?php if($dpMaintenance['show_twitter_widget']) {?> checked="checked" <?php }?> value="1" />
                                    <br>
                                </div>
                                <div class="desc"><?php _e('On/Off the twitter feed widget','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="errorCustom"><p><?php _e('Notice: Due to recent changes in the twitter API, you need to add your consume key and secret key. Follow the instructions below.','dpMaintenance'); ?></p></div>
                    
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Title:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[twitter_widget_title]' value="<?php echo $dpMaintenance['twitter_widget_title']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the title of the twitter feed widget.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Twitter Username:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[twitter_id]' value="<?php echo $dpMaintenance['twitter_id']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce your twitter username.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Consumer Key:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[twitter_consumer_key]' value="<?php echo $dpMaintenance['twitter_consumer_key']?>"/>
                                    <br>
                                </div>
                                <div class="desc"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Consumer Secret:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[twitter_consumer_secret]' value="<?php echo $dpMaintenance['twitter_consumer_secret']?>"/>
                                    <br>
                                </div>
                                <div class="desc"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Access Token:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[twitter_access_token]' value="<?php echo $dpMaintenance['twitter_access_token']?>"/>
                                    <br>
                                </div>
                                <div class="desc"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Access Token Secret:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[twitter_access_secret]' value="<?php echo $dpMaintenance['twitter_access_secret']?>"/>
                                    <br>
                                </div>
                                <div class="desc"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select">
                        <div class="option-inner">
                            <div class="formcontainer">
                                <div class="forminp">
                                    <strong>Directions to get the Consumer Key and Consumer Secret</strong>
                                    <ol>
                                        <li><a href="https://dev.twitter.com/apps/new">Add a new Twitter application</a></li>
                                        <li>Fill in Name, Description, Website, and Callback URL (don't leave any blank) with anything you want</li>
                                        <li>Agree to rules, fill out captcha, and submit your application</li>
                                        <li>Click the button "Create my access token" and then go to the OAuth tab.</li>
                                        <li>Copy the Consumer key, Consumer secret, Access token and Access token secret into the fields above</li>
                                        <li>Click the Save Settings button at the bottom of this page</li>
                                    </ol>
                   				</div>
                            </div>
                    	</div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w no_border">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Quantity of Tweets:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='number' min="0" max="50" name='dpMaintenance_options[twitter_count]' value="<?php echo $dpMaintenance['twitter_count']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Set the quantity of tweets to retrieve.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            
            <div id="menu_newsletter_widget" style="display:none;">
                <div class="titleArea">
                    <div class="wrapper">
                        <div class="pageTitle">
                            <h5><?php _e('Newsletter Widget','dpMaintenance'); ?></h5>
                            <span></span>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                </div>
                
                <div class="wrapper">
                    <div class="option option-checkbox">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Active:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='checkbox' name='dpMaintenance_options[show_newsletter]' value="1" class="checkbox" <?php if($dpMaintenance['show_newsletter']) {?> checked="checked" <?php }?>/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('On/Off the newsletter widget','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Title','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[newsletter_widget_title]' value="<?php echo $dpMaintenance['newsletter_widget_title']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the title of the newsletter widget.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Email Address:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[newsletter_email_address]' value="<?php echo $dpMaintenance['newsletter_email_address']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the Email address to receive newsletter subscriptions.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w no_border">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Subscribe Button:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[button_subscribe]' value="<?php echo $dpMaintenance['button_subscribe']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the Newsletter subscribe button text.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <h2>MailChimp Support</h2>
                	
                    <div class="option option-checkbox">
                            <div class="option-inner">
                                <label class="titledesc"><?php _e('Active:','dpMaintenance'); ?></label>
                                <div class="formcontainer">
                                    <div class="forminp">
                                        <input type='checkbox' name='dpMaintenance_options[mailchimp_active]' value="1" class="checkbox" <?php if($dpMaintenance['mailchimp_active']) {?> checked="checked" <?php }?>/>
                                        <br>
                                    </div>
                                    <div class="desc"><?php _e('On/Off the MailChimp support.','dpMaintenance'); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        
                        <div class="option option-select option_w">
                            <div class="option-inner">
                                <label class="titledesc"><?php _e('API Key','dpMaintenance'); ?></label>
                                <div class="formcontainer">
                                    <div class="forminp">
                                        <input type='text' name='dpMaintenance_options[mailchimp_api]' id="mailchimp_api_key" value="<?php echo $dpMaintenance['mailchimp_api']?>"/>&nbsp;&nbsp;
                                        <button onclick="MailChimp_getList(); return false;" class="button"><?php _e('Get Lists') ?></button>
                                        <br>
                                    </div>
                                    <div class="desc"><?php _e('Introduce your MailChimp API key.','dpMaintenance'); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        
                    
                        <div class="option option-select option_w no_border" id="div_mailchimp_list" style="display: <?php echo ($dpMaintenance['mailchimp_api'] != "") ? 'block' : 'none'?>;">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('List:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp" id="mailchimp_list">
                                    <select name='dpMaintenance_options[mailchimp_list]'>
                                    	<?php 
										if($dpMaintenance['mailchimp_api'] != "") {
											$mailchimp_class = new mailchimpSF_MCAPI($dpMaintenance['mailchimp_api']);
											
											$retval = $mailchimp_class->lists();
											
											if (!$mailchimp_class->errorCode){
												foreach ($retval['data'] as $list){
											?>
											<option value="<?php echo $list['id']?>"><?php echo $list['name']?></option>
											<?php 
												}	
											} else {
												echo "Error: ".$mailchimp_class->errorMessage;
											}
										}
										?>
                                    </select>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Select a list to add the new suscribers.','dpMaintenance'); ?></div>
                            </div>
                        </div>

                    </div>
                    <div class="clear"></div>
                </div>
                
                
            </div>
            
            <div id="menu_contact_form_widget" style="display:none;">
                <div class="titleArea">
                    <div class="wrapper">
                        <div class="pageTitle">
                            <h5><?php _e('Contact Form Widget','dpMaintenance'); ?></h5>
                            <span></span>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                </div>
                
                <div class="wrapper">
                    <div class="option option-checkbox">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Active:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='checkbox' name='dpMaintenance_options[show_contact_form]' value="1" class="checkbox" <?php if($dpMaintenance['show_contact_form']) {?> checked="checked" <?php }?>/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('On/Off the contact form widget','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Title:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[contact_form_title]' value="<?php echo $dpMaintenance['contact_form_title']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the title of the contact form widget.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Email Address:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[contact_form_email_address]' value="<?php echo $dpMaintenance['contact_form_email_address']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the Email address to receive the messages.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w no_border">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Your Name:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[your_name]' value="<?php echo $dpMaintenance['your_name']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the name input desciption.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w no_border">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Send Button:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[send_button]' value="<?php echo $dpMaintenance['send_button']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the Send button text.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            
            <div id="menu_form_validations" style="display:none;">
                <div class="titleArea">
                    <div class="wrapper">
                        <div class="pageTitle">
                            <h5><?php _e('Form Validations','dpMaintenance'); ?></h5>
                            <span></span>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                </div>
                
                <div class="wrapper">
                    <div class="option option-select">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Newsletter Success:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[valid_newsletter_success]' value="<?php echo $dpMaintenance['valid_newsletter_success']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the text to show when the subscription is successful.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                            
                    <div class="option option-select option_w">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Contact Success:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[valid_contact_success]' value="<?php echo $dpMaintenance['valid_contact_success']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the text to show when the contact message has been sent successfully.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Error','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[valid_error]' value="<?php echo $dpMaintenance['valid_error']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the text to show when occurs some error.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="option option-select option_w no_border">
                        <div class="option-inner">
                            <label class="titledesc"><?php _e('Required fields:','dpMaintenance'); ?></label>
                            <div class="formcontainer">
                                <div class="forminp">
                                    <input type='text' name='dpMaintenance_options[valid_required_fields]' value="<?php echo $dpMaintenance['valid_required_fields']?>"/>
                                    <br>
                                </div>
                                <div class="desc"><?php _e('Introduce the text to show when some required field is empty.','dpMaintenance'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>   
        </div>
        <div class="clear"></div>
    </div>
	
    <p align="right">
		<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
</form>

                    
</div> <!--end of float wrap -->


<?php	
}
function dpMaintenanceLite_register_mysettings() { // whitelist options
  register_setting( 'dpMaintenance-group', 'dpMaintenance_options' );
}
?>