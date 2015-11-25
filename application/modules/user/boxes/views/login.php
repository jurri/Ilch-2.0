<?php if($this->getUser() !== null): ?>
    <?=$this->getTrans('hello') ?> <b><?=$this->escape($this->getUser()->getName()) ?></b>,
    <br />
    <a href="<?=$this->getUrl(array('module' => 'user', 'controller' => 'panel', 'action' => 'index')) ?>">
        <?=$this->getTrans('panel') ?>
    </a>
    <br />
    <?php if($this->getUser()->isAdmin()): ?>
        <a target="_blank" href="<?=$this->getUrl(array('module' => 'admin', 'controller' => 'admin', 'action' => 'index')) ?>">
            <?=$this->getTrans('adminarea') ?>
        </a>
        <br />
    <?php endif; ?>
    <a href="<?=$this->getUrl(array('module' => 'admin/admin', 'controller' => 'login', 'action' => 'logout', 'from_frontend' => 1)) ?>">
        <?=$this->getTrans('logout') ?>
    </a>
<?php else: ?>

    <form action="<?=$this->getUrl(array('module' => 'user', 'controller' => 'login', 'action' => 'index')) ?>" class="form-horizontal" method="post">
        <input type="hidden" name="login_redirect_url" value="<?=$this->get('redirectUrl')?>" />

<?php
    require( APPLICATION_PATH . '/modules/user/static/fb/config.php');
require( APPLICATION_PATH . '/modules/user/static/fb/functions.php');
//destroy facebook session if user clicks reset
if(!$fbuser){
    $fbuser = null;
    $loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
    $output = '<a href="'.$loginUrl.'"><img src="'.BASE_URL.'/application/modules/user/static/images/facebook/fb.png'.'"></a><br/>'; 
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
    <link rel="stylesheet" href="<?php echo BASE_URL.'/application/modules/user/static/css/reset.css'; ?>"> <!-- CSS reset -->
    <link rel="stylesheet" href="<?php echo BASE_URL.'/application/modules/user/static/css/style.css'; ?>"> <!-- Gem style -->
    <script src="<?php echo BASE_URL.'/application/modules/user/static/js/modernizr.js'; ?>"></script> <!-- Modernizr -->
        
    <form action="" class="form-horizontal" method="post">
        <?=$this->getTokenField();
        $errors = $this->get('errors');
        ?>
        <div class="form-group">
            <div class="col-lg-12">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                    <input name="login_emailname"
                           class="form-control"
                           type="text"
                           placeholder="<?=$this->getTrans('nameEmail') ?>" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span>
                    <input name="login_password"
                           class="form-control"
                           type="password"
                           placeholder="<?=$this->getTrans('password') ?>" />
                </div>
            </div>
        </div>
        <div class="form-group">
             <div class="col-lg-12">
                <nav class="main-nav">
                    <button type="button" class="cd-signin btn btn-primary btn-block">SocialMedia</button>
		</nav>   
                <br>
                <button type="submit" class="btn btn-primary btn-block" name="login">
                    <?=$this->getTrans('login') ?>
                </button>
                <?php if ($this->get('regist_accept') == '1'): ?>
                    <a class="btn btn-default btn-block" href="<?=$this->getUrl(array('module' => 'user', 'controller' => 'regist', 'action' => 'index')) ?>"><?=$this->getTrans('register') ?></a>
                <?php endif; ?>
             </div>
        </div>
    </form>

    <?php if ($this->get('regist_accept') == '1'): ?>
        <a href="<?=$this->getUrl(array('module' => 'user', 'controller' => 'regist', 'action' => 'index')); ?>"><?=$this->getTrans('register'); ?></a><br />
    <?php endif; ?>
    <a href="<?=$this->getUrl(array('module' => 'user', 'controller' => 'login', 'action' => 'forgotpassword')) ?>"><?=$this->getTrans('forgotPassword') ?></a>
	
        <div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
		<div class="cd-user-modal-container"> <!-- this is the container wrapper -->
			<ul class="cd-switcher">
				<li><a href="#0">Social Login</a></li>
				<li><a href="#0">Sign in</a></li>
			</ul>

			<div id="cd-login"> <!-- log in form -->
                            <div id="gSignInWrapper">   
                                <div id="customBtn" class="customGPlusSignIn">
                                    <img src="<?php echo BASE_URL.'/application/modules/user/static/images/google/gplus.png'; ?>" />
                                </div>
                            </div>
                            <div id="name"></div>
                            <script>startApp();</script>
                            <?php echo $output; ?>
                            <a href="#"><img src="<?php echo BASE_URL.'/application/modules/user/static/images/twitter/tw.png'; ?>" /></a>
                          
			</div> <!-- cd-login -->

			<div id="cd-signup"> <!-- sign up form -->
                            <form class="cd-form" action="" method="post">
                                <?=$this->getTokenField() ?>
                                <?php $errors = $this->get('errors'); ?>
                                <fieldset>
                                    <div class="form-group <?php if (!empty($errors['loginContent_emailname'])) { echo 'has-error'; }; ?>">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                                            <input name="loginbox_emailname"
                                                   class="form-control"
                                                   type="text"
                                                   placeholder="<?=$this->getTrans('nameEmail') ?>" />
                                            <?php if (!empty($errors['loginContent_emailname'])): ?>
                                                <span class="help-inline"><?=$this->getTrans($errors['loginContent_emailname']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>         
                                    <div class="form-group <?php if (!empty($errors['loginContent_password'])) { echo 'has-error'; }; ?>">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                            <input name="loginbox_password"
                                                   class="form-control"
                                                   type="password"
                                                   placeholder="<?=$this->getTrans('password') ?>" />
                                            <?php if (!empty($errors['loginContent_password'])): ?>
                                                <span class="help-inline"><?=$this->getTrans($errors['loginContent_password']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="spacing">
                                        <a href="<?=$this->getUrl(array('module' => 'user', 'controller' => 'regist', 'action' => 'confirm')) ?>">Die Aktivierung Manuell freischalten</a>
                                    </div>
                                    <p class="fieldset">
                                        <button type="submit" class="btn btn-primary btn-block" name="login">
                                            <?=$this->getTrans('login') ?>
                                        </button>  
                                    </p>
                                </fieldset>
                                <p class="cd-form-bottom-message">
                                    <a href="<?=$this->getUrl(array('module' => 'user', 'controller' => 'login', 'action' => 'forgotpassword')) ?>"><?=$this->getTrans('forgotPassword') ?></a><br />
                                </p>
                            </form>
			</div> <!-- cd-signup -->
		</div> <!-- cd-user-modal-container -->
	</div> <!-- cd-user-modal -->       
    <script src="<?php echo BASE_URL.'/application/modules/user/static/js/main.js'; ?>"></script> <!-- Gem jQuery -->  
          
<?php endif; ?>
