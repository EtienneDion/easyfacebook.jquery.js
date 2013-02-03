/*
* EasyFacebook Javascript Tools v0.1
* Copyright (c) 2011 Etienne Dion
*/

(function ($) {
				function login(){
                	// on login
				}
				function logout(){
					// on logout
				}
				
				$.easyfb= {};
				var easyfb_defaults = [];
				var access_token;
				var debug = false;
				var base_url = base_url || document.location.href;
				
				
				easyfb_defaults['InitSettings'] = {
										 api_key: '0',
										 FB_lang: 'en_US',
										 perms:'',
										 get_user:'0',
										 get_friends:'0',
										 set_friends:'{}',
										 get_access_token:'0',
										 set_access_token:'0',
										 GA_Account: 'UA-9999999-9',
										 tracking_prefix:'demo',
										 base_url: '/',
										 auto_resize_tab:'0',
										 debug:false,
										 channelUrl:""
				};
				
				easyfb_defaults['PermRequestSettings'] = {
										 perms: '',
										 callback_url: 'http://www.url.com'
				};
				
				easyfb_defaults['IsFanSettings'] = {
										 page_id: '1234',
										 success: function(){ },
										 fail: function(){ }		
				};
				
				easyfb_defaults['InviteFriendsSettings'] = {
										 message: 'Test invite message', 
										 data: 'tracking information for the user',
										 title: '',
				};
				
				easyfb_defaults['AddFriendSettings'] = {
										id: '1234'
				};
				
				easyfb_defaults['FriendAutocompleteSettings'] = {
										 input_name: 'candidate[fb_friends_friend_autocomplete_1][fullname]',
									     input_facebook_id: 'candidate[fb_friends_friend_autocomplete_1][fcbId]'
				};
				
							
				
				  
				easyfb_defaults['ShareSettings'] = {
										 name: 'Test Name',
										 link: base_url,
										 actions: [
											{ 
											name: 'xyz', 
											link: base_url 
											}
										 ],
										 message: '',
										 caption: '',   //{*actor*} is only available in caption param
										 description:  '',
										 picture: '',
										 media:[],
										 properties: [],
										 user_message_prompt: ''
										 
				};
				
				easyfb_defaults['ActionSettings'] = {
										 app_namespace: 'app_namespace',
										 action: 'action',
										 object: 'object',
										 object_url: 'object_url'
				};
				
				
				var date = new Date(parseInt("2012"), parseInt("7")-1, parseInt("1"), parseInt("8")+3, parseInt("0"),0,0);
				date = Math.round(date.getTime() / 1000);   // default eventdate
				
				easyfb_defaults['CreateEventSettings'] = {
										name:'Event Name',
										location: 'Montreal, QC',
										//city:city,
										description:"Event description",
										//privacy:"CLOSED",
										start_time:date
				};
				easyfb_defaults['AttendEventSettings'] = {
										id:'1234',
				};
				
				easyfb_defaults['LikeSettings'] = {
										 url: 'http://www.like.com',
										 send: '0',
										 width:'90',  // also used to hide numbers of like, element css need to be adjust by language = overflow:hidden width=xx px
										 show_faces:'0', //or 0
										 action:'like', // or recommend
										 send:'0', //or false
										 layout:'button_count', // or box_count or button_count or standard
										 colorscheme:'light', // or light
										 font:'arial',  // or lucida grande or segoe ui or tahoma or trebuchet ms or verdana
										 ref:''
				};
				
				easyfb_defaults['SendSettings'] = {
										 url: 'http://www.send.com',
										 width:'150',
										 colorscheme:'dark', // or light
										 font:'arial',  // or lucida grande or segoe ui or tahoma or trebuchet ms or verdana
										 ref:''
				};
						
				easyfb_defaults['ShowWallSettings'] = {
										 nb: 10,
										 feed: null,
										 loading_message: "Chargement du mur ...",
										 timeout:'25000'
				};
									
			  
			  	var methods = {
					//test : function () { alert('test'); },
						fbinit : function ( options ) {  
										
										
										var defaults = easyfb_defaults['InitSettings'];
										options = $.extend(defaults, options);
										
										base_url = options.base_url;
										api_key = options.api_key;
										debug = options.debug;
										
										
										// Load the SDK Asynchronously
									    (function(d){
										   var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
										   js = d.createElement('script'); js.id = id; js.async = true;
										   js.src = "//connect.facebook.net/en_US/all.js";
										   d.getElementsByTagName('head')[0].appendChild(js);
									     }(document));
									  
										  
										
										if(/iPhone|iPod|Android|opera mini|blackberry|palm os|palm|hiptop|avantgo|plucker|xiino|blazer|elaine|iris|3g_t|windows ce|opera mobi|windows ce; smartphone;|windows ce; iemobile/i.test(navigator.userAgent)){
											mobile = 1;
											$(this).facebook_tracking({lid: 'mobile_broswer'});
											$(this).output_log({log: 'mobile_broswer'});
										} else {
											$(this).facebook_tracking({lid: 'normal_broswer'});
											$(this).output_log({log: 'normal_broswer'});
										}
										
					  
										if (!(options.GA_Account === 'UA-9999999-9' || options.GA_Account === '0')){
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
										
										var channelUrl = "";
										if(options.channelUrl !== ""){
											channelUrl = options.base_url+"channel.html";
										}	
										
										if(api_key !== '0'){
										
											//FACEBOOK INIT
											window.fbAsyncInit = function() {
																		
															FB.init({
																appId: api_key, 
																status: true, 
																cookie: true, 
																xfbml: true,
																oauth:true,
																channelUrl:channelUrl
															});
															
															
															$(this).output_log({log: 'facebook initiated'});
															
															
															// All the events registered 
															FB.Event.subscribe('auth.login', function(response) {
																// do something with response
																$(this).output_log({log: 'user logged in'});
																//window.location.reload();
																
																//login();
															});
															
															FB.Event.subscribe('auth.logout', function(response) {
																// do something with response
																
																$(this).output_log({log: 'user logged out'});
																//logout();
															});
															
															//FB.Canvas.setSize({ width: width, height: height }); 
															
															if (options.auto_resize_tab === '1' || options.auto_resize_tab === true){
																FB.Canvas.setAutoGrow();
															}
															
															
															
															// this will fire when any of the like widgets are "liked" by the user
															FB.Event.subscribe('edge.create', function(href, widget) {
																$(this).facebook_tracking({lid: tracking_prefix +'/has_been_liked/'+href});
																
															});
															FB.Event.subscribe('edge.remove', function(href, widget) {
																$(this).facebook_tracking({lid: tracking_prefix +'/has_been_unliked/'+href});
																
															});
											
															FB.Event.subscribe('message.send', function(href, widget) {
																$(this).facebook_tracking({lid: tracking_prefix +'/message_has_been_sended/'+href});
																
															});
															
															
															if (options.set_access_token !== '0' ){
																access_token = options.set_access_token;		 
															} 
														    
															
															
															FB.getLoginStatus(function(response) {
																 if (response.authResponse) {
																	$(this).facebook_login({
																		get_access_token: '0',
																		set_access_token: response.authResponse.accessToken,
																		get_user: '1',
																		get_friends: '1',
																		perms: options.perms,
																		success: options.success
																	});
																 } else {
																	 
																	 $(this).facebook_login({
																		get_access_token: options.get_access_token,
																		set_access_token: options.set_access_token,
																		get_user: options.get_user,
																		get_friends: options.get_friends,
																		perms: options.perms,
																		success: options.success
																	});
																 }
															});
																   
																   
												};
										}
																		   
										  
									},
					login : function (options) { 
				
									  	$(this).facebook_login(options);
                                           
										return this;
										
										
									},
									
					is_fan : function (options) { 
				
									  	var defaults = easyfb_defaults['IsFanSettings'];
                                        defaults['method'] = 'pages.isFan';	
										
										options = $.extend(defaults, options);
										
										FB.api({
											method: options.method,
											page_id: options.page_id,
										},  function(response) {
											
												if(response){
													options.success();
													$(this).facebook_tracking({lid: tracking_prefix +'/user_like_page/' });
												} else {
													options.fail();
													$(this).facebook_tracking({lid: tracking_prefix +'/user_dont_like_page/' });
												}
												
												
											}
										);
										
										
										
										return this;
										
										
									},
					
					
					//App Invitation request --> Notification
					invite_friends : function (options) { 
										
										var defaults = easyfb_defaults['InviteFriendsSettings'];
										
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
												
					//Add friends					
					add_friend : function (options) { 
				
										var defaults = easyfb_defaults['AddFriendSettings'];
										
										defaults['method'] = 'friends.add';		
										
										options = $.extend(defaults, options);
																	   
											FB.ui(options, 
													function(response) { 
															 $(this).facebook_tracking({lid: tracking_prefix +'/add_friend/'+response });
													}
											);
										
										
										return this;
										
										
									  
									},
									
					//Autocomplete			
					/* REQUIRED : <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.js">< /script> 
                        AND   <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>  */
					friend_autocomplete : function (options) { 
										
										
										var defaults = easyfb_defaults['FriendAutocompleteSettings'];
										
										var $this = $(this+'');
										var strthis = this+'';
										options = $.extend(defaults, options);
										
								
										//$('head').append('<link rel="stylesheet" href="'+base_url+'css/autocomplete.css" type="text/css" />');
										//$(this).facebook_tracking({lid: tracking_prefix +'/css/added/autocomplete.css' });
										//$('head').append('<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.custom.css" type="text/css" />');
										//$(this).facebook_tracking({lid: tracking_prefix +'/css/added/jquery-ui-1.8.custom.css' });
										
										var html = '<div id="fb_friends_'+this.substring(1)+'" class="ui-helper-clearfix"><input id="fb_to_'+this.substring(1)+'" type="text" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"><input id="'+options.input_name+'" type="hidden" name="'+options.input_name+'" value="" data="'+strthis.substring(1)+'"><input id="'+options.input_facebook_id+'" type="hidden" name="'+options.input_facebook_id+'" value="" data="'+strthis.substring(1)+'_fbid"></div>';
																	
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
																			if (typeof selected[value.id] === 'undefined'){
																				
																				suggestions.push(value.name);
																				suggested[value.name] = value.id;
																				
																			}
																		}
																	});
																	
																	//pass array to callback
																	add(suggestions); 			
															});
														} else {
																	$.each(friends, function(key, value) {
																		
																		if (value.name.toLowerCase().indexOf(req['term'].toLowerCase()) >= 0) {
																			if (typeof selected[value.id] === 'undefined'){
																				
																				suggestions.push(value.name);
																				suggested[value.name] = value.id;
																				
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
												
												
															 
												//add friend to friend div
												span.insertBefore("#fb_to_"+strthis.substring(1));
												$("input[data='"+strthis.substring(1)+"']").val(friend);
												$("input[data='"+strthis.substring(1)+"']").attr('rel', friendId);
												$("input[data='"+strthis.substring(1)+"_fbid']").val(friendId);
												
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
											
											
											
											$("input[data='"+strthis.substring(1)+"']").val("");
											$("input[data='"+strthis.substring(1)+"_fbid']").val("");
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
					
				
					//Post to wall --> Feed
					share : function (options) { 
				
										  var defaults = easyfb_defaults['ShareSettings'];
										  
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
														 $(this).facebook_tracking({lid: tracking_prefix +'/share/success/'+response.post_id });
													 } else {
														 $(this).facebook_tracking({lid: tracking_prefix +'/share/error' });
													 }
												  }
											  );
										 
										return this;
										
										
										  
									},
					//Post to wall --> Feed
					action : function (options) { 
				
										  var defaults = easyfb_defaults['ActionSettings'];
										  
										  options = $.extend(defaults, options);
										  
										  FB.api('/me/'+options.app_namespace+':' + options.action +'?'+options.object+'='+options.object_url ,'post',
													function(response) {
												if (!response || response.error) {
													$(this).facebook_tracking({lid: tracking_prefix +'/action/error' });
												} else {
													$(this).facebook_tracking({lid: tracking_prefix +'/action/success/'+response.id });		
												}
										  });
											  
										 
										return this;
										
										
										  
									},
					//Createevent --> Feed
					create_event : function (options) { 
				
										  var defaults = easyfb_defaults['CreateEventSettings'];
										  	
										  
										  
										  options = $.extend(defaults, options);
										  
										  
											 
										 	  FB.api('/me/events','post',options,function(resp) {
											  
												   $(this).facebook_tracking({lid: tracking_prefix +'/event/'+resp.id+'/created' });
												   
												   
												   FB.api('/'+resp.id+'/attending', 'post', function(resp) {
											  	  	  $(this).facebook_tracking({lid: tracking_prefix +'/event/'+resp.id+'/attended' });
													  //TO-DO : open in popup window
													  //window.location = "http://www.facebook.com/event.php?eid="+options.id;
												   });
												   
											  }); 
											  
											  
										return this;
										
										
										  
									},
									
					attend_event : function (options) { 
				
										  var defaults = easyfb_defaults['AttendEventSettings'];
										  	
										 
										  options = $.extend(defaults, options);
										  
										      
											
											  FB.api('/'+options.id+'/attending', 'post', function(resp) {
											  	  $(this).facebook_tracking({lid: tracking_prefix +'/event/'+resp.id+'/attended' });
												  //TO-DO : open in popup window
												  //window.location = "http://www.facebook.com/event.php?eid="+options.id;
											  });
											  
											  
										return this;
										
										
										  
									},
									
					like : function (options) { 
				
										  var defaults = easyfb_defaults['LikeSettings'];
										  	
										  options = $.extend(defaults, options);
										  
										  var $this = $(this+'');
										  
										  
										  $this.append("<fb:like href='"+options.url+"' send='"+options.send+"' layout='"+options.layout+"' width='"+options.width+"' show_faces='"+options.show_faces+"' action='"+options.action+"' colorscheme='"+options.colorscheme+"' ref='"+options.ref+"' font='"+options.font+"' style='overflow:visible;width:"+options.width+"px'></fb:like>"); 
										  
										  
                                           
										return this;
										
										
									},
					
					send : function (options) { 
				
										  var defaults = easyfb_defaults['SendSettings'];
										  	
										  options = $.extend(defaults, options);
										  
										  var $this = $(this+'');
										  
										  
										  $this.append("<fb:send href='"+options.url+"' ref='"+options.ref+"' font='"+options.font+"' colorscheme='"+options.colorscheme+"' width='"+options.width+"'  style='overflow:visible;width:"+options.width+"px'></fb:send>"); 
										  
                                          
                                          
										return this;
										
										
										  
									}, 
									
					//REQUIRED get_access_token:'1' in $('#fb-root').easyfb().fbinit({ ... });
					//GET FACEBOOK WALL FEEDS --> Facebook API GRAPH WITH JAVASCRIPT
					show_wall : function (options) { 
											var defaults = easyfb_defaults['ShowWallSettings'];
											
											options = $.extend(defaults, options);
											var thiss = this;
											var $this = $(this+'');
											$this.attr('feed', options.feed);
											$this.attr('nb', options.nb);
											$this.attr('loading_message', options.loading_message);
											$this.attr('timeout',options.timeout);
											
											
													
													
													$this.addClass("facebook_feed");
													
													$this.append("<div class='loader'>"+options.loading_message+"</div>");
													
													if(options.feed != null){
														var jonction = '?';
														var comment_url = 0;
														if (options.feed.indexOf("?") >=0){ 
															jonction = '&';
														} 
														if (options.feed.indexOf("ids") >=0){
															comment_url = 1;
															
															var vars = [], hash;
															var hashes = options.feed.slice(options.feed.indexOf('?') + 1).split('&');
															
															hash = hashes[0].replace('ids=','');
															
														} 
														
														var getUpdate = function() { 
															var opt = [];
															if(typeof($this.attr('feed')) != 'undefined'){
																opt.feed = $this.attr('feed');
																opt.nb = $this.attr('nb');
																opt.loading_message = $this.attr('loading_message');
																opt.timeout = $this.attr('timeout');
															} 
															
															$.ajax({
																url: opt.feed+"/"+jonction+"limit="+opt.nb+'&access_token='+access_token,
																dataType: "jsonp",
																success: function(feed)
																{
																	var html = "<ul>";
																	var data = [];
																	
																	if (comment_url){
																		var html = "<ul><li style='display:none' class='easyfb_user_input'><input class='comment' type='text' value='Écrire un commentaire...' rel="+hash+" onblur='if(this.value == \"\") { this.value = \"Écrire un commentaire...\"}' onclick='if(this.value == \"Écrire un commentaire...\") { this.value = \"\"}'/><a href='#' class='publier'>Publier</a></li>";
																		$(feed[hash]).each(function(i, dataf){
																		
																				$(dataf).each(function(z, datao){
																					
																					$(datao).each(function(y, datax){
																					
																						for (var d = 0;d<=datax.data.length;d++){
																							$(datax.data[d]).each(function(z, dataz){
																								
																									data.push(dataz);
																								
																							});
																						}
																					});
																				});
																			
																		});
																	} else {
																		data = feed.data;
																	}
																	$(data).each(function(i, elt){
																		
																		if(elt.from){
																		
																			className = (i%2 == 0)?"odd":"even";
																			borderClass = (i==0)?" first":(i==(opt.nb-1))?" last":"";
																			
																			date = elt.created_time.substr(0,10).split("-");
																			date = date[2]+"/"+date[1]+"/"+date[0];
																			
																			var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/i;
																			
																			html += "<li class='"+className+borderClass+"'>";
																			msg = elt.message.replace(exp,"<a href='$1'>$1</a>"); 
																			var name = "";
																			if(elt.name){
																			
																				if(elt.link){
																					 name = "<span class='fb_title'><a href="+elt.link+">"+elt.name+"</a></span>";
																				} else {
																					name = "<span>"+elt.name+"</span>";
																				}
																			}
																			var properties = "";
																			if(elt.properties){
																				 properties += "<ul>";
																				 $.each(elt.properties, function(y, eltc){
																				 
																					if(eltc.name){
																						properties += "<span>"+eltc.name+" : ";
																						properties += "<a href="+eltc.href+">"+eltc.text+"</a></span>";
																					}
																				 });
																				 properties += "</ul>";
																			}
																			var app ="";
																			if(elt.application){
																				app = " - <span>Created via "+ elt.application.name +"</span>";
																			}
																			var picture = "";
																			var imgclass="";
																			if(elt.picture){
																				imgclass="img";
																				picture += "<span class='img'><a href='"+elt.link+"'><img src='"+elt.picture+"' alt='"+elt.message+"' class='img'/></a>"
																				 + "<span class='date'><img src='"+elt.icon+"' alt='"+elt.type+"' title='"+elt.type+"' /> <small>"+date+"</small></span></span>";
																			}
																			var comments = "";
																			if(elt.comments){
																				 comments = "<div class='comments'><ul>";
																				 $.each(elt.comments, function(y, eltc){
																					$.each(eltc, function(y, eltb){
																						var clikes = "";
																						if (eltb.likes){
																							clikes = " - <span class='count'>"+eltb.likes+" personnes</span>";
																						}
																						var cd=new Date(eltb.created_time);
																						cdate = eltb.created_time.substr(0,10).split("-");
																						cdate = date[2]+"/"+date[1]+"/"+date[0];
																						comments += "<li><a href='http://www.facebook.com/profile.php?id='"+eltb.from.id+"' style='background:transparent url(http://graph.facebook.com/"+eltb.from.id+"/picture?type=small) no-repeat 0 0;' class='fb_comment_username'>"+eltb.from.name+"</a><p>"+eltb.message+"</p><span class='time'>"+cdate+"</span> - <a href='#' style='display:none' class='easyfb_user_input' class='like_comment easyfb_user_input' rel="+eltb.id+">J'aime</a><span style='display:none' class='easyfb_user_input'>"+clikes+"</span></li>";
																					});
																					
																				 });
																				 comments += "</ul></p></div>";
																			}
																			var likes = "";
																			
																			
																			var input = '';
																			
																			if (comment_url){
																				
																				if (elt.likes){
																					likes = " - <span class='count'>"+elt.likes+" personnes</span>";
																				}
																				
																			} else {
																			
																				var input = "<div style='display:none' class='easyfb_user_input'><input class='comment' type='text' value='Écrire un commentaire...' rel="+elt.id+" onblur='if(this.value == \"\") { this.value = \"Écrire un commentaire...\"}' onclick='if(this.value == \"Écrire un commentaire...\") { this.value = \"\"}'/><a href='#' class='publier'>Publier</a></div>";
																				if (elt.likes){
																					likes = " - <span class='count'>"+elt.likes.count+" personnes</span>";
																				}
																			}
																			
																			html += "<div class='txt'>"
																				 + "<a href='http://www.facebook.com/profile.php?id="+elt.from.id+"' class='fb_username' style='background:transparent url(http://graph.facebook.com/"+elt.from.id+"/picture) no-repeat 0 0;'>"+elt.from.name+"</a>"
																				 + "<p class='fb_message "+imgclass+"' >" +picture +"<span class='msg'>"+name+""+msg+"</span>"+properties+"</p>"
																				 + "</div>"  
																				 + "<div class='comment_box'><span>"+date+"</span>"+ app +" - <a href='#' class='like_comment easyfb_user_input' rel="+elt.id+" style='display:none' >J'aime</a><span style='display:none' class='easyfb_user_input'>"+likes +"</span>"+ comments + input +"</div>" //TODO fix Comment input
																				 + "</li>";
																				 
																		}
																	})
																	
																	
																	
																	
																	
																	html += "</ul>";
																	
																	$this.html(html);
																	//FB.XFBML.parse(this);
																	$this.find(".loader").remove();
																	
																	$('.like_comment').bind('click',function(e){
																		e.preventDefault();
																		var rel = $(this).attr('rel');
																		
																		$(this).facebook_login({
																				get_access_token: '0',
																				get_user: '1',
																				get_friends: '0',
																				perms: 'publish_stream'
																		});
																			
																			
																		FB.api("/"+rel+"/likes", 'post',function(response) {
																			if(response === true) {
																				
																				$(this).output_log({log: 'like on wall ' +rel });
																				$('body').trigger('update_wall');
																			} else {
																				$(this).output_log({log: 'like error on wall '+rel });
																			}
																		});
		
																	});
																	
																	$('.comment').bind('keypress', function(e) {
																											
																			$(this).facebook_login({
																				get_access_token: '0',
																				get_user: '1',
																				get_friends: '0',
																				perms: 'publish_stream'
																			});
																			
																			
																			if(e.keyCode==13){
																					var rel = $(this).attr('rel');
																					var ref = rel;
																					var params = {};
																					var msg = $(this).val();
																					params['message'] = msg;
																					
																					var path = '/comments';
																					if (comment_url){
																						path ='comments/';
																						params['ids'] = rel ;
																						rel ='';
																						params['path'] = "comments";
																						
																						var post = ' "'+params['message']+'" à propos de '+ params['ids'];
																						FB.api({
																							method: 'status.set',
																							status: post
																					    },  
																						function(response) {
																							 if (response && response.post_id) {
																								 $(this).facebook_tracking({lid: tracking_prefix +'/comments_on_wall/success/'+response.post_id });
																							 } else {
																								 $(this).facebook_tracking({lid: tracking_prefix +'/comments_on_wall/error' });
																							 }
																						  }
																					    );
																						  
																						  
																					}
																					FB.api("/"+rel+path, 'post',params,function(response) {
																						 if (!response || response.error) { 
																							
																							$(this).output_log({log: 'comment error on wall '+ref + '  /  '+response.error.type + '  /  '+ response.error.message });
																							$(this).facebook_tracking({lid: tracking_prefix +'/comments/error/  / '+ref  });
																						 } else {
																							
																							$(this).output_log({log: 'comment on wall  '+ref });
																							 $(this).facebook_tracking({lid: tracking_prefix +'/comments/succes/ '+ref+' / ' +response.post_id });
																							$('body').trigger('update_wall');
																						 }
																					});	
																			}
																	});	
																	$('body').bind('user', function(){
																		$(".easyfb_user_input").show();							
																	
																	});
																	
																	$(this).output_log({log: '/show_wall/loaded/   '+opt.feed });
																	
																}
															});
															
															
															if (options.timeout != '0'){
																//var t = setTimeout(getUpdate,opt.timeout);
															}
															
															
														};
														
														$('body').bind('update_wall',  function(){
															getUpdate();
														});
														
														$('body').trigger('update_wall');
														
														
													} else {
														
															
												
														$this.html("flux introuvable.");
														$(this).facebook_tracking({lid: tracking_prefix +'/show_wall/error' });
														$(this).output_log({log: '/show_wall/not_loaded/'+options.feed });
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
										
													$(this).output_log({log: 'tracking : _trackEvent  /   APP_ID:'+trackoptions['api_key']+'  /   option: '+trackoptions['lid']});
												});
											}
				};
				
				$.fn.facebook_user_data = function (options) {
						
						var defaults = {
										get_user: '0',
										get_friends: '0',
										success: function(){ }
						}; 
						
						var facebook_user_data_options = $.extend(defaults, options);	
						
						if (facebook_user_data_options['get_friends'] === '1' || facebook_user_data_options['get_friends'] === true || facebook_user_data_options['get_user'] === '1' || facebook_user_data_options['get_user'] === true){
							FB.api('/me', function(u) {
								if(u !== null &&  typeof(u.name) !== 'undefined') {
								  
									  if (facebook_user_data_options['get_user'] === '1' || facebook_user_data_options['get_user'] === true){
										  user = u;
										  $('body').trigger('user');
									
										  $(this).output_log({log: 'user initiated'});
									  }
								  
									  if (facebook_user_data_options['get_friends'] === '1' || facebook_user_data_options['get_friends'] === true){
										  
										 
										 FB.api('/me/friends', function(result) {
										 		friends = result.data;
												
												$('body').trigger('friends');
												$(this).output_log({log: 'friends list collected'});
												
										 });
									  } 
									  
									  $(this).facebook_tracking({lid: tracking_prefix +'/permission_allowed' });
									  
									  
									  facebook_user_data_options.success();
									  
								
								}
							 });
						 }
				};
				
				
				
				//Facebook connection status / login and permission 
				$.fn.facebook_login = function (options) {
										
												var defaults = {
													get_access_token: '0',
													set_access_token: '0',
													get_user: '0',
													get_friends: '0',
													perms: '',
													success: function(){ }
												}; 
												
												var loginoptions = $.extend(defaults, options);
												
												var get_access_token = function(response){
													
													if (loginoptions['get_access_token'] === '1' || loginoptions['get_access_token'] === true || loginoptions['set_access_token'] === false || loginoptions['set_access_token'] === '0'){
																	 access_token = response.authResponse.accessToken;
																	 
																	 //$(this).output_log({log: 'access_token ='+response.authResponse.accessToken});
																	 $(this).output_log({log: 'user is logged in and granted some permissions.'});
																	 
																	 $(this).output_log({log: 'access_token obtained'});
																	 $('body').trigger('access_token');
													}
													
												}
													
												
												
												
													if (loginoptions['get_friends'] === '1' || loginoptions['get_friends'] === true || loginoptions['get_user'] === '1' || loginoptions['get_user'] === true || loginoptions['get_access_token'] === '1' || loginoptions['get_access_token'] === true || loginoptions['perms'] !== '' || loginoptions['set_access_token'] !== '0'){
														FB.getLoginStatus(function(response) {
																 if (response.authResponse) {
																 
																	if (loginoptions['set_access_token'] !== '0'){  
																		access_token = loginoptions['set_access_token'];
																		
																		$(this).output_log({log: 'access_token set'});
																	    $('body').trigger('access_token');
																		
																	} else{
																		get_access_token(response);
																		
																	}
																	 
																	 
																	 $(this).output_log({log: 'fbinit done'});
																	 $('body').trigger('fbinit');
																	 
																	 
																	 
																	 $(this).facebook_user_data({
																						get_user: loginoptions['get_user'],
																						get_friends: loginoptions['get_friends'],
																						success: loginoptions.success()
																	 });
																	 
																	 
																	 
																   
																} else {
																	FB.login(function(response) {
																		if (response.authResponse) {
																				
																				if (loginoptions['set_access_token'] !== '0'){  
																					access_token = loginoptions['set_access_token'];
																					
																					$(this).output_log({log: 'access_token set'});
																	    			$('body').trigger('access_token');
																		
																				} else{
																					get_access_token(response);
																					
																				}
																				
																				
																						
																				$(this).facebook_user_data({
																									get_user: loginoptions['get_user'],
																									get_friends: loginoptions['get_friends'],
																									success: loginoptions.success()
																				 });
																					
																				
																				$('body').trigger('fbinit');
																				$(this).output_log({log: 'fbinit done'});
																				
																				
																		} else {
																				// user is not logged in
																				if (loginoptions['get_access_token'] === '1' ){
																					// access_token = response.session.access_token;
																					$(this).output_log({log: 'user is not logged in : cant get access token'});
																				}
																		
																				
																				$(this).output_log({log: 'fbinit done'});
																				$('body').trigger('fbinit');
																				$(this).facebook_tracking({lid: tracking_prefix +'/app_loaded_correctly/user_not_logged' });
																				
																		}
																	}, {scope: loginoptions['perms']});
																}
														});
													} else {
														
																$(this).output_log({log: 'fbinit done'});
																$('body').trigger('fbinit');
													}
													
													
												
											
				};
				
				
				//Debug mode...  
				$.fn.output_log = function (options) {
											
												var defaults = {
													log: 'LOG'
												}; 
												
												var logoptions = $.extend(defaults, options);
												
												this.each(function(){
												
													if( (window['console'] !== undefined) && ( debug === '1' || debug === true ) ){
														console.log('easyfb: '+logoptions['log']);
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
					login: fbFactory('login'),
					isFan: fbFactory('is_fan'),
					inviteFriends: fbFactory('invite_friends'),
					addFriend: fbFactory('add_friend'),
					friendAutoComplete: fbFactory('friend_autocomplete'),
					share: fbFactory('share'),
					action: fbFactory('action'),
					createEvent: fbFactory('create_event'),
					attendEvent: fbFactory('attend_event'),
					like: fbFactory('like'),
					send: fbFactory('send'),
					showWall: fbFactory('show_wall'),
					commentsBox: fbFactory('show_wall')
				});
					
				$.fn.easyfb = function (  ) {	
					// return the new jQuery instance
					target = this;
					
					var sub = fbQuery(this);
					return sub;
				};
				
})(jQuery)
		