<?php
   function social_login_settings(){	
    $setting_data=get_option('psl_social_plugin');	extract($setting_data['facebook_details']);
    extract($setting_data['google_plus_details']);   		extract($setting_data['change_text_details']);   		$login_label=trim($login_label);	$checkout_label=trim($checkout_label);
        ?>
       <div class="wrap">
    <div class="icon32" id="icon-users"><br></div>
    <form method="post" action="" id="all_social_setting">
   <table class="form-table"><tbody><tr valign="top" class=""><h1 class="titledesc">General Settings</h1></tr></tbody></table>	<hr />     <table class="form-table">		<tbody>			<tr valign="top">						<th class="titledesc" scope="row">							<label for="psl_social_label">Label</label>						</th>						<td class="forminp forminp-text">							<input type="text"  value="<?php echo !empty($login_label)?$login_label:''?>"  id="psl_social_label" name="psl_social_label" required> <span class="description">Change content of the label to display above social login buttons</span>							</td>			</tr>			<tr valign="top">						<th class="titledesc" scope="row">							<label for="psl_social_label_checkout">Description in checkout page</label>						</th>						<td class="forminp forminp-text">							<input type="text"  value="<?php echo !empty($checkout_label)?$checkout_label:''?>"  id="psl_social_label_checkout" name="psl_social_label_checkout" required> <span class="description">Change content of the description on checkout page</span>						</td>			</tr>		</tbody>	</table>   
    <hr />
     <h3>Facebook settings</h3>
     <table class="form-table">
		<tbody>
          
		  <tr valign="top" class="">
    			<th class="titledesc" scope="row">Enable Facebook Login</th>
    			<td class="forminp forminp-checkbox">
        			<fieldset>
        				<legend class="screen-reader-text"><span>Enable Facebook Login</span></legend>
        	       		<label for="psl_facebook_enable">
        				  <input type="checkbox"   id="psl_facebook_enable" name="psl_facebook_enable" <?php echo isset($enable_facebook)?'checked':'';?>/> 
                        </label> 													
                    </fieldset>
    			</td>
			</tr>
			<tr valign="top">
				<th class="titledesc" scope="row">
					<label for="psl_facebook_id">Facebook App Id</label>
				</th>
				<td class="forminp forminp-text">
				    <input type="text"  value="<?php echo isset($facebook_id)?$facebook_id:''?>"  id="psl_facebook_id" name="psl_facebook_id"> 						
                </td>
			</tr>
        </tbody>
    </table>
    <hr />
    <h3>Google settings</h3>
    <h5>CallBack Url:&nbsp;&nbsp;<?php echo site_url()."/my-account"?></h5>
    <table class="form-table">
		<tbody>
        <tr valign="top" class="">
			<th class="titledesc" scope="row">Enable Google Login</th>
			<td class="forminp forminp-checkbox">
	       		<fieldset>
                  <legend class="screen-reader-text"><span>Enable Google Login</span></legend>
					<label for="psl_google_enable">
			        <input type="checkbox"  id="psl_google_enable" name="psl_google_enable" <?php echo isset($enable_google_plus)?'checked':'';?>/></label>
                </fieldset>								
             </td>
         </tr>
		 <tr valign="top">
			<th class="titledesc" scope="row">
				<label for="psl_google_id">Google client id </label>
			</th>
			<td class="forminp forminp-text">
				<input type="text"  value="<?php echo isset($google_id)?$google_id:'';?>"  id="psl_google_id" name="psl_google_id"> 						
            </td>
		 </tr>
         <tr valign="top">
			<th class="titledesc" scope="row">
			     <label for="psl_google_secret">Google API key</label>
			</th>
			<td class="forminp forminp-text">
			     <input type="text"   value="<?php echo isset($google_api)?$google_api:'';?>"  id="psl_google_secret" name="psl_google_secret"> 						
            </td>
		 </tr>
        </tbody>
    </table>  
       
    <input type="submit" value="Save Changes" name="save_data" class="button button-primary" style="float: left; margin-right: 10px;">
    <input type="button" id="reset_default_all" value="Reset Default" name="save_data" class="button button-info" style="float: left; margin-right: 10px;">
    </form>
  </div>  
      
<?php	wp_enqueue_script("checkout-js", plugin_dir_url( __FILE__ )."js/checkout.js",array('jquery'),'',true);
	if(isset($_POST['save_data'])){
	extract($_POST);
	$social_setting=array('facebook_details'=>array('enable_facebook'=>$psl_facebook_enable,'facebook_id'=>$psl_facebook_id),'google_plus_details'=>array('enable_google_plus'=>$psl_google_enable,'google_id'=>$psl_google_id,'google_api'=>$psl_google_secret),'change_text_details'=>array('sign_in'=>$psl_change_sign_in,'sign_up'=>$psl_change_sign_up),'change_text_details'=>array('login_label'=>$psl_social_label,'checkout_label'=>$psl_social_label_checkout));
	update_option('psl_social_plugin', $social_setting);	wp_redirect("admin.php?page=psl-social-login");
   
   }
} 
?>