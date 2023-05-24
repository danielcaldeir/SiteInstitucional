<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo ($this->config['site_title']); ?></title>
        <link type="text/css" rel="stylesheet" href="<?php echo(BASE_URL);?>asserts/css/style.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo(BASE_URL);?>asserts/bootstrap/css/bootstrap.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo(BASE_URL);?>asserts/bootstrap/css/bootstrap-theme.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo(BASE_URL);?>asserts/AdminLTE/dist/css/AdminLTE.css"/>
        
    </head>
    <body>
        <div class="topo">header</div>
        <div class="menu"><?php $this->loadMenu(); ?>
        </div>
        <div class="container">
            <?php
                $this->loadViewInTemplate($viewName, $viewData);
            ?>
        </div>
        <div class="rodape">Footer</div>
        <br><br>
        
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<!--<script src="<?php echo BASE_URL; ?>asserts/jquery/dist/jquery.min.js"></script>-->
<script src="<?php echo BASE_URL; ?>asserts/jquery/dist/jquery.js"></script>
<!-- jQuery UI 1.12 -->
<!--<script src="<?php echo BASE_URL; ?>asserts/Jquery-UI/js/jquery-ui.min.js"></script>-->
<!--<script src="bower_components/jquery/dist/jquery.min.js"></script>-->
<!-- Bootstrap 3.3.7 -->
<!--<script src="<?php echo BASE_URL; ?>asserts/bootstrap/js/bootstrap.min.js"></script>-->
<script src="<?php echo BASE_URL; ?>asserts/bootstrap/js/bootstrap.js"></script>
<!-- jQuery Mask 1.14.0 -->
<!--<script src="<?php echo BASE_URL; ?>asserts/js/jquery.mask.js"></script>-->
<!--<script src="<?php echo BASE_URL; ?>asserts/js/jquery.mask.min.js"></script>-->
<!-- AdminLTE App -->
<!--<script src="<?php echo BASE_URL; ?>asserts/adminLTE/dist/js/adminlte.min.js"></script>-->
<script src="<?php echo BASE_URL; ?>asserts/adminLTE/dist/js/adminlte.js"></script>
<!-- CKEditor App -->
<script type="text/javascript" src="<?php echo(BASE_URL);?>asserts/ckeditor/ckeditor.js"></script>
<!-- Script App -->
<script src="<?php echo BASE_URL; ?>asserts/js/script.js"></script>
    </body>
</html>
