<?php

    include_once "configs.php";
    
	$object = $_GET["object"];

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Easy Facebook Javascript Starter kit</title>

<META NAME="robots" CONTENT="noindex,nofollow">
<?php if(isset($_GET["object"])){ ?>
    <meta property="fb:app_id" content="<?= $fbconfig['appId' ] ?>" /> 
    <meta property="og:type" content="fbtutoriel:<?= $object ?>" /> 
    <meta property="og:title" content="<?= $object ?>" /> 
    <meta property="og:image" content="http://etiennedion.com/easyfacebook/images/<?= $object ?>.jpg" />
    <meta property="og:description" content="Achievement : <?= $object ?>" /> 
    <meta property="og:url" content="http://etiennedion.com/easyfacebook/action.php?object=<?= $object ?>">
<?php } else { ?>
	<meta property="fb:app_id" content="<?= $fbconfig['appId' ] ?>" /> 
    <meta property="og:type" content="fbtutoriel:<?= $object ?>" /> 
    <meta property="og:title" content="<?= $object ?>" /> 
    <meta property="og:image" content="http://etiennedion.com/easyfacebook/images/<?= $object ?>.jpg" />
    <meta property="og:description" content="Achievement : <?= $object ?>" /> 
    <meta property="og:url" content="http://etiennedion.com/easyfacebook/action.php?object=<?= $object ?>">
<?php } ?>     
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.js"></script>
<link href="css/doc.css" rel="stylesheet" type="text/css"/>

<link href="css/prettify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/prettify/prettify.js"></script>
</head>

<body>


<div class="wrapper">
    <div id="header" >
    
    	<div class="menu">
            <a href="/" class="logo"><img width="360" height="29" alt="Développeurs Facebook Starter kit" src="images/logo3.jpg" class="img"></a>
            <a href="/">Documentation</a>
            <a href="exemples.php">Examples</a>
            <a href="#">Forum</a>
        </div>
        
    </div>
    
</div>
<div class="wrapper">
	<div id="container">
    
    	<!-- <div id="banner"></div> -->
    
    	<h1>Easy Facebook Javascript Starter kit</h1>
        
        
        
        <div id="bodyMenu" class="bodyMenu">
        	<div class="toplevelnav">
            	<ul>
                	<li class="active withsubsections">
                    		<a class="selected" href="/docs/"><div class="navSectionTitle">Documentation</div></a>
                    		<ul class="subsections">
                            	<li><a href="#" class="selected" rel="prerequis">Présentation et pré-requis</a></li>
                            	<li><a href="#" rel="utilisation">Utilisation</a></li>
                                <li><a href="#" rel="fonctions">Fonctions disponibles</a></li>
                                <li><a href="exemples.php" rel="external">Exemples</a></li>
                            </ul>
                           
                    </li>
                    <li><a href="#"><div class="navSectionTitle">Contributions</div></a></li>
  					<li><a href="#" rel="external"><div class="navSectionTitle">Téléchargements</div></a></li>
                </ul>
           </div>
        </div>
        
        <div id="prerequis" class="bodyText">
        	
            <div class="header">
            	<div class="content">
                	<h2>Présentation et pré-requis</h2>
                    	<div class="breadcrumbs">
                        	<a href="/docs/">Documentation</a> › <a href="/docs/guides/mobile/">Présentation et pré-requis</a>
                        </div>
                </div>
            </div>
            
            <p>La création de fan page custom et de site web intéragissant avec la plateforme facebook s'avère souvent beaucoup plus complexe qu'initialement prévu. La méconnaissance des concepts de base du développement de projet Facebook est à l'origine de la plupart des problèmes en cours de production. Cette librairie peut être utilisé dans une fan page Facebook ou dans un site web normal. Ce projet a été testé pour être compatible avec un DOCTYPE XHTML ou HTML5. </p>
            
            <h3>Pré-requis pour l'utilisation du Facebook Starter kit</h3>
            
            <ul>
            	<li>Connaissance minimal en intégration ou en développement de site web</li>
                <li>Un service d'hébergement de site web</li>
            	<li>Une app dans <a href="http://www.facebook.com/developpers">facebook développers</a></li>
            	<li><a href="http://jquery.com/">Jquery</a></li> 
            </ul>
            
            
            <p>Voici un outil créé pour les développeurs de site web afin de simplifier les intérections avec l'Api Facebook. Cette outil centralise toutes les actions nécessaire à la connection, gestion de permission, action sur la plateforme Facebook, tracking Google analytique et débuggage.<br/>L'outils simplifie les configurations et script nécessaire au démarrage d'un projet facebook tout en n'étant pas limitatif sur les développements plus complexe.</p>
            
            <h3>Ce projet inclu :</h3>
            
            <ul>
            	<li>Une structure de fichiers</li>
                <li>Une librairie de fonctions javascript</li>
                <li>Des exemples d'utilisation</li>
            	<li>Outil de Tracking Google Analytics</li>
            	<li>Outil de connection Facebook Connect</li>
                <li>Outil de débugging</li>
            </ul>
            <br/><br/><br/>
		</div>
        
         <div id="utilisation" class="bodyText">
        	
            <div class="header">
            	<div class="content">
                	<h2>Utilisation</h2>
                    	<div class="breadcrumbs">
                        	<a href="/">Documentation</a> › <a href="#utilisation">Utilisation</a>
                        </div>
                </div>
            </div>
            
            <p>L'utilisation de cette librairie se veut simplifié et flexible. Les options sont totalement paramètrable et des propriétées génériques sont utilisées pour limiter les erreurs de script.</p>
            
            <h3>Ajout css et javascript dans le head</h3>
            
            <h4>Modification du tag HTML : </h4>
            <code style="font-size:10px;" class="prettyprint">&#8249;html xmlns:fb="http://ogp.me/ns/fb#"&#8250;</code>
            
            
            <h4>Base Easy Facebook : </h4>
            <code style="font-size:10px;" class="prettyprint">&#8249;script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.js"&#8250;&#8249;/script&#8250;
            
                <br/>&#8249;link href="css/easyfacebook.jquery.css" rel="stylesheet" type="text/css"/&#8250;
                <br/>&#8249;script src="js/easyfacebook.jquery.js" type="text/javascript"&#8250;&#8249;/script&#8250;
                
        	</code>
            
            <h4>À ajouter pour champ Auto-complete :</h4>
             <code style="font-size:10px;" class="prettyprint">&#8249;script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.js"&#8250;&#8249;/script&#8250;
                <br/>&#8249;link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/&#8250; 
                
        	</code>
            
            <h4>À ajouter pour champ Carrousel Photo :</h4>
            <code style="font-size:10px;" class="prettyprint">&#8249;script src="http://sorgalla.com/projects/jcarousel/lib/jquery.jcarousel.min.js" type="text/javascript"&#8250;&#8249;/script&#8250;
                <br/>&#8249;link href="css/jcarrousel.skin.css" rel="stylesheet" type="text/css"/&#8250;
        	</code>
            
            <h3>Ajout de méta tag pour le sharing</h3>
            
            <code style="font-size:10px;" class="prettyprint">&#8249;meta property="og:title" content="Easy Facebook Javascript Tools " /&#8250;
        <br/>&#8249;meta property="og:type" content="article" /&#8250;
        <br/>&#8249;meta property="og:url" content="http://www.example.ca/" /&#8250;
        <br/>&#8249;meta property="og:image" content="http://www.example.ca/image.jpg" /&#8250;
        <br/>&#8249;meta property="og:site_name" content="Easy Facebook Javascript Tools" /&#8250;
        <br/>&#8249;meta property="fb:admins" content="xxxxxxxxxxx" /&#8250;
            </code>
            
             <h3>Ajout du fb-root tag de facebook dans le body</h3>
             <code class="prettyprint">&#8249;div id="fb-root"&#8250;&#8249;/div&#8250;</code>
            
            
            <h3><a id="init">Initialisation</a></h3>
            
            <p>Lors de l'initialisation plusieurs options sont nécessaire. Les options obligatoire sont :</p>
            <ul>
            	<li><code class="newattr">api_key</code> ( Facebook App Api Key ),</li>
                <li><code class="newattr">FB_lang</code> ( Langue pour les éléments Facebook //en_CA = invalid //en_US = valid ),</li>
                <li><code class="newattr">base_url</code> ( Root url de votre code source ).</li>
            </ul>
                
            <pre><code style="font-size:10px;" class="prettyprint">&#8249;script type="text/javascript"&#8250;
                
    $(document).ready(function(){
        $('#fb-root').easyfb().fbinit({
                 api_key: 'XXXXXXXXXXX', // obligatoire
                 FB_lang: 'fr_CA', // obligatoire //en_CA est invalide //en_US est valide
                 base_url: 'XXXXXXXXXXX' //  obligatoire, utilisé pour le sharing et les friends requests 
    	});
    })(jQuery)
                    
&#8249;/script&#8250;	
        	</code></pre>
            
            <p>Autres Options d'initiatilisation de la libarie:</p>
            <ul>
            	<li><code class="newattr">perms</code> : '',  // Si des permission sont nécessaire au chargement de la page</li>
                <li><code class="newattr">get_access_token</code> : '1', // obligatoire pour le chargement du wall of post et pour faire des 'actions' facebook</li>
                <li><code class="newattr">set_access_token</code> : 'XYZ123', // optionel pour le chargement du wall of post avec un token fourni par le backend.</li>
                <li><code class="newattr">get_user</code> : '1', // obligatoire pour créer un évenement et pour accéder aux données de l'utilisateur</li>
                <li><code class="newattr">get_friends</code> : '1',  // obligatoire pour utiliser la fonction autocomplete et pour obtenir la liste des amis => var friends = friends; liste des amis dans la variable friends</li>
                
                <li><code class="newattr">GA_Account</code> : 'UA-9999999-9', // Google analitics sera activé si différent de UA-9999999-9 ou 0</li>
                <li><code class="newattr">tracking_prefix</code> : 'demo',  // prefix pour Google analitics</li>
                <li><code class="newattr">auto_resize_tab</code> : '1'  // utilisé pour redimentionner le iframe dans une fanpage // pour éviter la scroll bar</li>
            </ul>
        
        	<p>Les fonctions disponible dans la librairie sans avoir besoin d'un login préalable ou d'acceptation de permission facebook sont:</p>
            <ul>
            	<li>Bouton J'aime : <strong class="prettyprint">$(".like").easyfb().like({ ... });</strong></li>
                <li>Bouton Envoyer : <strong class="prettyprint">$(".send").easyfb().send({ ... });</strong></li>
                <li>Inviter un ami : <strong class="prettyprint">$("#invite_friends").easyfb().inviteFriends({ ... });</strong></li>
                <li>Partager : <strong class="prettyprint">$("#share").easyfb().share({ ... });</strong></li>
                <li>Demande de login : <strong class="prettyprint">$('#login_request').easyfb().login({ ... }); </strong></li>
                <li>Is Fan of the page : <strong class="prettyprint">$(this).easyfb().isFan({ ... });</strong></li>
            </ul>
            
            <p>Voici un <a href="base.php">example</a> de ces fonctions.</p>
            
            <p>Pour avoir accès automatiquement aux données utilisateur il faut ajouter <strong>get_user:'1'</strong> lors de l'initialisation, la variable populé sera 'user'. Pour avoir accès à la liste d'amis il faut ajouter <strong>get_friends:'1'</strong>, la variable populé sera 'friends'.<br/>
            
            <pre><code style="font-size:11px;" class="prettyprint">$('#fb-root').easyfb().fbinit({
         ...
         get_user:'1',
         get_friends:'1'
         ...
});</code></pre></p>
            
            <p>Pour pouvoir utiliser les valeurs populés dans ces variables il faut attendre que la librairie se connecte à facebook et qu'elle valide les permissions. Des appels sont lancé lors de l'initialisation de easy facebook pour annoncer les evenements. Les évènements  'user' et 'friends' annoncent l'initialiation de ces variables. <br/>Elles sont ensuite utilisable comme ceci:</p>
            <pre><code class="prettyprint">$('body').bind('user', function(){ console.log(  value.name +','+ user.id  ); });</code><br/>
            ou <br/><br/><code class="prettyprint">$('body').bind('friends', function(){																		  
                        <br/>  $.each(friends, function(key, value) { 
                            <br/>    console.log( value.name +','+ value.uid );
                        <br/>  });
                  <br/>});
			</code></pre>
            
            <a href="https://developers.facebook.com/docs/reference/api/user/">Références sur les propriétés disponible pour un user et les permissions correspondantes</a><br/>
            <a href="https://developers.facebook.com/docs/reference/api/user/">Références sur les propriétés disponible pour un ami</a>
            <p>Pour populer un wall de post ou une liste de commentaire il faut attendre que le init facebook soit complêté. Il faut aussi ajouter dans l'initialisation <strong>get_access_token:'1'</strong> et attendre l'évènement <strong>access_token</strong>.<br/>
            
            <pre><code style="font-size:11px;" class="prettyprint">$('#fb-root').easyfb().fbinit({
         ...
         get_access_token:'1'
         ...
});</code></pre></p>
            Voici un example:
            <pre><code class="prettyprint">$('body').bind('access_token', function(){
								
        $("#wall").easyfb().showWall({
                     nb: 25,
                     feed: 'https://graph.facebook.com/106393796069284/feed',
                     loading_message: "Chargement du mur ...",
                     timeout:'25000'
        });
        
        $("#comment_box").easyfb().commentsBox({
                     nb: 25,
                     feed: 'https://graph.facebook.com/comments/?ids=http://www.example.com',
                     loading_message: "Chargement du mur ...",
                     timeout:'25000'
        });

});</code></pre>
            <br/>
            
            <p>Toutes les fonctions de la librairie sont accessibles au chargement de la page ou sur un évènement (ex: onClick ). <br/>Une fonction ayant le parammetre <strong>'on: "click"'</strong> sera exécuté seulement lors d'un click sur  l'élément déclaré. Par défault la fonction sera exécuté au chargement de la page. Il faut donc s'assurer d'avoir en main les variables / permissions nécessaires avant d'exécuter la fonction. Example: si dans une fonction on compte utiliser une information utilisateur provenant de la variable user. Il faut s'assurer d'avoir attendu que la permission soit disponible avant de d'exécuter la fonction. <br/><br/>Ainsi ceci: </p>
            <pre><code class="prettyprint">$('.login_request').easyfb().login({
                    on: 'click',
                    get_access_token: '0',
                    get_user: '1',
                    get_friends: '1',
                    perms: 'publish_stream,publish_actions',
                    success: function(){
                        
                        
                        $('.login_request').hide();
                        
                        
                        
                    }
                             
});
            </code></pre>
            
            <p>Déclanchera une demande de permission sur le click de les éléments ".login_request". <br/>Les fonctions utilisées au chargement de la page doivent préférablement être utilisées après l'événement 'fbinit' donc à l'intérieur de l'écouteur d'évenement: <code class="prettyprint">$('body').bind('fbinit', function(){ ... });</code></p>
            
            
            
            
            <br/><br/><br/>
		</div>
        
        
        <div id="fonctions" class="bodyText">
        	
            <div class="header">
            	<div class="content">
                	<h2>Liste des fonctions disponibles</h2>
                    	<div class="breadcrumbs">
                        	<a href="/docs/">Documentation</a> › <a href="/docs/">Fonctions disponibles</a>
                        </div>
                </div>
            </div>
            
            
            <h3>Initialisation</h3>
            <ul>
            	<li><a href="#link-init">Init</a> : <strong class="prettyprint">$('#fb-root').easyfb().fbinit({ ... });</strong></li>
            </ul>
            <h3>Login / Permissions</h3>
            <ul>
              <li><a href="#link-login">Demande de login / Permissions</a> : <strong class="prettyprint">$('#login_request').easyfb().login({ ... });</strong></li>
            </ul>
              
            <h3>Fonctions de base</h3>
            
            <ul>
            	<li><a href="#link-like">Bouton J'aime</a> : <strong class="prettyprint">$(".like").easyfb().like({ ... });</strong></li>
                <li><a href="#link-send">Bouton Envoyer</a> : <strong class="prettyprint">$(".send").easyfb().send({ ... });</strong></li>
                <li><a href="#link-invite">Inviter un ami</a> : <strong class="prettyprint">$("#invite_friends").easyfb().inviteFriends({ ... });</strong></li>
                <li><a href="#link-share">Partager</a> : <strong class="prettyprint">$("#share").easyfb().share({ ... });</strong></li>	
                <li><a href="#link-addfriend">Ajouter à sa liste d'ami</a> : <strong class="prettyprint">$("#add_friend").easyfb().addFriend({  ...	});</strong></li>
                <li><a href="#link-isfan">Is Fan of the page</a> : <strong class="prettyprint">$(this).easyfb().isFan({ ... });</strong></li>
            </ul>
            
            <h3>Fonctions avancées</h3>
            
            <p>Fonctions nécessitant l'ajout de <strong>get_access_token:'1'</strong> lors de l'initialisation</p>
            <ul>
            	<li><a href="#link-showwall">Mur de post venant d'une fanpage</a> : <strong class="prettyprint">$("#wall").easyfb().showWall({  ...	});</strong></li>
           		<li><a href="#link-commentsbox">Mur de commentaire à partir d'une url</a> : <strong class="prettyprint">$("#comment_box").easyfb().commentsBox({  ...	});</strong></li>
            </ul>
            
            <p>Évènement - Fonctions nécessitant la permission <strong>'create_event'</strong>.</p>
            <ul>
            	<li><a href="#link-createevent">Créer un évènement</a> : <strong class="prettyprint">$("#create_event").easyfb().createEvent({  ...	});</strong></li>
           		<li><a href="#link-participateevent">Participer à un évènement</a> : <strong class="prettyprint">$(".attend_event").each(function (){ ...	});</strong></li>
            </ul>
            
            <p>Fonctions nécessitant la permission <strong>'publish_actions'</strong>.</p>
            <ul>
            	<li><a href="#link-action">Action Facebook</a> : <strong class="prettyprint">$("#action").easyfb().action({ ... });</strong></li>
            </ul>
            
            <p>Fonctions nécessitant l'ajout de <strong>jquery-ui</strong> dans le head de la page et <strong>get_friends:'1'</strong> lors de l'initialisation.</p>
            <ul>
            	<li><a href="#link-autocomplete">Champs autocomplété choix d'ami</a> : <strong class="prettyprint">$("#friend_autocomplete").easyfb().friendAutoComplete({  ...	});</strong></li>
           		
            </ul>
            
            <br/><br/><br/>
            
            <p><span style="color:#006000;">Green attributes are native from facebook</span>, <br/><span style="color:red;">Red attributes are specific to this library</span>.</p>
            <br/>
            
            <div class="fonction"> 
            	<h2>Initialisation et Login / Permissions</h2>
            </div> 
                 
            <div class="fonction" id="link-init">
                <h3>Initialisation de la librairie : <em class="prettyprint">$("#fb-root").easyfb().fbinit({ ... });</em></h3>
                <p>Initialisation de la librairie et de l'application facebook</p>
                <h4>Attributs:</h4>
                <ul>
                    <li><code class="newattr">api_key</code> Obligatoire - ( Facebook App Api Key ),</li>
                    <li><code class="newattr">FB_lang</code> Obligatoire - ( Langue pour les éléments Facebook //en_CA = invalid //en_US = valid ),</li>
                    <li><code class="newattr">base_url</code> Obligatoire - ( Root url de votre code source ).</li>
                    <li><code class="newattr">perms</code> : '',  // Si des permission sont nécessaire au chargement de la page</li>
                    <li><code class="newattr">get_access_token</code> : '1', // obligatoire pour le chargement du wall of post et pour faire des 'actions' facebook</li>
                    <li><code class="newattr">set_access_token</code> : '...', // will set the access token from backend, utilisé pour le chargement du wall of post</li>
                    <li><code class="newattr">get_user</code> : '1', // obligatoire pour créer un évenement et pour accéder aux données de l'utilisateur</li>
                    <li><code class="newattr">get_friends</code> : '1',  // obligatoire pour utiliser la fonction autocomplete et pour obtenir la liste des amis => var friends = friends; liste des amis dans la variable friends</li>
                    <li><code class="newattr">GA_Account</code> : 'UA-9999999-9', // Google analitics sera activé si différent de UA-9999999-9 ou 0</li>
                    <li><code class="newattr">tracking_prefix</code> : 'demo',  // prefix pour Google analitics</li>
                    <li><code class="newattr">auto_resize_tab</code> : '1'  // utilisé pour redimentionner le iframe dans une fanpage // pour éviter la scroll bar</li>
                    
				</ul>
                <br/><a href="#init" class="internal_link">Références</a>
            </div>  
                     
            <div class="fonction" id="link-login">  
            	<h3>Demande de login : <em class="prettyprint">$('#login_request').easyfb().login({ ... });</em></h3>
                <p>Dialogues combinant <a href="https://developers.facebook.com/docs/reference/javascript/FB.getLoginStatus/" target="_blank">FB.getLoginStatus</a> et <a href="https://developers.facebook.com/docs/reference/javascript/FB.login/" target="_blank">FB.login</a> pour une demande de login et de permissions</p>
                <h4>Attributs:</h4>
                <ul>
                	<li><code class="newattr">on</code> - event(ex: 'click') on which the function is triggered base on the element in selector , if params is not present the function will be triggered on loading</li>
                    <li><code class="newattr">get_access_token</code> - will get the access token if this is equal to true, utilisé pour le chargement du wall of post et pour faire des 'actions' facebook</li>
                    <li><code class="newattr">set_access_token</code> - will set the access token from backend, utilisé pour le chargement du wall of post et pour faire des 'actions' facebook</li>
                    
                    <li><code class="newattr">get_user</code> - obligatoire pour créer un évenement et pour accéder aux données de l'utilisateur => crée une variable user qui contiens les données de l'utilisateur</li>
                    <li><code class="newattr">get_friends</code> - obligatoire pour utiliser la fonction autocomplete et pour obtenir la liste des amis => crée une variable user qui contiens les données de l'utilisateur</li>
                    <li><code class="newattr">perms</code> - liste des permissions (scope) demandé par l'apps</li>
                    <li><code class="newattr">success</code> - fonction à exécuter lorsque le login est un succès => function(){ ... }</li>
            	</ul>
                
           
            </div> 
            
            <div class="fonction"> 
            	<h2>Fonctions de base</h2>
            </div> 
                     
            <div class="fonction" id="link-like">
                <h3>Bouton J'aime <em class="prettyprint">$(".like").easyfb().like({ ... });</em></h3>
                <p>Génère un tag &#8249;fb:like&#8250;&#8249;/fb:like&#8250;</p>
                <h4>Attributs:</h4>
                <ul>
                    <li><code class="newattr">on</code> - event on which the button is generated base on the element in selector(ex: 'click'), if params is not present the button will be generated on loading</li>
                    <li><code class="newattr">url</code> - the URL to like. </li>
                    <li><code>send</code> - specifies whether to include a <a href="http://developers.facebook.com/docs/reference/plugins/send/">Send button</a> with the Like button. This only works with the XFBML version. </li>
                    <li><code>layout</code> - there are three options. 
                    
                    <ul>
                    <li><code>standard</code> - displays social text to the right of the button and friends' profile photos below. Minimum width: 225 pixels. Default width: 450 pixels. Height: 35 pixels (without photos) or 80 pixels (with photos). </li>
                    <li><code>button_count</code> - displays the total number of likes to the right of the button. Minimum width: 90 pixels.  Default width: 90 pixels. Height: 20 pixels. </li>
                    <li><code>box_count</code> - displays the total number of likes above the button. Minimum width: 55 pixels.  Default width: 55 pixels. Height: 65 pixels.</li>
                    </ul></li>
                    <li><code>show_faces</code> - specifies whether to display profile photos below the button (standard layout only) </li>
                    <li><code>width</code> - the width of the Like button. </li>
                    <li><code>action</code> - the verb to display on the button. Options: 'like', 'recommend' </li>
                    <li><code>font</code> - the font to display in the button. Options: 'arial', 'lucida grande', 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana' </li>
                    <li><code>colorscheme</code> - the color scheme for the like button. Options: 'light', 'dark' </li>
                    <li><code>ref</code> - a label for tracking referrals; must be less than 50 characters and can contain alphanumeric characters and some punctuation (currently +/=-.:_). The ref attribute causes two parameters to be added to the referrer URL when a user clicks a link from a stream story about a Like action: 
                    
                    <ul>
                    <li><code>fb_ref</code> - the ref parameter </li>
                    <li><code>fb_source</code> - the stream type ('home', 'profile', 'search', 'other') in which the click occurred and the story type ('oneline' or 'multiline'), concatenated with an underscore.</li>
                    </ul></li>
                </ul>
                <br/><a href="https://developers.facebook.com/docs/reference/plugins/like/" target="_blank">Références</a>
       		</div>                     
            
            <div class="fonction" id="link-send">
                <h3>Bouton Envoyer : <em class="prettyprint">$(".send").easyfb().send({ ... });</em></h3>
                <p>Génère un tag &#8249;fb:send&#8250;&#8249;/fb:send&#8250;</p>
                <h4>Attributs:</h4>
                <ul>
                    <li><code class="newattr">on</code> - event on which the button is generated base on the element in selector(ex: 'click'), if params is not present the button will be generated on loading</li>
                    <li><code class="newattr">url</code> - the URL to send. </li>
                    <li><code>font</code> - the font to display in the button. Options: 'arial', 'lucida grande', 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana' </li>
                    <li><code>colorscheme</code> - the color scheme for the button. Options: 'light', 'dark' </li>
                    <li><code>ref</code> - a label for tracking referrals; must be less than 50 characters and can contain alphanumeric characters and some punctuation (currently +/=-.:_). The ref attribute causes two parameters to be added to the referrer URL when a user clicks a link from a stream story about a Send action: 
                    
                    <ul>
                    <li><code>fb_ref</code> - the ref parameter </li>
                    <li><code>fb_source</code> - the story type ('message', 'group', 'email') in which the click occurred.</li>
                    </ul></li>
				</ul>
                <br/><a href="http://developers.facebook.com/docs/reference/plugins/send/" target="_blank">Références</a>
            </div>    
                
            <div class="fonction" id="link-invite">    
             	<h3>Inviter un ami : <em class="prettyprint">$("#invite_friends").easyfb().inviteFriends({ ... });</em></h3>
                <p>Dialogues d'invitation de plusieurs amis utilisant <a href="https://developers.facebook.com/docs/reference/javascript/FB.ui/" target="_blank">FB.ui</a> (envoi une notification avec un liens vers votre canevas url)</p>
                <h4>Attributs:</h4>
                <ul>
                	<li><code class="newattr">on</code> - event(ex: 'click') on which the function is triggered base on the element in selector , if params is not present the function will be triggered on loading</li>
                    <li><code>message</code> - The request the receiving user will see. It appears as a question posed by the sending user. The maximum length is 255 characters.</li>
					<li><code>data</code> - Optional, additional data you may pass for tracking. This will be stored as part of the request objects created. The maximum length is 255 characters.</li>
                    <li><code>title</code> - Optional, the title for the friend selector dialog. Maximum length is 50 characters. </li>  
                    <li><code>to</code> - Optional, A user ID or username. This may or may not be a friend of the user. If this is specified, the user will not have a choice of recipients. If this is omitted, the user will see a friend selector and will be able to select a maximum of 50 recipients. (Due to URL length restrictions, the maximum number of recipients is 25 in IE7 and also in IE8+ when using a non-iframe dialog.) </li> 
                    <li><code>filters</code> - Optional, default is '', which shows a selector that includes the ability for a user to browse all friends, but also filter to friends using the application and friends not using the application. Can also be all, app_users and app_non_users. This controls what set of friends the user sees if a friend selector is shown. If all, app_users ,or app_non_users is specified, the user will only be able to see users in that list and will not be able to filter to another list. Additionally, an application can suggest custom filters as dictionaries with a name key and a user_ids key, which respectively have values that are a string and a list of user ids. name is the name of the custom filter that will show in the selector. user_ids is the list of friends to include, in the order they are to appear. </li> 
                    <li><code>exclude_ids</code> - Optional, A array of user IDs that will be excluded from the dialog, for example: exclude_ids: [1, 2, 3] <br/>If a user is excluded from the dialog, the user will not show in the friend selector. </li> 
                    <li><code>max_recipients</code> - Optional, An integer that specifies the maximum number of friends that can be chosen by the user in the friend selector. </li>  
                     
                </ul>          
            	<br/><a href="https://developers.facebook.com/docs/reference/dialogs/requests/" target="_blank">Références</a>
            </div>  
            
             
            <div class="fonction" id="link-share">  
            	<h3>Partager : <em class="prettyprint">$("#share").easyfb().share({ ... });</em></h3>
                <p>Dialogues d'invitation de plusieurs amis utilisant <a href="https://developers.facebook.com/docs/reference/javascript/FB.ui/" target="_blank">FB.ui</a> (envoi une notification avec un liens vers votre canevas url)</p>
                <h4>Attributs:</h4>
                <ul>
                	<li><code class="newattr">on</code> - event(ex: 'click') on which the function is triggered base on the element in selector , if params is not present the function will be triggered on loading</li>
                    <li><code>from</code> - The ID or username of the user posting the message. If this is unspecified, it defaults to the current user. If specified, it must be the ID of the user or of a page that the user administers.</li>
                	<li><code>to</code> - The ID or username of the profile that this story will be published to. If this is unspecified, it defaults to the the value of from.</li>
					<li><code>message</code> - This field will be ignored on July 12, 2011 The message to prefill the text field that the user will type in. To be compliant with Facebook Platform Policies, your application may only set this field if the user manually generated the content earlier in the workflow. Most applications should not set this.</li>
                    <li><code>link</code> - The link attached to this post</li>
                    <li><code>picture</code> - The URL of a picture attached to this post. The picture must be at least 50px by 50px and have a maximum aspect ratio of 3:1</li>
                    <li><code>source</code> - The URL of a media file (e.g., a SWF or video file) attached to this post. If both source and picture are specified, only source is used.</li>
                    <li><code>name</code> - The name of the link attachment.</li>
					<li><code>caption</code> - The caption of the link (appears beneath the link name).</li>
                    <li><code>description</code> - The description of the link (appears beneath the link caption).</li>
                    <li><code>properties</code> - A JSON object of key/value pairs which will appear in the stream attachment beneath the description, with each property on its own line. Keys must be strings, and values can be either strings or JSON objects with the keys text and href.</li>
                    <li><code>actions</code> - A JSON array of action links which will appear next to the "Comment" and "Like" link under posts. Each action link should be represented as a JSON object with keys name and link.</li>
                    <li><code>ref</code> - A text reference for the category of feed post. This category is used in Facebook Insights to help you measure the performance of different types of post</li>

                </ul>
            	<br/><a href="https://developers.facebook.com/docs/reference/dialogs/feed/" target="_blank">Références</a>
              
            </div> 
             
            <div class="fonction" id="link-addfriend">  
            	<h3>Ajouter à sa liste d'ami : <em class="prettyprint">$("#add_friend").easyfb().addFriend({  ...	});</em></h3>
                <p>Dialogues d'ajout à sa liste d'amis utilisant <a href="https://developers.facebook.com/docs/reference/javascript/FB.ui/" target="_blank">FB.ui</a> (envoi une demande d'amitié)</p>
                <h4>Attributs:</h4>
                <ul>
                	<li><code class="newattr">on</code> - event(ex: 'click') on which the function is triggered base on the element in selector , if params is not present the function will be triggered on loading</li>
                    <li><code>redirect_uri</code> - The URL to redirect to after the user clicks a button on the dialog. Required, but automatically specified by most SDKs.</li>
            	</ul>
                
            	<br/><a href="https://developers.facebook.com/docs/reference/dialogs/friends/" target="_blank">Références</a>
              
            </div>  
            
           
   
            
            <div class="fonction" id="link-isfan">  
            	<h3>Is Fan of the page : <em class="prettyprint">$(this).easyfb().isFan({ ... });</em></h3>
                <p>Requête utilisant <a href="https://developers.facebook.com/docs/reference/javascript/FB.api/" target="_blank">FB.api</a> pour vérifier si l'utilisateur like une page facebook.</p>
                <h4>Attributs:</h4>
                <ul>
                	<li><code class="newattr">on</code> - event(ex: 'click') on which the function is triggered base on the element in selector , if params is not present the function will be triggered on loading</li>
                    <li><code>page_id</code> Obligatoire - id de la page à tester</li>
                    <li><code class="newattr">success</code> - Optionel - fonction exécuté si la personne est fan. Ex: function(){ ... })</li>
                    <li><code class="newattr">fail</code> - Optionel - fonction exécuté si la personne n'est pas fan. Ex: function(){ ... })</li>
											
            	</ul>
                
           
            </div> 
            
            <div class="fonction"> 
            	<h2>Fonctions avancées</h2>
                <br/><h3>Fonctions nécessitant l'ajout de <em>get_access_token:'1'</em>  lors de l'initialisation</h3>
            </div> 
            
            <div class="fonction" id="link-showwall">  
            	<h3>Mur de post venant d'une fanpage : <em class="prettyprint">$("#wall").easyfb().showWall({ ... });</em></h3>
                <p>Requête utilisant <a href="https://developers.facebook.com/docs/reference/javascript/FB.api/" target="_blank">FB.api</a> pour populer un wall de post d'une page facebook. 'get_access_token' dans la fonction init est requis pour utiliser cette fonction, optionellement 'set_access_token' peut fournir un token à partir du backend. Cette fonction permet de pouvoir skinner totalement le wall par css.</p>
                <h4>Attributs:</h4>
                <ul>
                	<li><code class="newattr">nb</code> Obligatoire - nombre de post à afficher</li>
                    <li><code class="newattr">feed</code> Obligatoire - url d'un feed sur https://graph.facebook.com/... id de la page .../feed </li>
                    <li><code class="newattr">loading_message</code> Message pendant le chargement </li>
                    <li><code class="newattr">timeout</code> Timeout en tick - par défault : 25000 </li>
            	</ul>
                <br/><a href="https://developers.facebook.com/tools/explorer/?method=GET&path=706847059" target="_blank">Graph Explorer</a>	
           		<br/><a href="https://developers.facebook.com/docs/reference/api/page/" target="_blank">Api graph Page Feed References</a>	
            </div>
            
            <div class="fonction" id="link-commentsbox">  
            	<h3>Mur de commentaire : <em class="prettyprint">$("#wall").easyfb().commentsBox({ ... });</em></h3>
                <p>Requête utilisant <a href="https://developers.facebook.com/docs/reference/javascript/FB.api/" target="_blank">FB.api</a> pour populer un wall de post d'une page facebook. 'get_access_token' dans la fonction init est requis pour utiliser cette fonction. Cette fonction permet de pouvoir skinner totalement le wall par css.</p>
                <h4>Attributs:</h4>
                <ul>
                	<li><code class="newattr">nb</code> Obligatoire - nombre de post à afficher</li>
                    <li><code class="newattr">feed</code> Obligatoire - url d'un feed de commentaire sur https://graph.facebook.com/comments/?ids=<strong>http://www.example.com&order_by=created_time&since=2011-07-22& </strong></li>
                    <li><code class="newattr">loading_message</code> Message pendant le chargement </li>
                    <li><code class="newattr">timeout</code> Timeout en tick - par défault : 25000 </li>
            	</ul>
                <br/><a href="https://developers.facebook.com/tools/explorer/?method=GET&path=706847059" target="_blank">Graph Explorer</a>	
           		<br/><a href="https://developers.facebook.com/docs/reference/api/page/" target="_blank">Api graph Page Feed References</a>	
            </div>
            
            <div class="fonction"> 
            	<h3>Évènement - Fonctions nécessitant la permission <em>'create_event'</em>.</h3>
            </div>
            
            <div class="fonction" id="link-createevent">  
            	<br/>
                <h3>Créer un évènement : <em class="prettyprint">$("#create_event").easyfb().createEvent({ ... });</em></h3> 
            	
                <p>Requête utilisant <a href="https://developers.facebook.com/docs/reference/javascript/FB.api/" target="_blank">FB.api</a> pour créer un évènement sur votre profil facebook.</p>
                
                 <h4>Attributs:</h4>                    
                <ul>
                	<li><code class="newattr">on</code> - event(ex: 'click') on which the function is triggered base on the element in selector , if params is not present the function will be triggered on loading</li>
                	<li><code>name</code> Obligatoire - nom de l'évènement</li>
                    <li><code>location</code> Obligatoire - ville ou emplacement de l'évènement</li>
                    <li><code>description</code> Obligatoire - Description de l'évènement </li>
                    <li><code>start_time</code> Obligatoire - Moment du début de l'activité en temps ISO-8601 ou UNIX timestamp</li>
                    <li><code>end_time</code> Optionel - Moment du fin de l'activité en temps ISO-8601 ou UNIX timestamp</li>
                    <li><code>privacy</code> Optionel - containing 'OPEN'( par default ), 'CLOSED', or 'SECRET' </li>
                    
            	</ul>
                <br/>Plus d'option <a href="http://developers.facebook.com/docs/reference/api/event/" target="_blank">ici</a>	
           		
            </div>
            
            <div class="fonction" id="link-participateevent">  
            	<br/>
                <h3>Participer à un évènement : <em class="prettyprint">$(".attend_event").each(function (){ ... });</em></h3> 
            	 
                <p>Requête utilisant <a href="https://developers.facebook.com/docs/reference/javascript/FB.api/" target="_blank">FB.api</a> pour s'inscrire à un évènement sur votre profil facebook.</p>
                
                  <h4>Attributs:</h4>                   
                <ul>
                	<li><code class="newattr">on</code> - event(ex: 'click') on which the function is triggered base on the element in selector , if params is not present the function will be triggered on loading</li>
                	<li><code>id</code> Obligatoire - id de l'évènement facebook</li>
                    
            	</ul>
              
           		
            </div>
            
            <div class="fonction"> 
            	<h3>Fonctions nécessitant la permission 'publish_actions'.</h3>
            </div>
            
         
            <div class="fonction" id="link-action">  
            	<br/>
                <h3>Action Facebook : <em class="prettyprint">$("#action").easyfb().action({ ... });</em></h3> 
            	 
                <p>Requête utilisant <a href="https://developers.facebook.com/docs/reference/javascript/FB.api/" target="_blank">FB.api</a> pour faire des <a href="https://developers.facebook.com/docs/beta/opengraph/">actions facebook</a> en utlisant le <a href="https://blog.facebook.com/blog.php?post=10150408488962131">nouveau timeline</a>. Nécessite d'avoir préabalement <a href="https://developers.facebook.com/docs/beta/opengraph/tutorial/">créé des actions dans votre app</a>. Une action utilise des <a href="https://developers.facebook.com/docs/beta/opengraph/define-objects/">objets</a>, des <a href="https://developers.facebook.com/docs/beta/opengraph/define-actions/">actions</a> et s'affiche avec des <a href="https://developers.facebook.com/docs/beta/opengraph/define-units/">agrégations</a>. Pour utiliser les actions avec cette librairie il est nécessaire d'ajouter les meta tag particulier dans le head pour une page objet pour que cela fonctionne. 
        <br/><br/>Ex:<br/><code style="font-size:10px;" class="prettyprint">
        
        &#8249;meta property="fb:app_id" content="APP_ID" /&#8250;<br/>
        &#8249;meta property="og:type" content="NAMESPACE:OBJET" /&#8250;<br/>
        &#8249;meta property="og:title" content="TITRE DE L'OBJET" /&#8250;<br/>
        &#8249;meta property="og:image" content="URL D'IMAGE" /&#8250;<br/>
        &#8249;meta property="og:description" content="DESCRIPTION" /&#8250;<br/>
        &#8249;meta property="og:url" content="URL DE L'OBJET EX:action.php?object=&#8249;?= $OBJET ?&#8250;"&#8250;
        </code>
        <br/><br/>
        Une fois les actions, objets, agrégations et page objet créé cette fonction simplifiera le processus d'exécution des actions sur facebook.
        </p>
                
                  <h4>Attributs:</h4>                   
                <ul>
                	<li><code class="newattr">on</code> - event(ex: 'click') on which the function is triggered base on the element in selector , if params is not present the function will be triggered on loading</li>
                	<li><code class="newattr">app_namespace</code> Obligatoire - le namespace de votre app dans <a href="https://developers.facebook.com/apps">facebook developers</a></li>
                    <li><code class="newattr">action</code> Obligatoire - le nom de votre action (Action Type Name)</li>
                    <li><code class="newattr">object</code> Obligatoire - le nom de votre objet (Object Type Name)</li>
                    <li><code class="newattr">object_url</code> Obligatoire - l'url de votre page objet</li>
                     
            	</ul>
              	
           		<br/><a href="https://developers.facebook.com/docs/beta/opengraph/objects/builtin/">Référence sur les objets facebook</a>
                <br/><a href="https://developers.facebook.com/tools/debug">Object url debugger</a>
                
            </div>
            
            
            
            <div class="fonction" id="link-autocomplete">  
            	<br/>
                <h3>Champs autocomplété choix d'ami : <em class="prettyprint">$("#friend_autocomplete").easyfb().friendAutoComplete({  ...	});</em></h3> 
            	 
                <p>Fonctions nécessitant l'ajout de <strong>jquery-ui</strong> dans le head de la page et <strong>get_friends:'1'</strong> lors de l'initialisation.
            <br/>Cette fonction crée un champs autocomplété avec la liste des amis por facilité le choix d'un ami pour la soumission dans un formulaire. 
            La fonction génère deux champ input: l'un pour le nom de l'ami et l'autre pour le id facebook de cet ami. Le 'name' et 'id' des champs inputs sont paramétrable dans les options de la fonction. Nécessite l'ajout de ces tag dans le head de la page:<br/><br/>
			<code style="font-size:10px;" class="prettyprint">&#8249;script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.js"&#8250;&#8249; /script&#8250;<br/>
            &#8249;link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/&#8250; </code>
            </p>
                
                  <h4>Attributs:</h4>                   
                <ul>
                	<li><code class="newattr">input_name</code> Obligatoire - nom de l'input généré pour le nom de l'ami selectionné</li>
                    <li><code class="newattr">input_facebook_id</code> Obligatoire - nom de l'input généré pour l'id facebook de l'ami selectionné</li>
                    
                      
            	</ul>
              	
           		
                
            </div>
            
            
             
		</div>
        
    </div>
    <div id="footer"><a href="http://etiennedion.com" target="_blank">Etienne Dion &copy; 2011</a></div>
</div>
<div id="bg"></div>
<script type="text/javascript">
	$(".subsections a").click(function(event){
		if ($(this).attr("rel") != 'external'){
			event.preventDefault();
			$(".subsections a").removeClass("selected");
			$(this).addClass("selected");
			$(".bodyText").hide();
			var section = $(this).attr("rel");
			$("#"+section).show();
		}
		
		prettyPrint();
		
	});
</script>
</body>
</html>
