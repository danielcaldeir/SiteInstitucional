    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tela de Menu
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL."menu/"); ?>"><i class="fa fa-address-book"></i>Menu</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        
        <!--<div class="box">
        <!--    <div class="box-header">
        <!--        <h3 class="box-title">Filtro</h3>
        <!--    </div>
        <!--    <div class="box-body">
        <!--        <div class="row">
        <!--            <form method="GET">
        <!--                <div class="col-sm-4">
        <!--                    <label for="nome_filtro">Nome</label><br>
        <!--                    <input type="text" name="nome" id="nome_filtro" value="<?php echo($filtro['nome']);?>" class="form-control"/>
        <!--                </div>
        <!--                <div class="col-sm-3">
        <!--                    <label for="email_filtro">E-Mail</label><br>
        <!--                    <input type="text" name="email" id="email_filtro" value="<?php echo($filtro['email']);?>" class="form-control"/>
        <!--                </div>
        <!--                <div class="col-sm-2">
        <!--                    <label>Status</label><br>
        <!--                    <select name="status" id="status_filtro" class="form-control">
        <!--                        <option value="0"></option>
        <!--                        <option <?php echo ($filtro['status']==1)?'selected':'';?> value="1">
        <!--                            DESABILITADO
        <!--                        </option>
        <!--                        <option <?php echo ($filtro['status']==2)?'selected':'';?> value="2">
        <!--                            HABILITADO
        <!--                        </option>
        <!--                        <option <?php echo ($filtro['status']==3)?'selected':'';?> value="3">
        <!--                            ADMINISTRATIVO
        <!--                        </option>
        <!--                    </select>
        <!--                </div>
        <!--                <div class="col-sm-2">
        <!--                    <label>Nivel do Grupo</label><br>
        <!--                    <select name="permissao" id="permissao_filtro" class="form-control">
        <!--                        <option value="0"></option>
        <!--                        <?php foreach ($permissao as $item) :?>
        <!--                        <option <?php echo ($filtro['permissao']==$item['id'])?'selected':'';?> value="<?php echo($item['id']);?>">
        <!--                            <?php echo($item['nome']);?>
        <!--                        </option>
        <!--                        <?php endforeach; ?>
        <!--                    </select>
        <!--                </div>
        <!--                <div class="col-sm-1">
        <!--                    <label>&nbsp;</label><br>
        <!--                    <input type="submit" value="Filtrar" class="btn btn-primary"/>
        <!--                </div>
        <!--            </form>
        <!--        </div>
        <!--    </div>
        <!--</div>
        -->
        
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Grupos de Menus</h3>
                <div class="box-tools">
                    <a href="<?php echo BASE_URL; ?>menu/addMenu/" class="btn btn-success">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
    <div id="AddMenu" class="collapse panel-collapse">
        <form action="<?php echo BASE_URL; ?>menu/addAction" method="POST" enctype="multipart/form-data">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            <h3 class="h3">Adicionar Menu</h3>
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
                        <div class="form-group">
                            <label for="url">URL:</label>
                            <input type="text" name="url" id="url" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo</label><br>
                            <select name="tipo" id="tipo" class="form-control" required>
                                <option value="pagina">Página</option>
                                <option value="formulario">Formulário</option>
                                <option value="portfolio">Portfolio</option>
                            </select>
                        </div>
                        <a href="#AddMenu" class="btn btn-default" data-toggle="collapse">
                            <i class="fa fa-sign-out"></i>FECHAR
                        </a>
                    </div>
                </div>
            </form>
    </div>
            <div class="box-body">
                <table class="table table-condensed">
                    <tr>
                        <th>Nome</th>
                        <th>URL</th>
                        <th>Tipo</th>
                        <th width="130">Ações</th>
                    </tr>
                    <?php foreach ($menus as $item) :?>
                    <tr>    
                        <td><?php echo utf8_encode($item['nome']);?></td>
                        <td><?php echo($item['url']);?></td>
                        <td><?php echo($item['tipo']);?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo BASE_URL; ?>menu/edit/<?php echo md5($item['id']); ?>" 
                                   class="btn btn-xs btn-primary">
                                    Editar
                                </a>
                                
                                <a href="<?php echo BASE_URL; ?>menu/delAction/?id=<?php echo md5($item['id']); ?>" 
                                   class="btn btn-xs btn-danger" onclick="return confirm('Tem certeza que deseja Excluir!')">
                                    Excluir
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <!--<ul class="pagination">
                <!--    <?php for($q=1;$q<=$numeroPaginas;$q++):?>
                <!--    <li class="<?php if ($paginaAtual == $q) {echo "active"; } ?>">
                <!--        <a href="<?php echo BASE_URL;?>menu/<?php 
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
        </script>
        
    </section>
    
<!--<br/><br/>-->

<!--<div>
<!--        <?php echo("Bom Dia ".$nome);  ?>
<!--        <br>
<!--        <?php //echo($this->config['painel_welcome']);?>
<!--        <br><br>
<!--        <h1 class="h1">Menus</h1>
<!--        <a class="home_cta_button" href="<?php echo(BASE_URL."menu/addMenu");?>">Adicionar Menu</a>
<!--    <?php if (isset($excluir) && $excluir == "error" ) :?>
<!--            <div class="alert-warning">
<!--                <label>Não foi possivel excluir esse registro</label>
<!--            </div>
<!--    <?php endif; ?>
<!--    <?php if (isset($excluir) && $excluir == "success" ) :?>
<!--            <div class="alert-success">
<!--                <label>Registro excluido com sucesso</label>
<!--            </div>
<!--    <?php endif; ?>
<!--        <table width="100%" border="1">
<!--            <tr>
<!--                <th>ID</th>
<!--                <th>Nome</th>
<!--                <th>URL</th>
<!--                <th>TIPO</th>
<!--                <th class="text-center">Ações</th>
<!--            </tr>
<!--            <?php foreach ($menus as $item): ?>
<!--            <tr>
<!--                <td><?php echo($item['id']); ?></td>
<!--                <td><?php echo (utf8_encode($item['nome'])); ?></td>
<!--                <td><?php echo($item['url'] );?></td>
<!--                <td><?php echo($item['tipo'] );?></td>
<!--                <td class="text-center">
<!--                    <a class="home_cta_button" href="<?php echo(BASE_URL."menu/editMenu/".md5($item['id'])); ?>">Editar Menu</a> 
<!--                    <a class="home_cta_button" href="<?php echo(BASE_URL."menu/excluirMenu/".md5($item['id'])); ?>">Excluir Menu</a>
<!--                </td>
<!--            </tr>
<!--            <?php endforeach; ?>
<!--        </table>
<!--</div>
-->
