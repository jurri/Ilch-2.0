<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" href="favicon.ico">
    <?=$this->getHeader() ?>
    <link href="<?=$this->getStaticUrl('css/bootstrap.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=$this->getLayoutUrl('css/styles.css') ?>" title="mainStyle">
    <link rel="icon" href="<?=$this->getStaticUrl('img/favicon.ico') ?>" type="image/x-icon" />

    <script type="text/javascript" src="<?=$this->getStaticUrl('js/bootstrap.js') ?>"></script>
</head>

<body>
    <!-- Wrap all page content here -->
    <div id="wrap">
        <!-- Fixed navbar -->
        <div class="navbar navbar-fixed-top" id="nav" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <i class="fa fa-list"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">               
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="<?=$this->getUrl(array('module' => 'article', 'action' => 'index')) ?>">Artikel</a></li>
                        <li><a href="<?=$this->getUrl(array('module' => 'user', 'action' => 'index')) ?>">Benutzer</a></li>
                        <li><a href="<?=$this->getUrl(array('module' => 'forum', 'action' => 'index')) ?>">Forum</a></li>
                        <li><a href="<?=$this->getUrl(array('module' => 'gallery', 'action' => 'index')) ?>">Galerie</a></li>
                        <li><a href="<?=$this->getUrl(array('module' => 'imprint', 'action' => 'index')) ?>">Impressum</a></li>
                        <li><a href="<?=$this->getUrl(array('module' => 'contact', 'action' => 'index')) ?>">Kontakt</a></li>                   
                        <li class="social-nav">
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!--/.container -->
        </div>
        <!--/.navbar -->

        <section class="well well-lg">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>simpleBW</h2>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li><?=$this->getHmenu() ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section id="blog">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="article">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default" id="headings">
                        <div class="panel-body">
                            <?=$this->getContent() ?>
                            
                        </div>
                    </div><span class="divider"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        
                        <div class="side-block">
                            <?php
                    echo $this->getMenu
                    (
                        1,
                        '<div class="panel panel-gaming">
                             <div class="panel-heading">%s</div>
                                <div class="tag">
                                    %c
                                </div>
                         </div>
                         <span class="divider"></span>'
                    );
                    ?>
                            
                        </div>
                        <div class="side-block">
                        <?php
                    echo $this->getMenu
                    (
                        2,
                        '<div class="panel panel-gaming">
                             <div class="panel-heading">%s</div>
                                <div class="panel-body">
                                    %c
                                </div>
                         </div>
                         <span class="divider"></span>'
                    );
                    ?>
                    </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="map"></section>

        <footer id="site-footer">
            <div class="container">
                <div class="row">
                    <span class="divider grey"></span>
                    <h4>2015 Jay<span class="brandy">Dee</span></h4>
                    <h5>by <a href="http://www.ilch.de">ilch.de</a></h5>
                    <a href="" class="scroll-top"><img width="50px" height="50px" src="<?=$this->getLayoutUrl('img/arrow.png') ?>" alt="" class="top"></a>
                </div>
            </div>
        </footer>
    </div>
    <!--/wrap-->
    <script src="<?=$this->getLayoutUrl('js/script.js') ?>"></script>
    <script>
    $(document).ready(function() {
        appMaster.preLoader();
        appMaster.smoothScroll();
        appMaster.navSpy();
    });
    </script>
</body>
</html>








