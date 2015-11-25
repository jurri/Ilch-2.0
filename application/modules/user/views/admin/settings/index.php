<legend><?=$this->getTrans('menuSettings') ?></legend>
<form class="form-horizontal" method="POST" action="<?=$this->getUrl(array('action' => $this->getRequest()->getActionName())) ?>">
    <?=$this->getTokenField() ?>
    <div class="form-group">
        <label for="regist_accept" class="col-lg-2 control-label">
            <?=$this->getTrans('acceptUserRegis') ?>:
        </label>
        <div class="col-lg-4">
            <div class="flipswitch">
                <input type="radio" class="flipswitch-input" name="regist_accept" value="1" id="regist-accept-yes" <?php if ($this->get('regist_accept') == '1') { echo 'checked="checked"'; } ?> />  
                <label for="regist-accept-yes" class="flipswitch-label flipswitch-label-on"><?=$this->getTrans('yes') ?></label>
                <input type="radio" class="flipswitch-input" name="regist_accept" value="0" id="regist-accept-no" <?php if ($this->get('regist_accept') != '1') { echo 'checked="checked"'; } ?> />  
                <label for="regist-accept-no" class="flipswitch-label flipswitch-label-off"><?=$this->getTrans('no') ?></label>
                <span class="flipswitch-selection"></span>
            </div>
        </div>
    </div>
    <div id="registRules" <?php if ($this->get('regist_accept') != '1') { echo 'class="hidden"'; } ?>>
        <div class="form-group">
            <label for="regist_confirm" class="col-lg-2 control-label">
                <?=$this->getTrans('confirmRegistrationEmail') ?>:
            </label>
            <div class="col-lg-4">
                <div class="flipswitch">
                    <input type="radio" class="flipswitch-input" name="regist_confirm" value="1" id="regist-confirm-yes" <?php if ($this->get('regist_confirm') == '1') { echo 'checked="checked"'; } ?> />  
                    <label for="regist-confirm-yes" class="flipswitch-label flipswitch-label-on"><?=$this->getTrans('yes') ?></label>
                    <input type="radio" class="flipswitch-input" name="regist_confirm" value="0" id="regist-confirm-no" <?php if ($this->get('regist_confirm') != '1') { echo 'checked="checked"'; } ?> />  
                    <label for="regist-confirm-no" class="flipswitch-label flipswitch-label-off"><?=$this->getTrans('no') ?></label>
                    <span class="flipswitch-selection"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="facebook_login" class="col-lg-2 control-label">
            <?=$this->getTrans('acceptUserRegisFacebook') ?>:
        </label>
        <div class="col-lg-4">
            <div class="flipswitch">
                <input type="radio" class="flipswitch-input" name="facebook_login" value="1" id="regist-accept-facebook-yes" <?php if ($this->get('facebook_login') == '1') { echo 'checked="checked"'; } ?> />  
                <label for="regist-accept-facebook-yes" class="flipswitch-label flipswitch-label-on"><?=$this->getTrans('yes') ?></label>
                <input type="radio" class="flipswitch-input" name="facebook_login" value="0" id="regist-accept-facebook-no" <?php if ($this->get('facebook_login') != '1') { echo 'checked="checked"'; } ?> />  
                <label for="regist-accept-facebook-no" class="flipswitch-label flipswitch-label-off"><?=$this->getTrans('no') ?></label>
                <span class="flipswitch-selection"></span>
            </div>
        </div>
    </div>
    <div id="fblogin" <?php if ($this->get('facebook_login') != '1') { echo 'class="hidden"'; } ?>>
        <div class="form-group">
            <input type="text" name="facebook_appID" value="<?=$this->get('facebook_appID') ?>" class="form-control" placeholder="facebook AppID">
            <input type="text" name="facebook_appSecret" value="<?=$this->get('facebook_appSecret') ?>" class="form-control" placeholder="facebook Secret">
        </div>
    </div>
    <div class="form-group">
        <label for="google_login" class="col-lg-2 control-label">
            <?=$this->getTrans('acceptUserRegisGoogle') ?>:
        </label>
        <div class="col-lg-4">
            <div class="flipswitch">
                <input type="radio" class="flipswitch-input" name="google_login" value="1" id="regist-accept-google-yes" <?php if ($this->get('google_login') == '1') { echo 'checked="checked"'; } ?> />  
                <label for="regist-accept-google-yes" class="flipswitch-label flipswitch-label-on"><?=$this->getTrans('yes') ?></label>
                <input type="radio" class="flipswitch-input" name="google_login" value="0" id="regist-accept-google-no" <?php if ($this->get('google_login') != '1') { echo 'checked="checked"'; } ?> />  
                <label for="regist-accept-google-no" class="flipswitch-label flipswitch-label-off"><?=$this->getTrans('no') ?></label>
                <span class="flipswitch-selection"></span>
            </div>
        </div>
    </div>
    <div id="googlelogin" <?php if ($this->get('google_login') != '1') { echo 'class="hidden"'; } ?>>
        <div class="form-group">
            <input type="text" name="google_appID" value="<?=$this->get('google_appID') ?>" class="form-control" placeholder="google+ AppID">
            <input type="text" name="google_appSecret" value="<?=$this->get('google_appSecret') ?>" class="form-control" placeholder="google+ Secret">
        </div>
    </div>
    <div class="form-group">
        <label for="twitter_login" class="col-lg-2 control-label">
            <?=$this->getTrans('acceptUserRegisTwitter') ?>:
        </label>
        <div class="col-lg-4">
            <div class="flipswitch">
                <input type="radio" class="flipswitch-input" name="twitter_login" value="1" id="regist-accept-twitter-yes" <?php if ($this->get('twitter_login') == '1') { echo 'checked="checked"'; } ?> />  
                <label for="regist-accept-twitter-yes" class="flipswitch-label flipswitch-label-on"><?=$this->getTrans('yes') ?></label>
                <input type="radio" class="flipswitch-input" name="twitter_login" value="0" id="regist-accept-twitter-no" <?php if ($this->get('twitter_login') != '1') { echo 'checked="checked"'; } ?> />  
                <label for="regist-accept-twitter-no" class="flipswitch-label flipswitch-label-off"><?=$this->getTrans('no') ?></label>
                <span class="flipswitch-selection"></span>
            </div>
        </div>
    </div>
    <div id="twitterlogin" <?php if ($this->get('twitter_login') != '1') { echo 'class="hidden"'; } ?>>
        <div class="form-group">
            <input type="text" name="twitter_appID" value="<?=$this->get('twitter_appID') ?>" class="form-control" placeholder="twitter AppID">
            <input type="text" name="twitter_appSecret" value="<?=$this->get('twitter_appSecret') ?>" class="form-control" placeholder="twitter Secret">
        </div>
    </div>
    <div id="rulesForRegist" <?php if ($this->get('regist_accept') != '1') { echo 'class="hidden"'; } ?>>
        <div class="form-group">
            <label for="regist_rules" class="col-lg-2 control-label">
                    <?=$this->getTrans('rulesForRegist') ?>:
            </label>
            <div class="col-lg-10">
                <textarea class="form-control ckeditor"
                          name="regist_rules"
                          cols="60"
                          id="ck_1"
                          toolbar="ilch_html"
                          rows="5"><?=$this->get('regist_rules') ?></textarea>
            </div>
        </div>
    </div>
    <div id="registAccept" <?php if ($this->get('regist_accept') != '1') { echo 'class="hidden"'; } ?>>
        <div id="confirmMail" <?php if ($this->get('regist_confirm') != '1') { echo 'class="hidden"'; } ?>>
            <div class="form-group">
                <label for="regist_confirm_mail" class="col-lg-2 control-label">
                    <?=$this->getTrans('mailForRegist') ?>:
                    <br /><br />
                    <div class="small">
                        <b><?=$this->getTrans('settingsRegistVariables') ?></b><br />
                        <b>{name}</b> = <?=$this->getTrans('settingsRegistVariablesName') ?><br />
                        <b>{sitetitle}</b> = <?=$this->getTrans('settingsRegistVariablesSitetitle') ?><br />
                        <b>{comfirm}</b> = <?=$this->getTrans('settingsRegistVariablesComfirm') ?>
                    </div>
                </label>
                <div class="col-lg-10">
                    <textarea class="form-control ckeditor"
                              name="regist_confirm_mail"
                              cols="60"
                              id="ck_2"
                              toolbar="ilch_html"
                              rows="5"><?=$this->get('regist_confirm_mail') ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div id="confirmMail" class="form-group">
        <label for="password_change_mail" class="col-lg-2 control-label">
            <?=$this->getTrans('mailForNewPassword') ?>:
            <br /><br />
            <div class="small">
                <b><?=$this->getTrans('settingsRegistVariables') ?></b><br />
                <b>{name}</b> = <?=$this->getTrans('settingsRegistVariablesName') ?><br />
                <b>{sitetitle}</b> = <?=$this->getTrans('settingsRegistVariablesSitetitle') ?><br />
                <b>{comfirm}</b> = <?=$this->getTrans('settingsRegistVariablesComfirm') ?>
            </div>
        </label>
        <div class="col-lg-10">
            <textarea class="form-control ckeditor"
                      name="password_change_mail"
                      cols="60"
                      id="ck_3"
                      toolbar="ilch_html"
                      rows="5"><?=$this->get('password_change_mail') ?></textarea>
        </div>
    </div>

    <legend><?=$this->getTrans('menuSettingsAvatar') ?></legend>
    <div class="form-group">
        <label for="avatar_height" class="col-lg-2 control-label">
            <?=$this->getTrans('avatarHeight') ?>
        </label>
        <div class="col-lg-2">
            <input name="avatar_height" 
                   type="text" 
                   id="avatar_height" 
                   class="form-control required" 
                   value="<?=$this->get('avatar_height') ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="avatar_width" class="col-lg-2 control-label">
            <?=$this->getTrans('avatarWidth') ?>
        </label>
        <div class="col-lg-2">
            <input name="avatar_width" 
                   type="text" 
                   id="avatar_width" 
                   class="form-control required" 
                   value="<?=$this->get('avatar_width') ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="avatar_size" class="col-lg-2 control-label">
            <?=$this->getTrans('avatarSizeBytes') ?>
        </label>
        <div class="col-lg-2">
            <input name="avatar_size" 
                   type="text" 
                   id="avatar_size" 
                   class="form-control required" 
                   value="<?=$this->get('avatar_size') ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="avatar_filetypes" class="col-lg-2 control-label">
            <?=$this->getTrans('avatarAllowedFileExtensions') ?>
        </label>
        <div class="col-lg-2">
            <input name="avatar_filetypes" 
                   type="text" 
                   id="avatar_filetypes" 
                   class="form-control required" 
                   value="<?=$this->get('avatar_filetypes') ?>" />
        </div>
    </div>
    <?=$this->getSaveBar() ?>
</form>

<script>
$('[name="regist_accept"]').click(function () {
    if ($(this).val() == "1") {
        $('#registRules').removeClass('hidden');
        $('#rulesForRegist').removeClass('hidden');
        $('#registAccept').removeClass('hidden');
    } else {
        $('#registRules').addClass('hidden');
        $('#rulesForRegist').addClass('hidden');
        $('#registAccept').addClass('hidden');
        }
});

$('[name="regist_confirm"]').click(function () {
    if ($(this).val() == "1") {
        $('#confirmMail').removeClass('hidden');
    } else {
        $('#confirmMail').addClass('hidden');
    }
});

$('[name="facebook_login"]').click(function () {
    if ($(this).val() == "1") {
        $('#fblogin').removeClass('hidden');
    } else {
        $('#fblogin').addClass('hidden');
    }
});

$('[name="google_login"]').click(function () {
    if ($(this).val() == "1") {
        $('#googlelogin').removeClass('hidden');
    } else {
        $('#googlelogin').addClass('hidden');
    }
});

$('[name="twitter_login"]').click(function () {
    if ($(this).val() == "1") {
        $('#twitterlogin').removeClass('hidden');
    } else {
        $('#twitterlogin').addClass('hidden');
    }
});
</script>
