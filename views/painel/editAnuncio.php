    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Produtos
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL); ?>produto/"><i class="fa fa-archive"></i>Produtos</a></li>
        <li class="active"><i class="fa fa-anchor"></i>Editar Produto</li>
      </ol>
    </section>
    
    <?php if ( !empty($id) ) : ?>
    <!-- Main content -->
    <section class="content container-fluid">
        
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        
        <!-- <pre><?php //print_r($info)?></pre> -->
        <!-- <pre><?php //print_r($cats); ?></pre> -->
        <!-- <pre><?php //print_r($fotosArray); ?></pre> -->

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Editar Produto</h3>
                
            </div>
            <div class="box-body">
                <hr class="headline">
                <?php foreach ($info as $item) :?>
                <form action="<?php echo BASE_URL; ?>produto/editAction/" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="categoria">Categoria:</label>
                        <select name="categoria" id="categoria" class="form-control">
                        <?php foreach ($cats as $cat): ?>
                            <option value="<?php echo($cat['id']); ?>" <?php if($item['id_categoria']==$cat['id']): echo('selected'); endif;?>> 
                                <?php echo($cat['nome']); ?> 
                            </option>
                        <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="titulo">Titulo:</label>
                        <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo($item['titulo']);?>"/>
                    </div>
                    <div class="form-group">
                        <label for="valor">Valor:</label>
                        <input type="text" name="valor" id="valor" class="form-control" value="<?php echo(number_format($item['valor'], 2)); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descricao:</label>
                        <textarea name="descricao" id="descricao" class="form-control"><?php echo($item['descricao']);?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado de Conservacao:</label>
                        <select name="estado" id="estado" class="form-control">
                            <option value="0" <?php if($item['estado']==0):echo('selected'); endif;?>>Ruim</option>
                            <option value="1" <?php if($item['estado']==1):echo('selected'); endif;?>>Bom</option>
                            <option value="2" <?php if($item['estado']==2):echo('selected'); endif;?>>Otimo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="add_foto">Fotos do Anuncio:</label><br>
                        <input type="file" name="fotos[]" multiple />
                        <br/>
                        <div class="panel panel-default">
                            <div class="panel-heading">Fotos do Anuncio</div>
                            <div class="panel-body">
                                <?php if ($fotos) : ?>
                                <?php foreach ($fotosArray as $fotos) : ?>
                                <div class="foto_item">
                                    <img src="<?php echo BASE_URL; ?>//imagem//produto//<?php echo($fotos['url']); ?>" class="img-thumbnail" border="0">
                                    <br>
                                    <a href="<?php echo BASE_URL; ?>foto/excluirFoto/&id=<?php echo($fotos['id']); ?>" class="btn btn-danger">Excluir Foto</a>
                                </div>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                    <input type="submit" id="botaoEnviarForm" value="Editar" class="btn btn-success" />
                </form>
                <?php endforeach; ?>
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
            
            function verificarStatus() {
                var status = document.getElementById('status');
                var select = document.getElementById('permissao_select');
                var label = document.getElementById('permissao_label');
                //alert('Verificar Status: '+status.value);
                if (status.value === '2'){
                    select.style.display = 'block';
                    label.style.display = 'block';
                } else {
                    select.style.display = 'none';
                    label.style.display = 'none';
                }
            }
        </script>
    </section>
    <!--<br/>-->
  <?php else : ?>
        <div class="container">
            <h3 class="h3">Não foi informado um identificador.</h3>
            <a href="<?php echo BASE_URL; ?>menu/" class="btn btn-info">VOLTAR</a>
        </div>
  <?php endif; ?>

<br/><br/><br/><br/>

<!--<hr/>
<!--<?php if (isset($_SESSION['token']) && !empty($_SESSION['token'])): ?>
<!--<div class="container-fluid">
<!--    <div class="small jumbotron">
<!--        <h4>Editar Anuncios</h4>
<!--    </div>
<!--    <?php if ( !empty($confirme) ):?>
<!--        <?php if ( $confirme == "error") :?>
<!--            <div class="alert-warning">
<!--                <label>Preencha todos os Campos</label>
<!--            </div>
<!--        <?php endif; ?>
<!--    <?php endif; ?>
<!--    <?php if ( !empty($confirme) ):?>
<!--        <?php if ( $confirme == "sucess" ) :?>
<!--            <div class="alert-success">
<!--                <strong>Anuncio Editado com Sucesso!</strong>
<!--            </div>
<!--        <?php endif; ?>
<!--    <?php endif; ?>
<!--    <?php if ( !empty($id) ) : ?>
<!--    <?php foreach($info as $item):?>
<!--    <form action="<?php echo BASE_URL; ?>produto/sisEditarAnuncio/" method="POST" enctype="multipart/form-data">
<!--        <div class="form-group">
<!--            <label for="categoria">Categoria:</label>
<!--            <select name="categoria" id="categoria" class="form-control">
<!--            <?php foreach ($cats as $cat): ?>
<!--                <option value="<?php echo($cat['id']); ?>" <?php if($item['id_categoria']==$cat['id']): echo('selected'); endif;?>> 
<!--                    <?php echo($cat['nome']); ?> 
<!--                </option>
<!--            <?php endforeach;?>
<!--            </select>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="titulo">Titulo:</label>
<!--            <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo($item['titulo']);?>"/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="valor">Valor:</label>
<!--            <input type="text" name="valor" id="valor" class="form-control" value="<?php echo(number_format($item['valor'], 2)); ?>"/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="descricao">Descricao:</label>
<!--            <textarea name="descricao" id="descricao" class="form-control"><?php echo($item['descricao']);?></textarea>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="estado">Estado de Conservacao:</label>
<!--            <select name="estado" id="estado" class="form-control">
<!--                <option value="0" <?php if($item['estado']==0):echo('selected'); endif;?>>Ruim</option>
<!--                <option value="1" <?php if($item['estado']==1):echo('selected'); endif;?>>Bom</option>
<!--                <option value="2" <?php if($item['estado']==2):echo('selected'); endif;?>>Otimo</option>
<!--            </select>
<!--        </div>
<!--            <div class="form-group">
<!--                <label for="add_foto">Fotos do Anuncio:</label><br>
<!--                <input type="file" name="fotos[]" multiple />
<!--                <br/>
<!--                <div class="panel panel-default">
<!--                    <div class="panel-heading">Fotos do Anuncio</div>
<!--                    <div class="panel-body">
<!--                        <?php if ($fotos) : ?>
<!--                        <?php foreach ($fotosArray as $fotos) : ?>
<!--                        <div class="foto_item">
<!--                            <img src="<?php echo BASE_URL; ?>//imagem//produto//<?php echo($fotos['url']); ?>" class="img-thumbnail" border="0">
<!--                            <br>
<!--                            <a href="<?php echo BASE_URL; ?>foto/excluirFoto/&id=<?php echo($fotos['id']); ?>" class="btn btn-danger">Excluir Foto</a>
<!--                        </div>
<!--                        <?php endforeach; ?>
<!--                        <?php endif; ?>
<!--                    </div>
<!--                </div>
<!--            </div>
<!--            <input type="hidden" id="id" name="id" value="<?php echo($item['id']); ?>"/>
<!--            <input type="hidden" id="token" name="token" value="<?php echo($_SESSION['token']); ?>" />
<!--            <input type="submit" id="botaoEnviarForm" value="SALVAR" class="btn btn-default"/> | 
<!--            <a href="<?php echo BASE_URL; ?>produto/meusAnuncios/" class="btn btn-default">VOLTAR</a>
<!--        </form>
<!--        <?php endforeach;?>
<!--    <br/>    <br/>    <br/>    <br/>    <br/>
<!--    <?php else : ?>
<!--    <form action="./index.php?pag=meusAnuncios" method="POST">
<!--        <div class="form-group">
<!--            <label>Não foi informado um identificador.</label>
<!--        </div>
<!--        <input type="submit" class="btn btn-default" value="VOLTAR"/>
<!--    </form>
<!--    <?php endif; ?>
<!--</div>
<!--<?php else: ?>
<!-- <script type="text/javascript" >window.location.href="./index.php?pag=login"; </script> -->
<!--<?php endif; ?>
-->