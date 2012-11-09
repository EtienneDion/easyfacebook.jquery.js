<?php 
$object = $_GET["object"];

?><html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xmlns:fb="https://www.facebook.com/2008/fbml"> 

<head prefix="og: http://ogp.me/ns# fbtutoriel:http://ogp.me/ns/apps/fbtutoriel#"> 
    <meta property="fb:app_id" content="152367548159504" /> 
    <meta property="og:type" content="fbtutoriel:<?= $object ?>" /> 
    <meta property="og:title" content="<?= $object ?>" /> 
    <meta property="og:image" content="http://etiennedion.com/hotspots2/images/<?= $object ?>.jpg" /> 
    <meta property="og:description" content="Achievement : <?= $object ?>" /> 
    <meta property="og:url" content="http://etiennedion.com/hotspots2/action.php?object=<?= $object ?>"> 

</head> 

<body> 
    <div id="fb-root"></div>
    <script src="http://connect.facebook.net/en_US/all.js"></script>
    <script>
        FB.init({ 
            appId:'152367548159504', cookie:true, 
            status:true, xfbml:true, oauth:true
        });
		
    </script>

        <fb:add-to-timeline></fb:add-to-timeline>

        <h3>
            <font size="30" face="verdana" color="grey">
                 <?= $object ?>
            </font> 
        </h3> 
        <p>
            <img title="<?= $object ?>"  src="http://etiennedion.com/hotspots2/images/<?= $object ?>.jpg" width="550"/><br />
        </p> 
        
        <fb:activity actions="fbtutoriel:own"></fb:activity>   
        <fb:activity actions="fbtutoriel:try"></fb:activity>   
    </body> 
    </html>
