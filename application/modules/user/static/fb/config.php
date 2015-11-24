<?php $config = \Ilch\Registry::get('config'); ?>
<?php
require( APPLICATION_PATH . '/modules/user/static/fb/facebook.php'); //include facebook SDK
######### Facebook API Configuration ##########
$appId = $config->get('facebook_appID'); //Facebook App ID
$appSecret = $config->get('facebook_appSecret'); // Facebook App Secret
$homeurl = 'http://treehawk.de/_hp/ds/index.php/user/login/fblogin';//APPLICATION_PATH;  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret
));
$fbuser = $facebook->getUser();
?>