<?php

    include_once "configs.php";
    
	$object = $_GET["object"];
if ( isset( $_REQUEST['login'] ) || isset( $_REQUEST['state'] ) ){
	$app_id = $fbconfig['appId'];
    $app_secret = $fbconfig['secret'];
    $my_url = $fbconfig['baseUrl'];

    session_start();
    $code = $_REQUEST["code"];
	
    if(empty($code)) {
      $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
      $dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" 
       . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
       . $_SESSION['state'];

      echo("<script> top.location.href='" . $dialog_url . "'</script>");
    }

    if($_REQUEST['state'] == $_SESSION['state']) {
      $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
       . "&client_secret=" . $app_secret . "&code=" . $code;
	
		
		
      $response = @file_get_contents($token_url);
      $params = null;
      parse_str($response, $params);
	  $fbconfig['token'] = $params['access_token']; 
     
    }
    else {
	   $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
       $dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" 
       . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
       . $_SESSION['state'];

      echo("<script> top.location.href='" . $dialog_url . "'</script>");
	  
      echo("The state does not match. You may be a victim of CSRF.");
    }
}
  
 
?><!DOCTYPE HTML>
<html xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Easy Facebook Javascript Tools</title>
<?php if(isset($_GET["object"])){ ?>
        <meta property="fb:app_id" content="<?= $fbconfig['appId' ] ?>" /> 
        <meta property="og:type" content="fbtutoriel:<?= $object ?>" /> 
        <meta property="og:title" content="<?= $object ?>" /> 
        <meta property="og:image" content="http://etiennedion.com/easyfacebook/images/<?= $object ?>.jpg" />
        <meta property="og:description" content="Achievement : <?= $object ?>" /> 
        <meta property="og:url" content="http://etiennedion.com/easyfacebook/action.php?object=<?= $object ?>">
<?php } else { ?>
		<!-- META TAG EXAMPLE FOR SHARE AND LIKE ON AN EXTERNAL WEBSITE -->
        <meta property="og:title" content="Easy Facebook Javascript Tools for developers" />
        <meta property="fb:app_id" content="<?= $fbconfig['appId' ] ?>" /> 
        <meta property="og:type" content="fbtutoriel:jsdevtool" /> 
        <meta property="og:url" content="http://etiennedion.com/easyfacebook/index.php" />
        <meta property="og:image" content="http://etiennedion.com/easyfacebook/images/easy.jpg" />
        <meta property="og:site_name" content="Easy Facebook Javascript Tools" />
        <meta property="og:description" content="Facebook Javascript Tools for developers" /> 
        <meta property="fb:admins" content="706847059" />
<?php } ?>    
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.js"></script>
		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />  
        <link href="css/easyfacebook.jquery.css" rel="stylesheet" type="text/css"/>
        <link href="css/autocomplete.css" rel="stylesheet" type="text/css"/>
		<script src="js/easyfacebook.jquery.js" type="text/javascript"></script>
        <script src="js/jquery.jcarousel.min.js" type="text/javascript"></script>
		<link href="css/jcarrousel.skin.css" rel="stylesheet" type="text/css"/>
   	
    </head>
	<body>
    <div id="fb-root"></div>
        

 
    <h3>Easy Facebook Javascript Tools</h3>
   
    
    
    <h2>Javascript API</h2>
    
 	// TODO :  
    // Check-in tool
    
    
    <h3>User</h3>
    <br />
   
    <div id="perms_request_box"><a href="#" class="login_request">Login request + perms(if not grant yet)</a></div><br /><br />
    <p>You <span id="likeornot">don't like</span> this page.</p><br />
    <div id="page-info"></div>
    <img src="images/placeholder.jpg" id="image" /><br />
    <span id="name">Permission request not grant yet or not activated in init</span>
    <h3>Friends</h3>
    <a href="#" class="add_friend" rel="100002059856516"><fb:profile-pic uid="100002059856516" size="thumb"></fb:profile-pic><fb:name uid="100002059856516"></fb:name> - Add to friend</a>
     
    <div id="friends" class="box"><a href="#" class="login_request">Permission request not grant yet or not activated in init</a><br /><br /></div>
    <h3>Friends Autocomplete</h3>
    <div id="friend_autocomplete_1" class="friend_autocomplete"></div>
    <div id="friend_autocomplete_2" class="friend_autocomplete"></div>
    <div id="friend_autocomplete_3" class="friend_autocomplete"></div>
    <br/>
    
    <h3>Photo Album</h3>
    <ul id="gallery" class="jcarousel-skin-tango">
   
	</ul>


    <h3>Dialogs</h3>

    <a href="#" id="invite_friends">App Invite</a>
    <br /><a href="#" id="feed">Feed</a>
    <br /><a href="#" class="publish" id="1" name="Christian">Publish 1</a> <a href="#" class="publish" id="2" name="Josee">Publish 2</a> <a href="#" class="publish" id="3" name="Serge">Publish 3</a>
    <?php /* <br /><a href="#" id="dialog">Dialog</a> // TODO : Create an function generating FB.ui with full control on param and callback<br /> */ ?>
    
    <h3>Actions</h3>
    
    <a href="#" id="star">Own a star</a><br />
    <a href="#" id="badge">Own a badge</a><br /><br />
    
    <h3>Events</h3>
    
    <a href="#" id="create_event">Create Event</a><br />
    <a href="#" class="attend_event" rel="241093349251067">Attend Event</a><br />
    
    <h3>Like</h3>
    
    <div id="like"></div><br />
    <div id="like2"></div><br />
    <div id="like3"></div>
    <h3>Send</h3>
    
    <div class="send"></div><br />
    
    <h2>Wall of post from page</h2>
    <div class="box" style="height:600px;"><div id="wall"><a href="#" class="perms_request">Permission request (if not grant yet)</a><br /><br /></div></div>
    <h2>Comment box from url</h2>
    <div class="box" style="height:600px;"><div id="comment_box"><a href="#" class="perms_request">Permission request (if not grant yet)</a><br /><br /></div></div>
    <p id="userName"></p>
   <?php /*
   
   
	<h2>XFBML</h2>
    
	<p>
        <fb:login-button scope="email,user_birthday,user_location,status_update,offline_access,user_checkins,publish_stream,friends_checkins" autologoutlink="1"></fb:login-button>
    </p>
    
	
    
    <h3>Add to timeline</h3>
    <fb:add-to-timeline></fb:add-to-timeline>
    <br /><br />
    <fb:activity actions="fbtutoriel:star"></fb:activity> 
    <br /><br />
    <fb:activity site="etiennedion.com" app_id="<?= $fbconfig['appId' ] ?>"></fb:activity> 
    <br /><br />
    <fb:facepile href="http://etiennedion.com" action="fbtutoriel:jsdevtool" width="200" max_rows="1"></fb:facepile>


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
            fields="[{'name':'name'}, {'name':'email'},{'name':'birthday'},{'name':'location'},{'name':'gender'},
            {'name':'favorite_car','description':'What is your favorite car?',
            'type':'text'}]" redirect-uri="<?= $fbconfig['appBaseUrl'] ?>"  fb_only="true" client_id="<?= $fbconfig['appId' ] ?>"></fb:registration>
        <br /><br />
        
        
        <h3>Live Stream</h3>
		<fb:live-stream event_app_id="<?= $fbconfig['appId' ] ?>" width="400" height="500" xid="1" always_post_to_friends="false"></fb:live-stream><br /><br />
        <h3>Recents activity - Based on url : lorealparis.ca</h3>
        <fb:activity site="lorealparis.ca" width="300" height="300" header="true" recommendations="true"></fb:activity>
        <br /><br />
        <h3>Comments - Based on url : example.com</h3>
        <div class="box">
            <!-- XFBML Example -->
            
            <fb:comments href="example.com" num_posts="2" width="330"></fb:comments>
            <!--  Modération: http://developers.facebook.com/tools/comments. 
            For example, the comments on this URL can be accessed via: https://graph.facebook.com/comments/?ids=http://developers.facebook.com/docs/reference/plugins/comments.
            -->
    	</div>
        
        
    </div>
    */ ?>
    
	<script type="text/javascript">
		
			//PHP var to JS
			
			
			var uid = '<?= $fqlId ?>';
			var mobile = 0;
			var api_key = '0';
			var base_url = "<?= $fbconfig['baseUrl'] ?>";
			var GA_Account = 0;
			var tracking_prefix ='undefined';
			var like = false;
			var user;
			var friends=0;
			
				
			
			
			(function($){
			
				//On DOM ready initialize
				$(document).ready(function(){
						
						
						//enlever $('#fb-root'). ajouter '#fb-root' automatiquement
						$('#fb-root').easyfb().fbinit({
											 api_key: '<?=$fbconfig['appId' ]?>', // required
											 FB_lang: 'fr_CA', // required //en_CA is invalid //en_US is valid
											 perms:'', 
											 get_access_token:'0',  // optional, use to showWall() 
											 //set_access_token:'<?=$fbconfig['token' ]?>', // optional, set token from backend replace get_access_token, use to showWall()  
											 get_user:'0',  //  optional, to access to user data ( var user.uid ), create event and get friends
											 get_friends:'0',  // optional, required to get friends if set_friends not used  : var friends = Array()  -->  $.each(friends, function(key, value) { ... });
											 set_friends:'{}',  // optional, set friends from backend replace get_friends: var friends = Array()  -->  friends.each()
											 GA_Account: 'UA-9999999-8', //  optional, 'UA-9999999-9' or '0' disable Google Analytics
											 tracking_prefix:'demo',  //  optional, prefix for Google Analytics
											 base_url: '<?=$fbconfig['baseUrl']?>', //  optional, domain and folder for organic sharing and friends request
											 auto_resize_tab:'0',  //Use in a tab of a facebook page. need to add this in your css to better result : html,body{ width:520px; overflow:hidden; }						
											 debug:true,
											 success: function(){
												
												$(this).output_log({log: 'fbinit success log'});
											 }
						});
						
						$("#like").easyfb().like({
										  url:'http://www.like.com/#product',	
										  width:'90',  // also used to hide numbers of like, element css need to be adjust by language = overflow:hidden width=xx px
										  show_faces:'1', //or 0
										  action:'like', // or recommend
										  send:'1', //or false
										  layout:'box_count', // or box_count or button_count or standard
										  colorscheme:'dark', // or light
										  font:'arial'  // or lucida grande or segoe ui or tahoma or trebuchet ms or verdana
						});
						
						$("#like2").easyfb().like({
										  url:'http://www.like.com/#product',	
										  width:'90',  // also used to hide numbers of like, element css need to be adjust by language = overflow:hidden width=xx px
										  show_faces:'0', //or 0
										  action:'recommend', // or recommend
										  send:'0', //or false
										  layout:'button_count', // or box_count or button_count or standard
										  colorscheme:'light', // or light
										  font:'arial'  // or lucida grande or segoe ui or tahoma or trebuchet ms or verdana
						});
						
						$("#like3").easyfb().like({
										  url:'http://www.like.com/#product',	
										  width:'90',  // also used to hide numbers of like, element css need to be adjust by language = overflow:hidden width=xx px
										  show_faces:'1', //or 0
										  action:'like', // or recommend
										  send:'0', //or false
										  layout:'standard', // or box_count or button_count or standard
										  colorscheme:'light', // or light
										  font:'tahoma'  // or lucida grande or segoe ui or tahoma or trebuchet ms or verdana
						});
						
						$(".send").easyfb().send({
										  url:'http://www.send.com/#product',	
										  width:'150',
										  colorscheme:'dark', // or light
										  font:'arial'  // or lucida grande or segoe ui or tahoma or trebuchet ms or verdana
						});
						
						$("#star").easyfb().action({
								 on: "click",
								 app_namespace: 'fbtutoriel',
								 action: 'own',
								 object: 'star',
								 object_url: 'http://etiennedion.com/hotspots2/action.php?object=star'
						});
						
						$("#badge").easyfb().action({
								 on: "click",
								 app_namespace: 'fbtutoriel',
								 action: 'own',
								 object: 'badge',
								 object_url: 'http://etiennedion.com/hotspots2/action.php?object=badge'
						});
						
						
						
						//could be called on load
						$('.login_request').easyfb().login({
											on: 'click',
											get_access_token: '1',
											get_user: '1',
											get_friends: '1',
											perms: 'publish_stream,publish_actions,create_event',
											success: function(){
												
												
												$('#perms_request_box').hide();
												
											}
									 
						});
					
						//example: used dynamicly
						$(".publish").each(function (){
							var name = $(this).attr('name'); 
							var id = $(this).attr('id'); 
							
							$(this).easyfb().share({
											 on: "click",
											 actions:[
											 	{ name: name, link: base_url }
											 ],
											 name: name +' receive a vote.',
											 link: base_url,
											 picture: 'http://www.etiennedion.com/images/a'+ id+'.jpg',
											 caption: '{*actor*} voted for '+ name,  //{*actor*} is only available in caption param
											 description: 'description',
											 message: '',
										 	 properties: [],
											 user_message_prompt: ''
							});
						});
						
						//example: used normaly
						$("#feed").easyfb().share({
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
						
						
						$(".add_friend").each(function (){
							
								var uid = $(this).attr('rel'); 
								
								$(this).easyfb().addFriend({
											on: "click",
											id: uid
								});
						});
						
						
						
						
						$("#invite_friends").easyfb().inviteFriends({
											 on: "click",
											 message: 'Test invite message', 
											 data: 'tracking information for the user'				
						});
						
						
						
						
						
								
						
						
						// on FB initiated
						$('body').bind('fbinit', function(){		
								
								
								//ckeck if user like the page or not  --> Better if done by PHP
								$(this).easyfb().isFan({
											page_id: '106393796069284',
											success: function(){  
													$('#likeornot').html("like");
											},
											fail: function(){
													$('#likeornot').html("don\'t like");
											}		
								});
						
								
								
						});
						
						
						
						// on access_token set
						$('body').bind('access_token', function(){
									
								$("#wall").easyfb().showWall({
											 nb: 25,
											 feed: 'https://graph.facebook.com/137214468461/feed',
											 loading_message: "Chargement du mur ...",
											 timeout:'25000'
								});
								
								$("#comment_box").easyfb().commentsBox({
											 nb: 25,
											 feed: 'https://graph.facebook.com/comments/?ids=http://www.example.com&order_by=created_time&since=2011-07-22&',
											 loading_message: "Chargement du mur ...",
											 timeout:'25000'
								});
								
								
								$(this).easyfb().action({
											 app_namespace: 'fbtutoriel',
											 action: 'try',
											 object: 'jsdevtool',
											 object_url: 'http://etiennedion.com/hotspots2/index.php'
								});
						});
						
																			  
						//on user initiated
						$('body').bind('user', function(){
						
								var image = document.getElementById('image');
							    image.src = 'http://graph.facebook.com/' + user.id + '/picture';
							    var name = document.getElementById('name');
							    name.innerHTML = user.name;	
								
								
								
								// Set timestamp
								var st = new Date(parseInt("2012"), parseInt("7")-1, parseInt("1"), parseInt("8")+3, parseInt("0"),0,0);
								st = Math.round(st.getTime() / 1000);
								
								
								$("#create_event").easyfb().createEvent({
											on: "click",
											//More options here: http://developers.facebook.com/docs/reference/api/event/
											name:'Event Name',
											location: 'Montreal, QC',
											//city:city,
											description:"Event description",
											start_time:st				
								});
								
								$(".attend_event").each(function (){
							
										var id = $(this).attr('rel'); 
										
									
										$(this).easyfb().attendEvent({
											on: "click",
											id: id			
										});
								});
								
								
								 // Custom : Info about a fanpage
								 var htmls = '<div style="background-color:#ddd;color:#000000;width:450px;">';
								 FB.api('/106393796069284', function(response1) {
											total_members = response1.likes;
											name = response1.name;
											link = response1.link;
											htmls += 'Total <i>'+total_members+'</i> persons likes '+'<a href="'+link+'">'+name+'</a><br/>';
											htmls += '</div><br/><br/>';
											$('#page-info').show();
											
											$('#page-info').html(htmls);
							     });
								 
								 
								 
								 // Custom :  get photo album
								 FB.api('/10150352649842950/photos', function(response_pic) {
											 var element = "";
											 $.each(response_pic.data, function(e){
											 	
											    element = "<li><a href='"+response_pic.data[e].link+"'><img src='"+response_pic.data[e].picture+"' width='130' height='76' alt='"+response_pic.data[e].name+"' /></a></li>";
											 	
											    $('#gallery').append(element);
											 
											 });
											 
											 jQuery('#gallery').jcarousel({
													wrap: 'circular'
											 });
							     });
								 
								 
								 
								
						});
							
																	  
						// on friends list collected  =  friends
						$('body').bind('friends', function(){
								
								
								/* REQUIRED : <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.js">< /script>  */ 
								/* AND   <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>  */ 
								$("#friend_autocomplete_1").easyfb().friendAutoComplete({
													 input_name: 'candidate[fb_friends_friend_autocomplete_1][fullname]',
													 input_facebook_id: 'candidate1'
								});
								$("#friend_autocomplete_2").easyfb().friendAutoComplete({
													 input_name: 'candidate',
													 input_facebook_id: 'fb_friends_friend_autocomplete_2'
								});
								$("#friend_autocomplete_3").easyfb().friendAutoComplete({
													 input_name: 'candidate[fb_friends_friend_autocomplete_3][fullname]',
													 input_facebook_id: 'candidate[fb_friends_friend_autocomplete_3][fcbId]'
								});
								
								
								
								var friends_html = $('<div/>');
																												  
								$.each(friends, function(key, value) { 
									  friend_html = '<div id="'+value.id+'" style="background:#ffffff url(http://graph.facebook.com/'+value.id+'/picture) no-repeat 4px 4px;"><span>'+value.name+'</span>, <br/><span>'+value.id+'</span>';    					
									 
									  
									  friend_html += '<br/><br/></div>';
									  // var friend_image = $('<img src="http://graph.facebook.com/'+value.uid+'/picture"/>'); 
									  // friend_html.append(friend_image);
									  friends_html.append($(friend_html));
								});
									 
								$('#friends').html(friends_html);
								
								
								
						});
						
						
						
						
				});
				
			    	
				
					 
				
			})(jQuery)
			
			
	</script>	
            
    </body>
</html>