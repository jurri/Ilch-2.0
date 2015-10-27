<?php $config = \Ilch\Registry::get('config'); ?>


<?php
define('FACEBOOK_SDK_V4_SRC_DIR', APPLICATION_PATH .'/modules/user/static/fb/src/Facebook/');
require( APPLICATION_PATH . '/modules/user/static/fb/src/Facebook/autoload.php');
//require_once __DIR__ . '/path/to/facebook-php-sdk-v4/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '1494626184167624',
  'app_secret' => 'c86c8c5b925b77a4378c75e5ed23b5c6',
  'default_graph_version' => 'v2.4',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://example.com/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
/*
?>

<!-- facebook login -->
<script> 
function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
        if (response.status === 'connected') {
            console.log(response.authResponse.accessToken);
        }
    });
}
    
window.fbAsyncInit = function() {
    FB.init({
        appId   : '<?=$config->get('facebook_appID') ?>', //1494626184167624
        xfbml   : true,
        version : 'v2.5',
        oauth   : true,
        status  : true, // check login status
        cookie  : true, // enable cookies to allow the server to access the session
    });
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));
     
function fb_login(){
    FB.login(function(response) {
        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            //console.log(response); // dump complete info
            access_token = response.authResponse.accessToken; //get access token
            user_id = response.authResponse.userID; //get FB UID

            FB.api('/me', function(response) {
                user_email = response.email; //get user email you can store this data into your database             
            });
        } else {
            //user hit cancel button
            console.log('User cancelled login or did not fully authorize.');
        }
    }, {
        scope: 'public_profile,publish_stream,email'
    });
}
/*
(function() {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
}()); 
*/
?>
<!--/script-->

<!-- Google+ login -->
<script src="https://apis.google.com/js/api:client.js"></script>
<script>
var googleUser = {};
var startApp = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
        auth2 = gapi.auth2.init({
            client_id: '<?=$config->get('google_appSecret') ?>-<?=$config->get('google_appID') ?>.apps.googleusercontent.com',
            cookiepolicy: 'single_host_origin',
            // Request scopes in addition to 'profile' and 'email'
            //scope: 'additional_scope'
        });
        attachSignin(document.getElementById('customBtn'));
    });
};

function attachSignin(element) {
    console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUser) {
            document.getElementById('name').innerText = "Signed in: " +
            googleUser.getBasicProfile().getName();
        }, function(error) {
            alert(JSON.stringify(error, undefined, 2));
        }
    );
}
</script>
  
<?php if($this->getUser() == null): ?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title"><?=$this->getTrans('menuLogin') ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4" >
                <?php if ($config->get('google_login') == 1): ?>
                <div id="gSignInWrapper">   
                    <div id="customBtn" class="customGPlusSignIn">
                        <img src="<?=$this->getModuleUrl('static/images/google/gplus.png') ?>" />
                    </div>
                </div>
                <div id="name"></div>
                <script>startApp();</script>
                <?php endif; ?>
                <?php if ($config->get('facebook_login') == 1): ?>
                <a href="#" onclick="fb_login();"><img src="<?=$this->getModuleUrl('static/images/facebook/fb.png') ?>"/></a><br/>
                <?php endif; ?>
                <?php if ($config->get('twitter_login') == 1): ?>
                <a href="#"><img src="<?=$this->getModuleUrl('static/images/twitter/tw.png') ?>" /></a>
                <?php endif; ?>
            </div>
            <div class="col-md-8" style="border-left:1px solid #ccc;height:160px">
                <div class="col-md-12">
                    <form class="form-horizontal" action="" method="post">
                        <?=$this->getTokenField() ?>
                        <?php $errors = $this->get('errors'); ?>
                        <fieldset>
                            <div class="form-group <?php if (!empty($errors['loginContent_emailname'])) { echo 'has-error'; }; ?>">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                                    <input class="form-control"
                                           name="loginContent_emailname"
                                           type="text"
                                           placeholder="<?=$this->getTrans('nameEmail') ?>" />
                                    <?php if (!empty($errors['loginContent_emailname'])): ?>
                                        <span class="help-inline"><?=$this->getTrans($errors['loginContent_emailname']) ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>         
                            <!--div class="spacing"><input type="checkbox" name="checkboxes" id="checkboxes-0" value="1"><small> Remember me</small></div-->                    
                            <div class="form-group <?php if (!empty($errors['loginContent_password'])) { echo 'has-error'; }; ?>">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                    <input class="form-control"
                                           name="loginContent_password"
                                           type="password"
                                           placeholder="<?=$this->getTrans('password') ?>" />
                                    <?php if (!empty($errors['loginContent_password'])): ?>
                                        <span class="help-inline"><?=$this->getTrans($errors['loginContent_password']) ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="spacing">
                                <a href="<?=$this->getUrl(array('module' => 'user', 'controller' => 'login', 'action' => 'forgotpassword')) ?>"><?=$this->getTrans('forgotPassword') ?></a><br />
                                <a href="<?=$this->getUrl(array('module' => 'user', 'controller' => 'regist', 'action' => 'confirm')) ?>">Die Aktivierung Manuell freischalten</a>
                            </div>
                            <!--fb:login-button class="btn" scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button-->
                            <input type="submit" 
                                   name="login" 
                                   class="btn btn-info btn-sm pull-right" 
                                   value="<?=$this->getTrans('login') ?>" />
                        </fieldset>
                    </form>
                </div>  
            </div>
        </div>  
    </div>
    <div class="panel-footer">
    <?php if ($this->get('regist_accept') == '1'): ?>
        <legend><?=$this->getTrans('menuRegist') ?></legend>
        <p>
            Die Registrierung ist in wenigen Augenblicken erledigt und ermöglicht ihnen, auf weitere Funktionen zuzugreifen. Die Administration kann registrierten Benutzern auch zusätzliche Berechtigungen zuweisen.
        </p>
        <p>
            <a href="<?=$this->getUrl(array('module' => 'user', 'controller' => 'regist', 'action' => 'index')) ?>" class="btn btn-default pull-left">
                <?=$this->getTrans('register') ?>
            </a>
        </p>
    <?php endif; ?>
    </div>
</div>
<?php endif; ?>