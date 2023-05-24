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
        <link type="text/css" rel="stylesheet" href="<?php echo(BASE_URL);?>asserts/css/styleNatal.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo(BASE_URL);?>asserts/css/bootstrap.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo(BASE_URL);?>asserts/css/bootstrap-theme.css"/>
        
        <style>
            body{
                color: <?php echo ($this->config['site_color']); ?>;
                background-color: yellow;
            }
        </style>
    </head>
    <body>
        <div class="panel">
            
        
        In Default Natal!!
        <div class="panel-title"><?php echo ($this->config['site_title']); ?></div>
        <div class="panel-heading"><?php $this->loadMenu(); ?></div>
        <div class="container">
            <?php
                $this->loadViewInTemplate($viewName, $viewData)
            ?>
        </div>
        <div class="panel-footer">Footer</div>
        <br><br>
        </div>
    </body>
</html>
