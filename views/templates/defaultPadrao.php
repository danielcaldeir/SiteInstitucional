<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo (empty($this->config['site_title'])?'@site_title':$this->config['site_title']); ?></title>
        <link type="text/css" rel="stylesheet" href="<?php echo(BASE_URL);?>asserts/css/style.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo(BASE_URL);?>asserts/bootstrap/css/bootstrap.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo(BASE_URL);?>asserts/bootstrap/css/bootstrap-theme.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo(BASE_URL); ?>asserts/AdminLTE_300/dist/css/adminlte.min.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo(BASE_URL); ?>asserts/iCheck/skins/square/blue.css" />
        
        <script type="text/javascript" src="<?php echo(BASE_URL);?>asserts/jquery/dist/jquery.js"></script>
        <script type="text/javascript" src="<?php echo(BASE_URL);?>asserts/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo(BASE_URL); ?>asserts/AdminLTE_300/dist/js/adminlte.min.js"></script>
    </head>
    <body>
        <?php //echo("<pre>"); print_r($this->config); echo("</pre>"); ?>
        <div id="page">
                <!-- <nav class="navbar navbar-static-top navbar-fixed-top" role="navigation"> -->
                <nav class="row navbar navbar-expand bg-lightgray fixed-top navbar-light border-bottom" role="navigation">
                    <div class="container-fluid">
                        <!--<div class="row">-->
                        <div class="col-sm-2 col-xs-2">
                            <div id="gtco-logo">
                                <a href="<?php echo(BASE_URL);?>">
                                    <?php echo (empty($this->config['site_title'])?'@site_title':$this->config['site_title']); ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-10 col-xs-10 text-right">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#"></a></li>
                                <!--    <li><a href="index.html">Home</a></li>-->
                                <!--    <li><a href="about.html">About</a></li>-->
                                <!--    <li class="dropdown">-->
                                <!--        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Services<span class="caret"></span></a>-->
                                <!--        <ul class="dropdown-menu">-->
                                <!--            <li><a href="#">Web Design</a></li>-->
                                <!--            <li><a href="#">eCommerce</a></li>-->
                                <!--            <li><a href="#">Branding</a></li>-->
                                <!--            <li><a href="#">API</a></li>-->
                                <!--        </ul>-->
                                <!--    </li>-->
                                <!--    <li class="dropdown">-->
                                <!--        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Dropdown</a>-->
                                <!--        <ul class="dropdown-menu">-->
                                <!--            <li><a href="#">HTML5</a></li>-->
                                <!--            <li><a href="#">CSS3</a></li>-->
                                <!--            <li><a href="#">Sass</a></li>-->
                                <!--            <li><a href="#">jQuery</a></li>-->
                                <!--        </ul>-->
                                <!--    </li>-->
                                <!--    <li><a href="portfolio.html">Portfolio</a></li>-->
                                <!--    <li><a href="contact.html">Contact</a></li>-->
                                <?php $this->loadMenu('menuV1'); ?>
                            </ul>
                        </div>
                        <!--</div>-->
                    </div>
                </nav>
            <header>
                <div class="menu" id="header"></div>
                <div class="row">#nbsp</div>
            </header>
            <!--<div class="topo"></div>-->
            <!--<div class="menu"><?php //$this->loadMenu(); ?></div>-->
            
            <div class="container">
                <?php
                    $this->loadView($viewName, $viewData);
                ?>
            </div>
            
            <!-- BEGIN footer -->
            <footer id="gtco-footer" class="gtco-section" role="contentinfo">
                <div class="gtco-container">
                    <div class="row row-pb-md">
                        <div class="col-md-4 gtco-widget gtco-footer-paragraph">
                            <h3><?php echo (empty($this->config['site_title'])?'@site_title':$this->config['site_title']); ?></h3>
                            <p><?php echo (empty($this->config['site_endereco'])?'@site_endereco':$this->config['site_endereco']); ?></p>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6 gtco-footer-link">
                                    <h3>Links</h3>
                                    <ul class="gtco-list-link">
                                    <!--    <li><a href="#">Home</a></li>-->
                                    <!--    <li><a href="#">Features</a></li>-->
                                    <!--    <li><a href="#">Products</a></li>-->
                                    <!--    <li><a href="#">Testimonial</a></li>-->
                                    <!--    <li><a href="#">Contact</a></li>-->
                                        <?php $this->loadMenu('menuV2'); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 gtco-footer-subscribe">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail3">Email address</label>
                                    <input type="email" class="form-control" id="" placeholder="Email">
                                </div>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="gtco-copyright">
                    <div class="gtco-container">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <p><small>&copy; 2016 Free HTML5. All Rights Reserved. </small></p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p><small>Designed by <a href="#" target="_blank">Daniel Caldeira</a> Demo Images: <a href="http://pixeden.com/" target="_blank">Pixeden</a> &amp; 
                                <a href="http://unsplash.com" target="_blank">Unsplash</a></small> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- END footer -->
        </div>
    </body>
</html>
