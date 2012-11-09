<?php

    include_once "fbmain.php";
   
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Outils Facebook Simplifié</title>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.js"></script>
<link href="css/easyfacebook.css" rel="stylesheet" type="text/css"/>
<script src="js/easyfacebook.js" type="text/javascript"></script>
</head>

<body> 
<div id="fb-root"></div>
<h1>Function de base</h1>

 <a href="#" id="perms_request">Permission request</a> <span>(if not grant yet redirect to your facebook app url (app.facebook.com...))</span><br /><br />
   
    <div id="perms_request_box"><a href="#" id="login_request">Login request + perms</a> <span>(if not grant yet)</span></div><br /><br />
    
    <h3>Dialogs</h3>

    <a href="#" id="invite_friends">Invite friends</a> <span>(redirect them to your facebook app url (app.facebook.com...)</span>
    <br /><a href="#" id="feed">Feed</a>
    <br /><a href="#" class="publish" id="1" name="Christian">Publish Christian</a> <a href="#" class="publish" id="2" name="Josee">Publish Josee</a> <a href="#" class="publish" id="3" name="Serge">Publish Serge</a>
    <?php  /* <br /><a href="#" id="dialog">Dialog</a> / TODO : Create an function generating FB.ui with full control on param and callback<br /> 
	*/  ?>
   
   
    <h3>Like / Recommend</h3>
    
    <div id="like"></div><br />
    <div id="like2"></div><br />
    <div id="like3"></div>
    
    <h3>Send</h3>
    
    <div class="send"></div><br />
    
    
    
    
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
											 base_url: '<?=$fbconfig['baseUrl']?>' //  optional, domain and folder for organic sharing and friends request
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
						
						//redirect happen even if allready granted : to be fix
						$("#perms_request").easyfb().permsRequest({
											on: "click",
											perms: 'user_birthday,user_relationship_details,read_stream,create_event',
											callback_url: 'http://apps.facebook.com/fbtutoriel/'
						});
						$(".publish").each(function (){
							var name = $(this).attr('name'); 
							var id = $(this).attr('id'); 
							
							$(this).easyfb().publish({
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
						
						
						//could be called on load
						$('#login_request').click( function (){
									$(this).facebook_login({
												get_access_token: '0',
												get_user: '1',
												get_friends: '1',
												perms: 'publish_stream',
												success: function(){
													
													
													$('#perms_request_box').hide();
													
													
													$(this).facebook_tracking({lid: tracking_prefix +'/Allow_Facebook' });
												}
									 });
						});
						
						
						$("#invite_friends").easyfb().inviteFriends({
											 on: "click",
											 message: 'Test invite message', 
											 data: 'tracking information for the user'				
						});
				});			
			})(jQuery)
			
			
	</script>	
</body>
</html>
