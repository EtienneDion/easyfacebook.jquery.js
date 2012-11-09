<?php

    include_once "fbmain.php";
   

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

	
    </head>
	<body>
    <div id="fb-root"></div>
        

 
    <div id="allow_mandatory">
    	<a href="#">Allow</a>
        <div id="friend_autocomplete_1" ></div>  
        <div id="friend_autocomplete_2" ></div>
        <div id="friend_autocomplete_3" ></div>
    </div>
    <h3>Dialogs</h3>

    <a href="#" id="invite_friends">App Invite</a>

    <br /><a href="#" class="publish" id="1" name="Christian">Publish 1</a> <a href="#" class="publish" id="2" name="Josee">Publish 2</a> <a href="#" class="publish" id="3" name="Serge">Publish 3</a>
    
    
    
    
    
	<script type="text/javascript">
		
			//PHP var to JS
			
			var width = <?= $width ?>; 
			var height = <?= $height ?>;
			var uid = '<?= $fqlId ?>';
			var mobile = 0;
			var api_key = '0';
			var base_url = "/";
			var GA_Account = 0;
			var tracking_prefix ='undefined';
			var like = false;
			var user;
			var friends=0;
			
				
				
			function login(){
                //document.location.href = base_url;
            }
            function logout(){
                //document.location.href = base_url;
            }
			
			 
			
				
		
			(function($){
			    
				$.fb= {};
				var fbdefaults = [];
				var access_token;
				
				
				
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
				
				
				fbdefaults['InviteFriendsSettings'] = {
										 message: 'Test invite message', 
										 data: 'tracking information for the user'
				};
				
				
				
				fbdefaults['FriendAutocompleteSettings'] = {
										 input_name: 'name_of_the_submited_input_to_backend'
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
										  
										
										if(/iPhone|iPod|Android|opera mini|blackberry|palm os|palm|hiptop|avantgo|plucker|xiino|blazer|elaine|iris|3g_t|windows ce|opera mobi|windows ce; smartphone;|windows ce; iemobile/i.test(navigator.userAgent)){
											mobile = 1;
											$(this).facebook_tracking({lid: 'mobile_broswer'});
											$(this).output_log({log: 'mobile_broswer'});
										} else {
											$(this).facebook_tracking({lid: 'normal_broswer'});
											$(this).output_log({log: 'normal_broswer'});
										}
										
					  
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
											
											
											$(this).output_log({log: 'Google Analytics initiated'});
										}
										
										if(api_key !== '0'){
										
											//FACEBOOK INIT
											window.fbAsyncInit = function() {
																		
																			FB.init({
																				appId: api_key, 
																				status: true, 
																				//session : <?php echo json_encode($session); ?>, // don't refetch the session when PHP already has it
																				cookie: true, 
																				xfbml: true
																			});
																			
																			
																			$(this).output_log({log: 'facebook initiated'});
																			
																			
																			// All the events registered 
																			FB.Event.subscribe('auth.login', function(response) {
																				// do something with response
																				$(this).output_log({log: 'user logged in'});
																				window.location.reload();
																				
																				//login();
																			});
																			FB.Event.subscribe('auth.logout', function(response) {
																				// do something with response
																				
																				$(this).output_log({log: 'user logged out'});
																				//logout();
																			});
																			
																			//FB.Canvas.setSize({ width: width, height: height }); 
																			
																			if (options.auto_resize_tab === '1'){
																				FB.Canvas.setAutoResize();
																			}
																			
																			
																			
																			// this will fire when any of the like widgets are "liked" by the user
																			FB.Event.subscribe('edge.create', function(href, widget) {
																				$(this).facebook_tracking({lid: tracking_prefix +'/has_been_liked/'+href});
																				
																			});
																			FB.Event.subscribe('edge.remove', function(href, widget) {
																				$(this).facebook_tracking({lid: tracking_prefix +'/has_been_unliked/'+href});
																				
																			});
															
																			FB.Event.subscribe('message.send', function(href, widget) {
																				$(this).facebook_tracking({lid: tracking_prefix +'/message.sended/'+href});
																				
																			});
																			
																			if (options.access_token_required != '0' && options.get_user != '0' && options.get_friends != '0'  && options.perms !=''){
																				$(this).facebook_login({
																					access_token_required: options.access_token_required,
																					get_user: options.get_user,
																					get_friends: options.get_friends,
																					perms: options.perms,
																					success: options.success
																				});	
																			}
																};
										}
																		   
										  
									},
					
					
					//App Invitation request --> Notification
					invite_friends : function (options) { 
										
										var defaults = fbdefaults['InviteFriendsSettings'];
										
										defaults['method'] = 'apprequests';	
									
										
										if (mobile){
											defaults['display'] = 'iframe';	
										} else {
											defaults['display'] = 'popup';	
										}
										
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
								
					//Autocomplete					
					friend_autocomplete : function (options) { 
				
										var defaults = fbdefaults['FriendAutocompleteSettings'];
										
										var $this = $(this+'');
										var strthis = this+'';
										options = $.extend(defaults, options);
										
								
										$('head').append('<link rel="stylesheet" href="css/autocomplete.css" type="text/css" />');
										//$(this).facebook_tracking({lid: tracking_prefix +'/css/added/autocomplete.css' });
										$('head').append('<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.custom.css" type="text/css" />');
										//$(this).facebook_tracking({lid: tracking_prefix +'/css/added/jquery-ui-1.8.custom.css' });
										
										var html = '<div id="fb_friends_'+this.substring(1)+'" class="ui-helper-clearfix"><input id="fb_to_'+this.substring(1)+'" type="text" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"><input id="'+options.input_name+'" type="hidden" name="'+options.input_name+'"></div>';
																	
										$this.html(html);
										$this.addClass('friend_autocomplete');
										
										
										var selected = [];
										var suggested = [];
																   
										//attach autocomplete
										$("#fb_to_"+strthis.substring(1)).autocomplete({
											
											//define callback to format results
											source: function(req, add){
													if (req['term'].length > 1){
														var suggestions = [];
														
														if (friends == 0){
															$('body').bind('friends', function(){
																	//create array for response objects
																																			  
																	$.each(friends, function(key, value) {
																		
																		if (value.name.toLowerCase().indexOf(req['term'].toLowerCase()) >= 0) {
																			if (typeof selected[value.uid]  === 'undefined'){
																				
																				suggestions.push(value.name);
																				suggested[value.name] = value.uid;
																				
																			}
																		}
																	});
																	
																	//pass array to callback
																	add(suggestions); 			
															});
														} else {
																	$.each(friends, function(key, value) {
																		
																		if (value.name.toLowerCase().indexOf(req['term'].toLowerCase()) >= 0) {
																			if (typeof selected[value.uid]  === 'undefined'){
																				
																				suggestions.push(value.name);
																				suggested[value.name] = value.uid;
																				
																			}
																		}
																	});
																	
																	//pass array to callback
																	add(suggestions); 
														}
													}	
													
												
											},
											
											//define select handler
											select: function(e, ui) {
												
												//create formatted friend
												var friend = ui.item.value;
												var	friendId = suggested[friend];
												var	span = $("<span>").text(friend).attr({
														rel: friendId
													});
												var	a = $("<a>").addClass("fb_remove").attr({
														href: "javascript:",
														title: "Remove " + friend
													}).text("x").appendTo(span);
													
													selected[friendId] = friend;
													
												//console.log(friendId);
												//add friend to friend div
												span.insertBefore("#fb_to_"+strthis.substring(1));
												$("#"+options.input_name).val(friendId)
												$("#fb_to_"+strthis.substring(1)).css('display','none');
												
											}, 
											
											//define select handler
											change: function() {
												
												//prevent 'to' field being updated and correct position
												$("#fb_to_"+strthis.substring(1)).css("top", 2);
												$("#fb_to_"+strthis.substring(1)).focus();
											}
										});
										
										//add click handler to friends div
										$("#fb_friends_"+strthis.substring(1)).click(function(){
											
											//focus 'to' field
											$("#fb_to_"+strthis.substring(1)).focus();
										});
										$("#fb_to_"+strthis.substring(1)).click(function(){
											
											$("#fb_to_"+strthis.substring(1)).focus();
										});
										
										//add live handler for clicks on remove links
										$(".fb_remove", document.getElementById("fb_friends_"+strthis.substring(1))).live("click", function(){
										
											//remove current friend
											$(this).parent().remove();
											var rel = $(this).parent().attr('rel');
											
											
											delete selected[rel];
											
											$("#fb_to_"+strthis.substring(1)).val("");
											$("#fb_to_"+strthis.substring(1)).focus();
											
											//correct 'to' field position
											if($("#fb_friends_"+strthis.substring(1)+" span").length === 0) {
												$("#fb_to_"+strthis.substring(1)).val("").css('display','block');
												$("#fb_to_"+strthis.substring(1)).css("top", 0);
												
											}				
										});	
										
										return this;
										
										
									  
									},
					//Post to wall --> Publish
					publish : function (options) { 
								
										var defaults = fbdefaults['PublishSettings'];
										
										
										defaults['method'] = 'feed';	
										
										if (mobile){
											defaults['display'] = 'touch';	
										} else {
											defaults['display'] = 'popup';	
										}
										
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
										
													$(this).output_log({log: 'tracking : _trackEvent  /   APP_ID:'+trackoptions['api_key']+'  /   option: '+trackoptions['lid']});
												});
											}
				};
				
				//Facebook connection status / login and permission 
				$.fn.facebook_login = function (options) {
										
												var defaults = {
													access_token_required: '0',
													get_user: '0',
													get_friends: '0',
													perms: '',
													success: function(){}
												}; 
												
											
													
												var loginoptions = $.extend(defaults, options);
												
												this.each(function(){
													
													FB.getLoginStatus(function(response) {
															 if (response.session) {
															 
																if (loginoptions['access_token_required'] === '1' ){
																	 access_token = response.session.access_token;
																	 
																	 $(this).output_log({log: 'access_token ='+response.session.access_token});
																	 $(this).output_log({log: 'user is logged in and granted some permissions.'});
																	 
																 }
																 
																 
																 $(this).output_log({log: 'fbinit done'});
																 $('body').trigger('fbinit');
																 $(this).facebook_tracking({lid: tracking_prefix +'/app_loaded_correctly' });
																 
																 
																 
																 //Get my facebook user id
																 FB.api('/me', function(u) {
																				if(u !== null && typeof(u.name) !== 'undefined') {
																					  
																					  if (loginoptions['get_user'] === '1'){
																						  user = u;
																						  $('body').trigger('user');
																						  
																						  $(this).output_log({log: 'user initiated'});
																					  }
																					  
																					  if (loginoptions['get_friends'] === '1'){
																						  user = u;
																						  var getfriends = FB.Data.query("SELECT name, uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1={0}) ORDER BY name", parseInt(user.id));	
																						  getfriends.wait(function(rows){
																								friends = rows;
																								$('body').trigger('friends');
																								
																								$(this).output_log({log: 'friends list collected'});
																						  });
																						  
																						  
																					  } 
																					  options.success();
																				
																				}
																});
															} else {
																FB.login(function(response) {
																	if (response.session) {
																			
																			if (loginoptions['access_token_required'] === '1' ){
																				 access_token = response.session.access_token;
																			
																				 $(this).output_log({log: 'user is logged in and granted some permissions.'});
																			}
																			
																			if (response.perms) {
																					
																					$(this).output_log({log: 'user is logged in and granted some permissions.'});
																					
																			} else { 
																					$(this).output_log({log: 'user is logged in, but did not grant any permissions'});
																					$(this).facebook_tracking({lid: tracking_prefix +'/app_loaded_correctly/user_did_not_grant_permission' });
																			}
																			
																			$('body').trigger('fbinit');
																			$(this).output_log({log: 'fbinit done'});
																			
																			FB.api('/me', function(u) {
																				if(u !== null &&  typeof(u.name) !== 'undefined') {
																					  
																					  if (loginoptions['get_user'] === '1'){
																						  user = u;
																						  $('body').trigger('user');
																					
																						  $(this).output_log({log: 'user initiated'});
																					  }
																				  
																					  if (loginoptions['get_friends'] === '1'){
																						  user = u;
																						  var getfriends = FB.Data.query("SELECT name, uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1={0}) ORDER BY name", parseInt(user.id));	
																						  getfriends.wait(function(rows){
																								friends = rows;
																								$('body').trigger('friends');
																								
																								$(this).output_log({log: 'friends list collected'});
																						  });
																					  } 
																					  
																					  options.success();
																					
																				}
																			});
																	} else {
																			// user is not logged in
																			if (loginoptions['access_token_required'] === '1' ){
																				// access_token = response.session.access_token;
																				$(this).output_log({log: 'user is not logged in : cant get access token'});
																			}
																	
																			$(this).output_log({log: 'user is not logged in : cant show user and friends'});
																			$(this).output_log({log: 'fbinit done'});
																			$('body').trigger('fbinit');
																			$(this).facebook_tracking({lid: tracking_prefix +'/app_loaded_correctly/user_not_logged' });
																			
																	}
																}, {perms: loginoptions['perms']});
															}
													});
													
													
													
												});
											
				};
				
				
				//Debug mode...  
				$.fn.output_log = function (options) {
											
												var defaults = {
													log: 'LOG'
												}; 
												
												var logoptions = $.extend(defaults, options);
												
												this.each(function(){
												
													if( (window['console'] !== undefined) ){
														console.log('log: '+logoptions['log']);
													}
												});
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
								
							    if (target['selector'] != ''){
									var obj = $(target['selector']+'') ;
									var objs = target['selector']+'';
								} else {
									var obj =  $(target);
									var objs = target;
								}
								
								var obja = arguments;
								
								return obj.bind(arguments[0]['on'], function(e) {
										e.isDefaultPrevented();
										e.preventDefault();
									    handler.apply(objs, obja);
								});
								
								
								
								
								
						} else {
							
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
					friendAutocomplete: fbFactory('friend_autocomplete'),
					publish: fbFactory('publish'),
					share: fbFactory('share'),
					createEvent: fbFactory('create_event'),
					attendEvent: fbFactory('attend_event'),
					like: fbFactory('like'),
					send: fbFactory('send'),
					showWall: fbFactory('show_wall'),
					commentsBox: fbFactory('show_wall')
				});
					
				$.fn.fb = function (  ) {	
					// return the new jQuery instance
					target = this;
					
					var sub = fbQuery(this);
					return sub;
				};
				
					
				//On DOM ready initialize
				$(document).ready(function(){
						
						//page 1 
						$('#fb-root').fb().fbinit({
											 api_key: '<?=$fbconfig['appId' ]?>',
											 FB_lang: 'fr_CA', //en_CA is invalid //en_US is valid
											 perms:'',
											 access_token_required:'0',
											 get_friends:'0',
											 get_user:'0',  // required for create event and acces to user data
											 GA_Account: 'UA-9999999-8',
											 tracking_prefix:'demo',
											 base_url: '<?=$fbconfig['appBaseUrl']?>',
											 auto_resize_tab:'1'
						});
						
						
						
						
						//example: used dynamicly
						$(".publish").each(function (){
							var name = $(this).attr('name'); 
							var id = $(this).attr('id'); 
							
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
						
						
						
						$("#invite_friends").fb().inviteFriends({
											on: "click",
											message: 'Test invite message', 
											data: 'tracking information for the user'				
						});
						
						
					
						$("#allow_mandatory a").click(function(){

							$(this).facebook_login({
								access_token_required: '0',
								get_user: '1',
								get_friends: '1',
								perms: '',
								success: function(){
									// go to page 2
								}
							});
						}); 
						//end page 1 
						
						
						
						//page 2
						/*
						$('#fb-root').fb().fbinit({
											 api_key: '<?=$fbconfig['appId' ]?>',
											 FB_lang: 'fr_CA', //en_CA is invalid //en_US is valid
											 perms:'',
											 access_token_required:'0',
											 get_friends:'1',
											 get_user:'0',  // required for create event and acces to user data
											 GA_Account: 'UA-9999999-8',
											 tracking_prefix:'demo',
											 base_url: '<?=$fbconfig['appBaseUrl']?>',
											 auto_resize_tab:'1'
						});
						
						
						
						$('body').bind('friends', function(){	
													console.log('autocomplete');	  
							if(friends){
								$("#friend_autocomplete_1").fb().friendAutocomplete({
													 input_name: 'friend_autocomplete_1'				
								});
								$("#friend_autocomplete_2").fb().friendAutocomplete({
													 input_name: 'friend_autocomplete_2'				
								});
								$("#friend_autocomplete_3").fb().friendAutocomplete({
													 input_name: 'friend_autocomplete_3'				
								});
							}
						});	
						
						*/
						//end page 2
						
				});
				
			
			})(jQuery)
			
			
	</script>	
    </body>
</html>