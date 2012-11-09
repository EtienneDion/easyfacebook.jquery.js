				//Post to wall
				$.fn.facebook_feed = function(options) {
			
					  var defaults = {
					  message: 'Test Message',
					  display: 'popup',
					  name: 'Test Name',
					  caption: '{*actor*} Test Caption',   //{*actor*} is only available in caption param
					  description:  'Test desc',
					  link: shareurl,
					  picture: 'http://www.lorealparis.ca/img/l10n/common/logoPrint.gif',
					  actions: [
						{ 
						name: 'fbrell', 
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
				
				
				
				
			/* TO DO
			//Post To wall (Possible target_id to post to friends wall)
			function publish(name,url,pic,message,desc){
				var publish = {
					 method: 'stream.publish',
					 display: 'popup',
					 name: name,
					 link: url,
					 picture: pic,
					 caption: '{*actor*} '+message,  //{*actor*} is only available in caption param
					 description: desc,
					 media:[{
					 type: 'image',
					 src: pic,
					 href: url}]
				
				};
	
				FB.ui(publish,
					  function(response) {
						 if (response && response.post_id) {
							 //bravo
						} else {
							 //error
						}
					  }
				 );	
			 }	
			*/
			 