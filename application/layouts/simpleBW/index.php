<!doctype html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" href="favicon.ico">
    <?=$this->getHeader() ?>
    <link href="<?=$this->getStaticUrl('css/bootstrap.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=$this->getLayoutUrl('css/animate.css') ?>">
    <link rel="stylesheet" href="<?=$this->getLayoutUrl('css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?=$this->getLayoutUrl('css/jquery.easy-pie-chart.css') ?>">
    <link rel="stylesheet" href="<?=$this->getLayoutUrl('css/styles.css') ?>" title="mainStyle">
    <link rel="icon" href="<?=$this->getStaticUrl('img/favicon.ico') ?>" type="image/x-icon" />
    

    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="<?=$this->getLayoutUrl('rs-plugin/css/settings.css') ?>" media="screen" />

    <script src="<?=$this->getLayoutUrl('js/modernizr.custom.32033.js') ?>"></script>

    <!--[if IE]><script type="text/javascript" src="js/excanvas.compiled.js"></script><![endif]-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Wrap all page content here -->
    <div id="wrap">

        <!-- Fixed navbar -->
        <div class="navbar navbar-fixed-top" id="nav" role="navigation">
            <!--div class="theme-switcher">
                <div class="colors">
                    <a href="javascript:void(0)" class="blue"></a>
                    <a href="javascript:void(0)" class="orange"></a>
                    <a href="javascript:void(0)" class="red"></a>
                </div>
                <a href="javascript:void(0)" class="Switcher"><span class="fa fa-pencil fa-lg"></span></a>
            </div-->
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--a class="navbar-brand" href="#">
                        <img src="img/logo.png" alt="">
                    </a-->
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    
                            
                    
            
                            
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Search">
                        </div>
                        
                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        
                      </form>
                    
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#">about</a></li>
                        <li><a href="#">services</a></li>
                        <li><a href="#">team</a></li>
                        <li><a href="#">our work</a></li>
                        <li><a href="#">contact</a></li>
                        <li><a href="blog-archive.html" class="active">blog</a></li>
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
                    <a href="" class="scroll-top"><img src="<?=$this->getLayoutUrl('img/top.png') ?>" alt="" class="top"></a>
                </div>
            </div>
        </footer>
    </div>
    <!--/wrap-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$this->getStaticUrl('js/bootstrap.js') ?>"></script>
    <script src="<?=$this->getLayoutUrl('js/stellar.js') ?>"></script>
    <script src="<?=$this->getLayoutUrl('js/isotope.pkgd.min.js') ?>"></script>
    <script src="<?=$this->getLayoutUrl('js/jquery.easypiechart.min.js') ?>"></script>

    <!-- jQuery REVOLUTION Slider  -->
    <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.plugins.min.js') ?>"></script>
    <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js') ?>"></script>

    <script src="<?=$this->getLayoutUrl('js/waypoints.min.js') ?>"></script>

    <!--script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASm3CwaK9qtcZEWYa-iQwHaGi3gcosAJc&sensor=false"></script-->
    <script src="<?=$this->getLayoutUrl('js/script.js') ?>"></script>

    <script>
    $(document).ready(function() {
        appMaster.preLoader();
        appMaster.smoothScroll();
        appMaster.animateScript();
        appMaster.navSpy();
        appMaster.revSlider();
        appMaster.stellar();
        appMaster.skillsChart();
        appMaster.isoTop();
        appMaster.canvasHack();
    });
    </script>

</body>

</html>








