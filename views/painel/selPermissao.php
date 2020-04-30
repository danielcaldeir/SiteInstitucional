    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Permissao
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL."permissao/"); ?>"><i class="fa fa-plane"></i>Permissao</a></li>
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
                        <li class="btn btn-primary">
                            <a href="#tabs2" data-toggle="tab" aria-expanded="false">Itens de Permissao</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tabs1" class="tab-pane active">
                            <div class="box">
                                <div class="box-header">
                                    <div class="box-tools">
                                        <a href="#AddPermissao" class="btn btn-success" data-toggle="collapse">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
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
                                <div class="box-body">
                                    <table class="table table-condensed">
                                        <tr>
                                            <th>Nome Permissao</th>
                                            <th width="150">QTD de Ativos</th>
                                            <th width="130">Ações</th>
                                        </tr>
                                        <?php foreach ($permitido as $item) :?>
                                        <tr>    
                                            <td><?php echo($item['nome']);?></td>
                                            <td><?php echo($item['total_user']);?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="<?php echo BASE_URL; ?>permissao/edit/<?php echo md5($item['id']); ?>" 
                                                       class="btn btn-xs btn-primary">
                                                        Editar
                                                    </a>
                                                    <?php if (($item['total_user'] == 0)): ?>
                                                    <a href="<?php echo BASE_URL; ?>permissao/del/<?php echo md5($item['id']); ?>" 
                                                       class="btn btn-xs btn-danger" <?php echo(($item['total_user']!=0)?'disabled':'');?> onclick="return confirm('Tem certeza que deseja Excluir!')">
                                                        Excluir
                                                    </a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="tabs2" class="tab-pane">
                            <div class="box">
                                <div class="box-header">
                                    <div class="box-tools">
                                        <a href="#AddPermissaoItem" class="btn btn-success" data-toggle="collapse">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
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
                                <div class="box-body">
                                    <table class="table table-condensed">
                                        <tr>
                                            <th>Nome Item</th>
                                            <th width="150">SLUG</th>
                                            <th width="130">Ações</th>
                                        </tr>
                                        <?php foreach ($permissaoItens as $item) :?>
                                        <tr>    
                                            <td><?php echo($item['nome']);?></td>
                                            <td><?php echo($item['slug']);?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="<?php echo BASE_URL; ?>permissao/editItem/<?php echo md5($item['id']); ?>" 
                                                       class="btn btn-xs btn-primary">
                                                        Editar
                                                    </a>
                                                    <a href="<?php echo BASE_URL; ?>permissao/delItem/<?php echo md5($item['id']); ?>" 
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
                        </div>
                    </div>
                </div>
            <!--</div>-->
        <!--</div>-->
        
        <script>
            //$(function() {
            //    $("#tabs").tabs();
            //});
        </script>
        
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