<?php 
add_action( 'woocommerce_register_form', 'psl_myaccount_register_form' );	
function psl_myaccount_register_form(){
		require_once('facebook_login.php');
        require_once('google_login.php');
		$setting_data=get_option('psl_social_plugin');
		extract($setting_data['facebook_details']);
		extract($setting_data['google_plus_details']);
		if($enable_facebook=='on'|| $enable_google_plus=='on' ){
			?> <p class="login-txt">Sign up with:</p>						 <div id="logo-link">
			<?php
			if($enable_facebook=='on'){ ?>
					   <img src='<?php echo plugin_dir_url( __FILE__ )."images/facebook.png";?>'   style="cursor:pointer;" onclick="facebook_login()"/>
					   <?php } if($enable_google_plus=='on'){?>
					   <img src='<?php echo plugin_dir_url( __FILE__ )."images/google-plus.png";?>'   style="cursor:pointer;" onclick="google_login()"/>
					   <?php } ?>             </div><?php
			}
		}
?><style></style>