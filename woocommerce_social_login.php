<?php
/**
* Plugin Name: Social Login Lite For WooCommerce
* Plugin URI: http://www.phoeniixx.com/
* Description: Social Login plugin allows you to let customers associate their social (Facebook and Google+) profiles with your ecommerce site.
* Version: 1.1
* Author: phoeniixx
* Author URI: http://www.phoeniixx.com/
*License: GPLv2 or later*License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/ 

ob_start();

if ( ! defined( 'ABSPATH' ) ) { 

    exit; // Exit if accessed directly

}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	session_start();

	// Put your plugin code here 

	require_once('social_login_settings.php');
	
	require_once('my_account_login_hook.php');
	
	require_once('my_account_register_hook.php');
	
	require_once('login_page_hook.php');
	
	require_once('checkout_page_hook.php');
	
	add_action('wp_head', 'your_function');	function your_function()	{		?>			<style>				 				.login-txt {					margin: 4px 0 0 4px;				}                #logo-link {                            margin: 8px 3px;                           }						   				.form-row.form-row-first.login-checkout {															float: none;															text-align: center;															width: 100%;														}		   					                 	                   								</style>		<?php	}
	
		$setting_data=get_option('psl_social_plugin');
	// add menu or sub_menu
    
	/* add_action('admin_menu','pctm_social_login');
			
			function pctm_social_login(){
				//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );				add_menu_page( 'phoeniixx', __( 'Phoeniixx', 'phe' ), 'nosuchcapability', 'phoeniixx', NULL, $icon_url, 57 );        				add_submenu_page( 'phoeniixx', 'Quick ViewW', 'Quick ViewW', 'manage_options', 'quick_view_settingw', 'quick_view_settingw' );
		   } */			add_action('admin_menu', 'pctm_social_login');	function pctm_social_login(){				$plugin_dir_url =  plugin_dir_url( __FILE__ );				add_menu_page( 'phoeniixx', __( 'Phoeniixx', 'phe' ), 'nosuchcapability', 'phoeniixx', NULL, $plugin_dir_url.'/images/logo-wp.png', 57 );        		add_submenu_page( 'phoeniixx', 'Social Login', 'Social Login', 'manage_options', 'psl-social-login', 'social_login_settings' );	}		
		//create user
		add_action( 'wp_ajax_psl_data_retrive', 'psl_data_retrive' );
		
		add_action( 'wp_ajax_nopriv_psl_data_retrive', 'psl_data_retrive' );
		
		function psl_data_retrive()
		{
			
			extract($_POST);
			
			$user_details=explode("*",$data);
			
			 $profile_name =$user_details[0];
			
			 $profile_email=$user_details[1];			if( !email_exists( $profile_email )&& username_exists( $profile_name )){				$profile_id=rand(1000, 9999);				$profile_name=$profile_name.$profile_id;			}
			
			$user_data=array(				
				"user_email"=>$profile_email,
				"user_login"=>$profile_name );												$user_id = wp_insert_user( $user_data );					if(!is_wp_error($user_id)) 						{							$user1 = get_user_by('id',$user_id);							wp_set_current_user( $user1->ID, $user1->user_login );							wp_set_auth_cookie( $user1->ID );							do_action( 'wp_login', $user1->user_login );							echo "success";							exit;						}else						{ 													if(is_wp_error($user_id))							{								$user1 = get_user_by( 'email', $profile_email);								wp_set_current_user( $user1->ID, $user1->user_login );								wp_set_auth_cookie( $user1->ID );								do_action( 'wp_login', $user1->user_login );								echo "success";								exit;												 							}						}			}
	}else
	{
		add_action('admin_notices', 'pctm_my_plugin_admin_notices');
			
			function pctm_my_plugin_admin_notices() {
				
				if (!is_plugin_active('plugin-directory/plugin-file.php')) {
					
					echo "<div class='error'><p>Please active WooCommerce First To Use WooCommerce Social Login</p></div>";
				}
			}
	}

ob_clean();
 ?>