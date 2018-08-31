<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Classificados MVC</title>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>asserts/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>asserts/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>asserts/css/template.css" />
        <script type="text/javascript" src="<?php echo BASE; ?>asserts/js/jquery-3.2.1.js" ></script>
        <script type="text/javascript" src="<?php echo BASE; ?>asserts/js/bootstrap.min.js" ></script>
    </head>
    <body>
		<nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo BASE; ?>">Site Institucional</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <?php if ( !empty($_SESSION['user']) ): ?>
                    <li><a href="<?php echo BASE; ?>painel/">Meus Anuncios</a></li>
                    <li><a href="<?php echo BASE; ?>sair/">Sair</a></li>
                    <?php else : ?>
                    <li><a href="<?php echo BASE; ?>cadastrar/">Cadastra-se</a></li>
                    <li><a href="<?php echo BASE; ?>login/">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
		
        <div class="topo">
            <div class="topo1"></div>
            <div class="banner"></div>
        </div>
        <div class="menu">
            <ul >
                <a href="<?php echo BASE; ?>"><li >HOME</li></a>
                <a href="<?php echo BASE; ?>painel/portfolio"><li >PORTFOLIO</li></a>
                <a href="<?php echo BASE; ?>painel/sobre"><li >SOBRE</li></a>
                <a href="<?php echo BASE; ?>painel/servicos"><li >SERVICOS</li></a>
                <a href="<?php echo BASE; ?>painel/contato"><li >CONTATO</li></a>
            </ul>
        </div>
        <div class="container-site">
            <?php $this->loadViewInPainel($viewName, $viewData); ?>
        </div>
        <div class="rodape"></div>
        
        
        
        <!--
        <nav class="navbar navbar-right navbar-fixed-bottom">
            <div class="container-fluid">
                <div class="navbar-text navbar-default">
                    <h3>Página produzida para Analise de Programação</h3>
                </div>
            </div>
        </nav>
        -->
    </body>
</html>
