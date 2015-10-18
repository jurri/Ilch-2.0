<link rel="stylesheet" href="<?php echo BASE_URL.'/application/modules/user/static/css/reset.css'; ?>"> <!-- CSS reset -->
	<link rel="stylesheet" href="<?php echo BASE_URL.'/application/modules/user/static/css/style.css'; ?>"> <!-- Gem style -->
	<script src="<?php echo BASE_URL.'/application/modules/user/static/js/modernizr.js'; ?>"></script> <!-- Modernizr -->

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
                    <a class="cd-signin btn btn-primary" href="#0">SocialMedia</a>
		</nav>     
                <button type="submit" class="btn btn-primary" name="login">
                    <?=$this->getTrans('login') ?>
                </button>
                <?php if ($this->get('regist_accept') == '1'): ?>
                    <a class="btn btn-default" href="<?=$this->getUrl(array('module' => 'user', 'controller' => 'regist', 'action' => 'index')) ?>"><?=$this->getTrans('register') ?></a>
                <?php endif; ?>
             </div>
        </div>
        <!--div class="form-group">
             <div class="col-lg-12">
                <fb:login-button class="btn" scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
             </div>
        </div-->
    </form>
    <a href="<?=$this->getUrl(array('module' => 'user', 'controller' => 'login', 'action' => 'forgotpassword')) ?>"><?=$this->getTrans('forgotPassword') ?></a>
    

	

	<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
		<div class="cd-user-modal-container"> <!-- this is the container wrapper -->
			<ul class="cd-switcher">
				<li><a href="#0">Sign in</a></li>
				<li><a href="#0">New account</a></li>
			</ul>

			<div id="cd-login"> <!-- log in form -->
				<form class="cd-form">
					<p class="fieldset">
						<label class="image-replace cd-email" for="signin-email">E-mail</label>
						<input class="full-width has-padding has-border" id="signin-email" type="email" placeholder="E-mail">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<label class="image-replace cd-password" for="signin-password">Password</label>
						<input class="full-width has-padding has-border" id="signin-password" type="text"  placeholder="Password">
						<a href="#0" class="hide-password">Hide</a>
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<input type="checkbox" id="remember-me" checked>
						<label for="remember-me">Remember me</label>
					</p>

					<p class="fieldset">
						<input class="full-width" type="submit" value="Login">
					</p>
				</form>
				
				<p class="cd-form-bottom-message"><a href="#0">Forgot your password?</a></p>
				<!-- <a href="#0" class="cd-close-form">Close</a> -->
			</div> <!-- cd-login -->

			<div id="cd-signup"> <!-- sign up form -->
				<form class="cd-form">
					<p class="fieldset">
						<label class="image-replace cd-username" for="signup-username">Username</label>
						<input class="full-width has-padding has-border" id="signup-username" type="text" placeholder="Username">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<label class="image-replace cd-email" for="signup-email">E-mail</label>
						<input class="full-width has-padding has-border" id="signup-email" type="email" placeholder="E-mail">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<label class="image-replace cd-password" for="signup-password">Password</label>
						<input class="full-width has-padding has-border" id="signup-password" type="text"  placeholder="Password">
						<a href="#0" class="hide-password">Hide</a>
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<input type="checkbox" id="accept-terms">
						<label for="accept-terms">I agree to the <a href="#0">Terms</a></label>
					</p>

					<p class="fieldset">
						<input class="full-width has-padding" type="submit" value="Create account">
					</p>
				</form>

				<!-- <a href="#0" class="cd-close-form">Close</a> -->
			</div> <!-- cd-signup -->

			<div id="cd-reset-password"> <!-- reset password form -->
				<p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>

				<form class="cd-form">
					<p class="fieldset">
						<label class="image-replace cd-email" for="reset-email">E-mail</label>
						<input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<input class="full-width has-padding" type="submit" value="Reset password">
					</p>
				</form>

				<p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
			</div> <!-- cd-reset-password -->
			<a href="#0" class="cd-close-form">Close</a>
		</div> <!-- cd-user-modal-container -->
	</div> <!-- cd-user-modal -->
        
        
<script src="<?php echo BASE_URL.'/application/modules/user/static/js/main.js'; ?>"></script> <!-- Gem jQuery -->   
    
    
<?php endif; ?>
