<?php 
    //$addPermissao = FALSE;
    //$editPermissao = FALSE;
    //$delPermissao = FALSE;
    $view = FALSE;
    
    $add = null;
    $edit = null;
    $del = null;
    foreach ($permissao as $perItem) {
        //if (!strcmp($perItem, "add_permissao")){  $addPermissao = TRUE;  }
        //if (!strcmp($perItem, "edit_permissao")){ $editPermissao = TRUE; }
        //if (!strcmp($perItem, "del_permissao")){  $delPermissao = TRUE;  }
        if (!is_null($add)){
            if (!strcmp($perItem, "add_config")){       $add = TRUE;       }
        }
        if (!is_null($edit)){
            if (!strcmp($perItem, "edit_config")){      $edit = TRUE;      }
        }
        if (!is_null($del)){
            if (!strcmp($perItem, "del_config")){       $del = TRUE;       }
        }
        if (!strcmp($perItem, "view_config")){      $view = TRUE;      }
    }
?>
    <!-- Content Header (Page header) -->
    <!--<pre>
    <!--    <?php //echo ("ADD Permissao: ");echo (($addPermissao)?'Verdadeiro':'Falso');?>
    <!--    <?php //echo ("EDIT Permissao: ");echo (($editPermissao)?'Verdadeiro':'Falso');?>
    <!--    <?php //echo ("DEL Permissao: ");echo (($delPermissao)?'Verdadeiro':'Falso');?>
    <!--</pre>
    -->
    <!--<pre>
    <!--    <?php echo ("ADD: ");echo (($add)?'Verdadeiro':(is_null($add)?'Nao se Aplica':'Falso'));?>
    <!--    <?php echo ("EDIT: ");echo (($edit)?'Verdadeiro':(is_null($edit)?'Nao se Aplica':'Falso'));?>
    <!--    <?php echo ("DEL: ");echo (($del)?'Verdadeiro':(is_null($del)?'Nao se Aplica':'Falso'));?>
    <!--</pre>
    -->
    <section class="content-header">
      <h1>
        Empresa
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL); ?>permissao/"><i class="fa fa-plane"></i>Empresa</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <!--<pre><?php //print_r($totalEmpresa);?></pre>-->
        <!--<pre><?php //print_r($permissao);?></pre>-->
        <!--<pre><?php //print_r($allEmpresa);?></pre>-->
        
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Grupos de Empresas</h3>
                <div class="box-tools">
                    <?php if($add):?>
                    <a href="#AddEmpresa" class="btn btn-success" data-toggle="collapse">
                        <i class="fa fa-plus"></i>
                    </a>
                    
                    <!--<a href="<?php echo(BASE_URL);?>empresas/add/" class="btn btn-success">
                    <!--    <i class="fa fa-plus"></i>
                    <!--</a>
                    -->
                    <?php endif;?>
                </div>
            </div>
    <?php if($add):?>
    <!--<div id="AddEmpresa" class="collapse panel-collapse">
    <!--    <form action="<?php echo BASE_URL; ?>empresas/addAction" method="POST">
    <!--        <div class="box">
    <!--            <div class="box-header">
    <!--                <div class="box-title">
    <!--                    <h3 class="h3">Cadastrar Empresa</h3>
    <!--                </div>
    <!--                <div class="box-tools">
    <!--                    <input type="submit" id="botaoEnviarForm" value="Adicionar" class="btn btn-success" />
    <!--                </div>
    <!--            </div>
    <!--            <div class="box-body">
    <!--                <div class="row">
    <!--                    <div class="col-sm-3 col-lg-3">
    <!--                        <div class="form-group">
    <!--                        <label class="control-label" for="cnpj_label">CNPJ:</label>
    <!--                        <div class="input-group">
    <!--                            <input type="text" name="cnpj" id="cnpj" class="form-control" onBlur="verificarCNPJ(this)" required/>
    <!--                        </div>
    <!--                        </div>
    <!--                        <div class="form-group">
    <!--                        <label class="control-label" for="razao_label">Razao Social:</label>
    <!--                        <div class="input-group">
    <!--                            <input type="text" name="razao" id="razao" class="form-control" required/>
    <!--                        </div>
    <!--                        </div>
    <!--                    </div>
    <!--                    <div class="col-sm-3 col-lg-3">
    <!--                        <div class="form-group">
    <!--                        <label class="control-label" for="nome_label">Nome:</label>
    <!--                        <div class="input-group">
    <!--                            <input type="text" name="fantasia" id="fantasia" class="form-control" required/>
    <!--                        </div>
    <!--                        </div>
    <!--                        <div class="form-group">
    <!--                        <label class="control-label" for="fundacao_label">Data Fundacao:</label>
    <!--                        <div class="input-group">
    <!--                            <input type="date" name="fundacao" id="fundacao" class="form-control" required/>
    <!--                        </div>
    <!--                        </div>
    <!--                    </div>
    <!--                    <div class="col-sm3 col-lg-3">
    <!--                        <div class="form-group">
    <!--                            <label class="control-label" for="cnae_label">CNAE</label>
    <!--                            <div class="input-group">
    <!--                                <select name="cnae_secao" id="cnae_secao" class="form-control" onchange="buscarCnae(this)">
    <!--                                    <?php foreach ($cnae as $cn) :?>
    <!--                                    <option value="<?php echo($cn['secao']);?>"><?php echo ($cn['descricao']);?></option>
    <!--                                    <?php endforeach;?>
    <!--                                </select>
    <!--                                <select name="cnae_divisao" id="cnae_divisao" class="form-control" onchange="buscarCnae(this)">
    <!--                                    <option value="0">0</option>
    <!--                                </select>
    <!--                                <select name="cnae_grupo" id="cnae_grupo" class="form-control" onchange="buscarCnae(this)">
    <!--                                    <option value="0">0</option>
    <!--                                </select>
    <!--                                <select name="cnae" id="cnae" class="form-control">
    <!--                                    <option value="0">0</option>
    <!--                                </select>
    <!--                            </div>
    <!--                        </div>
    <!--                    </div>
    <!--                    <div class="col-sm-3 col-lg-3">
    <!--                        <label class="control-label" for="regime_add">Regime:</label>
    <!--                        <div class="input-group">
    <!--                            <select name="regime" id="regime" class="form-control">
    <!--                                <option value="1">Simples Nacional</option>
    <!--                                <option value="3">Regime Normal</option>
    <!--                            </select>
    <!--                        </div>
    <!--                    </div>
    <!--                </div>
    <!--                <a href="#AddEmpresa" class="btn btn-default" data-toggle="collapse"><i class="fa fa-sign-out"></i>FECHAR</a>
    <!--            </div>
    <!--        </div>
    <!--    </form>
    <!--</div>
    -->
    <?php endif;?>
            <div class="box-body">
                <table class="table table-condensed">
                    <tr>
                        <th>CNPJ</th>
                        <th>Razao Social</th>
                        <th>Nome</th>
                        <th>Fundacao</th>
                        <!--<th>CNAE</th>-->
                        <?php if ($view || $edit):?>
                        <th width="130">Ações</th>
                        <?php endif;?>
                    </tr>
                    <?php foreach ($allEmpresa as $item) :?>
                    <tr>    
                        <td><?php echo($item['cpf_cnpj']);?></td>
                        <td><?php echo($item['razao_social']);?></td>
                        <td><?php echo($item['nome']);?></td>
                        <td><?php echo date_format(date_create($item['dt_fundacao']),'d/m/Y');?></td>
                        <!--<td><?php //echo ($item['descricao']);?></td>-->
                        
                        
                        <?php if ($view || $edit):?>
                        <td>
                            <div class="btn-group">
                                
                                <?php if ($view):?>
                                <a href="<?php echo BASE_URL; ?>config/selected/<?php echo md5($item['id']); ?>" 
                                   class="btn btn-xs btn-primary">
                                    Selected
                                </a>
                                <?php endif;?>
                                <?php if ($edit):?>
                                <a href="<?php echo BASE_URL; ?>empresas/edit/<?php echo md5($item['id']); ?>" 
                                   class="btn btn-xs btn-primary">
                                    Editar
                                </a>
                                <?php endif;?>
                                <!--
                                <?php if ($del):?>
                                <!--<a href="<?php echo BASE_URL; ?>empresas/del/<?php echo md5($item['id']); ?>" 
                                <!--   class="btn btn-xs btn-danger" onclick="return confirm('Tem certeza que deseja Excluir!')">
                                <!--    Excluir
                                <!--</a>
                                <?php endif;?>
                                -->
                            </div>
                        </td>
                        <?php endif;?>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <!--<ul class="pagination">
                <!--    <?php for($q=1;$q<=$numeroPaginas;$q++): ?>
                <!--    <li class="<?php if ($paginaAtual == $q) {echo "active"; } ?>">
                <!--        <a href="<?php echo BASE_URL;?>empresa/
                <!--            <?php $pag_array = $_GET; unset($pag_array['q']); $pag_array['pagAtual'] = $q; echo ("?". http_build_query($pag_array) ); ?>
                <!--            ">
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
            
            $(function() {
                $("#tabs").tabs();
            });
        </script>
        
    </section>
    <!-- /.content -->
      
<br/><br/><br/><br/>