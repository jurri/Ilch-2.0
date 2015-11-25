<?php $config = \Ilch\Registry::get('config'); ?>
<?php
require( APPLICATION_PATH . '/modules/user/static/fb/config.php');
require( APPLICATION_PATH . '/modules/user/static/fb/functions.php');
//destroy facebook session if user clicks reset
if(!$fbuser){
    $fbuser = null;
    $loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
    $output = '<a href="'.$loginUrl.'"><img src="'.$this->getModuleUrl('static/images/facebook/fb.png').'"></a><br/>'; 	
}else{
    $user_profile = $facebook->api('/me?fields=id,first_name,last_name,email,picture');
    $user = new Users();
    $user_data = $user->checkUser('facebook',
            $user_profile['id'],
            $user_profile['first_name'],
            $user_profile['last_name'],
            $user_profile['email'],
            $user_profile['picture']['data']['url']);
    if(!empty($user_data)){
        $output = '<h1>Facebook Profile Details </h1>';
        $output .= '<img src="'.$user_data['picture'].'">';
        $output .= '<br/>Facebook ID : ' . $user_data['oauth_uid'];
        $output .= '<br/>Name : ' . $user_data['fname'].' '.$user_data['lname'];
        $output .= '<br/>Email : ' . $user_data['email'];
        //$output .= '<br/>Gender : ' . $user_data['gender'];
        //$output .= '<br/>Locale : ' . $user_data['locale'];
        $output .= '<br/>You are login with : Facebook';
        $output .= '<br/>Logout from <a href="'.$this->getModuleUrl('static/fb/logout.php').'">LogOut</a>'; 
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
}
?>

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
    <legend><?=$this->getTrans('menuLogin') ?></legend>
    <form class="form-horizontal" action="" method="post">
        <?=$this->getTokenField() ?>
        <input type="hidden" name="login_redirect_url" value="<?=$this->get('redirectUrl');?>" />
        <?php $errors = $this->get('errors'); ?>
        <div class="form-group <?php if (!empty($errors['login_emailname'])) { echo 'has-error'; }; ?>">
            <label for="login_emailname" class="col-lg-2 control-label">
                <?=$this->getTrans('nameEmail') ?>:
            </label>
            <div class="col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                    <input class="form-control"
                           name="login_emailname"
                           id="login_emailname"
                           type="text" />
                    <?php if (!empty($errors['login_emailname'])): ?>
                        <span class="help-inline"><?=$this->getTrans($errors['login_emailname']) ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="form-group <?php if (!empty($errors['login_password'])) { echo 'has-error'; }; ?>">
            <label for="login_password" class="col-lg-2 control-label">
                <?=$this->getTrans('password') ?>:
            </label>
            <div class="col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span>
                    <input class="form-control"
                           name="login_password"
                           id="login_password"
                           type="password" />
                    <?php if (!empty($errors['login_password'])): ?>
                        <span class="help-inline"><?=$this->getTrans($errors['login_password']) ?></span>
                    <?php endif; ?>
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
                <?php echo $output; ?>
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
