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
	
	


function get_url_contents($url){
        $crl = curl_init();
        $timeout = 5;
        curl_setopt ($crl, CURLOPT_URL,$url);
        curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
        $ret = curl_exec($crl);
        curl_close($crl);
        return $ret;
}

$str = get_url_contents("https://graph.facebook.com/oauth/access_token?grant_type=client_credentials&client_id= ".$fbconfig['appId' ]."&client_secret=".$fbconfig['secret']);
*/

?><html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Easy Facebook Javascript Tools</title>

        <!-- META TAG EXAMPLE FOR SHARE AND LIKE ON AN EXTERNAL WEBSITE -->
        <meta property="og:title" content="Title example " />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="http://www.example.ca/" />
        <meta property="og:image" content="http://www.lorealparis.ca/img/l10n/common/logoPrint.gif" />
        <meta property="og:site_name" content="L&#039;Oréal" />
        <meta property="fb:admins" content="706847059" />

        
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.js"></script>
		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>  
        <link href="css/easyfacebook.css" rel="stylesheet" type="text/css"/>
		<script src="js/easyfacebook.js" type="text/javascript"></script>
        <script src="http://sorgalla.com/projects/jcarousel/lib/jquery.jcarousel.min.js" type="text/javascript"></script>
		<link href="css/jcarrousel.skin.css" rel="stylesheet" type="text/css"/>
   	
    </head><body>
    
    
     <?php /* if (!$fbme) { ?>
        You've to login using FB Login Button to see api calling result.
    <?php } */ ?>
	
    
     <?php  /*
    Access token = <?php print $str; ?>
 	
	<h2>PHP API</h2>
    
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
	
    
     </body>
</html>