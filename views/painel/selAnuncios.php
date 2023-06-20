<?php 
    $add = FALSE;
    $edit = FALSE;
    $del = FALSE;
    foreach ($permissao as $perItem) {
        if (!strcmp($perItem, "add_produto")){
            $add = TRUE;
        }
        if (!strcmp($perItem, "edit_produto")){
            $edit = TRUE;
        }
        if (!strcmp($perItem, "del_produto")){
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
        Produto
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL); ?>produto/"><i class="fa fa-archive"></i>Produto</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Todos os Produtos</h3>
                <div class="box-tools">
					<?php if($add):?>
                    <a href="#AddPortfolio" class="btn btn-success" data-toggle="collapse">
                        <i class="fa fa-plus"></i>
                    </a>
					
                    <!--<a href="<?php echo BASE_URL; ?>produto/add/" class="btn btn-success">
                    <!--    <i class="fa fa-plus"></i>
                    <!--</a>
                    -->
					<?php endif;?>
                </div>
            </div>
	<?php if($add):?>
    <div id="AddPortfolio" class="collapse panel-collapse">
        <!--<form action="<?php echo(BASE_URL); ?>produto/addAction" method="POST" enctype="multipart/form-data">
        <!--    <div class="box">
        <!--        <div class="box-header">
        <!--            <div class="box-title">
        <!--                <h3 class="h3">Adicionar Imagem</h3>
        <!--            </div>
        <!--            <div class="box-tools">
        <!--                <input type="submit" value="Enviar" class="btn btn-info"/>
        <!--            </div>
        <!--        </div>
        <!--        <div class="box-body">
        <!--            <div class="form-group">
        <!--                <input type="file" name="fotos[]" multiple />
        <!--            </div>
        <!--            <a href="#AddPortfolio" class="btn btn-default" data-toggle="collapse">
        <!--                <i class="fa fa-sign-out"></i>FECHAR
        <!--            </a>
        <!--        </div>
        <!--    </div>
        <!--</form>
		-->
        <form action="<?php echo BASE_URL; ?>produto/addAction" method="POST" enctype="multipart/form-data">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            <h3 class="h3">Adicionar Anuncio</h3>
                        </div>
                        <div class="box-tools">
                            <input type="submit" id="botaoEnviarForm" value="Adicionar" class="btn btn-success" />
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="categoria">Categoria:</label>
							<a href="<?php echo BASE_URL; ?>categorias/addCategoria/" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </a>
                            
                            <select name="categoria" id="categoria" class="form-control">
                            <?php foreach ($cats as $cat): ?>
                                <option value="<?php echo($cat['id']); ?>"> <?php echo($cat['nome']); ?> </option>
                            <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="titulo">Titulo:</label>
                            <input type="text" name="titulo" id="titulo" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="valor">Valor:</label>
                            <input type="text" name="valor" id="valor" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descricao:</label>
                            <textarea name="descricao" id="descricao" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado de Conservacao:</label>
                            <select name="estado" id="estado" class="form-control">
                                <option value="0">Ruim</option>
                                <option value="1">Bom</option>
                                <option value="2">Otimo</option>
                            </select>
                        </div>
                        <a href="#AddPortfolio" class="btn btn-default" data-toggle="collapse">
                            <i class="fa fa-sign-out"></i>FECHAR
                        </a>
                    </div>
                </div>
            </form>
        
    </div>
	<?php endif;?>
            <div class="box-body">
                <!--<?php// foreach ($anuncios as $item): ?>
                <!--<div class="portfolio-painel">
                <!--    <img src="<?php// echo BASE_URL; ?>imagem/portfolio/<?php// echo($item['imagem']); ?>" border="0" width="200" height="150">
                <!--    <?php// if($del):?>
                <!--    <a href="<?php// echo(BASE_URL); ?>portfolio/delPortfolio/<?php// echo($item['id']); ?>">Excluir Imagem</a>
                <!--    <br/>
                <!--    <?php// endif;?>
                <!--</div>
                <!--<?php// endforeach; ?>
				-->
                <table class="table table-condensed">
                    <tr>
                        <th>Foto</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th width="130">Ações</th>
                    </tr>
                    <?php foreach ($anuncios as $anuncio) :?>
                    <tr>    
                        <td>
                        <?php if (!empty($anuncio['url'])) :?>
                            <img src="<?php echo BASE_URL; ?>imagem/produto/<?php echo($anuncio['url']); ?>" border="0" height="50"/>
                        <?php else : ?>
                            <img src="<?php echo BASE_URL; ?>upload/minimagem.jpg" border="0" height="50"/>
                        <?php endif; ?>
                        </td>
                        <td><?php echo ($anuncio['titulo']);?></td>
                        <td><?php echo ($anuncio['valor']);?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo BASE_URL; ?>produto/edit/<?php echo md5($anuncio['id']); ?>" 
                                   class="btn btn-xs btn-primary">
                                    Editar
                                </a>
                                <a href="<?php echo BASE_URL; ?>produto/delAction/?id=<?php echo md5($anuncio['id']); ?>" 
                                   class="btn btn-xs btn-danger" onclick="return confirm('Tem certeza que deseja Excluir!')">
                                    Excluir
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                
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

<?php //if (isset($_SESSION['id']) && !empty($_SESSION['id'])): ?>
<!--<div class="container-fluid">
<!--    <div class="jumbotron">
<!--        <h4>Meus Anuncios</h4>
<!--    </div>
<!--    <?php if ( $confirme == "excluir" ) :?>
<!--            <div class="alert-success">
<!--                <strong>Anuncio Excluido!</strong>
<!--            </div>
<!--    <?php endif; ?>
<!--    <form action="<?php echo BASE_URL; ?>produto/addAnuncio/" method="POST">
<!--        <input type="submit" class="btn-default" value="Adicionar Anuncio">
<!--    </form>
<!--    <table class="table table-bordered">
<!--        <thead>
<!--            <tr>
<!--                <th>Foto</th>
<!--                <th>Tipo</th>
<!--                <th>Valor</th>
<!--                <th>Acoes</th>
<!--            </tr>
<!--        </thead>
<!--        <?php foreach ($anuncios as $anuncio): ?>
<!--        <tr>
<!--            <td>
                <?php if (!empty($anuncio['url'])) :?>
                <img src="<?php echo BASE_URL; ?>upload/<?php echo($anuncio['url']); ?>" border="0" height="50"/>
                <?php else : ?>
                    <img src="<?php echo BASE_URL; ?>upload/minimagem.jpg" border="0" height="50"/>
                <?php endif; ?>
<!--            </td>
<!--            <td><?php echo ($anuncio['titulo']); ?></td>
<!--            <td><?php echo (number_format($anuncio['valor'],2)); ?></td>
<!--            <td>
<!--                <a href="<?php echo BASE_URL; ?>produto/editarAnuncio/<?php echo($anuncio['id']); ?>" class="btn btn-info">
<!--                    Editar
<!--                </a>
<!--                <a href="<?php echo BASE_URL; ?>produto/excluirAnuncio/<?php echo($anuncio['id']); ?>" class="btn btn-danger">
<!--                    Excluir
<!--                </a>
<!--            </td>
<!--        </tr>
<!--        <?php endforeach;?>
<!--    </table>
<!--    <br/><br/><br/><br/>
<!--</div>
-->
<?php //else: ?>
<!--<script type="text/javascript" >window.location.href="./index.php?pag=login"; </script>-->
<?php //endif; ?>