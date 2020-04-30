    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tela de Usuarios
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL."usuario/"); ?>"><i class="fa fa-user"></i>Usuarios</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Filtro</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <form method="GET">
                        <div class="col-sm-4">
                            <label for="nome_filtro">Nome</label><br>
                            <input type="text" name="nome" id="nome_filtro" value="<?php echo($filtro['nome']);?>" class="form-control"/>
                        </div>
                        <div class="col-sm-3">
                            <label for="email_filtro">E-Mail</label><br>
                            <input type="text" name="email" id="email_filtro" value="<?php echo($filtro['email']);?>" class="form-control"/>
                        </div>
                        <div class="col-sm-2">
                            <label>Status</label><br>
                            <select name="status" id="status_filtro" class="form-control">
                                <option value="0"></option>
                                <option <?php echo ($filtro['status']==1)?'selected':'';?> value="1">
                                    DESABILITADO
                                </option>
                                <option <?php echo ($filtro['status']==2)?'selected':'';?> value="2">
                                    HABILITADO
                                </option>
                                <option <?php echo ($filtro['status']==3)?'selected':'';?> value="3">
                                    ADMINISTRATIVO
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>Nivel do Grupo</label><br>
                            <select name="permissao" id="permissao_filtro" class="form-control">
                                <option value="0"></option>
                                <?php foreach ($permissao as $item) :?>
                                <option <?php echo ($filtro['permissao']==$item['id'])?'selected':'';?> value="<?php echo($item['id']);?>">
                                    <?php echo($item['nome']);?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <label>&nbsp;</label><br>
                            <input type="submit" value="Filtrar" class="btn btn-primary"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Grupos de Usuarios</h3>
                <div class="box-tools">
                    <a href="#AddUsuario" class="btn btn-success" data-toggle="collapse">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
    <div id="AddUsuario" class="collapse panel-collapse">
        <form action="<?php echo BASE_URL; ?>usuario/addAction" method="POST">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h3 class="h3">Cadastrar Usuario</h3>
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
                            <label for="nome">E-Mail:</label>
                            <input type="email" name="email" id="email" class="form-control" required/>
                        </div>
                    <div class="form-group">
                            <label for="nome">Senha:</label>
                            <input type="password" name="senha" id="senha" class="form-control" required/>
                        </div>
                    <div class="form-group">
                            <label for="nome">Telefone:</label>
                            <input type="tel" name="telefone" id="telefone" class="form-control" required/>
                        </div>
                    <div class="form-group">
                        <label for="permissao">Nivel do Grupo</label><br>
                        <select name="permissao" id="permissao" class="form-control" required>
                                <option value="0"></option>
                                <?php foreach ($permissao as $item) :?>
                                <option value="<?php echo($item['id']);?>">
                                    <?php echo($item['nome']);?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <a href="#AddUsuario" class="btn btn-default" data-toggle="collapse"><i class="fa fa-sign-out"></i>FECHAR</a>
                </div>
            </div>
        </form>
    </div>        
            <div class="box-body">
                <table class="table table-condensed">
                    <tr>
                        <th>Nome</th>
                        <th>E - Mail</th>
                        <th>Status</th>
                        <th>Grupo</th>
                        <th>Telefone</th>
                        <th width="130">Ações</th>
                    </tr>
                    <?php foreach ($users as $item) :?>
                    <tr>    
                        <td><?php echo($item['nome']);?></td>
                        <td><?php echo($item['email']);?></td>
                        <?php if (intval($item['status']) === 0):?>
                            <td class="danger">DESABILITADO</td>
                        <?php elseif (intval($item['status']) === 1) : ?>
                            <td class="success">HABILITADO</td>
                        <?php else :?>
                            <td class="success"><strong>ADMINISTRATIVO</strong></td>
                        <?php endif; ?>
                        <td><?php echo($item['permissao_nome']);?></td>
                        <td><?php echo($item['telefone']);?></td>
                        <td>
                            <div class="btn-group">
                                <?php if (intval($item['status']) === 0) :?>
                                <a href="<?php echo BASE_URL; ?>usuario/habilitar/<?php echo md5($item['id']); ?>" 
                                   class="btn btn-xs btn-success">
                                    Habilitar
                                </a>
                                <?php else:?>
                                <a href="<?php echo BASE_URL; ?>usuario/edit/<?php echo md5($item['id']); ?>" 
                                   class="btn btn-xs btn-primary">
                                    Editar
                                </a>
                                
                                <a href="<?php echo BASE_URL; ?>usuario/del/<?php echo md5($item['id']); ?>" 
                                   class="btn btn-xs btn-danger" onclick="return confirm('Tem certeza que deseja Excluir!')">
                                    Excluir
                                </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <ul class="pagination">
                    <?php for($q=1;$q<=$numeroPaginas;$q++):?>
                    <li class="<?php if ($paginaAtual == $q) {echo "active"; } ?>">

                        <a href="<?php echo BASE_URL;?>usuario/<?php 
                            $pag_array = $_GET;
                            unset($pag_array['q']);
                            $pag_array['pagAtual'] = $q;
                            echo ("?". http_build_query($pag_array) ); 
                            ?>">
                            <?php echo $q; ?>
                        </a>
                    </li>
                    <?php endfor; ?>
                </ul>
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
    
<br/><br/><br/><br/>