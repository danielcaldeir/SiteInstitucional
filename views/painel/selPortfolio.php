<?php 
    $add = FALSE;
    $edit = null;
    $del = FALSE;
    foreach ($permissao as $perItem) {
        if (!strcmp($perItem, "add_portfolio")){
            $add = TRUE;
        }
        if (!strcmp($perItem, "edit_portfolio")){
            $edit = TRUE;
        }
        if (!strcmp($perItem, "del_portfolio")){
            $del = TRUE;
        }
    }
?>
    <!-- Content Header (Page header) -->
	<pre>
        <?php echo ("ADD: ");echo (($add)?'Verdadeiro':(is_null($add)?'Nao se Aplica':'Falso'));?>
        <?php echo ("EDIT: ");echo (($edit)?'Verdadeiro':(is_null($edit)?'Nao se Aplica':'Falso'));?>
        <?php echo ("DEL: ");echo (($del)?'Verdadeiro':(is_null($del)?'Nao se Aplica':'Falso'));?>
    </pre>
	
    <section class="content-header">
      <h1>
        Portfolio
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL); ?>portfolio/"><i class="fa fa-address-book"></i>Portfolio</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Grupos</h3>
                <div class="box-tools">
					<?php if($add):?>
                    <!--<a href="#AddPortfolio" class="btn btn-success" data-toggle="collapse">
                    <!--    <i class="fa fa-plus"></i>
                    <!--</a>
					-->
                    <a href="<?php echo BASE_URL; ?>portfolio/add/" class="btn btn-success">
                        <i class="fa fa-plus"></i>
                    </a>
                    
					<?php endif;?>
                </div>
            </div>
	<?php if($add):?>
    <div id="AddPortfolio" class="collapse panel-collapse">
        <form action="<?php echo(BASE_URL); ?>portfolio/addPortfolio" method="POST" enctype="multipart/form-data">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h3 class="h3">Adicionar Imagem</h3>
                    </div>
                    <div class="box-tools">
                        <input type="submit" value="Enviar" class="btn btn-info"/>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <input type="file" name="fotos[]" multiple />
                    </div>
                    <a href="#AddPortfolio" class="btn btn-default" data-toggle="collapse">
                        <i class="fa fa-sign-out"></i>FECHAR
                    </a>
                </div>
            </div>
        </form>
        <!--<form action="<?php echo BASE_URL; ?>menu/addAction" method="POST" enctype="multipart/form-data">
        <!--        <div class="box">
        <!--            <div class="box-header">
        <!--                <div class="box-title">
        <!--                    <h3 class="h3">Adicionar Menu</h3>
        <!--                </div>
        <!--                <div class="box-tools">
        <!--                    <input type="submit" id="botaoEnviarForm" value="Adicionar" class="btn btn-success" />
        <!--                </div>
        <!--            </div>
        <!--            <div class="box-body">
        <!--                <div class="form-group">
        <!--                    <label for="nome">Nome:</label>
        <!--                    <input type="text" name="nome" id="nome" class="form-control" required/>
        <!--                </div>
        <!--                <div class="form-group">
        <!--                    <label for="url">URL:</label>
        <!--                    <input type="text" name="url" id="url" class="form-control" required/>
        <!--                </div>
        <!--                <div class="form-group">
        <!--                    <label for="tipo">Tipo</label><br>
        <!--                    <select name="tipo" id="tipo" class="form-control" required>
        <!--                        <option value="pagina">Página</option>
        <!--                        <option value="formulario">Formulário</option>
        <!--                        <option value="portfolio">Portfolio</option>
        <!--                    </select>
        <!--                </div>
        <!--                <a href="#AddMenu" class="btn btn-default" data-toggle="collapse">
        <!--                    <i class="fa fa-sign-out"></i>FECHAR
        <!--                </a>
        <!--            </div>
        <!--        </div>
        <!--    </form>
        -->
    </div>
	<?php endif;?>
            <div class="box-body">
                <?php foreach ($portfolio as $item): ?>
		<div class="portfolio-painel">
			<img src="<?php echo BASE_URL; ?>imagem/portfolio/<?php echo($item['imagem']); ?>" border="0" width="200" height="150">
			<?php if($del):?>
			<a href="<?php echo(BASE_URL); ?>portfolio/delPortfolio/<?php echo($item['id']); ?>">Excluir Imagem</a> <br/>
			<?php endif;?>
		</div>
                <?php endforeach; ?>
                <!--<table class="table table-condensed">
                <!--    <tr>
                <!--        <th>Nome</th>
                <!--        <th>URL</th>
                <!--        <th>Tipo</th>
                <!--        <th width="130">Ações</th>
                <!--    </tr>
                <!--    <?php foreach ($menus as $item) :?>
                <!--    <tr>    
                <!--        <td><?php echo utf8_encode($item['nome']);?></td>
                <!--        <td><?php echo($item['url']);?></td>
                <!--        <td><?php echo($item['tipo']);?></td>
                <!--        <td>
                <!--            <div class="btn-group">
                <!--                <a href="<?php echo BASE_URL; ?>menu/edit/<?php echo md5($item['id']); ?>" 
                <!--                   class="btn btn-xs btn-primary">
                <!--                    Editar
                <!--                </a>
                <!--                <a href="<?php echo BASE_URL; ?>menu/delAction/?id=<?php echo md5($item['id']); ?>" 
                <!--                   class="btn btn-xs btn-danger" onclick="return confirm('Tem certeza que deseja Excluir!')">
                <!--                    Excluir
                <!--                </a>
                <!--            </div>
                <!--        </td>
                <!--    </tr>
                <!--    <?php endforeach; ?>
                <!--</table>
                -->
            </div>
        </div>
        
        
        <script>
            function verificarDataHora() {
                var now = new Date(); 
                var hrs = now.getHours(); 
                var msg = ""; 
                if (hrs > 0) msg = "Mornin' Sunshine!"; 
                // REALLY early 
                if (hrs > 6) msg = "Good morning"; 
                // After 6am 
                if (hrs > 12) msg = "Good afternoon"; 
                // After 12pm 
                if (hrs > 17) msg = "Good evening"; 
                // After 5pm 
                if (hrs > 22) msg = "Go to bed!"; 
                // After 10pm 
                alert(msg);
            }
        </script>
        
    </section>
    
    
<!--<div>
<!--    <?php echo("Bom Dia ".$nome);  ?>
<!--    <br>
<!--    <div style="clear: both"></div>
<!--    <h1 class="h1">Portfolio</h1>
<!--    <form action="<?php echo(BASE_URL."painel/addPortfolio"); ?>" method="POST" enctype="multipart/form-data">
<!--        <fieldset style="border: 1px solid; border-color: #000">
<!--            <legend>Adicionar Imagem</legend>
<!--            <input type="file" name="fotos[]" multiple />
<!--            <input type="submit" value="Enviar" />
<!--        </fieldset>
<!--    </form>
<!--    <!--<a href="<?php echo(BASE_URL."painel/addPortfolio");?>" class="home_cta_button">Adicionar Imagem</a>-->
<!--    <div style="clear: both"></div>
<!--    <?php foreach ($portfolio as $item): ?>
<!--        <div class="portfolio-painel">
<!--            <img src="<?php echo BASE_URL; ?>imagem/portfolio/<?php echo($item['imagem']); ?>" border="0" width="200" height="150">
<!--            <a href="<?php echo(BASE_URL."painel/delPortfolio/".$item['id']); ?>">Excluir Imagem</a> <br/>
<!--        </div>
<!--    <?php endforeach; ?>
<!--    <div style="clear: both"></div>
<!--</div>
-->
