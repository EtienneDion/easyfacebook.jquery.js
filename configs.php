<?php

	//CONFIG
	$fbconfig['facebookSdkPath'] ="src/";
	$fbconfig['baseUrl']  = "http://www.etiennedion.com/easyfacebook/";
	$fbconfig['appBaseUrl'] =  "http://apps.facebook.com/fbtutoriel/";   
	
    $fbconfig['appId']  = 'xxx';
    $fbconfig['api']  = 'xxx';
    $fbconfig['secret']  = 'xxx';
	$fbconfig['token'] = '0';	
	


	$page_id = '137214468461';
	$width = '520';
	$height = '1480';
	$tracking_prefix = 'tutorial';
	
	$ALBUM_ID ='26155';
	
	
	

 
	/*
	
	// Include facebook and Create our Application instance.
    try{
        include_once $fbconfig['facebookSdkPath']."facebook.php";
		
    }
    catch(Exception $o){
        echo '<pre>';
        print_r($o);
        echo '</pre>';
    }
    
   
	
	 $facebook = new Facebook(array(
		  'appId' => $fbconfig['appId'],
		  'secret' => $fbconfig['secret'],
		  'cookie' => true,
		)); 

 
    // We may or may not have this data based on a $_GET or $_COOKIE based session.
    // If we get a session here, it means we found a correctly signed session using
    // the Application Secret only Facebook and the Application know. We dont know
    // if it is still valid until we make an API call using the session. A session
    // can become invalid if it has already expired (should not be getting the
    // session back in this case) or if the user logged out of Facebook.
    $session = $facebook->getSession();
    $loginUrl = $facebook->getLoginUrl(
            array(
            'canvas'    => 1,
            'fbconnect' => 0,
            'req_perms' => 'email,publish_stream,status_update,user_birthday,user_location,user_work_history,manage_pages',
			'next' => $fbconfig['appBaseUrl'],
            )
    );
 	
    $fbme = null;
    // Session based graph API call.
	if (!$session) {
       echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";  
        exit;
    } else {
        try {
            $uid      =   $facebook->getUser();
            $fbme     =   $facebook->api('/me');

        } catch (FacebookApiException $e) {
             echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";  
            exit;
        }
    }
	
	//output error
    function d($d){
        echo '<pre>';
        print_r($d);
        echo '</pre>';
    }
	
	
		
	//Get Signed request --> does not work ... need investiguation
	function parse_signed_request($signed_request, $secret) {
	  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 
	
	  // decode the data
	  $sig = base64_url_decode($encoded_sig);
	  $data = json_decode(base64_url_decode($payload), true);
	
	  if (strtoupper($data['algorithm']) != 'HMAC-SHA256') {
		error_log('Unknown algorithm. Expected HMAC-SHA256');
		return 'Unknown algorithm. Expected HMAC-SHA256 : '.$data;
	  }
	
	  // check sig
	  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
	  if ($sig !== $expected_sig) {
		error_log('Bad Signed JSON signature!');
		return 'Bad Signed JSON signature! : '.$data;
	  }
	
	  return $data;
	}
	
	function base64_url_decode($input) {
		return base64_decode(strtr($input, '-_', '+/'));
	}
	
	$signed_request = $_REQUEST["signed_request"];
	$response = parse_signed_request($signed_request, $fbconfig['secret']);

*/

?>
