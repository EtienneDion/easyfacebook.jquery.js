# Easy Facebook Javascript Starter kit

  

    * Pr�sentation et pr�-requis
    * Utilisation
    * Fonctions disponibles
  
  

  

## Pr�sentation et pr�-requis



La cr�ation de fan page custom et de site web int�ragissant avec la plateforme
facebook s'av�re souvent beaucoup plus complexe qu'initialement pr�vu. La
m�connaissance des concepts de base du d�veloppement de projet Facebook est �
l'origine de la plupart des probl�mes en cours de production. Cette librairie
peut �tre utilis� dans une fan page Facebook ou dans un site web normal. Ce
projet a �t� test� pour �tre compatible avec un DOCTYPE XHTML ou HTML5.

### Pr�-requis pour l'utilisation du Facebook Starter kit

  * Connaissance minimal en int�gration ou en d�veloppement de site web
  * Un service d'h�bergement de site web
  * Une app dans [facebook d�veloppers](http://www.facebook.com/developpers)
  * [Jquery](http://jquery.com/)

Voici un outil cr�� pour les d�veloppeurs de site web afin de simplifier les
int�rections avec l'Api Facebook. Cette outil centralise toutes les actions
n�cessaire � la connection, gestion de permission, action sur la plateforme
Facebook, tracking Google analytique et d�buggage.

L'outils simplifie les configurations et script n�cessaire au d�marrage d'un
projet facebook tout en n'�tant pas limitatif sur les d�veloppements plus
complexe.

### Ce projet inclu :

  * Une structure de fichiers
  * Une librairie de fonctions javascript
  * Des exemples d'utilisation
  * Outil de Tracking Google Analytics
  * Outil de connection Facebook Connect
  * Outil de d�bugging
  
  
  

## Utilisation


L'utilisation de cette librairie se veut simplifi� et flexible. Les options
sont totalement param�trable et des propri�t�es g�n�riques sont utilis�es pour
limiter les erreurs de script.

### Ajout css et javascript dans le head

#### Modification du tag HTML :

`�html xmlns:fb="http://ogp.me/ns/fb#"�`

#### Base Easy Facebook :

`�script type="text/javascript"
src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.js"��/script�

�link href="css/easyfacebook.jquery.css" rel="stylesheet" type="text/css"/�

�script src="js/easyfacebook.jquery.js" type="text/javascript"��/script� `

#### � ajouter pour champ Auto-complete :

`�script type="text/javascript"
src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.js"��/script�

�link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base
/jquery-ui.css" rel="stylesheet" type="text/css"/� `

#### � ajouter pour champ Carrousel Photo :

`�script
src="http://sorgalla.com/projects/jcarousel/lib/jquery.jcarousel.min.js"
type="text/javascript"��/script�

�link href="css/jcarrousel.skin.css" rel="stylesheet" type="text/css"/� `

### Ajout de m�ta tag pour le sharing

`�meta property="og:title" content="Easy Facebook Javascript Tools " /�

�meta property="og:type" content="article" /�

�meta property="og:url" content="http://www.example.ca/" /�

�meta property="og:image" content="http://www.example.ca/image.jpg" /�

�meta property="og:site_name" content="Easy Facebook Javascript Tools" /�

�meta property="fb:admins" content="xxxxxxxxxxx" /� `

### Ajout du fb-root tag de facebook dans le body

`�div id="fb-root"��/div�`

### Initialisation

Lors de l'initialisation plusieurs options sont n�cessaire. Les options
obligatoire sont :

  * `api_key` ( Facebook App Api Key ),
  * `FB_lang` ( Langue pour les �l�ments Facebook //en_CA = invalid //en_US = valid ),
  * `base_url` ( Root url de votre code source ).
    
    �script type="text/javascript"�
    
                    $(document).ready(function(){
                    $('#fb-root').easyfb().fbinit({
                    api_key: 'XXXXXXXXXXX', // obligatoire
                    FB_lang: 'fr_CA', // obligatoire //en_CA est invalide //en_US est valide
                    base_url: 'XXXXXXXXXXX' //  obligatoire, utilis� pour le sharing et les friends requests
                    });
                    })(jQuery)
    
                    �/script�
                

Autres Options d'initiatilisation de la libarie:

  * `perms` : '', // Si des permission sont n�cessaire au chargement de la page
  * `get_access_token` : '1', // obligatoire pour le chargement du wall of post et pour faire des 'actions' facebook
  * `set_access_token` : 'XYZ123', // optionel pour le chargement du wall of post avec un token fourni par le backend.
  * `get_user` : '1', // obligatoire pour cr�er un �venement et pour acc�der aux donn�es de l'utilisateur
  * `get_friends` : '1', // obligatoire pour utiliser la fonction autocomplete et pour obtenir la liste des amis =&gt; var friends = friends; liste des amis dans la variable friends
  * `GA_Account` : 'UA-9999999-9', // Google analitics sera activ� si diff�rent de UA-9999999-9 ou 0
  * `tracking_prefix` : 'demo', // prefix pour Google analitics
  * `auto_resize_tab` : '1' // utilis� pour redimentionner le iframe dans une fanpage // pour �viter la scroll bar

Les fonctions disponible dans la librairie sans avoir besoin d'un login
pr�alable ou d'acceptation de permission facebook sont:

  * Bouton J'aime : **$(".like").easyfb().like({ ... });**
  * Bouton Envoyer : **$(".send").easyfb().send({ ... });**
  * Inviter un ami : **$("#invite_friends").easyfb().inviteFriends({ ... });**
  * Partager : **$("#share").easyfb().share({ ... });**
  * Demande de login : **$('#login_request').easyfb().login({ ... }); **
  * Is Fan of the page : **$(this).easyfb().isFan({ ... });**

Voici un [example](base.php) de ces fonctions.

Pour avoir acc�s automatiquement aux donn�es utilisateur il faut ajouter
**get_user:'1'** lors de l'initialisation, la variable popul� sera 'user'.
Pour avoir acc�s � la liste d'amis il faut ajouter **get_friends:'1'**, la
variable popul� sera 'friends'.

    
    $('#fb-root').easyfb().fbinit({
                    ...
                    get_user:'1',
                    get_friends:'1'
                    ...
                    });

Pour pouvoir utiliser les valeurs popul�s dans ces variables il faut attendre
que la librairie se connecte � facebook et qu'elle valide les permissions. Des
appels sont lanc� lors de l'initialisation de easy facebook pour annoncer les
evenements. Les �v�nements 'user' et 'friends' annoncent l'initialiation de
ces variables.

Elles sont ensuite utilisable comme ceci:

    
    $('body').bind('user', function(){ console.log(  value.name +','+ user.id  ); });  
    
                ou   
      
    $('body').bind('friends', function(){
                          
      $.each(friends, function(key, value) {
                          
        console.log( value.name +','+ value.uid );
                          
      });
                          
    });
                    

[R�f�rences sur les propri�t�s disponible pour un user et les permissions
correspondantes](https://developers.facebook.com/docs/reference/api/user/)

[R�f�rences sur les propri�t�s disponible pour un
ami](https://developers.facebook.com/docs/reference/api/user/)

Pour populer un wall de post ou une liste de commentaire il faut attendre que
le init facebook soit compl�t�. Il faut aussi ajouter dans l'initialisation
**get_access_token:'1'** et attendre l'�v�nement **access_token**.

    
    $('#fb-root').easyfb().fbinit({
                    ...
                    get_access_token:'1'
                    ...
                    });

Voici un example:

    
    $('body').bind('access_token', function(){
    
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
    
                    });

  

Toutes les fonctions de la librairie sont accessibles au chargement de la page
ou sur un �v�nement (ex: onClick ).

Une fonction ayant le parammetre **'on: "click"'** sera ex�cut� seulement lors
d'un click sur l'�l�ment d�clar�. Par d�fault la fonction sera ex�cut� au
chargement de la page. Il faut donc s'assurer d'avoir en main les variables /
permissions n�cessaires avant d'ex�cuter la fonction. Example: si dans une
fonction on compte utiliser une information utilisateur provenant de la
variable user. Il faut s'assurer d'avoir attendu que la permission soit
disponible avant de d'ex�cuter la fonction.

  
Ainsi ceci:

    
    $('.login_request').easyfb().login({
                    on: 'click',
                    get_access_token: '0',
                    get_user: '1',
                    get_friends: '1',
                    perms: 'publish_stream,publish_actions',
                    success: function(){
    
    
                    $('.login_request').hide();
    
    
    
                    }
    
                    });
                

D�clanchera une demande de permission sur le click de les �l�ments
".login_request".

Les fonctions utilis�es au chargement de la page doivent pr�f�rablement �tre
utilis�es apr�s l'�v�nement 'fbinit' donc � l'int�rieur de l'�couteur
d'�venement: `$('body').bind('fbinit', function(){ ... });`

  
  
  

## Liste des fonctions disponibles



### Initialisation

  * Init : **$('#fb-root').easyfb().fbinit({ ... });**

### Login / Permissions

  * Demande de login / Permissions : **$('#login_request').easyfb().login({ ... });**

### Fonctions de base

  * Bouton J'aime : **$(".like").easyfb().like({ ... });**
  * Bouton Envoyer : **$(".send").easyfb().send({ ... });**
  * Inviter un ami : **$("#invite_friends").easyfb().inviteFriends({ ... });**
  * Partager : **$("#share").easyfb().share({ ... });**
  * Ajouter � sa liste d'ami : **$("#add_friend").easyfb().addFriend({ ... });**
  * Is Fan of the page : **$(this).easyfb().isFan({ ... });**

### Fonctions avanc�es

Fonctions n�cessitant l'ajout de **get_access_token:'1'** lors de
l'initialisation

  * Mur de post venant d'une fanpage : **$("#wall").easyfb().showWall({ ... });**
  * Mur de commentaire � partir d'une url : **$("#comment_box").easyfb().commentsBox({ ... });**

�v�nement - Fonctions n�cessitant la permission **'create_event'**.

  * Cr�er un �v�nement : **$("#create_event").easyfb().createEvent({ ... });**
  * Participer � un �v�nement : **$(".attend_event").each(function (){ ... });**

Fonctions n�cessitant la permission **'publish_actions'**.

  * Action Facebook : **$("#action").easyfb().action({ ... });**

Fonctions n�cessitant l'ajout de **jquery-ui** dans le head de la page et
**get_friends:'1'** lors de l'initialisation.

  * Champs autocompl�t� choix d'ami : **$("#friend_autocomplete").easyfb().friendAutoComplete({ ... });**
  
  
  

Green attributes are native from facebook,

Red attributes are specific to this library.

  

## Initialisation et Login / Permissions

### Initialisation de la librairie : _$("#fb-root").easyfb().fbinit({ ... });_

Initialisation de la librairie et de l'application facebook

#### Attributs:

  * `api_key` Obligatoire - ( Facebook App Api Key ),
  * `FB_lang` Obligatoire - ( Langue pour les �l�ments Facebook //en_CA = invalid //en_US = valid ),
  * `base_url` Obligatoire - ( Root url de votre code source ).
  * `perms` : '', // Si des permission sont n�cessaire au chargement de la page
  * `get_access_token` : '1', // obligatoire pour le chargement du wall of post et pour faire des 'actions' facebook
  * `set_access_token` : '...', // will set the access token from backend, utilis� pour le chargement du wall of post
  * `get_user` : '1', // obligatoire pour cr�er un �venement et pour acc�der aux donn�es de l'utilisateur
  * `get_friends` : '1', // obligatoire pour utiliser la fonction autocomplete et pour obtenir la liste des amis =&gt; var friends = friends; liste des amis dans la variable friends
  * `GA_Account` : 'UA-9999999-9', // Google analitics sera activ� si diff�rent de UA-9999999-9 ou 0
  * `tracking_prefix` : 'demo', // prefix pour Google analitics
  * `auto_resize_tab` : '1' // utilis� pour redimentionner le iframe dans une fanpage // pour �viter la scroll bar
  
R�f�rences

### Demande de login : _$('#login_request').easyfb().login({ ... });_

Dialogues combinant [FB.getLoginStatus](https://developers.facebook.com/docs/r
eference/javascript/FB.getLoginStatus/) et [FB.login](https://developers.faceb
ook.com/docs/reference/javascript/FB.login/) pour une demande de login et de
permissions

#### Attributs:

  * `on` - event(ex: 'click') on which the function is triggered base on the element in selector , if params is not present the function will be triggered on loading
  * `get_access_token` - will get the access token if this is equal to true, utilis� pour le chargement du wall of post et pour faire des 'actions' facebook
  * `set_access_token` - will set the access token from backend, utilis� pour le chargement du wall of post et pour faire des 'actions' facebook
  * `get_user` - obligatoire pour cr�er un �venement et pour acc�der aux donn�es de l'utilisateur =&gt; cr�e une variable user qui contiens les donn�es de l'utilisateur
  * `get_friends` - obligatoire pour utiliser la fonction autocomplete et pour obtenir la liste des amis =&gt; cr�e une variable user qui contiens les donn�es de l'utilisateur
  * `perms` - liste des permissions (scope) demand� par l'apps
  * `success` - fonction � ex�cuter lorsque le login est un succ�s =&gt; function(){ ... }

## Fonctions de base

### Bouton J'aime _$(".like").easyfb().like({ ... });_

G�n�re un tag �fb:like��/fb:like�

#### Attributs:

  * `on` - event on which the button is generated base on the element in selector(ex: 'click'), if params is not present the button will be generated on loading
  * `url` - the URL to like. 
  * `send` - specifies whether to include a [Send button](http://developers.facebook.com/docs/reference/plugins/send/) with the Like button. This only works with the XFBML version. 
  * `layout` - there are three options. 
    * `standard` - displays social text to the right of the button and friends' profile photos below. Minimum width: 225 pixels. Default width: 450 pixels. Height: 35 pixels (without photos) or 80 pixels (with photos). 
    * `button_count` - displays the total number of likes to the right of the button. Minimum width: 90 pixels. Default width: 90 pixels. Height: 20 pixels. 
    * `box_count` - displays the total number of likes above the button. Minimum width: 55 pixels. Default width: 55 pixels. Height: 65 pixels.
  * `show_faces` - specifies whether to display profile photos below the button (standard layout only) 
  * `width` - the width of the Like button. 
  * `action` - the verb to display on the button. Options: 'like', 'recommend' 
  * `font` - the font to display in the button. Options: 'arial', 'lucida grande', 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana' 
  * `colorscheme` - the color scheme for the like button. Options: 'light', 'dark' 
  * `ref` - a label for tracking referrals; must be less than 50 characters and can contain alphanumeric characters and some punctuation (currently +/=-.:_). The ref attribute causes two parameters to be added to the referrer URL when a user clicks a link from a stream story about a Like action: 
    * `fb_ref` - the ref parameter 
    * `fb_source` - the stream type ('home', 'profile', 'search', 'other') in which the click occurred and the story type ('oneline' or 'multiline'), concatenated with an underscore.
  
[R�f�rences](https://developers.facebook.com/docs/reference/plugins/like/)

### Bouton Envoyer : _$(".send").easyfb().send({ ... });_

G�n�re un tag �fb:send��/fb:send�

#### Attributs:

  * `on` - event on which the button is generated base on the element in selector(ex: 'click'), if params is not present the button will be generated on loading
  * `url` - the URL to send. 
  * `font` - the font to display in the button. Options: 'arial', 'lucida grande', 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana' 
  * `colorscheme` - the color scheme for the button. Options: 'light', 'dark' 
  * `ref` - a label for tracking referrals; must be less than 50 characters and can contain alphanumeric characters and some punctuation (currently +/=-.:_). The ref attribute causes two parameters to be added to the referrer URL when a user clicks a link from a stream story about a Send action: 
    * `fb_ref` - the ref parameter 
    * `fb_source` - the story type ('message', 'group', 'email') in which the click occurred.
  
[R�f�rences](http://developers.facebook.com/docs/reference/plugins/send/)

### Inviter un ami : _$("#invite_friends").easyfb().inviteFriends({ ... });_

Dialogues d'invitation de plusieurs amis utilisant
[FB.ui](https://developers.facebook.com/docs/reference/javascript/FB.ui/)
(envoi une notification avec un liens vers votre canevas url)

#### Attributs:

  * `on` - event(ex: 'click') on which the function is triggered base on the element in selector , if params is not present the function will be triggered on loading
  * `message` - The request the receiving user will see. It appears as a question posed by the sending user. The maximum length is 255 characters.
  * `data` - Optional, additional data you may pass for tracking. This will be stored as part of the request objects created. The maximum length is 255 characters.
  * `title` - Optional, the title for the friend selector dialog. Maximum length is 50 characters. 
  * `to` - Optional, A user ID or username. This may or may not be a friend of the user. If this is specified, the user will not have a choice of recipients. If this is omitted, the user will see a friend selector and will be able to select a maximum of 50 recipients. (Due to URL length restrictions, the maximum number of recipients is 25 in IE7 and also in IE8+ when using a non-iframe dialog.) 
  * `filters` - Optional, default is '', which shows a selector that includes the ability for a user to browse all friends, but also filter to friends using the application and friends not using the application. Can also be all, app_users and app_non_users. This controls what set of friends the user sees if a friend selector is shown. If all, app_users ,or app_non_users is specified, the user will only be able to see users in that list and will not be able to filter to another list. Additionally, an application can suggest custom filters as dictionaries with a name key and a user_ids key, which respectively have values that are a string and a list of user ids. name is the name of the custom filter that will show in the selector. user_ids is the list of friends to include, in the order they are to appear. 
  * `exclude_ids` - Optional, A array of user IDs that will be excluded from the dialog, for example: exclude_ids: [1, 2, 3]   
If a user is excluded from the dialog, the user will not show in the friend
selector.

  * `max_recipients` - Optional, An integer that specifies the maximum number of friends that can be chosen by the user in the friend selector. 
  
[R�f�rences](https://developers.facebook.com/docs/reference/dialogs/requests/)

### Partager : _$("#share").easyfb().share({ ... });_

Dialogues d'invitation de plusieurs amis utilisant
[FB.ui](https://developers.facebook.com/docs/reference/javascript/FB.ui/)
(envoi une notification avec un liens vers votre canevas url)

#### Attributs:

  * `on` - event(ex: 'click') on which the function is triggered base on the element in selector , if params is not present the function will be triggered on loading
  * `from` - The ID or username of the user posting the message. If this is unspecified, it defaults to the current user. If specified, it must be the ID of the user or of a page that the user administers.
  * `to` - The ID or username of the profile that this story will be published to. If this is unspecified, it defaults to the the value of from.
  * `message` - This field will be ignored on July 12, 2011 The message to prefill the text field that the user will type in. To be compliant with Facebook Platform Policies, your application may only set this field if the user manually generated the content earlier in the workflow. Most applications should not set this.
  * `link` - The link attached to this post
  * `picture` - The URL of a picture attached to this post. The picture must be at least 50px by 50px and have a maximum aspect ratio of 3:1
  * `source` - The URL of a media file (e.g., a SWF or video file) attached to this post. If both source and picture are specified, only source is used.
  * `name` - The name of the link attachment.
  * `caption` - The caption of the link (appears beneath the link name).
  * `description` - The description of the link (appears beneath the link caption).
  * `properties` - A JSON object of key/value pairs which will appear in the stream attachment beneath the description, with each property on its own line. Keys must be strings, and values can be either strings or JSON objects with the keys text and href.
  * `actions` - A JSON array of action links which will appear next to the "Comment" and "Like" link under posts. Each action link should be represented as a JSON object with keys name and link.
  * `ref` - A text reference for the category of feed post. This category is used in Facebook Insights to help you measure the performance of different types of post
  
[R�f�rences](https://developers.facebook.com/docs/reference/dialogs/feed/)

### Ajouter � sa liste d'ami : _$("#add_friend").easyfb().addFriend({ ... });_

Dialogues d'ajout � sa liste d'amis utilisant
[FB.ui](https://developers.facebook.com/docs/reference/javascript/FB.ui/)
(envoi une demande d'amiti�)

#### Attributs:

  * `on` - event(ex: 'click') on which the function is triggered base on the element in selector , if params is not present the function will be triggered on loading
  * `redirect_uri` - The URL to redirect to after the user clicks a button on the dialog. Required, but automatically specified by most SDKs.
  
[R�f�rences](https://developers.facebook.com/docs/reference/dialogs/friends/)

### Is Fan of the page : _$(this).easyfb().isFan({ ... });_

Requ�te utilisant
[FB.api](https://developers.facebook.com/docs/reference/javascript/FB.api/)
pour v�rifier si l'utilisateur like une page facebook.

#### Attributs:

  * `on` - event(ex: 'click') on which the function is triggered base on the element in selector , if params is not present the function will be triggered on loading
  * `page_id` Obligatoire - id de la page � tester
  * `success` - Optionel - fonction ex�cut� si la personne est fan. Ex: function(){ ... })
  * `fail` - Optionel - fonction ex�cut� si la personne n'est pas fan. Ex: function(){ ... })

## Fonctions avanc�es

  

### Fonctions n�cessitant l'ajout de _get_access_token:'1'_ lors de
l'initialisation

### Mur de post venant d'une fanpage : _$("#wall").easyfb().showWall({ ...
});_

Requ�te utilisant
[FB.api](https://developers.facebook.com/docs/reference/javascript/FB.api/)
pour populer un wall de post d'une page facebook. 'get_access_token' dans la
fonction init est requis pour utiliser cette fonction, optionellement
'set_access_token' peut fournir un token � partir du backend. Cette fonction
permet de pouvoir skinner totalement le wall par css.

#### Attributs:

  * `nb` Obligatoire - nombre de post � afficher
  * `feed` Obligatoire - url d'un feed sur https://graph.facebook.com/... id de la page .../feed 
  * `loading_message` Message pendant le chargement 
  * `timeout` Timeout en tick - par d�fault : 25000 
  
[Graph Explorer](https://developers.facebook.com/tools/explorer/?method=GET&amp;pa
th=706847059)

[Api graph Page Feed
References](https://developers.facebook.com/docs/reference/api/page/)

### Mur de commentaire : _$("#wall").easyfb().commentsBox({ ... });_

Requ�te utilisant
[FB.api](https://developers.facebook.com/docs/reference/javascript/FB.api/)
pour populer un wall de post d'une page facebook. 'get_access_token' dans la
fonction init est requis pour utiliser cette fonction. Cette fonction permet
de pouvoir skinner totalement le wall par css.

#### Attributs:

  * `nb` Obligatoire - nombre de post � afficher
  * `feed` Obligatoire - url d'un feed de commentaire sur https://graph.facebook.com/comments/?ids=**http://www.example.como_by=created_time&amp;since;=2011-07-22&amp; **
  * `loading_message` Message pendant le chargement 
  * `timeout` Timeout en tick - par d�fault : 25000 
  
[Graph Explorer](https://developers.facebook.com/tools/explorer/?method=GET&amp;pa
th=706847059)

[Api graph Page Feed
References](https://developers.facebook.com/docs/reference/api/page/)

### �v�nement - Fonctions n�cessitant la permission _'create_event'_.

  

### Cr�er un �v�nement : _$("#create_event").easyfb().createEvent({ ... });_

Requ�te utilisant
[FB.api](https://developers.facebook.com/docs/reference/javascript/FB.api/)
pour cr�er un �v�nement sur votre profil facebook.

#### Attributs:

  * `on` - event(ex: 'click') on which the function is triggered base on the element in selector , if params is not present the function will be triggered on loading
  * `name` Obligatoire - nom de l'�v�nement
  * `location` Obligatoire - ville ou emplacement de l'�v�nement
  * `description` Obligatoire - Description de l'�v�nement 
  * `start_time` Obligatoire - Moment du d�but de l'activit� en temps ISO-8601 ou UNIX timestamp
  * `end_time` Optionel - Moment du fin de l'activit� en temps ISO-8601 ou UNIX timestamp
  * `privacy` Optionel - containing 'OPEN'( par default ), 'CLOSED', or 'SECRET' 
  
Plus d'option [ici](http://developers.facebook.com/docs/reference/api/event/)

  

### Participer � un �v�nement : _$(".attend_event").each(function (){ ... });_

Requ�te utilisant
[FB.api](https://developers.facebook.com/docs/reference/javascript/FB.api/)
pour s'inscrire � un �v�nement sur votre profil facebook.

#### Attributs:

  * `on` - event(ex: 'click') on which the function is triggered base on the element in selector , if params is not present the function will be triggered on loading
  * `id` Obligatoire - id de l'�v�nement facebook

### Fonctions n�cessitant la permission 'publish_actions'.

  

### Action Facebook : _$("#action").easyfb().action({ ... });_

Requ�te utilisant
[FB.api](https://developers.facebook.com/docs/reference/javascript/FB.api/)
pour faire des [actions
facebook](https://developers.facebook.com/docs/beta/opengraph/) en utlisant le
[nouveau timeline](https://blog.facebook.com/blog.php?post=10150408488962131).
N�cessite d'avoir pr�abalement [cr�� des actions dans votre
app](https://developers.facebook.com/docs/beta/opengraph/tutorial/). Une
action utilise des
[objets](https://developers.facebook.com/docs/beta/opengraph/define-objects/),
des [actions](https://developers.facebook.com/docs/beta/opengraph/define-
actions/) et s'affiche avec des
[agr�gations](https://developers.facebook.com/docs/beta/opengraph/define-
units/). Pour utiliser les actions avec cette librairie il est n�cessaire
d'ajouter les meta tag particulier dans le head pour une page objet pour que
cela fonctionne.

  
Ex:

` �meta property="fb:app_id" content="APP_ID" /�

�meta property="og:type" content="NAMESPACE:OBJET" /�

�meta property="og:title" content="TITRE DE L'OBJET" /�

�meta property="og:image" content="URL D'IMAGE" /�

�meta property="og:description" content="DESCRIPTION" /�

�meta property="og:url" content="URL DE L'OBJET EX:action.php?object=�?=
$OBJET ?�"� `

  
Une fois les actions, objets, agr�gations et page objet cr�� cette fonction
simplifiera le processus d'ex�cution des actions sur facebook.

#### Attributs:

  * `on` - event(ex: 'click') on which the function is triggered base on the element in selector , if params is not present the function will be triggered on loading
  * `app_namespace` Obligatoire - le namespace de votre app dans [facebook developers](https://developers.facebook.com/apps)
  * `action` Obligatoire - le nom de votre action (Action Type Name)
  * `object` Obligatoire - le nom de votre objet (Object Type Name)
  * `object_url` Obligatoire - l'url de votre page objet
  
[R�f�rence sur les objets facebook](https://developers.facebook.com/docs/beta/
opengraph/objects/builtin/)

[Object url debugger](https://developers.facebook.com/tools/debug)

  

### Champs autocompl�t� choix d'ami :
_$("#friend_autocomplete").easyfb().friendAutoComplete({ ... });_

Fonctions n�cessitant l'ajout de **jquery-ui** dans le head de la page et
**get_friends:'1'** lors de l'initialisation.

Cette fonction cr�e un champs autocompl�t� avec la liste des amis por facilit�
le choix d'un ami pour la soumission dans un formulaire. La fonction g�n�re
deux champ input: l'un pour le nom de l'ami et l'autre pour le id facebook de
cet ami. Le 'name' et 'id' des champs inputs sont param�trable dans les
options de la fonction. N�cessite l'ajout de ces tag dans le head de la page:

  
`�script type="text/javascript"
src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.js"��
/script�

�link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base
/jquery-ui.css" rel="stylesheet" type="text/css"/� `

#### Attributs:

  * `input_name` Obligatoire - nom de l'input g�n�r� pour le nom de l'ami selectionn�
  * `input_facebook_id` Obligatoire - nom de l'input g�n�r� pour l'id facebook de l'ami selectionn�

[Etienne Dion (C) 2011](http://etiennedion.com)

