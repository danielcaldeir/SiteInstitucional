<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo ($this->config['site_painel_title']); ?></title>
        <link type="text/css" rel="stylesheet" href="<?php echo(BASE_URL);?>asserts/css/painel.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo(BASE_URL);?>asserts/bootstrap/css/bootstrap.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo(BASE_URL);?>asserts/css/farbtastic.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo(BASE_URL);?>asserts/bootstrap/css/bootstrap-theme.css"/>
        <!--<script type="text/javascript" src="<?php echo(BASE_URL);?>asserts/bootstrap/js/bootstrap.js"></script>-->
        <script type="text/javascript" src="<?php echo(BASE_URL);?>asserts/js/farbtastic.js"></script>
        <!--<script type="text/javascript" src="<?php echo(BASE_URL);?>asserts/ckeditor/ckeditor.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo(BASE_URL);?>asserts/jquery/dist/jquery.js"></script>-->
        
    </head>
    <body>
        <nav class="nav navbar-fixed-top">
            <div class="navbar-right">
                Painel Administrativo: <?php echo ($this->config['site_painel_title']); ?> &nbsp; &nbsp; &nbsp;
            </div>
        </nav>
        <div class="menu">
            <?php //$this->loadMenuPainel(); ?>
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
              <li class="header">MENU</li>
              <!-- Optionally, you can add icons to the links -->
              <li <?php echo ($viewData['menuActive']=='home')?'class="active"':'class=""'; ?>>
                  <a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
              </li>
              <?php if ($viewData['user']->validarPermissao('view_vendas')): ?>
              <li <?php echo ($viewData['menuActive']=='venda')?'class="active"':'class=""'; ?>>
                  <a href="<?php echo(BASE_URL."vendas/"); ?>"><i class="fa fa-credit-card"></i> <span>Vendas</span></a>
              </li>
              <?php endif; ?>
              <?php if ($viewData['user']->validarPermissao('add_menu')): ?>
              <li <?php echo ($viewData['menuActive']=='menu')?'class="active"':'class=""'; ?>>
                  <a href="<?php echo(BASE_URL."menu/"); ?>"><i class="fa fa-address-book"></i> <span>Menu</span></a>
              </li>
              <?php endif; ?>
              <?php if ($viewData['user']->validarPermissao('add_permissao')): ?>
              <li <?php echo ($viewData['menuActive']=='permissao')?'class="active"':'class=""'; ?>>
                  <a href="<?php echo(BASE_URL."permissao/"); ?>"><i class="fa fa-plane"></i> <span>Permissoes</span></a>
              </li>
              <?php endif; ?>
              <?php if ($viewData['user']->validarPermissao('view_portfolio')): ?>
              <li <?php echo ($viewData['menuActive']=='compra')?'class="active"':'class=""'; ?>>
                  <a href="<?php echo(BASE_URL."portfolio/"); ?>"><i class="fa fa-cart-plus"></i> <span>Portfolio</span></a>
              </li>
              <?php endif; ?>
              <?php if ($viewData['user']->validarPermissao('view_relatorio')): ?>
              <li <?php echo ($viewData['menuActive']=='relatorio')?'class="active"':'class=""'; ?>>
                  <a href="<?php echo(BASE_URL."relatorio/"); ?>"><i class="fa fa-book"></i> <span>Relatorios</span></a>
              </li>
              <?php endif; ?>
              <?php if ($viewData['user']->validarPermissao('edit_pagina')): ?>
              <li <?php echo ($viewData['menuActive']=='pagina')?'class="active"':'class=""'; ?>>
                  <a href="<?php echo(BASE_URL); ?>paginas/"><i class="fa fa-link"></i> <span>Paginas</span></a>
              </li>
              <?php endif; ?>
              <?php if ($viewData['user']->validarPermissao('view_cliente')): ?>
              <li <?php echo ($viewData['menuActive']=='cliente')?'class="active"':'class=""'; ?>>
                  <a href="<?php echo(BASE_URL."clientes/"); ?>"><i class="fa fa-users"></i> <span>Clientes</span></a>
              </li>
              <?php endif; ?>
              <?php if ($viewData['user']->validarPermissao('view_produto')): ?>
              <li <?php echo ($viewData['menuActive']=='produto')?'class="active"':'class=""'; ?>>
                  <a href="<?php echo(BASE_URL."produto/"); ?>"><i class="fa fa-archive"></i> <span>Produtos</span></a>
              </li>
              <?php endif; ?>
              <?php if ($viewData['user']->validarPermissao('add_usuario')): ?>
              <li <?php echo ($viewData['menuActive']=='usuario')?'class="active"':'class=""'; ?>>
                  <a href="<?php echo(BASE_URL); ?>usuarios/"><i class="fa fa-user"></i> <span>Usuarios</span></a>
              </li>
              <?php endif; ?>
              <?php if ($viewData['user']->validarPermissao('view_empresa')): ?>
              <li <?php echo ($viewData['menuActive']=='empresa')?'class="active"':'class=""'; ?>>
                  <a href="<?php echo(BASE_URL."empresas/"); ?>"><i class="fa fa-archive"></i> <span>Empresas</span></a>
              </li>
              <?php endif; ?>
              <!-- Item Menu -->
              <!--<li class="active">
              <!--    <a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a>
              <!--</li>
              <!-- Fim Item Menu -->
              <!-- TreeView Menu -->
              <!--<li class="treeview">
              <!--  <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
              <!--    <span class="pull-right-container">
              <!--        <i class="fa fa-angle-left pull-right"></i>
              <!--      </span>
              <!--  </a>
              <!--  <ul class="treeview-menu">
              <!--    <li><a href="#">Link in level 2</a></li>
              <!--    <li><a href="#">Link in level 2</a></li>
              <!--  </ul>
              <!--</li>
              <!-- Fim TreeView Menu -->
              <li class="navbar-default">
                  <a class="btn btn-warning" href="<?php echo(BASE_URL);?>perfil/"> <span>Perfil</span></a>
              </li>
              <li class="navbar-default">
                  <a class="btn btn-warning" href="<?php echo(BASE_URL);?>login/logout/"> <span>Sair</span></a>
              </li>
            </ul>
            <!-- /.sidebar-menu -->
        </div>
        <div class="container">
            <?php $this->loadViewInPainel($viewName, $viewData); ?>
        </div>
        <div class="rodape">Footer</div>
        <br><br>
        <!--<nav class="navbar navbar-fixed-bottom">
        <!--    <div class="container-fluid home_cta">
        <!--        <div class="navbar-text navbar-default">
        <!--            <h5><a class="home_cta_button" href="<?php echo(BASE_URL.'login/logout');?>">Logout</a></h5>
        <!--        </div>
        <!--    </div>
        <!--</nav>
        -->
        
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
<!--<script src="<?php echo BASE_URL; ?>dist/js/adminlte.min.js"></script>-->
<!-- CKEditor App -->
<script type="text/javascript" src="<?php echo(BASE_URL);?>asserts/ckeditor/ckeditor.js"></script>
<!-- Script App -->
<script src="<?php echo BASE_URL; ?>asserts/js/script.js"></script>

    </body>
</html>
