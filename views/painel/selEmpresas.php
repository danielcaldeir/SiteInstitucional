<?php 
    $add = FALSE;
    $edit = FALSE;
    $del = FALSE;
    foreach ($permissao as $perItem) {
        if (!strcmp($perItem, "add_empresa")){
            $add = TRUE;
        }
        if (!strcmp($perItem, "edit_empresa")){
            $edit = TRUE;
        }
        if (!strcmp($perItem, "del_empresa")){
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
        Tela de Empresas
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL); ?>empresas/"><i class="fa fa-user"></i>Empresas</a></li>
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
                            <label class="control-label" for="cnpj_label">CNPJ</label>
                            <input type="text" name="cnpj" id="cnpj_filtro" value="<?php echo($filtro['cnpj']);?>" class="form-control"/>
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label" for="nome_label">NOME</label><br>
                            <input type="text" name="nome" id="nome_filtro" value="<?php echo($filtro['nome']);?>" class="form-control"/>
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label" for="regime_label">REGIME</label><br>
                            <select name="regime" id="regime_filtro" class="form-control">
                                <option value="0"></option>
                                <option <?php echo ($filtro['regime']==1)?'selected':'';?> value="1">
                                    Simples Nacional
                                </option>
                                <option <?php echo ($filtro['regime']==3)?'selected':'';?> value="3">
                                    Normal
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>CNAE</label><br>
                            <select name="cnae" id="cnae_filtro" class="form-control">
                                <option value="0"></option>
                                <?php foreach ($cnaeFiltro as $item) :?>
                                <option <?php echo ($filtro['cnae']==$item['classe'])?'selected':'';?> value="<?php echo($item['classe']);?>">
                                    <?php echo($item['classe']);?> - <?php echo ($item['descricao']);?>
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
                <h3 class="box-title">Grupos de Empresas</h3>
                <div class="box-tools">
                    <?php if($add):?>
                    <!--<a href="#AddEmpresa" class="btn btn-success" data-toggle="collapse">
                    <!--    <i class="fa fa-plus"></i>
                    <!--</a>
                    -->
                    <a href="<?php echo(BASE_URL);?>empresas/add/" class="btn btn-success">
                        <i class="fa fa-plus"></i>
                    </a>
                    
                    <?php endif;?>
                </div>
            </div>
    <?php if($add):?>
    <div id="AddEmpresa" class="collapse panel-collapse">
        <form action="<?php echo BASE_URL; ?>empresas/addAction" method="POST">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h3 class="h3">Cadastrar Empresa</h3>
                    </div>
                    <div class="box-tools">
                        <input type="submit" id="botaoEnviarForm" value="Adicionar" class="btn btn-success" />
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-3 col-lg-3">
                            <div class="form-group">
                            <label class="control-label" for="cnpj_label">CNPJ:</label>
                            <div class="input-group">
                                <input type="text" name="cnpj" id="cnpj" class="form-control" onBlur="verificarCNPJ(this)" required/>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="control-label" for="razao_label">Razao Social:</label>
                            <div class="input-group">
                                <input type="text" name="razao" id="razao" class="form-control" required/>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-lg-3">
                            <div class="form-group">
                            <label class="control-label" for="nome_label">Nome:</label>
                            <div class="input-group">
                                <input type="text" name="fantasia" id="fantasia" class="form-control" required/>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="control-label" for="fundacao_label">Data Fundacao:</label>
                            <div class="input-group">
                                <input type="date" name="fundacao" id="fundacao" class="form-control" required/>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm3 col-lg-3">
                            <div class="form-group">
                                <label class="control-label" for="cnae_label">CNAE</label>
                                <div class="input-group">
                                    <select name="cnae_secao" id="cnae_secao" class="form-control" onchange="buscarCnae(this)">
                                                    <?php foreach ($cnae as $cn) :?>
                                                    <option value="<?php echo($cn['secao']);?>"><?php echo ($cn['descricao']);?></option>
                                                    <?php endforeach;?>
                                                </select>
                                                <select name="cnae_divisao" id="cnae_divisao" class="form-control" onchange="buscarCnae(this)">
                                                    <option value="0">0</option>
                                                </select>
                                                <select name="cnae_grupo" id="cnae_grupo" class="form-control" onchange="buscarCnae(this)">
                                                    <option value="0">0</option>
                                                </select>
                                                <select name="cnae" id="cnae" class="form-control">
                                                    <option value="0">0</option>
                                                </select>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-sm-3 col-lg-3">
                            <label class="control-label" for="regime_add">Regime:</label>
                            <div class="input-group">
                                <select name="regime" id="regime" class="form-control">
                                    <option value="1">Simples Nacional</option>
                                    <option value="3">Regime Normal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                        
                    
                    
                    <a href="#AddEmpresa" class="btn btn-default" data-toggle="collapse"><i class="fa fa-sign-out"></i>FECHAR</a>
                </div>
            </div>
        </form>
    </div>        
    <?php endif;?>
            <div class="box-body">
                <table class="table table-condensed">
                    <tr>
                        <th>CNPJ</th>
                        <th>Razao Social</th>
                        <th>Nome</th>
                        <th>Fundacao</th>
                        <th>CNAE</th>
                        <?php if ($edit || $del):?>
                        <th width="130">Ações</th>
                        <?php endif;?>
                    </tr>
                    <?php foreach ($empresas as $item) :?>
                    <tr>    
                        <td><?php echo($item['cpf_cnpj']);?></td>
                        <td><?php echo($item['razao_social']);?></td>
                        <td><?php echo($item['nome']);?></td>
                        <td><?php echo date_format(date_create($item['dt_fundacao']),'d/m/Y');?></td>
                        <td><?php echo ($item['descricao']);?></td>
                        
                        
                        <?php if ($edit || $del):?>
                        <td>
                            <div class="btn-group">
                                
                                <?php if ($edit):?>
                                <a href="<?php echo BASE_URL; ?>empresas/edit/<?php echo md5($item['id']); ?>" 
                                   class="btn btn-xs btn-primary">
                                    Editar
                                </a>
                                <?php endif;?>
                                <?php if ($del):?>
                                <a href="<?php echo BASE_URL; ?>empresas/delAction/<?php echo md5($item['id']); ?>" 
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
                <ul class="pagination">
                    <?php for($q=1;$q<=$numeroPaginas;$q++):?>
                    <li class="<?php if ($paginaAtual == $q) {echo "active"; } ?>">

                        <a href="<?php echo BASE_URL;?>empresa/<?php 
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
    
<br/><br/><br/><br/>