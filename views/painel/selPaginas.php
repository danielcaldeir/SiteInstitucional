<?php 
    $add = FALSE;
    $edit = FALSE;
    $del = FALSE;
    foreach ($permissao as $perItem) {
        if (!strcmp($perItem, "add_pagina")){
            $add = TRUE;
        }
        if (!strcmp($perItem, "edit_pagina")){
            $edit = TRUE;
        }
        if (!strcmp($perItem, "del_pagina")){
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
    
    <section class="content-header">
      <h1>
        Paginas
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL); ?>pagina/"><i class="fa fa-link"></i>Paginas</a></li>
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
					<!--<a href="#AddPagina" class="btn btn-success" data-toggle="collapse">
                    <!--    <i class="fa fa-plus"></i>
                    <!--</a>
                    -->
                    <a href="<?php echo(BASE_URL);?>pagina/addPagina/" class="btn btn-success">
                        <i class="fa fa-plus"></i>
                    </a>
					<?php endif;?>
                </div>
            </div>
	<?php if ($add):?>
    <div id="AddPagina" class="collapse panel-collapse">
        <form action="<?php echo BASE_URL; ?>pagina/addAction" method="POST">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            <h3 class="h3">Adicionar Pagina</h3>
                        </div>
                        <div class="box-tools">
                            <input type="submit" id="botaoEnviarForm" value="Adicionar" class="btn btn-success" />
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="url">URL:</label>
                            <select name="url" id="url" class="form-control" required>
                                <?php foreach ($menuItem as $item) :?>
                                <option value="<?php echo($item); ?>"><?php echo($item); ?></option>
                                <?php endforeach;?>
                            </select>
                            <!--<input type="text" name="url" id="url" class="form-control" required/>-->
                        </div>
                        <div class="form-group">
                            <label for="menu">Criar menu automiticamente:</label>
                            <input type="checkbox" name="add_menu" id="add_menu" class="form-inline" value="SIM"/>
                        </div>
                        <div class="form-group">
                            <label for="titulo">Titulo:</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="corpo">Corpo</label>
                            <textarea name="corpo" id="corpo" class="form-control" required></textarea>
                        </div>
                        <a href="#AddPagina" class="btn btn-default" data-toggle="collapse">
                            <i class="fa fa-sign-out"></i>FECHAR
                        </a>
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
                    <?php foreach ($paginas as $item) :?>
                    <tr>
                        <td><?php echo($item['url']);?></td>
                        <td><?php echo($item['titulo']);?></td>
						<?php if($edit || $del):?>
                        <td>
                            <div class="btn-group">
								<?php if($edit):?>
                                <a href="<?php echo BASE_URL; ?>pagina/edit/<?php echo md5($item['id']); ?>" 
                                   class="btn btn-xs btn-primary">
                                    Editar
                                </a>
                                <?php endif;?>
								<?php if($del):?>
                                <a href="<?php echo BASE_URL; ?>pagina/delAction/<?php echo md5($item['id']); ?>" 
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
        
        <!--<pre>
        <!--    <?php print_r($menuItem)?>
        <!--</pre>
        -->
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
            
            
            window.onload = function(){
                CKEDITOR.replace("corpo");
            };
        </script>
        
    </section>
<br/><br/><br/><br/>

<!--<hr/>
<!--<div>
<!--        <?php echo("Bom Dia ".$nome);  ?>
<!--        <br>
<!--        <?php echo($this->config['site_painel_welcome']);?>
<!--        <br><br>
<!--        <h1 class="h1">Paginas</h1>
<!--        <a href="<?php echo(BASE_URL);?>paginas/add/" class="home_cta_button">Adicionar Pagina</a>
<!--        <table width="100%" border="1">
<!--            <tr>
<!--                <th>ID</th>
<!--                <th>URL</th>
<!--                <th>Titulo</th>
<!--                <th class="text-center">Ações</th>
<!--            </tr>
<!--            <?php foreach ($paginas as $itemPag): ?>
<!--            <tr>
<!--                <td><?php echo($itemPag['id']); ?></td>
<!--                <td><?php echo($itemPag['url'] );?></td>
<!--                <td><?php echo (utf8_encode($itemPag['titulo'])); ?></td>
<!--                <td class="text-center">
<!--                    <a class="home_cta_button" href="<?php echo(BASE_URL);?>paginas/edit/<?php echo($itemPag['id']); ?>">Editar Pagina</a> 
<!--                    <a class="home_cta_button" href="<?php echo(BASE_URL);?>paginas/excluirPagina/<?php echo($itemPag['id']); ?>">Excluir Pagina</a>
<!--                </td>
<!--            </tr>
<!--            <?php endforeach; ?>
<!--        </table>
<!--</div>
<!--<br/><br/><br/><br/>
-->