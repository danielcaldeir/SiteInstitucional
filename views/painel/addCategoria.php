<?php 
    $add = FALSE;
    $edit = FALSE;
    $del = FALSE;
    foreach ($permissao as $perItem) {
        if (!strcmp($perItem, "add_categoria")){
            $add = TRUE;
        }
        if (!strcmp($perItem, "edit_categoria")){
            $edit = TRUE;
        }
        if (!strcmp($perItem, "del_categoria")){
            $del = TRUE;
        }
    }
?>
    <!-- Content Header (Page header) -->
    <pre>
        <?php echo ("ADD: ");echo (($add)?'Verdadeiro':'Falso');?>
        <?php echo ("EDIT: ");echo (($edit)?'Verdadeiro':'Falso');?>
        <?php echo ("DEL: ");echo (($del)?'Verdadeiro':'Falso');?>
    </pre>
    
    <!--<pre><?php //print_r($cnaeFiltro);?></pre>-->

    <section class="content-header">
      <h1>
        Categorias
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL); ?>produto/"><i class="fa fa-archive"></i>Produto</a></li>
        <li class="active"><i class="fa fa-bank"></i>Categoria</li>
      </ol>
    </section>
    
    
    <!-- Main content -->
    <section class="content container-fluid">
        
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Todas as Paginas</h3>
                <div class="box-tools">
                    <?php if ($add):?>
					<a href="#AddCategoria" class="btn btn-success" data-toggle="collapse">
                        <i class="fa fa-plus"></i>
                    </a>
                    
                    <!--<a href="<?php echo(BASE_URL);?>pagina/addPagina/" class="btn btn-success">
                    <!--    <i class="fa fa-plus"></i>
                    <!--</a>
                    -->
					<?php endif;?>
                </div>
            </div>
	<?php if ($add):?>
        <div id="AddCategoria" class="collapse panel-collapse">
            <form action="<?php echo BASE_URL; ?>categorias/addAction" method="POST" enctype="multipart/form-data">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            <h3 class="h3">Adicionar Categoria</h3>
                        </div>
                        <div class="box-tools">
                            <input type="submit" id="botaoEnviarForm" value="Adicionar" class="btn btn-success" />
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" class="form-control" required/>
                        </div>
                    <!--    <div class="form-group">
                    <!--        <label for="url">URL:</label>
                    <!--        <input type="text" name="url" id="url" class="form-control" required/>
                    <!--    </div>
                    <!--    <div class="form-group">
                    <!--        <label for="tipo">Tipo</label><br>
                    <!--        <select name="tipo" id="tipo" class="form-control" required>
                    <!--            <option value="pagina">Página</option>
                    <!--            <option value="formulario">Formulário</option>
                    <!--            <option value="portfolio">Portfolio</option>
                    <!--        </select>
                    <!--    </div>
                    <!--    <a href="#AddUsuario" class="btn btn-default" data-toggle="collapse">
                    <!--        <i class="fa fa-sign-out"></i>FECHAR
                    <!--    </a>
                    -->
                    </div>
                </div>
            </form>
        </div>
    <?php endif;?>
	
            <div class="box-body">
                <table class="table table-condensed">
                    <tr>
                        <th>URL</th>
                        <th>Titulo</th>
						<?php if($edit || $del):?>
                        <th width="130">Ações</th>
						<?php endif;?>
                    </tr>
                    <?php foreach ($cats as $item) :?>
                    <tr>
                        <td><?php echo($item['id_empresa']);?></td>
                        <td><?php echo($item['nome']);?></td>
						<?php if($edit || $del):?>
                        <td>
                            <div class="btn-group">
								<?php if($edit):?>
                                <a href="<?php echo BASE_URL; ?>categorias/editCategoria/<?php echo md5($item['id']); ?>" 
                                   class="btn btn-xs btn-primary">
                                    Editar
                                </a>
                                <?php endif;?>
								<?php if($del):?>
                                <a href="<?php echo BASE_URL; ?>categorias/delAction/<?php echo md5($item['id']); ?>" 
                                   class="btn btn-xs btn-danger" onclick="return confirm('Tem certeza que deseja Excluir!')">
                                    Excluir
                                </a>
								<?php endif;?>
                            </div>
                        </td>
						<?php endif;?>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <!--<ul class="pagination">
                <!--    <?php for($q=1;$q<=$numeroPaginas;$q++):?>
                <!--    <li class="<?php if ($paginaAtual == $q) {echo "active"; } ?>">
                <!--        <a href="<?php echo BASE_URL;?>usuario/<?php 
                            $pag_array = $_GET;
                            unset($pag_array['q']);
                            $pag_array['pagAtual'] = $q;
                            echo ("?". http_build_query($pag_array) ); 
                            ?>">
                <!--            <?php echo $q; ?>
                <!--        </a>
                <!--    </li>
                <!--    <?php endfor; ?>
                <!--</ul>
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
    
    <br/><br/>
    <br/><br/>
<!--<hr>
<!--<div class="container-fluid">
<!--    <div class="navbar topnav">
<!--        <h2 class="h2">Cadastrar Categoria</h2>
<!--    </div>
<!--    <?php if ( $confirme == "error" ) :?>
<!--        <div class="alert-warning">
<!--            <label>Preencha todos os Campos</label>
<!--        </div>
<!--    <?php endif; ?>
<!--    <?php if ( $confirme == "success" ) :?>
<!--        <div class="alert-success">
<!--            <label>Registro inserido com sucesso</label>
<!--            <a href="<?php echo(BASE_URL."painel/menus"); ?>">
<!--                Acesse o Link para visualizar.
<!--            </a>
<!--        </div>
<!--    <?php endif; ?>
<!--    <?php if ( $confirme == "existe" ) :?>
<!--        <div class="alert-warning">
<!--            <label>Este registro ja existe!</label><br/>
<!--            <a href="<?php echo BASE_URL; ?>painel/menus">Acesse o Menu.</a>
<!--        </div>
<!--    <?php else :?>
<!--    <form action="<?php echo BASE_URL; ?>categorias/sisAddCategoria" method="POST">
<!--        <div class="form-group">
<!--            <label for="nome">Nome:</label>
<!--            <input type="text" name="nome" id="nome" class="form-control" required/>
<!--        </div>
<!--        <?php foreach ($subArray as $itemSub) :?>
<!--        <div class="form-group">
<!--            <label for="email">SUB:</label>
<!--            <input type="text" name="texto" id="texto" value="<?php echo($sub ." - ". utf8_encode($itemSub['nome'])); ?>" disabled class="form-control"/>
<!--        </div>
<!--        <?php endforeach; ?>
<!--        <input type="hidden" name="sub" id="sub" value="<?php echo($sub); ?>" />
<!--        <input type="submit" id="botaoEnviarForm" value="Adicionar" class="btn btn-success" />
<!--        <a href="<?php echo BASE_URL; ?>painel/menus/" class="btn btn-default">VOLTAR</a>
<!--    </form>
<!--    <!--<pre><?php print_r($subArray)?></pre>-->
<!--    <?php endif; ?>
<!--    <br/><br/><br/><br/>
<!--</div>
-->