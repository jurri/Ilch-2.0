<?php
$userMapper = new \Modules\User\Mappers\User();
$commentMapper = new \Modules\Comment\Mappers\Comment();
$image = $this->get('image');
$comments = $this->get('comments');
$commentsCount = $commentMapper->getCountComments('user/gallery/showimage/user/'.$this->getRequest()->getParam('user').'/gallery/'.$this->getRequest()->getParam('gallery').'/id/'.$this->getRequest()->getParam('id'));
$nowDate = new \Ilch\Date();
$config = \Ilch\Registry::get('config');
$col = 10;

function rec($id, $uid, $req, $obj)
{
    $CommentMappers = new \Modules\Comment\Mappers\Comment();
    $userMapper = new \Modules\User\Mappers\User();
    $fk_comments = $CommentMappers->getCommentsByFKId($id);
    $user_rep = $userMapper->getUserById($uid);
    $config = \Ilch\Registry::get('config');
    $nowDate = new \Ilch\Date();

    foreach ($fk_comments as $fk_comment) {
        $commentDate = new \Ilch\Date($fk_comment->getDateCreated());
        $user = $userMapper->getUserById($fk_comment->getUserId());

        if ($req > $config->get('comment_interleaving')) {
            $req = $config->get('comment_interleaving');
        }

        $col = 10 - $req;
        echo '  <article class="row" id="comment_'.$fk_comment->getId().'">';
                    if ($config->get('comment_avatar') == 1) {
                        echo '  <div class="col-md-2 col-sm-2 col-md-offset-'.$req.' col-sm-offset-'.$req.' hidden-xs">';
                        echo '      <figure class="thumbnail" title="'.$user->getName().'">';
                        echo '          <a href="'.$obj->getUrl(array('module' => 'user', 'controller' => 'profil', 'action' => 'index', 'user' => $user->getId())).'"><img class="img-responsive" src="'.$obj->getBaseUrl($user->getAvatar()).'" alt="'.$user->getName().'"></a>';
                        echo '      </figure>';
                        echo '  </div>';
                        echo '  <div class="col-md-'.$col.' col-sm-'.$col.'">';
                    } else {
                        $col = $col + 2;
                        echo '  <div class="col-md-'.$col.' col-sm-'.$col.' col-md-offset-'.$req.' col-sm-offset-'.$req.'">';
                    }
        echo '      <div class="panel panel-default">';
        echo '          <div class="panel-bodylist">';
        echo '              <div class="panel-heading right"><i class="fa fa-reply"></i> '.$user_rep->getName().'</div>';
        echo '              <header class="text-left">';
        echo '                  <div class="comment-user">';
        echo '                      <i class="fa fa-user" title="'.$obj->getTrans('commentUser').'"></i> <a href="'.$obj->getUrl(array('module' => 'user', 'controller' => 'profil', 'action' => 'index', 'user' => $fk_comment->getUserId())).'">'.$user->getName().'</a>';
        echo '                  </div>';
                                if ($config->get('comment_date') == 1) {
                                    echo '<time class="comment-date"><i class="fa fa-clock-o" title="'.$obj->getTrans('commentDateTime').'"></i> '.$commentDate->format("d.m.Y - H:i", true).'</time>';
                                }
        echo '              </header>';
        echo '              <div class="comment-post"><p>'.nl2br($fk_comment->getText()).'</p></div>';
                                if ($obj->getUser() AND $config->get('comment_reply') == 1) {
                                    echo '<p class="text-right"><a href="javascript:slideReply(\'reply_'.$fk_comment->getId().'\');" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> '.$obj->getTrans('reply').'</a></p>';
                                }
        echo '              </div>';
        echo '          </div>';
        echo '      </div>';
        echo '  </article>';

        if($obj->getUser()) {
            echo '  <div class="replyHidden" id="reply_'.$fk_comment->getId().'">';
            echo '      <form action="" class="form-horizontal" method="POST">';
                            echo $obj->getTokenField();
            echo '          <section class="comment-list">';
            echo '              <article class="row">';
                                    $col = $col - 1;
                                    $req = $req + 1;
                                    if ($config->get('comment_avatar') == 1) {
                                        echo '  <div class="col-md-2 col-sm-2 col-md-offset-'.$req.' col-sm-offset-'.$req.' hidden-xs">';
                                        echo '      <figure class="thumbnail" title="'.$obj->getUser()->getName().'">';
                                        echo '          <a href="'.$obj->getUrl('user/profil/index/user/'.$obj->getUser()->getId()).'"><img class="img-responsive" src="'.$obj->getUrl().'/'.$obj->getUser()->getAvatar().'" alt="'.$obj->getUser()->getName().'"></a>';
                                        echo '      </figure>';
                                        echo '  </div>';
                                    }
            echo '                  <div class="col-md-'.$col.' col-sm-'.$col.'">';
            echo '                      <div class="panel panel-default">';
            echo '                          <div class="panel-body">';
            echo '                              <div class="panel-heading right"><i class="fa fa-reply"></i> '.$user->getName().'</div>';
            echo '                              <header class="text-left">';
            echo '                                  <div class="comment-user">';
            echo '                                      <i class="fa fa-user" title="'.$obj->getTrans('commentUser').'"></i> <a href="'.$obj->getUrl(array('module' => 'user', 'controller' => 'profil', 'action' => 'index', 'user' => $obj->getUser()->getId())).'">'.$obj->getUser()->getName().'</a>';
            echo '                                  </div>';
                                                    if ($config->get('comment_date') == 1) {
                                                        echo '<time class="comment-date"><i class="fa fa-clock-o" title="'.$obj->getTrans('commentDateTime').'"></i> '.$nowDate->format("d.m.Y - H:i", true).'</time>';
                                                    }
            echo '                              </header>';
            echo '                              <div class="comment-post">';
            echo '                                  <p>';
            echo '                                      <textarea class="form-control"
                                                                    accesskey=""
                                                                    name="gallery_comment_text"
                                                                    style="resize: vertical"
                                                                    required></textarea>';
            echo '                                  </p>';
            echo '                              </div>';
            echo '                              <input type="hidden" name="fkId" value="'.$fk_comment->getId().'" />';
            echo '                              <p class="text-right submit">';
                                                    echo $obj->getSaveBar('submit', 'Comment');
            echo '                              </p>';
            echo '                          </div>';
            echo '                      </div>';
            echo '                  </div>';
            echo '              </article>';
            echo '          </section>';
            echo '      </form>';
            echo '  </div>';
        }

        $fkk_comments = $CommentMappers->getCommentsByFKId($fk_comment->getId());
        $req = $req -1;
        if (count($fkk_comments) > 0) {
            $req++;
        }
        $i=1;

        foreach ($fkk_comments as $fkk_comment) {
            if ($i == 1) {
                rec($fk_comment->getId(), $fk_comment->getUserId(), $req, $obj);
                $i++;
            }
        }

        if (count($fkk_comments) > 0) {
            $req--;
        }
    }
}
?>

<link href="<?=$this->getModuleUrl('../comment/static/css/comment.css') ?>" rel="stylesheet">
<style>
.replyHidden {
    display: none;
}
</style>

<legend><?=$this->getTrans('menuGallery') ?></legend>
<div id="gallery">
    <div class="row">
        <div class="col-md-6">
            <a href="<?=$this->getUrl().'/'.$image->getImageUrl() ?>">
                <img class="thumbnail" src="<?=$this->getUrl().'/'.$image->getImageUrl() ?>" alt="<?=$image->getImageTitle() ?>"/>
            </a>
        </div>
        <div class="col-md-6">
            <h3><?=$image->getImageTitle() ?></h3>
            <p><?=$image->getImageDesc() ?></p>
        </div>
    </div>
</div>

<?php if ($config->get('comment_avatar') == 0) { $col = $col +2; }; ?>
<div class="row">
    <div class="col-md-12">
        <legend class="page-header" id="comment"><?=$this->getTrans('comments') ?> (<?=$commentsCount ?>)</legend>
        <?php if($this->getUser()): ?>
            <div class="reply">
                <form action="" class="form-horizontal" method="POST">
                    <?=$this->getTokenField() ?>
                    <section class="comment-list">
                        <article class="row">
                            <?php if ($config->get('comment_avatar') == 1): ?>
                                <div class="col-md-2 col-sm-2 hidden-xs">
                                    <figure class="thumbnail" title="<?=$this->getUser()->getName() ?>">
                                        <a href="<?=$this->getUrl('user/profil/index/user/'.$this->getUser()->getId()) ?>"><img class="img-responsive" src="<?=$this->getUrl().'/'.$this->getUser()->getAvatar() ?>" alt="<?=$this->getUser()->getName() ?>"></a>
                                    </figure>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-<?=$col ?> col-sm-<?=$col ?>">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <header class="text-left">
                                            <div class="comment-user">
                                                <i class="fa fa-user" title="<?=$this->getTrans('commentUser') ?>"></i> <a href="<?=$this->getUrl(array('module' => 'user', 'controller' => 'profil', 'action' => 'index', 'user' => $this->getUser()->getId())) ?>"><?=$this->getUser()->getName() ?></a>
                                            </div>
                                            <?php if ($config->get('comment_date') == 1): ?>
                                                <time class="comment-date"><i class="fa fa-clock-o" title="<?=$this->getTrans('commentDateTime') ?>"></i> <?=$nowDate->format("d.m.Y - H:i", true) ?></time>
                                            <?php endif; ?>
                                        </header>
                                        <div class="comment-post">
                                            <p>
                                                <textarea class="form-control"
                                                          accesskey=""
                                                          name="gallery_comment_text"
                                                          style="resize: vertical"
                                                          required></textarea>
                                            </p>
                                        </div>
                                        <p class="text-right submit">
                                            <?=$this->getSaveBar('submit', 'Comment') ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </section>
                </form>
            </div>
        <?php endif; ?>
        <?php if ($comments != ''): ?>
            <?php foreach ($comments as $comment): ?>
                <?php $user = $userMapper->getUserById($comment->getUserId()); ?>
                <?php $commentDate = new \Ilch\Date($comment->getDateCreated()); ?>
                <section class="comment-list">
                    <article class="row" id="comment_<?=$comment->getId() ?>">
                        <?php if ($config->get('comment_avatar') == 1): ?>
                            <div class="col-md-2 col-sm-2 hidden-xs">
                                <figure class="thumbnail" title="<?=$user->getName() ?>">
                                    <a href="<?=$this->getUrl('user/profil/index/user/'.$user->getId()) ?>"><img class="img-responsive" src="<?=$this->getUrl().'/'.$user->getAvatar() ?>" alt="<?=$this->escape($user->getName()) ?>"></a>
                                </figure>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-<?=$col ?> col-sm-<?=$col ?>">
                            <div class="panel panel-default">
                                <div class="panel-bodylist">
                                    <header class="text-left">
                                        <div class="comment-user">
                                            <i class="fa fa-user" title="<?=$this->getTrans('commentUser') ?>"></i> <a href="<?=$this->getUrl(array('module' => 'user', 'controller' => 'profil', 'action' => 'index', 'user' => $user->getId())) ?>"><?=$this->escape($user->getName()) ?></a>
                                        </div>
                                        <?php if ($config->get('comment_date') == 1): ?>
                                            <time class="comment-date"><i class="fa fa-clock-o" title="<?=$this->getTrans('commentDateTime') ?>"></i> <?=$commentDate->format("d.m.Y - H:i", true) ?></time>
                                        <?php endif; ?>
                                    </header>
                                    <div class="comment-post"><p><?=nl2br($this->escape($comment->getText())) ?></p></div>
                                    <?php if ($this->getUser() AND $config->get('comment_reply') == 1): ?>
                                        <p class="text-right"><a href="javascript:slideReply('reply_<?=$comment->getId() ?>');" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> <?=$this->getTrans('reply') ?></a></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </article>

                    <?php if($this->getUser()): ?>
                        <div class="replyHidden" id="reply_<?=$comment->getId() ?>">
                            <form action="" class="form-horizontal" method="POST">
                                <?=$this->getTokenField() ?>
                                <article class="row">
                                    <?php if ($config->get('comment_avatar') == 1): ?>
                                        <div class="col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-1 hidden-xs">
                                            <figure class="thumbnail" title="<?=$this->getUser()->getName() ?>">
                                                <a href="<?=$this->getUrl('user/profil/index/user/'.$this->getUser()->getId()) ?>"><img class="img-responsive" src="<?=$this->getUrl().'/'.$this->getUser()->getAvatar() ?>" alt="<?=$this->getUser()->getName() ?>"></a>
                                            </figure>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-<?=$col+-1 ?> col-sm-<?=$col-1 ?>">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="panel-heading right"><i class="fa fa-reply"></i> <?=$this->escape($user->getName()) ?></div>
                                                <header class="text-left">
                                                    <div class="comment-user">
                                                        <i class="fa fa-user" title="<?=$this->getTrans('commentUser') ?>"></i> <a href="<?=$this->getUrl(array('module' => 'user', 'controller' => 'profil', 'action' => 'index', 'user' => $this->getUser()->getId())) ?>"><?=$this->getUser()->getName() ?></a>
                                                    </div>
                                                    <?php if ($config->get('comment_date') == 1): ?>
                                                        <time class="comment-date"><i class="fa fa-clock-o" title="<?=$this->getTrans('commentDateTime') ?>"></i> <?=$nowDate->format("d.m.Y - H:i", true) ?></time>
                                                    <?php endif; ?>
                                                </header>
                                                <div class="comment-post">
                                                    <p>
                                                        <textarea class="form-control"
                                                                  accesskey=""
                                                                  name="gallery_comment_text"
                                                                  style="resize: vertical"
                                                                  required></textarea>
                                                    </p>
                                                </div>
                                                <input type="hidden" name="fkId" value="<?=$comment->getId() ?>" />
                                                <p class="text-right submit">
                                                    <?=$this->getSaveBar('submit', 'Comment') ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </form>
                        </div>
                    <?php endif; ?>
                    <?php rec($comment->getId(), $comment->getUserId(), 1, $this) ?>
                </section>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
function slideReply(thechosenone) {
    $('.replyHidden').each(function(index) {
        if ($(this).attr("id") == thechosenone) {
            $(this).slideDown(400);
        } else {
            $(this).slideUp(200);

            $('.reply').slideUp(200);
        }
    });
}
</script>
