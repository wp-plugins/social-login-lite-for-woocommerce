<?php

/**

* Plugin Name: Social Login Lite For WooCommerce

* Plugin URI: http://www.phoeniixx.com/

* Description: Social Login plugin allows you to let customers associate their social (Facebook and Google+) profiles with your ecommerce site.

* Version: 1.3

* Author: phoeniixx

* Author URI: http://www.phoeniixx.com/

*License: GPLv2 or later

*License URI: http://www.gnu.org/licenses/gpl-2.0.html

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
	include_once('checkout_page_hook.php');
	
	add_action('admin_enqueue_scripts', 'updimg_scripts');function updimg_scripts() {
		if (isset($_GET['page']) && $_GET['page'] == 'psl-social-login') {
			wp_enqueue_media();
			}
	}
	
	add_action('wp_head', 'your_function');

	function your_function()
	{
		?>
			<style>
				 

				.login-txt {
					margin: 4px 0 0 4px;
				}

                #logo-link {
                            margin: 8px 3px;
                           }
						   
				.form-row.form-row-first.login-checkout {
															float: none;
															text-align: center;
															width: 100%;
														}		   
					
                 
	
                   					
			</style>
		<?php
	
	}


		$setting_data=get_option('psl_social_plugin');

	
		
	add_action('admin_menu', 'pctm_social_login');

	function pctm_social_login(){
		
		$plugin_dir_url =  plugin_dir_url( __FILE__ );
		
		add_menu_page( 'phoeniixx', __( 'Phoeniixx', 'phe' ), 'nosuchcapability', 'phoeniixx', NULL, $plugin_dir_url.'/images/logo-wp.png', 57 );
        
		add_submenu_page( 'phoeniixx', 'Social Login', 'Social Login', 'manage_options', 'psl-social-login', 'social_login_settings' );
		

	}		

		//create user


		add_action( 'wp_ajax_psl_data_retrive', 'psl_data_retrive' );

		add_action( 'wp_ajax_nopriv_psl_data_retrive', 'psl_data_retrive' );
		
		function psl_data_retrive()
		{
			
			extract($_POST);
			

			$user_details=explode("*",$data);

			$profile_name =$user_details[0];
			$profile_email=$user_details[1];
			$social_type=$user_details[2];

			if( !email_exists( $profile_email )&& username_exists( $profile_name )){
				$profile_id=rand(1000, 9999);
				$profile_name=$profile_name.$profile_id;
			}

				$user_id = username_exists( $profile_name );
					if ( !$user_id and email_exists($profile_email) == false ) {
						$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
						$user_idd = wp_create_user( $profile_name, $random_password, $profile_email );
					}

					if(isset($user_idd)) 
						{

							$user1 = get_user_by('id',$user_idd);
							
							wp_set_current_user( $user1->ID, $user1->user_login );

							wp_set_auth_cookie( $user1->ID );

							do_action( 'wp_login', $user1->user_login );
                            
                            $to=$profile_email;
                          

                            $sub = get_bloginfo( 'name' )." Details";
                            $msg='<div style="background-color:#f5f5f5;width:100%;margin:0;padding:70px 0 70px 0">
                                	<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td valign="top" align="center">
                        						   	<table width="600" cellspacing="0" cellpadding="0" border="0" style="border-radius:6px!important;background-color:#fdfdfd;border:1px solid #dcdcdc;border-radius:6px!important">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" align="center">
                                                                    <table width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="#557da1" style="background-color:#557da1;color:#ffffff;border-top-left-radius:6px!important;border-top-right-radius:6px!important;border-bottom:0;font-family:Arial;font-weight:bold;line-height:100%;vertical-align:middle">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                	               <h1 style="color:#ffffff;margin:0;padding:28px 24px;display:block;font-family:Arial;font-size:30px;font-weight:bold;text-align:left;line-height:150%">'.get_bloginfo( 'name' ).' Login Details</h1>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td valign="top" align="center">
                                                                	<table width="600" cellspacing="0" cellpadding="0" border="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td valign="top" style="background-color:#fdfdfd;border-radius:6px!important">
                                                                                    <table width="100%" cellspacing="0" cellpadding="20" border="0">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td valign="top">
                                                                                                    <div style="color:#737373;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
                                                                                                        <p>Your '. get_bloginfo( 'name' ).' Login Details Are:</p>
                                                                                                        <p>Username: '.$profile_name.'</p>
                                                                                                        <p>Password: '.$random_password.'<br/></p>
                        															                 </div>
                        													                   	</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td valign="top" align="center">
                                                                	<table width="600" cellspacing="0" cellpadding="10" border="0" style="border-top:0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td valign="top">
                                                                                    <table width="100%" cellspacing="0" cellpadding="10" border="0">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td valign="middle" style="border:0;color:#99b1c7;font-family:Arial;font-size:12px;line-height:125%;text-align:center" colspan="2">
                                                                                	                <p>'.get_bloginfo( 'name' ).'</p>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>' ;  
                           
                            $header = "MIME-Version: 1.0\r\n";
                            $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                            wp_mail($to,$sub,$msg,$header);
							if($social_type=='gplus'){
								$gp_count=get_option('psl_gp_count');
								if($gp_count==''){
									$gp_count=0;
								}
								$gp_count=$gp_count+1;
								update_option('psl_gp_count',$gp_count);
							}
							if($social_type=='face'){
								$fb_count=get_option('psl_fb_count');
								if($fb_count==''){
									$fb_count=0;
								}
								$fb_count=$fb_count+1;
								update_option('psl_fb_count',$fb_count);
							}
							echo "success";

							exit;


						}else
						{ 						

							

								$user1 = get_user_by( 'email', $profile_email);
								
								wp_set_current_user( $user1->ID, $user1->user_login );

								wp_set_auth_cookie( $user1->ID );

								do_action( 'wp_login', $user1->user_login );
								if($social_type=='gplus'){
									$gp_count=get_option('psl_gp_count');
									if($gp_count==''){
										$gp_count=0;
									}
										$gp_count=$gp_count+1;
										update_option('psl_gp_count',$gp_count);
								}
								if($social_type=='face'){
									$fb_count=get_option('psl_fb_count');
									if($fb_count==''){
										$fb_count=0;
									}
									$fb_count=$fb_count+1;
									update_option('psl_fb_count',$fb_count);
								}

								echo "success";

								exit;												 

							

						}
			}


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