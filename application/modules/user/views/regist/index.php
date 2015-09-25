<style>
.regist .panel-body {
    background: #eee;
}
</style>

<?php if ($this->get('regist_accept') == '1'): ?>
    <?php include APPLICATION_PATH.'/modules/user/views/regist/navi.php'; ?>
    <form class="form-horizontal" method="POST" action="<?=$this->getUrl(array('action' => $this->getRequest()->getActionName())) ?>">
        <?=$this->getTokenField() ?>
        <div class="regist panel panel-default">
            <div class="panel-heading">
                <?=$this->getTrans('rules') ?>
            </div>
            <div class="panel-body">
                <?=$this->get('regist_rules') ?>
            </div>
        </div>
        <div class="col-lg-6" align="left">
            <label class="checkbox inline <?php if ($this->get('error') != '') { echo 'text-danger'; } ?>" style="margin-left: 20px;">
                <input type="checkbox" name="acceptRule" value="1"> <?=$this->getTrans('acceptRule') ?>
            </label>
        </div>
        <div class="col-lg-6" align="right">
            <?=$this->getSaveBar('nextButton', 'Regist') ?>
        </div>
    </form>
    <div class="col-lg-12">
        <div class="omb_login">
            <div class="row omb_row-sm-offset-3 omb_loginOr">
                <div class="col-xs-12 col-sm-6">
                    <hr class="omb_hrOr">
                    <span class="omb_spanOr"><?=$this->getTrans('or') ?></span>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?=$this->getTrans('menuLoginWith') ?></h3>
                </div>
                <div class="row omb_row-sm-offset-3 omb_socialButtons">
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="btn btn-lg btn-block omb_btn-facebook">
                            <i class="fa fa-facebook visible-xs"></i>
                            <span class="hidden-xs">Facebook</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="btn btn-lg btn-block omb_btn-twitter">
                            <i class="fa fa-twitter visible-xs"></i>
                            <span class="hidden-xs">Twitter</span>
                        </a>
                    </div>	
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="btn btn-lg btn-block omb_btn-google">
                            <i class="fa fa-google-plus visible-xs"></i>
                            <span class="hidden-xs">Google+</span>
                        </a>
                    </div>	
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <?=$this->getTrans('noRegistAccept') ?>
<?php endif; ?>
