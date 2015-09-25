<!-- Platzieren Sie dieses asynchrone JavaScript unmittelbar vor Ihrem </body>-Tag -->
<script type="text/javascript">
    (function() {
        var po = document.createElement('script'); 
        po.type = 'text/javascript'; 
        po.async = true;
        po.src = 'https://apis.google.com/js/client:plusone.js';
        var s = document.getElementsByTagName('script')[0]; 
        s.parentNode.insertBefore(po, s);
    })();
     
    function signinCallback(authResult) {
        if (authResult['access_token']) {
        // Autorisierung erfolgreich
        // Nach der Autorisierung des Nutzers nun die Anmeldeschaltfläche ausblenden, zum Beispiel:
            document.getElementById('signinButton').setAttribute('style', 'display: none');
        } else if (authResult['error']) {
        // Es gab einen Fehler.
        // Mögliche Fehlercodes:
        //   "access_denied" – Der Nutzer hat den Zugriff für Ihre App abgelehnt.
        //   "immediate_failed" – Automatische Anmeldung des Nutzers ist fehlgeschlagen.
        // console.log('Es gab einen Fehler: ' + authResult['Fehler']);
        }
    }
</script>
    
<script type="text/javascript">
    function disconnectUser(access_token) {
        var revokeUrl = 'https://accounts.google.com/o/oauth2/revoke?token=' +
        access_token;

      // Führen Sie einen asynchrone GET-Anfrage durch.
        $.ajax({
            type: 'GET',
            url: revokeUrl,
            async: false,
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(nullResponse) {
            // Führen Sie jetzt nach der Trennung des Nutzers eine Aktion durch.
            // Die Reaktion ist immer undefiniert.
            },
            error: function(e) {
            // Handhaben Sie den Fehler.
            // console.log(e);
            // Wenn es nicht geklappt hat. könnten Sie Nutzer darauf hinweisen, wie die manuelle Trennung erfolgt.
            // https://plus.google.com/apps
            }
        });
    }
// Sie könnten die Trennung über den Klick auf eine Schaltfläche auslösen.
    $('#revokeButton').click(disconnectUser);
</script>

<?php if($this->getUser() == null): ?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title"><?=$this->getTrans('menuLogin') ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4" >
                
                <span id="signinButton">
                    <span
                      class="g-signin"
                      data-callback="signinCallback"
                      data-clientid="532260975165-7cb2to2sdrnav7i3ul8gch18o24mq9vn.apps.googleusercontent.com"
                      data-cookiepolicy="single_host_origin"
                      data-requestvisibleactions="http://schemas.google.com/AddActivity"
                      data-scope="https://www.googleapis.com/auth/plus.login">
                    </span>
                </span>
                
                <a href="#"><img src="<?=$this->getModuleUrl('static/images/facebook/fb.png') ?>"/></a><br/>
                <a href="#"><img src="<?=$this->getModuleUrl('static/images/google/gplus.png') ?>" /></a><br/>
                <a href="#"><img src="<?=$this->getModuleUrl('static/images/twitter/tw.png') ?>" /></a>
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
            Die Registrierung ist in wenigen Augenblicken erledigt und ermÃ¶glicht ihnen, auf weitere Funktionen zuzugreifen. Die Administration kann registrierten Benutzern auch zusÃ¤tzliche Berechtigungen zuweisen.
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