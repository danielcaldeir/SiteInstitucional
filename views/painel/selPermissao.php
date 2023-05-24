<?php 
    $addPermissao = FALSE;
    $editPermissao = FALSE;
    $delPermissao = FALSE;
    $viewItem = FALSE;
    $addItem = FALSE;
    $editItem = FALSE;
    $delItem = FALSE;
    foreach ($permissao as $perItem) {
        if (!strcmp($perItem, "add_permissao")){
            $addPermissao = TRUE;  }
        if (!strcmp($perItem, "edit_permissao")){ $editPermissao = TRUE; }
        if (!strcmp($perItem, "del_permissao")){  $delPermissao = TRUE;  }
        if (!strcmp($perItem, "view_item")){      $viewItem = TRUE;      }
        if (!strcmp($perItem, "add_item")){       $addItem = TRUE;       }
        if (!strcmp($perItem, "edit_item")){      $editItem = TRUE;      }
        if (!strcmp($perItem, "del_item")){       $delItem = TRUE;       }
    }
?>
    <!-- Content Header (Page header) -->
    <pre>
        <?php echo ("ADD Permissao: ");echo (($addPermissao)?'Verdadeiro':'Falso');?>
        <?php echo ("EDIT Permissao: ");echo (($editPermissao)?'Verdadeiro':'Falso');?>
        <?php echo ("DEL Permissao: ");echo (($delPermissao)?'Verdadeiro':'Falso');?>
    </pre>
    
    <pre>
        <?php echo ("ADD Item: ");echo (($addItem)?'Verdadeiro':'Falso');?>
        <?php echo ("EDIT Item: ");echo (($editItem)?'Verdadeiro':'Falso');?>
        <?php echo ("DEL Item: ");echo (($delItem)?'Verdadeiro':'Falso');?>
    </pre>
    
    <section class="content-header">
      <h1>
        Permissao
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL); ?>permissao/"><i class="fa fa-plane"></i>Permissao</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        
        <!--<div class="box">-->
            <!--<div class="box-header">
            <!--    <h3 class="box-title">Grupos de Permissoes</h3>
            <!--    <div class="box-tools">
            <!--        <a href="<?php echo BASE_URL; ?>permissaoLTE/itemPermissao/" class="btn btn-primary">Itens de Permissao</a>
            <!--        <a href="<?php echo BASE_URL; ?>permissaoLTE/add/" class="btn btn-success">Adicionar</a>
            <!--    </div>
            <!--</div>
            -->
            <!--<div class="box-body">-->
                <div id="tabs" class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active btn btn-primary">
                            <a href="#tabs1" data-toggle="tab" aria-expanded="true">Grupo de Permissao</a>
                        </li>
						<?php if($viewItem):?>
                        <li class="btn btn-primary">
                            <a href="#tabs2" data-toggle="tab" aria-expanded="false">Itens de Permissao</a>
                        </li>
						<?php endif;?>
                    </ul>
                    <div class="tab-content">
                        <div id="tabs1" class="tab-pane active">
                            <div class="box">
                                <div class="box-header">
                                    <div class="box-tools">
                                        <?php if($addPermissao):?>
                                        <!--<a href="#AddPermissao" class="btn btn-success" data-toggle="collapse">
                                        <!--    <i class="fa fa-plus"></i>
                                        <!--</a>
                                        -->
                                        <a href="<?php echo BASE_URL; ?>permissao/add/" class="btn btn-success">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <?php endif;?>
                                    </div>
                                </div>
				<?php if($addPermissao):?>
                <div id="AddPermissao" class="collapse panel-collapse">
                    <form action="<?php echo BASE_URL; ?>permissao/addAction" method="POST">
                        <div class="box">
                            <div class="box-header">
                                <div class="box-title">
                                    <h3 class="h3">Adicionar Grupo de Permissão</h3>
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
                                <?php foreach ($permissaoItens as $item) :?>
                                <div class="form-group">
                                    <input type="checkbox" name="items[]" value="<?php echo ($item['id']);?>" id="item-<?php echo($item['id']);?>"/>
                                    <label for="item-<?php echo($item['id']);?>"><?php echo($item['nome']);?></label>
                                </div>
                                <?php endforeach; ?>
                                <a href="#AddPermissao" class="btn btn-default" data-toggle="collapse"><i class="fa fa-sign-out"></i>FECHAR</a>
                            </div>
                        </div>
                    </form>
                </div>
				<?php endif;?>
                                <div class="box-body">
                                    <table class="table table-condensed">
                                        <tr>
                                            <th>Nome Permissao</th>
                                            <th width="150">QTD de Ativos</th>
                                            <?php if ($editPermissao || $delPermissao):?>
											<th width="130">Ações</th>
											<?php endif;?>
                                        </tr>
                                        <?php foreach ($permitido as $item) :?>
                                        <tr>    
                                            <td><?php echo($item['nome']);?></td>
                                            <td><?php echo($item['total_user']);?></td>
                                            <?php if ($editPermissao || $delPermissao):?>
											<td>
                                                <div class="btn-group">
                                                    <?php if($editPermissao):?>
													<a href="<?php echo BASE_URL; ?>permissao/edit/<?php echo md5($item['id']); ?>" 
                                                       class="btn btn-xs btn-primary">
                                                        Editar
                                                    </a>
													<?php endif;?>
													<?php if($delPermissao):?>
                                                    <?php if (($item['total_user'] == 0)): ?>
                                                    <a href="<?php echo BASE_URL; ?>permissao/del/<?php echo md5($item['id']); ?>" 
                                                       class="btn btn-xs btn-danger" <?php echo(($item['total_user']!=0)?'disabled':'');?> onclick="return confirm('Tem certeza que deseja Excluir!')">
                                                        Excluir
                                                    </a>
                                                    <?php endif; ?>
													<?php endif;?>
                                                </div>
                                            </td>
											<?php endif;?>
                                        </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
						<?php if($viewItem):?>
                        <div id="tabs2" class="tab-pane">
                            <div class="box">
                                <div class="box-header">
                                    <div class="box-tools">
                                        <?php if($addItem):?>
                                        <!--<a href="#AddPermissaoItem" class="btn btn-success" data-toggle="collapse">
                                        <!--    <i class="fa fa-plus"></i>
                                        <!--</a>
                                        -->
                                        <a href="<?php echo BASE_URL; ?>permissao/addItem/" class="btn btn-success">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <?php endif;?>
                                    </div>
                                </div>
				<?php if($addItem):?>
                <div id="AddPermissaoItem" class="collapse panel-collapse">
                    <form action="<?php echo BASE_URL; ?>permissao/addItemAction" method="POST">
                        <div class="box">
                            <div class="box-header">
                                <div class="box-title">
                                    <h3 class="h3">Adicionar Item de Permissão</h3>
                                </div>
                                <div class="box-tools">
                                    <input type="submit" id="botaoEnviarForm" value="Adicionar" class="btn btn-success" />
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="nome">Nome do Item:</label>
                                    <input type="text" name="nome" id="nome" class="form-control" required/>
                                </div>
                                <div class="form-group">
                                    <label for="SLUG">Nome do SLUG:</label>
                                    <input type="text" name="slug" id="slug" class="form-control" required/>
                                </div>
                                <a href="#AddPermissaoItem" class="btn btn-default" data-toggle="collapse"><i class="fa fa-sign-out"></i>FECHAR</a>
                            </div>
                        </div>
                    </form>
                </div>
				<?php endif;?>
                                <div class="box-body">
                                    <table class="table table-condensed">
                                        <tr>
                                            <th>Nome Item</th>
                                            <th width="150">SLUG</th>
                                            <?php if($editItem || $delItem):?>
											<th width="130">Ações</th>
											<?php endif;?>
                                        </tr>
                                        <?php foreach ($permissaoItens as $item) :?>
                                        <tr>    
                                            <td><?php echo($item['nome']);?></td>
                                            <td><?php echo($item['slug']);?></td>
                                            <?php if($editItem || $delItem):?>
											<td>
                                                <div class="btn-group">
                                                    <?php if($editItem):?>
													<a href="<?php echo BASE_URL; ?>permissao/editItem/<?php echo md5($item['id']); ?>" 
                                                       class="btn btn-xs btn-primary">
                                                        Editar
                                                    </a>
													<?php endif;?>
													<?php if($delItem):?>
                                                    <a href="<?php echo BASE_URL; ?>permissao/delItem/<?php echo md5($item['id']); ?>" 
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
                                </div>
                            </div>
                        </div>
						<?php endif;?>
                    </div>
                </div>
            <!--</div>-->
        <!--</div>-->
        
        
        
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
            
            $(function() {
                $("#tabs").tabs();
            });
        </script>
        
    </section>
    <!-- /.content -->
      <!--
      <!--  <div>
      <!--    <h1 class="h1">Permissões</h1>
      <!--    <fieldset style="border: 1px solid; border-color: #000">
      <!--      <legend>Página Principal</legend>
      <!--      <?php foreach ($permitido as $item) :?>
      <!--      <br><?php print_r($item);?>
      <!--      <?php endforeach; ?>
      <!--      <br/><br/>
      <!--    </fieldset>
      <!--    <br/><br/>
      <!--  </div>
      -->
<br/><br/><br/><br/>