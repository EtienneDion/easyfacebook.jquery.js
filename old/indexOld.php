<?php

    include_once "fbmain.php";
   
 
    //if user is logged in and session is valid.
    if ($fbme){
        //Retriving movies those are user like using graph api
        try{
            $movies = $facebook->api('/me/movies');
        }
        catch(Exception $o){
            d($o);
        }
 
        //Calling users.getinfo legacy api call example
        try{
            $param  =   array(
                'method'  => 'users.getinfo',
                'uids'    => $fbme['id'],
                'fields'  => 'name,current_location,profile_url',
                'callback'=> ''
            );
            $userInfo   =   $facebook->api($param);
        }
        catch(Exception $o){
            d($o);
        }
 
        //Update user's status using graph api
        if (isset($_POST['statusUpdate'])){
            try {
                $statusUpdate = $facebook->api('/me/feed', 'post', array('message'=> $_POST['statusUpdate'], 'cb' => ''));
            } catch (FacebookApiException $e) {
                d($e);
            }
        }
		
		if (isset($_POST['postToPage'])){

		//Post to page using graph api
			$accounts = $facebook->api('/me/accounts');
			   
			foreach($accounts['data'] as $account){
			   if($account['id'] == $page_id) {   // the one we are looking for
				  $token = $account['access_token'];
			
			
			
					try {
						$status = $facebook->api('/' .$page_id .'/feed', 'post',
						   array(
							  'message'=> $_POST['postToPage'],
							  'cb' => '',
							  'access_token' => $token));
					} catch (FacebookApiException $e) {
						d($e);
					}
				}
			}
		}
	
 
        //fql query example using legacy method call and passing parameter
        try{
            //get user id
            $uid    = $facebook->getUser();
            //or you can use $uid = $fbme['id'];
 
            $fql    =   "select uid, name, first_name, last_name, hometown_location, sex, pic_square from user where uid=" . $uid;
            $param  =   array(
                'method'    => 'fql.query',
                'query'     => $fql,
                'callback'  => ''
            );
            $fqlResult   =   $facebook->api($param);
			
			$fqlId = $fqlResult[0]['uid'];
			$fqlName = $fqlResult[0]['name'];
			$fqlFirst_name =$fqlResult[0]['first_name'];
			$fqlLast_name =$fqlResult[0]['last_name'];
			$fqlCity =$fqlResult[0]['hometown_location']['city'];
			$fqlState =$fqlResult[0]['hometown_location']['state'];
			$fqlCountry =$fqlResult[0]['hometown_location']['country'];
			$fqlPic =$fqlResult[0]['pic_square'];
        }
        catch(Exception $o){
            d($o);
        }
		
		//Get user status using legacy method
		try{
            //get user id
            $uid    = $facebook->getUser();
            //or you can use $uid = $fbme['id'];
 
            $fql    =   "SELECT status FROM user WHERE uid =" . $uid;
            $param  =   array(
                'method'    => 'fql.query',
                'query'     => $fql,
                'callback'  => ''
            );
            $fqlResultStatus   =   $facebook->api($param);
        }
        catch(Exception $o){
            d($o);
        }
		
		//Get user's status using legacy method
		try{
            //get user id
           
			$uid    = $facebook->getUser();
            //or you can use $uid = $fbme['id'];
 
            $fql    =   "SELECT post_id,actor_id,target_id,message FROM stream WHERE source_id =" . $uid;
            $param  =   array(
                'method'    => 'fql.query',
                'query'     => $fql,
                'callback'  => ''
            );
            $fqlResultstream   =   $facebook->api($param);
        }
        catch(Exception $o){
            d($o);
        }
		
		//Get app page feed
		try{
        
            $fql    =   "SELECT post_id,actor_id,target_id,message FROM stream WHERE source_id =" . $page_id;
            $param  =   array(
                'method'    => 'fql.query',
                'query'     => $fql,
                'callback'  => ''
            );
            $fqlResultstreampage   =   $facebook->api($param);
        }
        catch(Exception $o){
            d($o);
        }
		
		//Post photo to album
		if (isset($_POST['photo'])){
           

			try{
				
				
				$photo = $_POST['photo'];
				$messagephoto = $_POST['messagephoto'];
				//or you can use $uid = $fbme['id'];
				$args = array('message' => $messagephoto);
				$args['image'] = '@' . realpath($photo);
				
				$data = $facebook->api('/'. $ALBUM_ID . '/photos', 'post', $args);
				$fqlResultstreamphoto= $data ;
	
			}
			catch(Exception $o){
				d($o);
			}
		
		
        }
		
		//Check if user like the page
		try{
		
 
            $fql    =   "SELECT target_id FROM connection WHERE source_id = " . $uid ." AND target_id =" . $page_id;
            $param  =   array(
                'method'    => 'fql.query',
                'query'     => $fql,
                'callback'  => ''
            );
            $fqlResultlikeID   =   $facebook->api($param);
			
		    
			if ( empty($fqlResultlikeID) ) {
			// user has NOT Liked the page/whatever
				$like = 0;
			} else {
			// user HAS Liked the page/whatever
				$like = 1;
			}
		}
			catch(Exception $o){
				d($o);
		}
		
		
		
    }
	




?><!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Facebook Tutoriel</title>
<?php        	/*
        META TAG EXAMPLE FOR SHARE AND LIKE ON AN EXTERNAL WEBSITE
        <meta property="og:title" content="Title example " />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="http://www.lorealparis.ca/" />
        <meta property="og:image" content="http://www.lorealparis.ca/img/l10n/common/logoPrint.gif" />
        <meta property="og:site_name" content="L&#039;Oréal" />
        <meta property="fb:admins" content="706847059" />
        */
?>
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

		<style type="text/css">
            .box{
                margin: 5px;
                border: 1px solid #60729b;
                padding: 5px;
                width: 340px;
                height: 200px;
                overflow:auto;
                background-color: #e6ebf8;
                float:none;
                display:block;
            }
        </style>
   	
    </head>
	<body>
    <div id="fb-root"></div>
        

 
    <h3>Hotspots Tests</h3>
    <?php if (!$fbme) { ?>
        You've to login using FB Login Button to see api calling result.
    <?php } ?>
    <p>
        <fb:login-button autologoutlink="true" perms="email,user_birthday,status_update,publish_stream"></fb:login-button>
    </p>
 	<h2>PHP API</h2>
    <?php
    if ($like){ echo 'You like this page<br/>';} else {echo 'You don\'t like this page<br/>';}
	?>
    <?php if ($_REQUEST['facebook_tab'] == '1'){
	  	echo 'We are in a facebook tab';
	  } else {
	  	echo 'We are not in a facebook tab';
	  }
	  ?>
    
    
    <?php if ($fbme){ ?>
   
   
    
    <div class="box">
        <b>User Information using Graph API</b>
        <?php d($fbme); ?>
    </div>

    <div class="box">
        <b>User likes these movies | using graph api</b>
         <?php d($movies); ?>
    </div>

    <div class="box">
        <b>User Information by Calling Legacy API method "users.getinfo"</b>
        <?php d($userInfo); ?>
    </div>
    <div class="box">
        <b>FQL Query Example 'Name' by calling Legacy API method "fql.query"</b>
        <?php d($fqlId); ?>
        <?php d($fqlName); ?>
        <?php d($fqlFirst_name); ?>
        <?php d($fqlLast_name); ?>
        <?php d($fqlCity); ?>
        <?php d($fqlState); ?>
        <?php d($fqlCountry); ?>
        <img src="<?=$fqlPic ?>"/>
        
        
       
    </div>
    
    <div class="box">
        <b>FQL Query Example by calling Legacy API method "fql.query"</b>
        <?php d($fqlResult); ?>
    </div>
    <div class="box">
    <?php              
            if ($_REQUEST) {
              echo '<p>signed_request contents:</p>';
              
              echo '<pre>';
              print_r($response);
              echo '</pre>';
            } else {
              echo '$_REQUEST is empty';
            }
    ?>
    </div>     
    
     <h3>Your Status</h3>
    <div class="box"><?php d($fqlResultStatus); ?></div>

    <h3>Your Stream</h3>
    <div class="box"><?php d($fqlResultstream); ?>  </div> 

    <h3>Page Stream</h3>
    <div class="box"><?php d($fqlResultstreampage); ?> </div>  


    <div class="box">
        <form name="" action="<?=$fbconfig['baseUrl']?>" method="post">
            <label for="statusUpdate">Status update using Graph API</label>
            <br />
            <textarea id="statusUpdate" name="statusUpdate" cols="50" rows="5">Write your status here and click 'submit'</textarea>
            <br />
            <input type="submit" value="Update My Status" />
        </form>
        <?php if (isset($statusUpdate)) { ?>
            <br />
            <b style="color: red">Status Updated Successfully! Status id is <?=$statusUpdate['id']?></b>
         <?php } ?>
    </div>
    
    
    <div class="box">
        <form name="" action="<?=$fbconfig['baseUrl']?>" method="post">
            <label for="postToPage">Post to page using Graph API (need to like the page before)</label>
            <br />
            <textarea id="postToPage" name="postToPage" cols="50" rows="5">Write your status here and click 'submit'</textarea>
            <br />
            <input type="submit" value="Update My Status" />
        </form>
        <?php if (isset($status)) { ?>
            <br />
            <b style="color: red">Status Updated Successfully! Status id is <?=$status['id']?></b>
         <?php } ?>
    </div>
    
     <div class="box">
        <form name="" action="<?=$fbconfig['baseUrl']?>" method="post" enctype="multipart/form-data">
            <label for="messagephoto">Upload Photo to album</label>
            <br />
            <textarea id="messagephoto" name="messagephoto" cols="50" rows="5">Write your status here and click 'submit'</textarea>
            <br />
            <input name="photo" type="file" id="photo">
            <input type="submit" value="Update My Status" />
        </form>
        
            <b style="color: red"><?php print_r ($fqlResultstreamphoto); ?></b>
         
    </div>
 
    <?php } ?>
    
    <h2>Javascript API</h2>
    
 	<p>You <span id="likeornot">don't like</span> this page.</p><br />
    <a href="#" id="perms_request">Permission request</a><br /><br />
    
    
    <img src="placeholder" id="image" /><br />
    <span id="name"></span>
     <br /><a href="#" class="addtofriend" rel="100002059856516"><fb:profile-pic uid="100002059856516" size="thumb"></fb:profile-pic><fb:name uid="100002059856516"></fb:name> - Add to friend</a>
     
    <h3>Friends</h3>
    <div id="friends" class="box"></div>
    <h3>Dialogs</h3>
    <a href="#" id="share">Share</a>
    
    <br /><a href="#" id="invite">App Invite</a>
    
    <br /><a href="#" id="feed">Feed</a>
    <br /><a href="#" class="publish" id="1" name="Christian">Publish 1</a> <a href="#" class="publish" id="2" name="Josee">Publish 2</a> <a href="#" class="publish" id="3" name="Serge">Publish 3</a>
    <br /><a href="#" id="dialog">Dialog</a><br />
    <h3>Automatic status by javascript without autorisation<h3/>
    <input type="text" id="status"/>&nbsp;&nbsp;<a href="#" id="setStatus">Set Status</a>
    <h2>Wall of post from page</h2>
    <div class="box"><div id="wall"></div></div>
    
    
	<h2>XFBML</h2>
    <div id="foo">
    	<div class="box">
            <!-- XFBML Example -->
            <fb:like href="example.com" layout="button_count" show_faces="false" width="150" font="arial"></fb:like><br />
            <fb:name uid="706847059"></fb:name><br />
            <fb:profile-pic uid="706847059" size="thumb"></fb:profile-pic><br />
            <fb:name uid="100002059856516"></fb:name><br />
            <fb:profile-pic uid="100002059856516" size="thumb"></fb:profile-pic><br />
            
    	</div><br /><br />
        
        <fb:registration
            fields="[{'name':'name'}, {'name':'email'},
            {'name':'favorite_car','description':'What is your favorite car?',
            'type':'text'}]" redirect-uri="<?= $fbconfig['appBaseUrl'] ?>"  fb_only="true" client_id="<?= $fbconfig['appId' ] ?>"></fb:registration>
        <br /><br />
        <iframe src="http://www.facebook.com/plugins/registration.php?
                     client_id=<?= $fbconfig['appId' ] ?>&
                     redirect_uri=<?= $fbconfig['appBaseUrl'] ?>&
                     fields=name,birthday,gender,location,email"
                scrolling="auto"
                frameborder="no"
                style="border:none"
                allowTransparency="true"
                width="100%"
                height="330">
        </iframe>
        <br /><br />
        <h3>Live Stream</h3>
		<fb:live-stream event_app_id="<?= $fbconfig['appId' ] ?>" width="400" height="500" xid="1" always_post_to_friends="false"></fb:live-stream><br /><br />
        <h3>Recents activity - Based on url : lorealparis.ca</h3>
        <fb:activity site="lorealparis.ca" width="300" height="300" header="true" recommendations="true"></fb:activity>
        <br /><br />
        <h3>Comments - Based on url : lorealparis.ca</h3>
        <div class="box">
            <!-- XFBML Example -->
            
            <fb:comments href="example.com" num_posts="2" width="330"></fb:comments>
    	</div>
    </div>
    
    
	<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-2580180-1']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		
    </script>
	<script type="text/javascript">
		
			//PHP var to JS
			var api_key ='<?=$fbconfig['appId' ]?>';
			var width = <?= $width ?>; 
			var height = <?= $height ?>;
			var tracking_prefix = '<?= $tracking_prefix ?>';
			var baseUrl = "<?=$fbconfig['baseUrl']?>";
			var shareurl = "<?=$fbconfig['appBaseUrl']?>";
			var pageid = <?= $page_id?>;
			var uid = '<?= $fqlId ?>';
			
			var like = false;
			
			function login(){
                //document.location.href = baseUrl;
            }
            function logout(){
                //document.location.href = baseUrl;
            }
			//FACEBOOK INIT
            window.fbAsyncInit = function() {
                FB.init({
				appId: api_key, 
				status: true, 
				session : <?php echo json_encode($session); ?>, // don't refetch the session when PHP already has it
				cookie: true, 
				xfbml: true});
 				
				
				 
				
        
                /* All the events registered */
                FB.Event.subscribe('auth.login', function(response) {
                    // do something with response
                    login();
                });
                FB.Event.subscribe('auth.logout', function(response) {
                    // do something with response
                    logout();
                });
				/*
				FB.Canvas.setSize({ width: width, height: height }); 
				*/
			
				FB.Canvas.setAutoResize();
				
				var href = 'example.com';
				// this will fire when any of the like widgets are "liked" by the user
				FB.Event.subscribe('edge.create', function(href, widget) {
					alert('You liked ' + href, widget);
				});
				FB.Event.subscribe('edge.remove', function(href, widget) {
					alert('You disliked ' + href, widget);
				});

				
				
			   //Get my facebook user id
			   FB.api('/me', function(user) {
			   
				   if(user != null) {
				   
				   
				   	
					  
					  
					  
					  
				      //Get my facebook picture
					  var image = document.getElementById('image');
					  image.src = 'http://graph.facebook.com/' + user.id + '/picture';
					  var name = document.getElementById('name');
					 
					  name.innerHTML = user.name;
					  
					  
					 
					  var friends = FB.Data.query("SELECT name, uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1={0}) ORDER BY name", parseInt(user.id));
					  friends.wait(function(rows){
						  var friends_html = $('<div/>');
						  
						  $.each(rows, function(key, value) { 
							  var friend_html = $('<a id="'+value.uid+'">'+value.name+'</a>'); 
							  var friend_image = $('<img src="http://graph.facebook.com/'+value.uid+'/picture"/>'); 
							  friend_html.append(friend_image);
							  friends_html.append(friend_html);
						  });
							 
							 $('#friends').append(friends_html);

					   });

					  
					  //ckeck if user like the page or not  --> Better if done by PHP
				      var query = FB.Data.query('SELECT uid FROM page_fan WHERE uid={0} AND page_id={1}', user.id, pageid);
					  query.wait(function(resp) {
								if (resp) {
									like = true;
								} else {
									like = false;
								}
								if (like) {
											document.getElementById('likeornot').innerHTML ="like";
								} else {
											document.getElementById('likeornot').innerHTML = "don\'t like";
								}
					 });
					 
					 
				   }
				   
				   
				   
			   });
			
						
            };
			
			//Include facebook SDK and choose language
            (function() {
                var e = document.createElement('script');
                e.type = 'text/javascript';
                e.src = document.location.protocol +
                    '//connect.facebook.net/en_US/all.js';   /* Change en_US to your language   Also For debugging purpose : http://static.ak.fbcdn.net/connect/en_US/core.debug.js  */
                e.async = true;
                document.getElementById('fb-root').appendChild(e);
            }());
 
			//activate XFBML for part of ducument --> Already activated with FB.init  xfbml: true
			//FB.XFBML.parse(document.getElementById('foo'));
			
			
			function dialog(){
              		
				
				  	var dialog = {
							 'method': 'fbml.dialog',
							 'display': 'dialog',
							 'fbml': ' <bp=image/source"<img src="http://dev.philippedallaire.com/MASSIVART/wp-content/themes/massivart/images/i-twitter.png">" width=x.tits=36C|alt=border"0"><a href="#" onclick="inclick();">Test</a>',
							 'width': 575

				  	};
				 	FB.ui(dialog,function(response) {
						alert("fbDialogDismiss();");
					});
					
					
			}
			
			function setStatus(status_val){
                
                FB.api(
                  {
                    method: 'status.set',
                    status: status_val
                  },
                  function(response) {
                    if (response == 0){
                        alert('Your facebook status not updated. Give Status Update Permission.');
                    }
                    else{
                        alert('Your facebook status updated');
                    }
                  }
                );
            }

		
			(function($){
				
			
				
				$.fn.facebook_set_status = function(options) {
			
					var defaults = {
                    	status: 'Status test'
                    };
					
					defaults['method'] = 'status.set';			
					
					options = $.extend(defaults, options);
				
					this.each(function(){	
					
						FB.ui(options, 
							function(response) {
								if (response == 0){
									$(this).facebook_tracking({lid: tracking_prefix +'/status_set/error/'+response });
								}
								else{
									$(this).facebook_tracking({lid: tracking_prefix +'/status_set/success/'+response });
								}	
							}
						);
					});
					
				return this;
				};
				
				
				$.fn.facebook_perms_request = function(options) {
			
					var defaults = {
					   perms: 'user_birthday,user_relationship_details,read_stream'
				  	};
					
					defaults['method'] = 'permissions.request';		
					defaults['display'] = 'iframe';		
					
					options = $.extend(defaults, options);
				
					this.each(function(){	
					
						FB.ui(options, 
							function(response) {
					
				 
								if (response.perms != null) {
										 $(this).facebook_tracking({lid: tracking_prefix +'/perms_request/'+response });
										 
										 
										 top.location.href = baseUrl;
								}
							}
						);
					});
					
				return this;
				};
				
				$.fn.facebook_friends_add = function(options) {
			
					var defaults = {
						 id: 'fbid'
					};
					
					defaults['method'] = 'friends.add';		
					
					options = $.extend(defaults, options);
				
					this.each(function(){	
					
						FB.ui(options, 
							function(response) { 
									 $(this).facebook_tracking({lid: tracking_prefix +'/friends_add/'+response });
							}
						);
					});
					
				return this;
				};
				
				
				
				
				$.fn.facebook_publish = function(options) {
			
					var defaults = {
						 name: 'name',
						 link: shareurl,
						 picture: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif',
						 caption: '{*actor*} Test Caption',  //{*actor*} is only available in caption param
						 description: 'description',
						 media:[{
						 type: 'image',
						 src: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif',
						 href: shareurl}]
				
					};
					
					
					defaults['method'] = 'stream.publish';	
					defaults['display'] = 'popup';	
					
					options = $.extend(defaults, options);
				
					this.each(function(){	
					
						FB.ui(options, 
							function(response) {
								 if (response && response.post_id) {
									 $(this).facebook_tracking({lid: tracking_prefix +'/dialog/success/'+response.post_id });
								 } else {
									 $(this).facebook_tracking({lid: tracking_prefix +'/publish/error' });
								 }
							  }
						);
					
					});
					
				return this;
				};
				
				//Post to wall --> Publish
				$.fn.facebook_publish = function(options) {
			
					var defaults = {
						 name: 'name',
						 link: shareurl,
						 picture: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif',
						 caption: '{*actor*} Test Caption',  //{*actor*} is only available in caption param
						 description: 'description',
						 media:[{
						 type: 'image',
						 src: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif',
						 href: shareurl}]
				
					};
					
					
					defaults['method'] = 'stream.publish';	
					defaults['display'] = 'popup';	
					
					options = $.extend(defaults, options);
				
					this.each(function(){	
					
						FB.ui(options, 
							function(response) {
								 if (response && response.post_id) {
									 $(this).facebook_tracking({lid: tracking_prefix +'/publish/success/'+response.post_id });
								 } else {
									 $(this).facebook_tracking({lid: tracking_prefix +'/publish/error' });
								 }
							  }
						);
					
					});
					
				return this;
				};
		
				//Post to wall --> Feed
				$.fn.facebook_feed = function(options) {
			
					  var defaults = {
					  message: 'Test Message',
					  name: 'Test Name',
					  caption: '{*actor*} Test Caption',   //{*actor*} is only available in caption param
					  description:  'Test desc',
					  link: shareurl,
					  picture: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif',
					  actions: [
						{ 
						name: 'xyz', 
						link: shareurl 
						}
					  ],
					  media:[
					    { 
						type: 'image', 
						src: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif', 
						href: shareurl 
						}
					  ],
					  properties:[
						{ text: 'value1', href: shareurl+'?id=1'},
						{ text: 'value2', href: shareurl+'?id=2'},
						{ text: 'value3', href: shareurl+'?id=3'},
						{ text: 'value4', href: shareurl+'?id=4'},
						{ text: 'value5', href: shareurl+'?id=5'}
					  ],
					  user_message_prompt: 'Test Message Prompt'
					  };
					
					
					defaults['method'] = 'feed';	
					defaults['display'] = 'popup';	
					
					options = $.extend(defaults, options);
				
					this.each(function(){	
					
						FB.ui(options, 
							function(response) {
								 if (response && response.post_id) {
									 $(this).facebook_tracking({lid: tracking_prefix +'/feed/success/'+response.post_id });
								 } else {
									 $(this).facebook_tracking({lid: tracking_prefix +'/feed/error' });
								 }
							  }
						);
					
					});
					
				return this;
				};
			
			
			    //Simple share URL 
				$.fn.facebook_share = function(options) {
			
					var defaults = {
						 u: shareurl
					};
					
					defaults['method'] = 'stream.share';	
						
					options = $.extend(defaults, options);
					
					this.each(function(){
						FB.ui(options, 
							function(response) {
								 if (response && response.post_id) {
								 	 
									 $(this).facebook_tracking({lid: tracking_prefix +'/share/success/'+response.post_id });
								} else {
									 $(this).facebook_tracking({lid: tracking_prefix +'/share/error' });
								}
							  }
						);
			 		});
					
				return this;
				};
				
			 
			 	//App Invitation request --> notification
				$.fn.facebook_invite = function(options) {
			
					var defaults = {
						message: 'Test invite message', 
						data: 'tracking information for the user'
					};
					
					defaults['method'] = 'apprequests';	
						
					options = $.extend(defaults, options);
					
					this.each(function(){
						FB.ui(options, 
							function(response) {
								 if (response) {
									 $(this).facebook_tracking({lid: tracking_prefix +'/invite/success/' });
								} else {
									 $(this).facebook_tracking({lid: tracking_prefix +'/invite/error' });
								}
							  }
						);
						FB.Canvas.scrollTo(0,0);

			 		});
					
					return this;
				};
				
					
			
			 	//GET FACEBOOK WALL FEEDS --> Facebook API GRAPH BY JAVASCRIPT
				$.fn.facebook_wall = function(options) {
			
					var defaults = {
						nb: 10,
						feed: null,
						loading_message: "Chargement du mur ..."
					};
							
					options = $.extend(defaults, options);
					
					this.each(function(){
					
						var obj = $(this);
						
						obj.addClass("facebook_feed");
						obj.append("<div class='loader'>"+options.loading_message+"</div>");
						
						if(options.feed != null){
							$.ajax({
								url: options.feed+"?limit="+options.nb,
								dataType: "jsonp",
								success: function(feed)
								{
									var html = "<ul>";
									
									$(feed.data).each(function(i, elt){
										className = (i%2 == 0)?"odd":"even";
										borderClass = (i==0)?" first":(i==(options.nb-1))?" last":"";
										
										date = elt.created_time.substr(0,10).split("-");
										date = date[2]+"/"+date[1]+"/"+date[0];
										
										var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/i;
										msg = elt.message.replace(exp,"<a href='$1'>$1</a>"); 
										
										html += "<li class='"+className+borderClass+"'>";
										if(elt.picture){
											html += "<div class='img'><a href='"+elt.link+"'><img src='"+elt.picture+"' alt='"+elt.message+"' /></a>"
											 + "<p class='date'><img src='"+elt.icon+"' alt='"+elt.type+"' title='"+elt.type+"' /> <small>"+date+"</small></p></div>";
										}
										html += "<div class='txt'>"
											 + "<h3>"+elt.from.name+"</h3>"
											 + "<p>"+msg+"</p></div>"
											 + "</li>";
									})
									
									html += "</ul>";
									
									obj.html(html);
									obj.find(".loader").remove();
									$(this).facebook_tracking({lid: tracking_prefix +'/wall/loaded/'+options.feed});
									
								}
							});
							
						} else {
							
								
							
							obj.html("flux introuvable.");
									$(this).facebook_tracking({lid: tracking_prefix +'/wall/error' });
						}
					});
					
				return this;
				};
				
		
				
				
				//Google Analytics Tracking...  And hopefully Facebook insight too...
				$.fn.facebook_tracking = function(options) {
			
					var defaults = {
					  	lid: 'EVENT_TYPE'
					 }; 
					
					defaults['api_key'] = api_key;	
						
					var options = $.extend(defaults, options);
					
					this.each(function(){
						
						_gaq.push(['_trackEvent', 'APP_ID/'+options['api_key'], options['lid']]);
						/*
						DOES NOT WORK -- to investiguate
						FB.Insights.impression(options, 
							function(response) {
								 if (response) {
									 //bravo
								} else {
									 //error
								}
							  }
						);
						*/
			 		});
					
				return this;
				};
				
				
				
				
				//On DOM ready initialize
				$(document).ready(function(){
					
					
						$(".publish").click(function (event){ 
								event.preventDefault();
								
								
								
								
								$(this).facebook_publish({
								 name: event.target.name+' receive a vote.',
								 link: shareurl,
								 picture: 'http://www.etiennedion.com/images/a'+event.target.id+'.jpg',
								 caption: '{*actor*} voted for '+event.target.name,  //{*actor*} is only available in caption param
								 description: 'description',
								 media:[
								 {
										type: 'image',
										src: 'http://www.etiennedion.com/images/a'+event.target.id+'.jpg',
										href: shareurl
								 },{ 
										type: 'image', 
										src: 'http://www.etiennedion.com/images/a'+event.target.id+'.jpg', 
										href: shareurl 
									}
								 ]
						
							});
						});
						
						
						
						$("#feed").click(function (event){ 
								event.preventDefault();
								
								$(this).facebook_feed({
									message: 'Test Message',
									name: 'Test Name',
									caption: '{*actor*} Test Caption',   //{*actor*} is only available in caption param
									description:  'Test desc',
									link: shareurl,
									picture: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif',
									actions: [
										{ name: 'fbrell', link: shareurl }
									],
									media:[
									  { 
										type: 'image', 
										src: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif', 
										href: shareurl 
									  },{ 
										type: 'image', 
										src: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif', 
										href: shareurl 
									  },{ 
										type: 'image', 
										src: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif', 
										href: shareurl 
									  }
									],
									properties: [
										{ text: 'value1', href: shareurl+'?id=1'},
										{ text: 'value2', href: shareurl+'?id=2'},
										{ text: 'value3', href: shareurl+'?id=3'},
										{ text: 'value4', href: shareurl+'?id=4'},
										{ text: 'value5', href: shareurl+'?id=5'}
									],
									user_message_prompt: 'Test Message Prompt'
								});
						});
						
						
						$("#perms_request").click(function (event){ 
								event.preventDefault();
								
								$(this).facebook_perms_request({
									perms: 'user_birthday,user_relationship_details,read_stream',
								}); 
						});
						
						$(".addtofriend").click(function (event){ 
								event.preventDefault();
								var fbid = $(this).attr('rel');
								$(this).facebook_friends_add({
									id: fbid
								}); 
						});
						
						$("#invite").click(function (event){ 
								event.preventDefault();
								
								$(this).facebook_invite({
									message: 'Test invite message', 
									data: 'tracking information for the user'
								});
						});
						
						
						
						
						
						$("#share").click(function (event){ 
								event.preventDefault();
								
								$(this).facebook_share({
									u: shareurl
								}); 
						});
						
						$("#setStatus").click(function (event){ 
								event.preventDefault();
								
								setStatus(document.getElementById('status').value);
						});
						
					    $("#wall").facebook_wall({
							nb: 3,
							feed: 'http://graph.facebook.com/lorealpariscanada/feed',
							loading_message: "Chargement du mur ..."
						});
					
						
						
						$("#dialog").click(function (event){ 
								event.preventDefault();
								
								dialog();
						});
					
				});
				
			
			
			
			})(jQuery);
			
			
	</script>	
    </body>
</html>