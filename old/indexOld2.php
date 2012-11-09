<?php

    include_once "fbmain.php";
   
 /*
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
	


*/

?><!DOCTYPE HTML>
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
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.js"></script>

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
    <?php /* if (!$fbme) { ?>
        You've to login using FB Login Button to see api calling result.
    <?php } */ ?>
    <p>
        <fb:login-button autologoutlink="true" perms="email,user_birthday,status_update,publish_stream"></fb:login-button>
    </p>
 	<h2>PHP API</h2>
    <?php  /*
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
        <form name="" action="<?=$fbconfig['base_url']?>" method="post">
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
        <form name="" action="<?=$fbconfig['base_url']?>" method="post">
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
        <form name="" action="<?=$fbconfig['base_url']?>" method="post" enctype="multipart/form-data">
            <label for="messagephoto">Upload Photo to album</label>
            <br />
            <textarea id="messagephoto" name="messagephoto" cols="50" rows="5">Write your status here and click 'submit'</textarea>
            <br />
            <input name="photo" type="file" id="photo">
            <input type="submit" value="Update My Status" />
        </form>
        
            <b style="color: red"><?php print_r ($fqlResultstreamphoto); ?></b>
         
    </div>
 
    <?php } */ ?>
    
    <h2>Javascript API</h2>
    
 	
    <h3>User</h3>
    <a href="#" id="perms_request">Permission request (if not grant yet)</a><br /><br />
    <p>You <span id="likeornot">don't like</span> this page.</p><br />
   
    <img src="placeholder" id="image" /><br />
    <span id="name"></span>
    <h3>Friends</h3>
    <a href="#" class="add_friend" rel="100002059856516"><fb:profile-pic uid="100002059856516" size="thumb"></fb:profile-pic><fb:name uid="100002059856516"></fb:name> - Add to friend</a>
     
    <div id="friends" class="box"><a href="#" id="perms_request">Permission request (if not grant yet)</a><br /><br /></div>
    <h3>Dialogs</h3>

    <a href="#" id="invite_friends">App Invite</a>
    <br /><a href="#" id="feed">Feed</a>
    <br /><a href="#" class="publish" id="1" name="Christian">Publish 1</a> <a href="#" class="publish" id="2" name="Josee">Publish 2</a> <a href="#" class="publish" id="3" name="Serge">Publish 3</a>
    <br /><a href="#" id="dialog">Dialog</a><br />
    
    <h3>Events</h3>
    
    <a href="#" id="create_event">Create Event</a><br />
    
    <h2>Wall of post from page</h2>
    <div class="box"><div id="wall"><a href="#" id="perms_request">Permission request (if not grant yet)</a><br /><br /></div></div>
    
    
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
        <?php /*
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
        
        */ ?>
        <h3>Live Stream</h3>
		<fb:live-stream event_app_id="example.com" width="400" height="500" xid="1" always_post_to_friends="false"></fb:live-stream><br /><br />
        <h3>Recents activity - Based on url : lorealparis.ca</h3>
        <fb:activity site="lorealparis.ca" width="300" height="300" header="true" recommendations="true"></fb:activity>
        <br /><br />
        <h3>Comments - Based on url : example.com</h3>
        <div class="box">
            <!-- XFBML Example -->
            
            <fb:comments href="example.com" num_posts="2" width="330"></fb:comments>
    	</div>
    </div>
    
    
	<script type="text/javascript">
		
			//PHP var to JS
			
			var width = <?= $width ?>; 
			var height = <?= $height ?>;
			
			
			
			var uid = '<?= $fqlId ?>';
			
			
			
			function login(){
                //document.location.href = base_url;
            }
            function logout(){
                //document.location.href = base_url;
            }
			
			 
			
		
			(function($){
			    
				$.fb= {};
				var api_key = '0';
				var base_url = "/";
				var fbdefaults = [];	
				var access_token;
				var GA_Account = 0;
				var tracking_prefix ='undefined';
				var like = false;
				var user;
				var friends;
				
				var date = new Date(parseInt("2012"), parseInt("7")-1, parseInt("1"), parseInt("8")+3, parseInt("0"),0,0);
				date = Math.round(date.getTime() / 1000);
				
				fbdefaults['InitSettings'] = {
										 api_key: '0',
										 FB_lang: 'en_US',
										 perms:'read_stream,publish_stream,offline_access,create_event',
										 get_friends:'0',
										 access_token_required:'1',
										 GA_Account: 'UA-9999999-9',
										 tracking_prefix:'demo',
										 base_url: '/'
										 
										
				};
				
				fbdefaults['PermRequestSettings'] = {
										 perms: 'user_birthday,user_relationship_details,read_stream',
										 callback_url: 'http://www.etiennedion.com'
				};
				
				fbdefaults['InviteFriendsSettings'] = {
										 message: 'Test invite message', 
										 data: 'tracking information for the user'
				};
				
				fbdefaults['AddFriendSettings'] = {
										 id: '12345678'
				};
								
				fbdefaults['PublishSettings'] = {
										 name: 'name',
										 link: base_url,
										 picture: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif',
										 caption: '{*actor*} Test Caption',  //{*actor*} is only available in caption param
										 description: 'description',
										 media:[{
										 type: 'image',
										 src: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif',
										 href: base_url}]	
				};
				  
				fbdefaults['ShareSettings'] = {
										 message: 'Test Message',  
										 name: 'Test Name',
										 caption: '{*actor*} Test Caption',   //{*actor*} is only available in caption param
										 description:  'Test desc',
										 link: base_url,
										 picture: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif',
										 actions: [
											{ 
											name: 'xyz', 
											link: base_url 
											}
										 ],
										 media:[
											{ 
											type: 'image', 
											src: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif', 
											href: base_url 
											}
										 ],
										 properties:[
											{ text: 'value1', href: base_url+'?id=1'},
											{ text: 'value2', href: base_url+'?id=2'},
											{ text: 'value3', href: base_url+'?id=3'},
											{ text: 'value4', href: base_url+'?id=4'},
											{ text: 'value5', href: base_url+'?id=5'}
										 ],
										 user_message_prompt: 'Test Message Prompt'
				};

				fbdefaults['EventSettings'] = {
										on: "click",
										name:'Event Name',
										location: 'Montreal, QC',
										//city:city,
										description:"Event description",
										//privacy:"CLOSED",
										start_time:date
				};
					
				fbdefaults['ShowWallSettings'] = {
										 nb: 10,
										 feed: null,
										 loading_message: "Chargement du mur ..."
				};
									
			  
			  	var methods = {
					//test : function () { alert('test'); },
						fbinit : function ( options ) {  
							
										var defaults = fbdefaults['InitSettings'];
										options = $.extend(defaults, options);
										
										base_url = options.base_url;
										api_key = options.api_key;
										 
										(function() {
											var e = document.createElement('script'); e.async = true;
											e.src = document.location.protocol +
											  '//connect.facebook.net/'+options.FB_lang+'/all.js';
											document.getElementById('fb-root').appendChild(e);
										}());
										  
										if (options.GA_Account !== 'UA-9999999-9'){
											 GA_Account =1;
											 tracking_prefix = options.tracking_prefix;
											 var _gaq = _gaq || [];
											 _gaq.push(['_setAccount', options.GA_Account]);
											 _gaq.push(['_trackPageview']);
										
											(function() {
												var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
												ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
												var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
											}());
											
											console.log('Google Analytics initiated');
										}
										
										if(options.api_key !== '0'){
										
											//FACEBOOK INIT
											window.fbAsyncInit = function() {
																			FB.init({
																				appId: options.api_key, 
																				status: true, 
																				//session : <?php echo json_encode($session); ?>, // don't refetch the session when PHP already has it
																				cookie: true, 
																				xfbml: true
																			});
																			
																			
																			
																			console.log('facebook initiated');
																			
																			
																			
																			// All the events registered 
																			FB.Event.subscribe('auth.login', function(response) {
																				// do something with response
																				console.log('user logged in');
																				//login();
																			});
																			FB.Event.subscribe('auth.logout', function(response) {
																				// do something with response
																				console.log('user logged out');
																				//logout();
																			});
																			
																			//FB.Canvas.setSize({ width: width, height: height }); 
																			
																			if (options.auto_resize_tab === '1'){
																				FB.Canvas.setAutoResize();
																			}
																			
																			
																			var href = 'example.com';
																			// this will fire when any of the like widgets are "liked" by the user
																			FB.Event.subscribe('edge.create', function(href, widget) {
																				$(this).facebook_tracking({lid: tracking_prefix +'/has_been_liked/'});
																				console.log(tracking_prefix +'/has_been_liked/');
																			});
																			FB.Event.subscribe('edge.remove', function(href, widget) {
																				$(this).facebook_tracking({lid: tracking_prefix +'/has_been_unliked/'});
																				console.log(tracking_prefix +'/has_been_unliked/');
																			});
															
																			
																		    if (options.get_friends === '1' || options.get_user === '1' || options.access_token_required === '1'){
																			
																			
																		    	FB.getLoginStatus(function(response) {
																						 if (response.session) {
																						 
																						 	if (options.access_token_required === '1' ){
																								 access_token = response.session.access_token;
																								 console.log('access_token ='+response.session.access_token);
																								 
																								 console.log('user is logged in and granted some permissions.');
																							 }
																							 
																							 console.log('fbinit done');
																							 $('body').trigger('fbinit');
																							 
																							 //Get my facebook user id
																							 FB.api('/me', function(u) {
																											if(u !== null && typeof(u.name) !== 'undefined') {
																												  
																												  if (options.get_user === '1'){
																													  user = u;
																													  $('body').trigger('user');
																													  console.log('user initiated');
																											   	  }
																												  
																												  if (options.get_friends === '1'){
																												      user = u;
																													  var getfriends = FB.Data.query("SELECT name, uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1={0}) ORDER BY name", parseInt(user.id));	
																													  getfriends.wait(function(rows){
																															friends = rows;
																															$('body').trigger('friends');
																															console.log('friends list collected');
																													  });
																												  } 
																												 
																											
																											}
																				   			});
																				 		} else {
																							FB.login(function(response) {
																								if (response.session) {
																										
																									    if (options.access_token_required === '1' ){
																											 access_token = response.session.access_token;
																											 console.log('user is logged in and granted some permissions.');
																										}
																										
																										if (response.perms) {
																												console.log('user is logged in and granted some permissions.');
																										} else { 
																											  	console.log('user is logged in, but did not grant any permissions');
																										}
																										
																										console.log('fbinit done');
																										$('body').trigger('fbinit');
																										
																										FB.api('/me', function(u) {
																											if(u !== null &&  typeof(u.name) !== 'undefined') {
																												  
																												  if (options.get_user === '1'){
																													  user = u;
																													  $('body').trigger('user');
																													  console.log('user initiated');
																											   	  }
																											  
																												  if (options.get_friends === '1'){
																												      user = u;
																													  var getfriends = FB.Data.query("SELECT name, uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1={0}) ORDER BY name", parseInt(user.id));	
																													  getfriends.wait(function(rows){
																															friends = rows;
																															$('body').trigger('friends');
																															console.log('friends list collected');
																													  });
																												  } 
																												
																											}
																										});
																							 	} else {
																										// user is not logged in
																										if (options.access_token_required === '1' ){
																											 access_token = response.session.access_token;
																										}
																										console.log('user is not logged in : cant show user and friends');
																										console.log('fbinit done');
																										$('body').trigger('fbinit');
																										
																										
																								}
																							}, {perms: options.perms});
																						}
																				});
																			}	   
																				   
																				   
																};
										}
																		   
										  
									},
					
					//Request facebook permission			
					perms_request : function (options) { 
				
										var defaults = fbdefaults['PermRequestSettings'];
										
										defaults['method'] = 'permissions.request';		
										defaults['display'] = 'iframe';		
										console.log(options);
										 
										options = $.extend(defaults, options);
										
									   
																	   
											FB.ui(options, 
												function(response) {
										
									 
													if (response.perms != null) {
															 $(this).facebook_tracking({lid: tracking_prefix +'/perms_request/'+response });
															 
															 
															 top.location.href = options.callback_url;
													}
												}
											);
										
										
									    return this;
										
									   
									},
					
					//App Invitation request --> Notification
					invite_friends : function (options) { 
										
										var defaults = fbdefaults['InviteFriendsSettings'];
										
										defaults['method'] = 'apprequests';	
										console.log(options);
										  	
										options = $.extend(defaults, options);
										
										
																	   
											FB.ui(options, 
												function(response) {
													 if (response) {
														 $(this).facebook_tracking({lid: tracking_prefix +'/invite_friends/success/' });
													} else {
														 $(this).facebook_tracking({lid: tracking_prefix +'/invite_friends/error' });
													}
												  }
											);
											FB.Canvas.scrollTo(0,0);
										
										
										return this;
										
										
									 
									},
												
					//Add friends					
					add_friend : function (options) { 
				
										var defaults = fbdefaults['AddFriendSettings'];
										
										defaults['method'] = 'friends.add';		
										console.log(options);
										  
										options = $.extend(defaults, options);
									
																			   
											FB.ui(options, 
													function(response) { 
															 $(this).facebook_tracking({lid: tracking_prefix +'/add_friend/'+response });
													}
											);
										
										
										return this;
										
										
									  
									},
					
					//Post to wall --> Publish
					publish : function (options) { 
								
										var defaults = fbdefaults['PublishSettings'];
										
										
										defaults['method'] = 'stream.publish';	
										defaults['display'] = 'popup';	
										console.log(options);
										
										options = $.extend(defaults, options);
									
																												
											FB.ui(options, 
												function(response) {
													 if (response && response.post_id) {
														 $(this).facebook_tracking({lid: tracking_prefix +'/publish/success/'+response.post_id });
													 } else {
														 $(this).facebook_tracking({lid: tracking_prefix +'/publish/error' });
													 }
												}
											);
																				
																				
									
										
											
										return this;
										
										
										
									},
				
					//Post to wall --> Feed
					share : function (options) { 
				
										  var defaults = fbdefaults['ShareSettings'];
										  
										  defaults['method'] = 'feed';	
										  defaults['display'] = 'popup';	
										  console.log(options);
										  
										  options = $.extend(defaults, options);
										  
										  
											  FB.ui(options, 
												function(response) {
													 if (response && response.post_id) {
														 $(this).facebook_tracking({lid: tracking_prefix +'/feed/success/'+response.post_id });
													 } else {
														 $(this).facebook_tracking({lid: tracking_prefix +'/feed/error' });
													 }
												  }
											  );
										 
										return this;
										
										
										  
									},
					//Createevent --> Feed
					create_event : function (options) { 
				
										  var defaults = fbdefaults['EventSettings'];
										  	
										  console.log(options);
										  
										  options = $.extend(defaults, options);
										  
										  
											 
										 	  FB.api('/me/events','post',options,function(resp) {
												   //alert(resp.id);
												   window.location = "http://www.facebook.com/event.php?eid="+resp.id;
											  }); 
										return this;
										
										
										  
									},
					

					//GET FACEBOOK WALL FEEDS --> Facebook API GRAPH BY JAVASCRIPT
					show_wall : function (options) { 
											var defaults = fbdefaults['ShowWallSettings'];
											
											options = $.extend(defaults, options);
											
													
											
													var $this = $(this+'');
													
													$this.addClass("facebook_feed");
													
													$this.append("<div class='loader'>"+options.loading_message+"</div>");
													
													if(options.feed != null){
														$.ajax({
															url: options.feed+"?limit="+options.nb+'&access_token='+access_token,
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
																
																$this.html(html);
																$this.find(".loader").remove();
																$(this).facebook_tracking({lid: tracking_prefix +'/show_wall/loaded/'+options.feed});
																
															}
														});
														
													} else {
														
															
														
																$this.html("flux introuvable.");
																$(this).facebook_tracking({lid: tracking_prefix +'/show_wall/error' });
													}
													
												
										
											
									  
									}  
									
				};					
				
						
				//Google Analytics Tracking...  
				$.fn.facebook_tracking = function (options) {
											if (GA_Account){
												var defaults = {
													lid: 'EVENT_TYPE'
												}; 
												
												defaults['api_key'] = api_key;	
													
												var trackoptions = $.extend(defaults, options);
												
												this.each(function(){
													
													_gaq.push(['_trackEvent', 'APP_ID/'+trackoptions['api_key'], trackoptions['lid']]);
												
												});
											}
				};
				
				// Create a sub instance of jQuery which will contain the new fb methods
				var fbQuery = $.sub();
				// target remembers what elements were found by jquery
				var target;
				// load default settings from global scope
				var settings = {};
				
				// A factory which return a api method which remembers its options and target
				function fbFactory(methodId) {
					// Extend settings with new options
					//$.extend(settings, defaults[methodId]);
					var handler = methods[methodId];
					// return the newly fabricated function
					return function() {
						// If a event name is passed in the "on" attribute, we bind an event
						// instead of calling the handler rightaway
						
					
						if (typeof(arguments[0]['on']) !== 'undefined') {
								console.log('on'+arguments[0]['on']+'/');
							    if (target['selector'] != ''){
									var obj = $(target['selector']+'') ;
									var objs = target['selector']+'';
									
									console.log($(target['selector']+''));
								
								} else {
									var obj =  $(target);
									var objs = target;
									
									console.log($(target));
								}
								console.log(arguments);
								var obja = arguments;
								
								return obj.bind(arguments[0]['on'], function(e) {
										e.isDefaultPrevented();
										e.preventDefault();
									    handler.apply(objs, obja);
								});
								
								
								
								
								
						} else {
							console.log('onload/');
							console.log(target['selector']+'');
							console.log(arguments);
							return handler.apply(target['selector']+'', arguments);
							
						}
					};
				}
				// extend the sub instance of jQuery to add fb methods
				fbQuery.fn.extend({
					fbinit: fbFactory('fbinit'),
					permsRequest: fbFactory('perms_request'),
					inviteFriends: fbFactory('invite_friends'),
					addFriend: fbFactory('add_friend'),
					publish: fbFactory('publish'),
					share: fbFactory('share'),
					createEvent: fbFactory('create_event'),
					showWall: fbFactory('show_wall')
				});
					
				$.fn.fb = function (  ) {	
					// return the new jQuery instance
					target = this;
					
					var sub = fbQuery(this);
					return sub;
				};
				
					
				//On DOM ready initialize
				$(document).ready(function(){
						
							//enlever $('#fb-root'). ajouter '#fb-root' automatiquement
						$('#fb-root').fb().fbinit({
											 api_key: '<?=$fbconfig['appId' ]?>',
											 FB_lang: 'fr_CA', //en_CA is invalid //en_US is valid
											 perms:'create_event',
											 access_token_required:'1',
											 get_friends:'1',
											 get_user:'1',  // required for create event and acces to user data
											 GA_Account: 'UA-9999999-8',
											 tracking_prefix:'demo',
											 base_url: '<?=$fbconfig['appBaseUrl']?>',
											 auto_resize_tab:'1'
						});
						
						
						//redirect happen even if allready granted : to be fix
						$("#perms_request").fb().permsRequest({
											on: "click",
											perms: 'user_birthday,user_relationship_details,read_stream,create_event',
											callback_url: 'http://apps.facebook.com/fbtutoriel/'
						});
						
						//example: used dynamicly
						$(".publish").each(function (){
							var name = $(this).attr('name'); 
							var id = $(this).attr('id'); 
							console.log($(this));
							$(this).fb().publish({
											 on: "click",
											 name: name +' receive a vote.',
											 link: base_url,
											 picture: 'http://www.etiennedion.com/images/a'+ id+'.jpg',
											 caption: '{*actor*} voted for '+ name,  //{*actor*} is only available in caption param
											 description: 'description',
											 media:[
											 {
													type: 'image',
													src: 'http://www.etiennedion.com/images/a'+id+'.jpg',
													href: base_url
											 },{ 
													type: 'image', 
													src: 'http://www.etiennedion.com/images/a'+id+'.jpg', 
													href: base_url 
												}
											 ] 
							});
						});
						
						//example: used normaly
						$("#feed").fb().share({
											on: "click",
											message: 'Test Message',
											name: 'Test Name',
											caption: '{*actor*} Test Caption',   //{*actor*} is only available in caption param
											description:  'Test desc',
											link: base_url,
											picture: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif',
											actions: [
												{ name: 'test', link: base_url }
											],
											media:[
											  { 
												type: 'image', 
												src: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif', 
												href: base_url 
											  },{ 
												type: 'image', 
												src: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif', 
												href: base_url 
											  },{ 
												type: 'image', 
												src: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif', 
												href: base_url 
											  }
											],
											properties: [
												{ text: 'value1', href: base_url+'?id=1'},
												{ text: 'value2', href: base_url+'?id=2'},
												{ text: 'value3', href: base_url+'?id=3'},
												{ text: 'value4', href: base_url+'?id=4'},
												{ text: 'value5', href: base_url+'?id=5'}
											],
											user_message_prompt: 'Test Message Prompt'
						});
						
						//example: used dynamicly
						$(".add_friend").each(function (){
							
							var uid = $(".add_friend").attr('rel'); 
							console.log($(this));
							
							$(this).fb().addFriend({
											on: "click",
											id: uid
							});
						});
						
						$("#invite_friends").fb().inviteFriends({
											on: "click",
											message: 'Test invite message', 
											data: 'tracking information for the user'				
						});
						
						
						
										
				
						
						
						
						// on FB initiated
						$('body').bind('fbinit', function(){
							$("#wall").fb().showWall({
											nb: 3,
											feed: 'https://graph.facebook.com/lorealpariscanada/feed',
											loading_message: "Chargement du mur ..."
							});
						});
																				  
						//on user initiated
						$('body').bind('user', function(){
						
								var image = document.getElementById('image');
							    image.src = 'http://graph.facebook.com/' + user.id + '/picture';
							    var name = document.getElementById('name');
							    name.innerHTML = user.name;	
								
								
								
								var st = new Date(parseInt("2012"), parseInt("7")-1, parseInt("1"), parseInt("8")+3, parseInt("0"),0,0);
								st = Math.round(st.getTime() / 1000);
								$("#create_event").fb().createEvent({
											on: "click",
											//More options here: http://developers.facebook.com/docs/reference/api/event/
											name:'Event Name',
											location: 'Montreal, QC',
											//city:city,
											description:"Event description",
											//privacy:"CLOSED",
											start_time:st				
								});
								
								
								
								
								 //ckeck if user like the page or not  --> Better if done by PHP
								  
								  
								  
									  var query = FB.Data.query('SELECT uid FROM page_fan WHERE uid={0} AND page_id={1}', user.id,'137214468461');
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
								 
								
						});
																			  
						// on friends list collected  =  friends
						$('body').bind('friends', function(){
									var friends_html = $('<div/>');
																													  
									$.each(friends, function(key, value) { 
										  var friend_html = $('<a id="'+value.uid+'">'+value.name+'</a>'); 
										  var friend_image = $('<img src="http://graph.facebook.com/'+value.uid+'/picture"/>'); 
										  friend_html.append(friend_image);
										  friends_html.append(friend_html);
									});
										 
									$('#friends').html(friends_html);
						});
						
				});
				
			
			})(jQuery)
			
			
	</script>	
    </body>
</html>