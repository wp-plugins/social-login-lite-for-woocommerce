<?php

   function social_login_settings(){

    $setting_data=get_option('psl_social_plugin');
	if(!empty($setting_data)){
		extract($setting_data['facebook_details']);

		extract($setting_data['google_plus_details']);   
		
		extract($setting_data['change_text_details']);   
		
		$login_label=trim($login_label);
		
		$checkout_label=trim($checkout_label);
	}
	?>

   <div class="wrap">
	<?php $tab2 = sanitize_text_field( $_GET['tab2'] );	?>
		<h2> WooCommerce Social Login - Plugin Options </h2>

		<h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
			<a class="nav-tab <?php if($tab2 == 'general' || $tab2 == ''){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=psl-social-login&amp;tab2=general">General</a>
			<a class="nav-tab <?php if($tab2 == 'reports'){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=psl-social-login&amp;tab2=reports">Reports</a>
		</h2>

    <div class="icon32" id="icon-users"><br></div>
	<?php if($tab2 == 'general' || $tab2 == ''){ ?>

    <form  method="post" action="" id="all_social_setting" enctype="multipart/form-data">



   <table class="form-table"><tbody><tr valign="top" class=""></tr></tbody></table>
	<hr />
     <table class="form-table">

		<tbody>
			<tr valign="top">
						<th class="titledesc" scope="row">
							<label for="psl_social_label">Label</label>
						</th>
						<td class="forminp forminp-text">
							<input type="text"  value="<?php echo !empty($login_label)?$login_label:''?>"  id="psl_social_label" name="psl_social_label" required> <span class="description">Change content of the label to display above social login buttons</span>	
						</td>
			</tr>
			<tr valign="top">
						<th class="titledesc" scope="row">
							<label for="psl_social_label_checkout">Description in checkout page</label>
						</th>
						<td class="forminp forminp-text">
							<input type="text"  value="<?php echo !empty($checkout_label)?$checkout_label:''?>"  id="psl_social_label_checkout" name="psl_social_label_checkout" required> <span class="description">Change content of the description on checkout page</span>
						</td>
			</tr>
		</tbody>
	</table>
   


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
            <tr valign="top">
				<td>Upload Image</td>
				
				<td>
					<label for="upload_image">
					<input id="upload_image" name="ad_image" height="32px" width="32px" type="text" value="<?php echo ($google_icon_url!='')?$google_icon_url:'' ?>" />
					<input id="upload_image_button" class="button" type="button" value="Upload Image" />
					
					
						
						<br />Enter a URL or upload an image for the Icon of size 32*32.
				</label>
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
         <tr valign="top">
			<td>Upload Image</td>
			
			<td>
			<label for="upload_image2">
			<input id="upload_image1" name="ad_image1" height="32px" width="32px" type="text" value="<?php echo ($google_icon_url!='')?$google_icon_url:'' ?>" />
			<input id="upload_image_button1" class="button" type="button" value="Upload Image" />
			
			
				
				<br />Enter a URL or upload an image for the Icon of size 32*32.
				</label>
			</td>
		</tr>



        </tbody>



    </table>  



       



    <input type="submit" value="Save Changes" name="save_data" class="button button-primary" style="float: left; margin-right: 10px;">



    <input type="button" id="reset_default_all" value="Reset Default" name="save_data" class="button button-info" style="float: left; margin-right: 10px;">



    </form>

	<?php }else if($tab2 == 'reports'){  ?>
		<html>
			<head>
				<script type="text/javascript" src="https://www.google.com/jsapi"></script>
					<script type="text/javascript">
					  google.load("visualization", "1", {packages:["corechart"]});
					  google.setOnLoadCallback(drawChart);
					  function drawChart() {
						var data = google.visualization.arrayToDataTable([
						  ['Task', 'Hours per Day'],
						  ['Facebook',  <?php $fb_count=get_option('psl_fb_count'); echo ($fb_count!='')?$fb_count:0?>],
						  ['Google+',   <?php $gp_count=get_option('psl_gp_count'); echo ($gp_count!='')?$gp_count:0?>]
						]);

						var options = {
						  title: 'Social Login Activities',
						  pieHole: 0.4,
						};

						var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
						chart.draw(data, options);
					  }
					</script>
			</head>
			<body>
				<div id="donutchart" style="width: 1150px; height: 500px;"></div>
				<div class="socialchart" style="width: 1150px; height: auto;">
					<table class="socialchart-data" width=100%>
						<tr>
						<th>Networks</th><th>Number of Connections</th>
						</tr>
						<tr><td>Facebook</td><td><?php $fb_count=get_option('psl_fb_count'); echo ($fb_count!='')?$fb_count:0?></td></tr>
						<tr><td>Google Plus</td><td><?php $gp_count=get_option('psl_gp_count'); echo ($gp_count!='')?$gp_count:0?></td></tr>
					</table>
				</div>
			</body>
		</html>
	<?php }?>
  </div>  
<style>
.socialchart {
    background: #fff none repeat scroll 0 0;
    margin-top: 20px;
	 padding: 14px;
}
.socialchart-data{border:1px solid #ccc;}
.socialchart-data th {
    padding-bottom: 10px;
    text-align: left;
}
</style>


      



<?php
	wp_enqueue_script("checkout-js", plugin_dir_url( __FILE__ )."js/checkout.js",array('jquery'),'',true);
	wp_enqueue_script("addmedia-js", plugin_dir_url( __FILE__ )."js/media_upload.js",array('jquery'),'',true);

	

	if(isset($_POST['save_data'])){
	  
  
	extract($_POST);
	

	$social_setting=array('facebook_details'=>array('enable_facebook'=>$psl_facebook_enable,'facebook_id'=>$psl_facebook_id,'fb_icon_url'=>$ad_image),'google_plus_details'=>array('enable_google_plus'=>$psl_google_enable,'google_id'=>$psl_google_id,'google_api'=>$psl_google_secret,'google_icon_url'=>$ad_image1),'change_text_details'=>array('sign_in'=>$psl_change_sign_in,'sign_up'=>$psl_change_sign_up),'change_text_details'=>array('login_label'=>$psl_social_label,'checkout_label'=>$psl_social_label_checkout));



	update_option('psl_social_plugin', $social_setting);

	
	wp_redirect("admin.php?page=psl-social-login");



   


   }



} 



?>