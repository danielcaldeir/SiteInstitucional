<?php 
    $viewConfig = FALSE;
    $viewEmpresa = FALSE;
    foreach ($viewData['permissao'] as $perItem) {
        if (!strcmp($perItem, "view_config")){
            $viewConfig = TRUE;
        }
        if (!strcmp($perItem, "view_empresa")){
            $viewEmpresa = TRUE;
        }
    }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Painel Administrativo AdminLTE</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>asserts/bootstrap/css/bootstrap.min.css" type="text/css">
        <!--<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">-->
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>asserts/font-awesome/css/font-awesome.min.css" type="text/css">
        <!--<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">-->
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>asserts/Ionicons/css/ionicons.min.css" type="text/css">
        <!--<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">-->
        <!-- JQuery UI -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>asserts/jquery-ui/css/jquery-ui.min.css" type="text/css">
        <!-- Jquery UI THEME -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>asserts/jquery-ui/css/jquery-ui.theme.min.css" type="text/css">
        <!-- Jquery UI STRUCTURE -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>asserts/jquery-ui/css/jquery-ui.structure.min.css" type="text/css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>asserts/AdminLTE/dist/css/AdminLTE.min.css" type="text/css">
        <!--<link rel="stylesheet" href="dist/css/AdminLTE.min.css">-->
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
            page. However, you can choose any other skin. Make sure you
            apply the skin class to the body tag so the changes take effect. -->
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>asserts/AdminLTE/dist/css/skins/<?php echo($this->config['site_painel_color']);?>.css" type="text/css">
        <!--<link rel="stylesheet" href="<?php echo BASE_URL; ?>asserts/AdminLTE/dist/css/skins/skin-blue.min.css" type="text/css">-->
        <!--<link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">-->
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <!-- Template Antigo -->
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>asserts/css/template.css" />
        
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition <?php echo($this->config['site_painel_color']);?> sidebar-mini"><!-- skin-blue -->
    <!--<pre><?php //print_r($viewData['user'])?></pre>-->
	<!--<pre><?php //print_r($viewData['permissao'])?></pre>-->
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <?php if ($viewEmpresa):?>
    <a href="<?php echo BASE_URL; ?>config/empresa/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><?php echo($viewData['empresa']->getNome());?></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo($viewData['empresa']->getNome());?></b></span>
    </a>
    <?php else :?>
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><?php echo($viewData['empresa']->getNome());?></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo($viewData['empresa']->getNome());?></b></span>
    </a>
    <?php endif;?>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        <!-- Messages-menu: style can be found in dropdown.less-->
        <!--  <li class="dropdown messages-menu">
        <!--    <!-- Menu toggle button -->
        <!--    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!--      <i class="fa fa-envelope-o"></i>
        <!--      <span class="label label-success">4</span>
        <!--    </a>
        <!--    <ul class="dropdown-menu">
        <!--      <li class="header">You have 4 messages</li>
        <!--      <li>
        <!--        <!-- inner menu: contains the messages -->
        <!--        <ul class="menu">
        <!--          <!-- start message -->
        <!--          <li>
        <!--            <a href="#">
        <!--              <div class="pull-left">
        <!--                <!-- User Image -->
        <!--                <img src="<?php echo BASE_URL; ?>asserts/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        <!--                <!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
        <!--              </div>
        <!--              <!-- Message title and timestamp -->
        <!--              <h4>
        <!--                Support Team
        <!--                <small><i class="fa fa-clock-o"></i> 5 mins</small>
        <!--              </h4>
        <!--              <!-- The message -->
        <!--              <p>Why not buy a new awesome theme?</p>
        <!--            </a>
        <!--          </li>
        <!--          <!-- end message -->
        <!--        </ul>
        <!--        <!-- /.menu -->
        <!--      </li>
        <!--      <li class="footer"><a href="#">See All Messages</a></li>
        <!--    </ul>
        <!--  </li>
        <!-- End messages-menu -->
        <!-- Notifications Menu -->
        <!--  <li class="dropdown notifications-menu">
        <!--    <!-- Menu toggle button -->
        <!--    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!--      <i class="fa fa-bell-o"></i>
        <!--      <span class="label label-warning">10</span>
        <!--    </a>
        <!--    <ul class="dropdown-menu">
        <!--      <li class="header">You have 10 notifications</li>
        <!--      <li>
        <!--        <!-- Inner Menu: contains the notifications -->
        <!--        <ul class="menu">
        <!--          <!-- start notification -->
        <!--          <li>
        <!--            <a href="#">
        <!--              <i class="fa fa-users text-aqua"></i> 5 new members joined today
        <!--            </a>
        <!--          </li>
        <!--          <!-- end notification -->
        <!--        </ul>
        <!--      </li>
        <!--      <li class="footer"><a href="#">View all</a></li>
        <!--    </ul>
        <!--  </li>
        <!-- End Notifications Menu -->
        <!-- Tasks Menu -->
        <!--  <li class="dropdown tasks-menu">
        <!--    <!-- Menu Toggle Button -->
        <!--    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!--      <i class="fa fa-flag-o"></i>
        <!--      <span class="label label-danger">9</span>
        <!--    </a>
        <!--    <ul class="dropdown-menu">
        <!--      <li class="header">You have 9 tasks</li>
        <!--      <li>
        <!--        <!-- Inner menu: contains the tasks -->
        <!--        <ul class="menu">
        <!--          <!-- Task item -->
        <!--          <li>
        <!--            <a href="#">
        <!--              <!-- Task title and progress text -->
        <!--              <h3>
        <!--                Design some buttons
        <!--                <small class="pull-right">20%</small>
        <!--              </h3>
        <!--              <!-- The progress bar -->
        <!--              <div class="progress xs">
        <!--                <!-- Change the css width attribute to simulate progress -->
        <!--                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
        <!--                     aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
        <!--                  <span class="sr-only">20% Complete</span>
        <!--                </div>
        <!--              </div>
        <!--            </a>
        <!--          </li>
        <!--          <!-- end task item -->
        <!--        </ul>
        <!--      </li>
        <!--      <li class="footer">
        <!--        <a href="#">View all tasks</a>
        <!--      </li>
        <!--    </ul>
        <!--  </li>
        <!-- End Tasks Menu -->
        <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo BASE_URL; ?>asserts/AdminLTE/dist/img/<?php echo($this->config['site_painel_avatar']);?>.png" class="user-image" alt="User Image">
			  <!--<img src="<?php echo BASE_URL; ?>asserts/AdminLte/dist/img/avatar1.png" class="user-image" alt="User Image">-->
              <!--<img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $viewData['user']->getNome();?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                  <img src="<?php echo BASE_URL; ?>asserts/AdminLTE/dist/img/<?php echo($this->config['site_painel_avatar']);?>.png" class="img-circle" alt="User Image">
				  <!--<img src="<?php echo BASE_URL; ?>asserts/AdminLte/dist/img/avatar1.png" class="img-circle" alt="User Image">-->
                  <!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
                <p>
                  <?php echo $viewData['user']->getNome(); ?> - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!--<li class="user-body">
              <!--  <div class="row">
              <!--    <div class="col-xs-4 text-center">
              <!--      <a href="#">Followers</a>
              <!--    </div>
              <!--    <div class="col-xs-4 text-center">
              <!--      <a href="#">Sales</a>
              <!--    </div>
              <!--    <div class="col-xs-4 text-center">
              <!--      <a href="#">Friends</a>
              <!--    </div>
              <!--  </div>
              <!--</li>
              <!-- /Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo BASE_URL; ?>perfil/" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo BASE_URL; ?>login/logout/" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        <!-- End User Account Menu -->
          <!-- Control Sidebar Toggle Button -->
          <!--<li>
          <!--  <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          <!--</li>
          <!-- Fim Control Sidebar Toggle Button -->
          <!-- Config -->
          <?php if($viewConfig):?>
          <li>
            <a href="<?php echo BASE_URL; ?>config/"><i class="fa fa-gears"></i></a>
          </li>
          <!-- Fim Config-->
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel user-body">
        <div class="pull-left image">
            <img src="<?php echo BASE_URL; ?>asserts/AdminLTE/dist/img/<?php echo($this->config['site_painel_avatar']);?>.png" class="img-circle" alt="User Image">
			<!--<img src="<?php echo BASE_URL; ?>asserts/AdminLTE/dist/img/avatar1.png" class="img-circle" alt="User Image">-->
            <!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
        </div>
        <div class="pull-left info">
          <p><?php echo $viewData['user']->getNome();?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

    <!-- search form (Optional) -->
    <!--  <form action="#" method="get" class="sidebar-form">
    <!--    <div class="input-group">
    <!--        <input type="text" name="q" class="form-control" placeholder="Search...">
    <!--        <span class="input-group-btn">
    <!--            <button type="submit" name="search" id="search-btn" class="btn btn-flat">
    <!--              <i class="fa fa-search"></i>
    <!--            </button>
    <!--        </span>
    <!--    </div>
    <!--  </form>
    <!-- /.search form -->

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
        <?php if ($viewData['user']->validarPermissao('view_menu')): ?>
        <li <?php echo ($viewData['menuActive']=='menu')?'class="active"':'class=""'; ?>>
            <a href="<?php echo(BASE_URL."menu/"); ?>"><i class="fa fa-address-book"></i> <span>Menu</span></a>
        </li>
        <?php endif; ?>
        <?php if ($viewData['user']->validarPermissao('view_permissao')): ?>
        <li <?php echo ($viewData['menuActive']=='permissao')?'class="active"':'class=""'; ?>>
            <a href="<?php echo(BASE_URL."permissao/"); ?>"><i class="fa fa-plane"></i> <span>Permissoes</span></a>
        </li>
        <?php endif; ?>
        <?php if ($viewData['user']->validarPermissao('view_portfolio')): ?>
        <li <?php echo ($viewData['menuActive']=='portfolio')?'class="active"':'class=""'; ?>>
            <a href="<?php echo(BASE_URL."portfolio/"); ?>"><i class="fa fa-cart-plus"></i> <span>Portfolio</span></a>
        </li>
        <?php endif; ?>
        <?php if ($viewData['user']->validarPermissao('view_relatorio')): ?>
        <li <?php echo ($viewData['menuActive']=='relatorio')?'class="active"':'class=""'; ?>>
            <a href="<?php echo(BASE_URL."relatorio/"); ?>"><i class="fa fa-book"></i> <span>Relatorios</span></a>
        </li>
        <?php endif; ?>
        <?php if ($viewData['user']->validarPermissao('view_pagina')): ?>
        <li <?php echo ($viewData['menuActive']=='pagina')?'class="active"':'class=""'; ?>>
            <a href="<?php echo(BASE_URL."pagina/"); ?>"><i class="fa fa-link"></i> <span>Paginas</span></a>
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
        <?php if ($viewData['user']->validarPermissao('view_usuario')): ?>
        <li <?php echo ($viewData['menuActive']=='usuario')?'class="active"':'class=""'; ?>>
            <a href="<?php echo(BASE_URL."usuario/"); ?>"><i class="fa fa-user"></i> <span>Usuarios</span></a>
        </li>
        <?php endif; ?>
		<?php if ($viewData['user']->validarPermissao('view_empresa')): ?>
        <li <?php echo ($viewData['menuActive']=='empresa')?'class="active"':'class=""'; ?>>
            <a href="<?php echo(BASE_URL."empresas/"); ?>"><i class="fa fa-building"></i> <span>Empresas</span></a>
        </li>
        <?php endif; ?>
        <!-- Item Menu -->
    <!--    <li class="active">
    <!--        <a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a>
    <!--    </li>
        <!-- Fim Item Menu -->
        <!-- TreeView Menu -->
    <!--    <li class="treeview">
    <!--      <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
    <!--        <span class="pull-right-container">
    <!--            <i class="fa fa-angle-left pull-right"></i>
    <!--          </span>
    <!--      </a>
    <!--      <ul class="treeview-menu">
    <!--        <li><a href="#">Link in level 2</a></li>
    <!--        <li><a href="#">Link in level 2</a></li>
    <!--      </ul>
    <!--    </li>
        <!-- Fim TreeView Menu -->
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <?php $this->loadViewInPainel($viewName, $viewData); ?>
    
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">Nova Loja 2.0</a>.</strong> Todos os Direitos Reservados.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->
        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>
              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->
      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>
          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>
            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
        
        
        
<!--        <nav class="navbar navbar-inverse">
<!--          <div class="container-fluid">
<!--            <div class="navbar-header">
<!--                <a class="navbar-brand" href="<?php echo BASE_URL; ?>">Site Institucional</a>
<!--            </div>
<!--            <ul class="nav navbar-nav navbar-right">
<!--                <?php if ( !empty($_SESSION['user']) ): ?>
<!--                <li><a href="<?php echo BASE_URL; ?>usuario/gerenciaUsuario/">Gerenciar Usuario</a></li>
<!--                <li><a href="<?php echo BASE_URL; ?>pagina/">Gerenciar Página</a></li>
<!--                <li><a href="<?php echo BASE_URL; ?>menu/">Gerenciar Menu</a></li>
<!--                <li><a href="<?php echo BASE_URL; ?>sair/">Sair</a></li>
<!--                <?php else : ?>
<!--                <li><a href="<?php echo BASE_URL; ?>cadastrar/">Cadastra-se</a></li>
<!--                <li><a href="<?php echo BASE_URL; ?>login/">Login</a></li>
<!--                <?php endif; ?>
<!--            </ul>
<!--          </div>
<!--        </nav>
<!--        <div class="topo">
<!--          <div class="topo1"></div>
<!--          <div class="banner"></div>
<!--        </div>
<!--        <div class="menu">
<!--            <?php //$this->loadMenuPainel()?>
<!--        </div>
<!--        <div class="container-site">
<!--            <?php //$this->loadViewInPainel($viewName, $viewData); ?>
<!--        </div>
<!--        <div class="rodape">
<!--          <nav class="navbar navbar-right navbar-fixed-bottom">
<!--            <div class="container-fluid">
<!--              <div class="navbar-text navbar-default">
<!--                <h3>Página produzida para Analise de Programação</h3>
<!--              </div>
<!--            </div>
<!--          </nav>
<!--        </div>
-->

        
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<!--<script src="<?php echo BASE_URL; ?>asserts/JQuery/jquery-3.2.1.min.js"></script>-->
<script src="<?php echo BASE_URL; ?>asserts/JQuery/jquery-3.2.1.js"></script>
<!-- jQuery UI 1.12 -->
<script src="<?php echo BASE_URL; ?>asserts/Jquery-UI/js/jquery-ui.min.js"></script>
<!--<script src="bower_components/jquery/dist/jquery.min.js"></script>-->
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo BASE_URL; ?>asserts/bootstrap/js/bootstrap.min.js"></script>
<!--<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->
<!-- jQuery Mask 1.14.0 -->
<script src="<?php echo BASE_URL; ?>asserts/jquery-mask-plugin/dist/jquery.mask.js"></script>
<!--<script src="<?php echo BASE_URL; ?>asserts/jquery-mask-plugin/dist/jquery.mask.min.js"></script>-->
<!-- AdminLTE App -->
<script src="<?php echo BASE_URL; ?>asserts/adminLTE/dist/js/adminlte.min.js"></script>
<!--<script src="dist/js/adminlte.min.js"></script>-->
<!-- CKEditor App -->
<script type="text/javascript" src="<?php echo(BASE_URL);?>asserts/ckeditor/ckeditor.js"></script>
<!-- Script App -->
<script src="<?php echo BASE_URL; ?>asserts/js/script.js"></script>
<script type="text/javascript">
    var BASE_URL = '<?php echo BASE_URL; ?>';    
    
    function verificarCNPJ(obj) {
        if(validarCNPJ(obj.value)){
            obj.style.backgroundColor = 'white';
        }else{
            obj.style.backgroundColor = 'red';
        }
    };
    function verificarCPF(obj) {
        if(validaCPF(obj.value)){
            obj.style.backgroundColor = 'white';
        }else{
            obj.style.backgroundColor = 'red';
        }
    };
</script>

    </body>
</html>
