<?php

add_action('login_form', 'psl_login_form_add');
function psl_login_form_add(){
		require_once('facebook_login.php');
        require_once('google_login.php');
		$setting_data=get_option('psl_social_plugin');
		extract($setting_data['facebook_details']);
		extract($setting_data['google_plus_details']);				extract($setting_data['change_text_details']);  		?>		<style>	.login-hook {								}										.login-hook > p {									font-weight: bold;                                    padding-bottom: 7px;								}		</style>						<?php 
		if($enable_facebook=='on'|| $enable_google_plus=='on' ){
			echo  "<div class='login-hook'> <p>".$login_label."</p>";?> 
			<?php if($enable_facebook=='on'){ ?>
					   <img src='<?php echo plugin_dir_url( __FILE__ )."images/facebook.png";?>'   style="cursor:pointer;" onclick="facebook_login()"/>
					   <?php } if($enable_google_plus=='on'){?>
					   <img src='<?php echo plugin_dir_url( __FILE__ )."images/google-plus.png";?>'   style="cursor:pointer;" onclick="google_login()"/>
					    <?php }?>						</div>												<?php
			}
		}
?>