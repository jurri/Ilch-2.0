<?php
require( APPLICATION_PATH . '/modules/user/static/fb/facebook.php'); //include facebook SDK
######### Facebook API Configuration ##########
$appId = '968563509849818'; //Facebook App ID
$appSecret = '92dd22daefd4b5b5bd934b4827430032'; // Facebook App Secret
$homeurl = 'http://treehawk.de/_hp/_dev/fblogin/';  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret
));
$fbuser = $facebook->getUser();
?>