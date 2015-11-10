<link href="<?=$this->getModuleUrl('static/css/forum-style.css') ?>" rel="stylesheet">
<?php
$topics = $this->get('topics');
$topicMapper = $this->get('topicMapper');
$forumMapper = $this->get('forumMapper');
$groupIdsArray = $this->get('groupIdsArray');
$adminAccess = null;
if ($this->getUser()) {
    $adminAccess = $this->getUser()->isAdmin();
}
?>
<div id="forum">
    <h3><?=$this->getTrans('showNewPosts') ?></h3>
    <div class="forabg">
        <ul class="topiclist">
            <li class="header">
                <dl class="icon">
                    <dt><span class="forum-name"><?=$this->getTrans('topics') ?><span></span></span></dt>
                    <dd class="posts"><?=$this->getTrans('replies') ?></dd>
                    <dd class="views"><?=$this->getTrans('views') ?></dd>
                    <dd class="lastpost"><span><?=$this->getTrans('lastPost') ?></span></dd>
                </dl>
            </li>
        </ul>
        <ul class="topiclist topics">
            <?php foreach ($topics as $topic): ?>
            <?php $forum = $forumMapper->getForumById($topic->getTopicId()); ?>
                <?php $lastPost = $topicMapper->getLastPostByTopicId($topic->getId()) ?>
                    <?php if (is_in_array($groupIdsArray, explode(',', $forum->getReadAccess())) || $adminAccess == true): ?>
                    <?php $countPosts = $forumMapper->getCountPostsByTopicId($topic->getId()) ?>

                    <?php if (!in_array($this->getUser()->getId(), explode(',', $lastPost->getRead()))): ?>
                    <li class="row bg1">
                        <dl class="icon" style="
                            <?php if ($this->getUser()): ?>
                                <?php if (in_array($this->getUser()->getId(), explode(',', $lastPost->getRead()))): ?>
                                    background-image: url(<?=$this->getModuleUrl('static/img/forum_read.png') ?>);
                                <?php else: ?>
                                    background-image: url(<?=$this->getModuleUrl('static/img/topic_unread.png') ?>);
                                <?php endif; ?>
                            <?php else: ?>
                                background-image: url(<?=$this->getModuleUrl('static/img/forum_read.png') ?>);
                            <?php endif; ?>
                                background-repeat: no-repeat;">
                            <dt>
                                <a href="<?=$this->getUrl(array('controller' => 'showposts', 'action' => 'index','topicid' => $topic->getId())) ?>" class="topictitle">
                                    <?=$topic->getTopicTitle() ?>
                                </a>
                                <?php if ($topic->getType() == '1'): ?>
                                    <i class="fa fa-thumb-tack"></i>
                                <?php endif; ?>
                                <br>
                                <?=$this->getTrans('by') ?>
                                <a href="<?=$this->getUrl(array('controller' => 'showposts', 'action' => 'index','topicid' => $topic->getId())) ?>" style="color: #AA0000;" class="username-coloured">
                                    <?=$topic->getAuthor()->getName() ?>
                                </a>
                                »
                                <?=$topic->getDateCreated() ?>
                            </dt>
                            <dd class="posts"><?=$countPosts -1 ?></dd>
                            <dd class="views"><?=$topic->getVisits() ?></dd>
                            <dd class="lastpost">
                                <span>
                                    <img style="width:30px; padding-right: 5px;" src="<?=$this->getBaseUrl($lastPost->getAutor()->getAvatar()) ?>">
                                    <?=$this->getTrans('by') ?>
                                    <a href="<?=$this->getUrl(array('module' => 'user', 'controller' => 'profil', 'action' => 'index', 'user' => $lastPost->getAutor()->getId())) ?>">
                                        <?=$lastPost->getAutor()->getName() ?>
                                    </a>
                                    <a href="<?=$this->getUrl(array('controller' => 'showposts', 'action' => 'index','topicid' => $lastPost->getTopicId(), 'page' => $lastPost->getPage())) ?>#<?=$lastPost->getId()?>">
                                        <img src="<?=$this->getModuleUrl('static/img/icon_topic_latest.png') ?>" alt="<?=$this->getTrans('viewLastPost') ?>" title="<?=$this->getTrans('viewLastPost') ?>" height="10" width="12">
                                    </a>
                                    <br>
                                    <?=$lastPost->getDateCreated() ?>
                                </span>
                            </dd>
                        </dl>
                    </li>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>

        </ul>
    </div>
</div>

