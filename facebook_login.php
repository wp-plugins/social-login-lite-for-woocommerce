        <div id="fb-root"></div>
        <script>
		<?php
			$setting_data=get_option('psl_social_plugin');
			extract($setting_data['facebook_details']);
			extract($setting_data['twitter_details']);
			extract($setting_data['google_plus_details']);
		?>
          window.fbAsyncInit = function() {
            FB.init({
              appId      : '<?php echo $facebook_id;?>', // Set YOUR APP ID
              status     : true, // check login status
              cookie     : true, // enable cookies to allow the server to access the session
              xfbml      : true  // parse XFBML
            });
         
               /* FB.Event.subscribe('auth.authResponseChange', function(response) 
                {
                     if (response.status === 'connected') 
                        {
                            document.getElementById("message").innerHTML +=  "<br>Connected to Facebook";
                            //SUCCESS
                        }    
                
                    else if (response.status === 'not_authorized') 
                       {
                             document.getElementById("message").innerHTML +=  "<br>Failed to Connect";
                                //FAILED
                        }
                    else 
                        {
                             document.getElementById("message").innerHTML +=  "<br>Logged Out";
                        //UNKNOWN ERROR
                        }
                }); */
            };
        
           function facebook_login(){
               FB.login(function(response) {
                  if (response.authResponse) 
                      {
                          getUserInfo();
                      } 
                  else 
                      {
                           console.log('User cancelled login or did not fully authorize.');
                      }
                  },{scope: 'email,user_photos,user_videos'});
            }
        
          function getUserInfo() {
              FB.api('/me', function(response) {							response.email=jQuery.trim(response.email);
                if(response.email!=''){				var str=response.name;
                      str +="*"+response.email;
                    var data = {
						'action': 'psl_data_retrive',
						'data': str  // We pass php values differently!
					};				}else{					alert("NO Email is provided");				}
					// We can also pass the url value separately from ajaxurl for front end AJAX implementations
					jQuery.post('<?php echo site_url();?>/wp-admin/admin-ajax.php', data, function(response,status) {
						if(response=='success'){
							window.location.href = "<?php echo site_url();?>/my-account";
						}
					});
					  
					});
            }
            
            function getPhoto(){
                FB.api('/me/picture?type=normal', function(response) {
                  var str="<br/><b>Pic</b> : <img src='"+response.data.url+"'/>";
                  document.getElementById("status").innerHTML+=str;
                });
            }
        
            function Logout()
            {
                FB.logout(function(){document.location.reload();});
            }
                  // Load the SDK asynchronously
            (function(d){
             var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement('script'); js.id = id; js.async = true;
             js.src = "//connect.facebook.net/en_US/all.js";
             ref.parentNode.insertBefore(js, ref);
           }(document));
        </script>         