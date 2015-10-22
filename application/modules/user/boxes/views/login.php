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
    <?php /*
    <link rel="stylesheet" href="<?php echo BASE_URL.'/application/modules/user/static/css/reset.css'; ?>"> <!-- CSS reset -->
    <link rel="stylesheet" href="<?php echo BASE_URL.'/application/modules/user/static/css/style.css'; ?>"> <!-- Gem style -->
    <script src="<?php echo BASE_URL.'/application/modules/user/static/js/modernizr.js'; ?>"></script> <!-- Modernizr -->
     */
    ?>
    <form action="" class="form-horizontal" method="post">
        <?=$this->getTokenField();
        $errors = $this->get('errors');
        ?>
        <div class="form-group">
            <div class="col-lg-12">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                    <input name="loginbox_emailname"
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
                    <input name="loginbox_password"
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
    <a href="<?=$this->getUrl(array('module' => 'user', 'controller' => 'login', 'action' => 'forgotpassword')) ?>"><?=$this->getTrans('forgotPassword') ?></a>
	<?php /*
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
                            <a href="#" onclick="fb_login();"><img src="<?php echo BASE_URL.'/application/modules/user/static/images/facebook/fb.png'; ?>"/></a><br/>
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
         */ ?>   
<?php endif; ?>
