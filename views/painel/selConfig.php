<?php 
    $add = null;
    $edit = FALSE;
    $del = null;
    foreach ($permissao as $perItem) {
        if (!is_null($add)){
            if (!strcmp($perItem, "add_config")){
                $add = TRUE;
            }
        }
        if (!is_null($edit)){
            if (!strcmp($perItem, "edit_config")){
                $edit = TRUE;
            }
        }
        if (!is_null($del)){
            if (!strcmp($perItem, "del_config")){
                $del = TRUE;
            }
        }
    }
?>
    <!-- Content Header (Page header) -->
    <?php 
    //$adm = FALSE;
    //foreach ($permissao as $perItem) {
    //    if (!strcmp($perItem, "add_empresa")){
    //        $adm = TRUE;
    //    }
    //}
    ?>
    
    <!--<pre>
    <!--    <?php echo ("ADD: ");echo (($add)?'Verdadeiro':(is_null($add)?'Nao se Aplica':'Falso'));?>
    <!--    <?php echo ("EDIT: ");echo (($edit)?'Verdadeiro':(is_null($edit)?'Nao se Aplica':'Falso'));?>
    <!--    <?php echo ("DEL: ");echo (($del)?'Verdadeiro':(is_null($del)?'Nao se Aplica':'Falso'));?>
    <!--</pre>
    -->
    <section class="content-header">
      <h1>
        Configuração da Empresa
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL); ?>config/"><i class="fa fa-book"></i>Configuraçao da Empresa</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <!--<pre><?php //print_r($empresa);?></pre>-->
        <!--<pre><?php //print_r ($empresa_cnae);?></pre>-->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Configuração da Empresa</h3>
                <div class="box-tools">
                    
                </div>
            </div>
            <div class="box-body">
                <div id="tabs" class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="btn btn-primary active">
                            <a href="#tabs1" data-toggle="tab" aria-expanded="true">Principal</a>
                        </li>
                        <li class="btn btn-primary">
                            <a href="#tabs2" data-toggle="tab" aria-expanded="false">Endereço</a>
                        </li>
                        <li class="btn btn-primary">
                            <a href="#tabs3" data-toggle="tab" aria-expanded="false">Perfil</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tabs1" class="tab-pane active">
                            <div class="box">
                                <form method="GET" action="<?php echo BASE_URL; ?>config/editPrincipalAction" onsubmit="return cadastroPrincipal(this)">
                                <div class="box-header">
                                    <h3 class="box-title">Cadastro Principal da Empresa</h3>
                                    <?php if($edit):?>
                                    <div class="box-tools">
                                        <input type="hidden" value="<?php echo md5($empresa->getID());?>" name="id">
                                        <input type="submit" value="Gravar" class="btn btn-primary"/>
                                    </div>
                                    <?php endif;?>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-3 col-lg-3">
                                            <label class="control-label" for="cnpj_add">CNPJ:</label><br>
                                            <div class="input-group">
                                                <i class="glyphicon glyphicon-search input-group-addon"></i>
                                                <input type="text" name="cnpj" id="cnpj" value="<?php echo($empresa->getCpfCnpj());?>" class="form-control" onblur="verificarCNPJ(this)"/>
                                            </div>
                                            <label class="control-label" for="razao_add">Razão Social:</label><br>
                                            <div class="input-group">
                                                <i class="glyphicon glyphicon-search input-group-addon"></i>
                                                <input type="text" name="razao" id="razao" value="<?php echo($empresa->getRazaoSocial());?>" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-lg-3">
                                            <label class="control-label" for="fantasia_add">Nome Fantasia:</label><br>
                                            <div class="input-group">
                                                <i class="glyphicon glyphicon-search input-group-addon"></i>
                                                <input type="text" name="fantasia" id="fantasia" value="<?php echo($empresa->getNome());?>" class="form-control"/>
                                            </div>
                                            <label class="control-label" for="fundacao_add">Fundação:</label><br>
                                            <div class="input-group">
                                                <i class="glyphicon glyphicon-search input-group-addon"></i>
                                                <input type="date" name="fundacao" id="fundacao" value="<?php echo($empresa->getDTFundacao());?>" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3 col-lg-3">
                                            <label class="control-label" for="cnae_add">CNAE:</label><br>
                                            <div class="input-group">
                                                <select name="cnae_secao" id="cnae_secao" class="form-control" onchange="buscarCnae(this)">
                                                    <?php foreach ($cnae as $cn) :?>
                                                    <option value="<?php echo($cn['secao']);?>"><?php echo utf8_encode($cn['descricao']);?></option>
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
                                        <div class="col-sm-3 col-lg-3">
                                            <label class="control-label" for="regime_add">Regime:</label><br>
                                            <div class="input-group">
                                                <select name="regime" id="regime" class="form-control">
                                                    <option value="1">Simples Nacional</option>
                                                    <option value="3">Regime Normal</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                            
                            
                        </div>
                        <div id="tabs2" class="tab-pane">
                            <div class="box">
                                <form method="GET" action="<?php echo BASE_URL; ?>config/editAuxiliarAction" onsubmit="return cadastroAuxiliar(this)">
                                <div class="box-header">
                                    <h3 class="box-title">Informação Complementar da Empresa</h3>
                                    <?php if ($edit):?>
                                    <div class="box-tools">
                                        <input type="hidden" value="<?php echo md5($empresa->getID());?>" name="id">
                                        <input type="submit" value="Gravar" class="btn btn-primary"/>
                                    </div>
                                    <?php endif;?>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="form-group col-sm-3 col-lg-3">
                                            <label class="control-label" for="cep">CEP:</label>
                                            <div class="input-group">
                                                <i class="glyphicon glyphicon-search input-group-addon"></i>
                                                <input type="text" name="cep" id="cep" value="<?php echo($empresa->getEnderecoCEP());?>" class="form-control" onblur="consultaCEP()" />
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3 col-lg-3">
                                            <label class="control-label" for="endereco">Endereco:</label>
                                            <div class="input-group-sm">
                                                <input type="text" name="endereco" id="endereco" value="<?php echo($empresa->getEndereco());?>" class="form-control" />
                                            </div>
                                            <label class="control-label" for="numero">Numero:</label>
                                            <div class="input-group">
                                                <input type="text" name="numero" id="numero" value="<?php echo($empresa->getEnderecoNumero());?>" class="form-control" />
                                            </div>
                                            <label class="control-label" for="adicional">Complemento:</label>
                                            <div class="input-group">
                                                <input type="text" name="adicional" id="adicional" value="<?php echo($empresa->getEnderecoAdicional());?>" class="form-control" />
                                            </div>
                                            <label class="control-label" for="bairro">Bairro:</label>
                                            <div class="input-group">
                                                <input type="text" name="bairro" id="bairro" value="<?php echo($empresa->getEnderecoBairro());?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3 col-lg-3">
                                            <label class="control-label" for="estado">Estado:</label>
                                            <div class="input-group-sm">
                                                <select name="estado" id="estado" class="form-control" onchange="buscarEstados(this)">
                                                    <?php foreach ($estados as $estado) :?>
                                                    <option value="<?php echo($estado['CodigoUf']);?>" <?php echo (($estado['CodigoUf']==$empresa->getEnderecoEstado())?"selected":"")?>>
                                                        <?php echo ($estado['Nome']);?>
                                                    </option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                            <label class="control-label" for="cidade">Cidade:</label>
                                            <div class="input-group-sm">
                                                <select name="cidade" id="cidade" class="form-control">
                                                    <option value="0">0</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-lg-3">
                                            <label class="control-label" for="pais">Pais:</label>
                                            <div class="input-group">
                                                <input type="text" name="pais" id="pais" value="<?php echo($empresa->getEnderecoPais());?>" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        
                        <div id="tabs3" class="tab-pane">
                            <div class="box">
                                <form method="POST" action="<?php echo BASE_URL; ?>painel/sisEditPropriedadeADMIN">
                                <!--<form method="POST" action="<?php echo BASE_URL; ?>painel/sisEditPropriedadeADMIN" onsubmit="return cadastroAuxiliar(this)">-->
                                <div class="box-header">
                                    <h3 class="box-title">Configuração do Perfil Geral</h3>
                                    <?php if ($edit):?>
                                    <div class="box-tools">
                                        <input type="hidden" value="<?php echo md5($empresa->getID());?>" name="id">
                                        <input type="submit" value="Gravar" class="btn btn-primary"/>
                                    </div>
                                    <?php endif;?>
                                </div>
                                <div class="box-body">
                                    <!--<fieldset style="border: 1px groove; border-color: #000">-->
                                    <!--<legend>Página do Administrador</legend>-->
                                    <!--<form action="<?php echo BASE_URL; ?>painel/sisEditPropriedadeADMIN" method="POST">-->
                                        <div class="form-group">
                                            <label for="site_painel"><h2>ADMIN</h2></label>
                                            <select name="site_painel" class="form-control">
                                                <option value="painel" <?php echo( ($this->config['site_painel'] == 'painel')?('selected'):('') ); ?>>
                                                    Padrao
                                                </option>
                                                <option value="template" <?php echo( ($this->config['site_painel'] == 'template')?('selected'):('') ); ?>>
                                                    Padrao Novo
                                                </option>
                                            </select>
                                            <!--<input type="text" class="form-control" id="site_painel" name="site_painel" value="<?php echo($this->config['site_painel']);?>" disabled=""/>-->
                                	    </div>
                                        <div class="form-group">
                                            <label for="site_title_painel"><h4>Titulo ADMIN</h4></label>
                                            <input type="text" class="form-control" id="site_title_painel" name="site_title_painel" value="<?php echo($this->config['site_painel_title']);?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="painel_welcome"><h4>Welcome ADMIN</h4></label>
                                            <textarea name="site_painel_welcome" id="site_painel_welcome" class="form-control">
                                                <?php echo($this->config['site_painel_welcome']);?>
                                            </textarea>
                                            <!--<input type="text" class="form-control" id="painel_welcome" name="painel_welcome" value="<?php echo($this->config['site_painel_welcome']);?>"/>-->
                                        </div>
                                        <div class="form-group">
                                            <label for="site_color_painel"><h3>Cor</h3></label>
                                            <select id="site_painel_color" name="site_painel_color" class="form-control">
                                                <option value="skin-blue" <?php echo(($this->config['site_painel_color'] == 'skin-blue')?'selected':'');?>>Azul</option>
                                                <option value="skin-black" <?php echo(($this->config['site_painel_color'] == 'skin-black')?'selected':'');?>>Preto</option>
                                                <option value="skin-green" <?php echo(($this->config['site_painel_color'] == 'skin-green')?'selected':'');?>>Verde</option>
                                                <option value="skin-purple" <?php echo(($this->config['site_painel_color'] == 'skin-purple')?'selected':'');?>>Roxo</option>
                                                <option value="skin-red" <?php echo(($this->config['site_painel_color'] == 'skin-red')?'selected':'');?>>Vermelho</option>
                                                <option value="skin-yellow" <?php echo(($this->config['site_painel_color'] == 'skin-yellow')?'selected':'');?>>Amarelo</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="site_avatar_painel"><h3>Avatar</h3></label>
                                            <select id="site_painel_avatar" name="site_painel_avatar" class="form-control">
                                                <option value="avatar1" <?php echo(($this->config['site_painel_avatar'] == 'avatar1')?'selected':'');?>>avatar1</option>
                                                <option value="avatar2" <?php echo(($this->config['site_painel_avatar'] == 'avatar2')?'selected':'');?>>avatar2</option>
                                                <option value="avatar3" <?php echo(($this->config['site_painel_avatar'] == 'avatar3')?'selected':'');?>>avatar3</option>
                                                <option value="avatar4" <?php echo(($this->config['site_painel_avatar'] == 'avatar4')?'selected':'');?>>avatar4</option>
                                                <option value="avatar5" <?php echo(($this->config['site_painel_avatar'] == 'avatar5')?'selected':'');?>>avatar5</option>
                                            </select>
                                        </div>
                                        <!--<input type="submit" name="Enviar" class="button" value="Enviar Dados"/>-->
                                    <!--</form>-->
                                    <!--</fieldset>-->
                                </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <hr>
        <!--<div class="box">
        <!--    <div class="box-header">
        <!--        <h3 class="box-title">Selecione o Tipo de Configuração</h3>
        <!--    </div>
        <!--    <div class="box-body">
        <!--        <div class="row">
        <!--            <div class="col-sm-3 col-lg-3">
        <!--                <div class="small-box bg-aqua">
        <!--                    <div class="inner">
        <!--                        <h3>20</h3>
        <!--                        <p>Informação Principal da Empresa</p>
        <!--                    </div>
        <!--                    <div class="icon">
        <!--                        <i class="fa fa-credit-card"></i>
        <!--                    </div>
        <!--                    <a href="#ConfigPrincipal" class="small-box-footer" data-toggle="collapse">
        <!--                        <i class="fa fa-arrow-circle-up"></i>
        <!--                    </a>
        <!--                </div>
        <!--            </div>
        <!--            <div class="col-sm-3 col-lg-3">
        <!--                <div class="small-box bg-green">
        <!--                    <div class="inner">
        <!--                        <h3>20</h3>
        <!--                        <p>Informação Complementar da Empresa</p>
        <!--                    </div>
        <!--                    <div class="icon">
        <!--                        <i class="fa fa-users"></i>
        <!--                    </div>
        <!--                    <a href="#ConfigComplementar" class="small-box-footer" data-toggle="collapse">
        <!--                        <i class="fa fa-arrow-circle-up"></i>
        <!--                    </a>
        <!--                </div>
        <!--            </div>
        <!--        </div>
        <!--    </div>
        <!--</div>
        -->
        
    <!--<div id="ConfigPrincipal" class="collapse panel-collapse">
    <!--    <div class="box">
    <!--        <form method="GET" onsubmit="return openPopupVendas(this)">
    <!--            <div class="box-header">
    <!--                <h3 class="box-title">Cadastro Principal da Empresa</h3>
    <!--                <div class="box-tools">
    <!--                    <input type="submit" value="Gravar" class="btn btn-primary"/>
    <!--                </div>
    <!--            </div>
    <!--            <div class="box-body">
    <!--                <div class="row">
    <!--                    <div class="col-sm-3 col-lg-3">
    <!--                        <label class="control-label" for="cnpj_add">CNPJ:</label><br>
    <!--                        <div class="input-group">
    <!--                            <i class="glyphicon glyphicon-search input-group-addon"></i>
    <!--                            <input type="text" name="cnpj" id="cnpj" value="" class="form-control" onblur="verificarCNPJ(this)"/>
    <!--                        </div>
    <!--                        <label class="control-label" for="razao_add">Razão Social:</label><br>
    <!--                        <div class="input-group">
    <!--                            <i class="glyphicon glyphicon-search input-group-addon"></i>
    <!--                            <input type="text" name="razao" id="razao" value="" class="form-control"/>
    <!--                        </div>
    <!--                    </div>
    <!--                    <div class="col-sm-3 col-lg-3">
    <!--                        <label class="control-label" for="fantasia_add">Nome Fantasia:</label><br>
    <!--                        <div class="input-group">
    <!--                            <i class="glyphicon glyphicon-search input-group-addon"></i>
    <!--                            <input type="text" name="fantasia" id="fantasia" value="" class="form-control"/>
    <!--                        </div>
    <!--                        <label class="control-label" for="fundacao_add">Fundação:</label><br>
    <!--                        <div class="input-group">
    <!--                            <i class="glyphicon glyphicon-search input-group-addon"></i>
    <!--                            <input type="date" name="fundacao" id="fundacao" value="" class="form-control"/>
    <!--                        </div>
    <!--                    </div>
    <!--                    <div class="form-group col-sm-3 col-lg-3">
    <!--                        <label class="control-label" for="cnae_add">CNAE:</label><br>
    <!--                        <div class="input-group">
    <!--                            <select name="cnae_secao" id="cnae_secao" class="form-control" onchange="buscarCnae(this)">
    <!--                                <?php foreach ($cnae as $cn) :?>
    <!--                                <option value="<?php echo($cn['secao']);?>"><?php echo utf8_encode($cn['descricao']);?></option>
    <!--                                <?php endforeach;?>
    <!--                            </select>
    <!--                            <select name="cnae" id="cnae_divisao" class="form-control" onchange="buscarCnae(this)">
    <!--                                <option value="0">0</option>
    <!--                            </select>
    <!--                            <select name="cnae" id="cnae_grupo" class="form-control" onchange="buscarCnae(this)">
    <!--                                <option value="0">0</option>
    <!--                            </select>
    <!--                            <select name="cnae" id="cnae" class="form-control">
    <!--                                <option value="0">0</option>
    <!--                            </select>
    <!--                        </div>
    <!--                    </div>
    <!--                    <div class="col-sm-3 col-lg-3">
    <!--                        <label class="control-label" for="regime_add">Regime:</label><br>
    <!--                        <div class="input-group">
    <!--                            <select name="regime" id="regime" class="form-control">
    <!--                                <option value="1">Simples Nacional</option>
    <!--                                <option value="3">Regime Normal</option>
    <!--                            </select>
    <!--                        </div>
    <!--                    </div>
    <!--                </div>
    <!--            </div>
    <!--        </form>
    <!--        <a href="#ConfigPrincipal" class="btn btn-default" data-toggle="collapse">
    <!--            <i class="fa fa-sign-out"></i>FECHAR</a>
    <!--    </div>
    <!--</div>
    -->
    
    <!--<div id="ConfigComplementar" class="collapse panel-collapse">
    <!--    <div class="box">
    <!--        <form method="GET" onsubmit="return openPopupClientes(this)">
    <!--            <div class="box-header">
    <!--                <h3 class="box-title">Informação Complementar da Empresa</h3>
    <!--                <div class="box-tools">
    <!--                    <input type="submit" value="Gerar Relatorio" class="btn btn-primary"/>
    <!--                </div>
    <!--            </div>
    <!--            <div class="box-body">
    <!--                <div class="row">
    <!--                    <div class="form-group col-sm-3 col-lg-3">
    <!--                        <label class="control-label" for="cep">CEP:</label>
    <!--                        <div class="input-group">
    <!--                            <i class="glyphicon glyphicon-search input-group-addon"></i>
    <!--                            <input type="text" name="cep" id="cep" class="form-control" onblur="consultaCEP()" />
    <!--                        </div>
    <!--                    </div>
    <!--                    <div class="form-group col-sm-3 col-lg-3">
    <!--                        <label class="control-label" for="endereco">Endereco:</label>
    <!--                        <div class="input-group-sm">
    <!--                            <input type="text" name="endereco" id="endereco" class="form-control" />
    <!--                        </div>
    <!--                        <label class="control-label" for="numero">Numero:</label>
    <!--                        <div class="input-group">
    <!--                            <input type="text" name="numero" id="numero" class="form-control" />
    <!--                        </div>
    <!--                        <label class="control-label" for="adicional">Complemento:</label>
    <!--                        <div class="input-group">
    <!--                            <input type="text" name="adicional" id="adicional" class="form-control" />
    <!--                        </div>
    <!--                        <label class="control-label" for="bairro">Bairro:</label>
    <!--                        <div class="input-group">
    <!--                            <input type="text" name="bairro" id="bairro" class="form-control" />
    <!--                        </div>
    <!--                    </div>
    <!--                    <div class="form-group col-sm-3 col-lg-3">
    <!--                        <label class="control-label" for="estado">Estado:</label>
    <!--                        <div class="input-group-sm">
    <!--                            <select name="estado" id="estado" class="form-control" onchange="buscarEstados(this)">
    <!--                                <?php foreach ($estados as $estado) :?>
    <!--                                <option value="<?php echo($estado['CodigoUf']);?>" >
    <!--                                    <?php echo utf8_encode($estado['Nome']);?>
    <!--                                </option>
    <!--                                <?php endforeach;?>
    <!--                            </select>
    <!--                        </div>
    <!--                        <label class="control-label" for="cidade">Cidade:</label>
    <!--                        <div class="input-group-sm">
    <!--                            <select name="cidade" id="cidade" class="form-control">
    <!--                                <option value="0">0</option>
    <!--                            </select>
    <!--                        </div>
    <!--                    </div>
    <!--                    <div class="col-sm-3 col-lg-3">
    <!--                        <label class="control-label" for="pais">Pais:</label>
    <!--                        <div class="input-group">
    <!--                            <input type="text" name="pais" id="pais" class="form-control" />
    <!--                        </div>
    <!--                    </div>
    <!--                </div>
    <!--            </div>
    <!--        </form>
    <!--        <a href="#ConfigComplementar" class="btn btn-default" data-toggle="collapse">
    <!--            <i class="fa fa-sign-out"></i>FECHAR</a>
    <!--    </div>
    <!--</div>
    -->
        
        
        <script type="text/javascript">
            
            //window.onload = function() {
            //    var obj = [];
            //<?php foreach ($empresa_cnae as $cnae_for) :?>
            //    <?php foreach ($cnae_for as $key => $cn) :?>
            //        obj['<?php echo($key);?>'] = '<?php echo($cn);?>';
            //    <?php endforeach;?>
            //<?php endforeach;?>
            //    atualizarCnae(obj,'0');
            //}
            
            window.onload = function() {
                    var obj = [];
                    <?php foreach ($empresa_cnae as $cnae_for) :?>
                        <?php foreach ($cnae_for as $key => $cnae) :?>
                            obj['<?php echo($key);?>'] = '<?php echo($cnae);?>';
                        <?php endforeach;?>
                    <?php endforeach;?>
                    atualizarCnae(obj,'0');
                    obj['codEstado'] = '<?php echo($empresa->getEnderecoEstado());?>';
                    obj['codCidade'] = '<?php echo($empresa->getEnderecoCidade());?>';
                    buscarEstados(obj);
            }
            
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
            
            //function openPopupVendas(obj) {
            //    var data = $(obj).serialize();
            //    var url = BASE_URL+"relatorio/vendasPDF?"+data;
            //    window.open(url, "Relatorio", "width=700, height=500");
            //    return false;
            //};
            
            //function openPopupClientes(obj) {
            //    var data = $(obj).serialize();
            //    var url = BASE_URL+"relatorio/clientesPDF?"+data;
            //    window.open(url, "Relatorio", "width=700, height=500");
            //    return false;
            //};
            
            //function openPopupProdutos(obj) {
            //    var data = $(obj).serialize();
            //    var url = BASE_URL+"relatorio/produtosPDF?"+data;
            //    window.open(url, "Relatorio", "width=700, height=500");
            //    return false;
            //};
            
            function cadastroPrincipal(obj) {
                var data = $(obj).serialize();
                //var url = BASE_URL+"relatorio/vendasPDF?"+data;
                console.log(obj);
                console.log(data);
                var ret = true;
                var cnpj = document.getElementById('cnpj');
                var razao = document.getElementById('razao');
                var fantasia = document.getElementById('fantasia');
                var fundacao = document.getElementById('fundacao');
                var cnae = document.getElementById('cnae');
                if (validarCNPJ(cnpj.value) === false){ cnpj.value="";            cnpj.focus();     ret=false; }
                if (razao.value === ""){ razao.style.backgroundColor='red';       razao.focus();    ret=false; }
                else { razao.style.backgroundColor='white';    }
                if (fantasia.value === ""){ fantasia.style.backgroundColor='red'; fantasia.focus(); ret=false; }
                else { fantasia.style.backgroundColor='white'; }
                if (fundacao.value === ""){ fundacao.style.backgroundColor='red'; fundacao.focus(); ret=false; }
                else { fundacao.style.backgroundColor='white'; }
                if (cnae.value === 0){      cnae.style.backgroundColor='red';     cnae.focus();     ret=false; } 
                else { cnae.style.backgroundColor='white';     }
                //window.open(url, "Relatorio", "width=700, height=500");
                //window.alert(cnpj.value);
                //window.alert(razao.value);
                //window.alert(fantasia.value);
                //window.alert(fundacao.value);
                //window.alert(cnae.value);
                return ret;
            };
            
            /**
             * Comment
             * @param {Element} obj
             */
            function cadastroAuxiliar(obj) {
                var data = $(obj).serialize();
                //var url = BASE_URL+"relatorio/vendasPDF?"+data;
                console.log(obj);
                console.log(data);
                console.log(data['cep']);
                var ret = true;
                var cep = document.getElementById('cep');
                var endereco = document.getElementById('endereco');
                var numero = document.getElementById('numero');
                var adicional = document.getElementById('adicional');
                var bairro = document.getElementById('bairro');
                var estado = document.getElementById('estado');
                var cidade = document.getElementById('cidade');
                var pais = document.getElementById('pais');
                
                if (cep.value === ""){ cep.style.backgroundColor='red';  cep.focus();  ret=false; }
                else {  cep.style.backgroundColor='white';  }
                if (endereco.value === ""){  endereco.style.backgroundColor='red';  endereco.focus();  ret=false; }
                else {  endereco.style.backgroundColor='white';  }
                if (numero.value === ""){ numero.style.backgroundColor='red'; numero.focus(); ret=false; }
                else { numero.style.backgroundColor='white'; }
                if (adicional.value === ""){ adicional.style.backgroundColor='red'; adicional.focus(); ret=false; }
                else { adicional.style.backgroundColor='white'; }
                if (bairro.value === 0){ bairro.style.backgroundColor='red'; bairro.focus(); ret=false; }
                else { bairro.style.backgroundColor='white'; }
                if (estado.value === 0){ estado.style.backgroundColor='red'; estado.focus(); ret=false; }
                else { estado.style.backgroundColor='white'; }
                if (cidade.value === 0){ cidade.style.backgroundColor='red'; cidade.focus(); ret=false; }
                else { cidade.style.backgroundColor='white'; }
                if (pais.value === 0){ pais.style.backgroundColor='red'; pais.focus(); ret=false; }
                else { pais.style.backgroundColor='white'; }
                //window.open(url, "Relatorio", "width=700, height=500");
                //window.alert(cep.value);
                //window.alert(endereco.value);
                //window.alert(numero.value);
                //window.alert(adicional.value);
                //window.alert(bairro.value);
                //window.alert(cidade.value);
                //window.alert(estado.value);
                //window.alert(pais.value);
                return ret;
            }
        </script>
        
    </section>
    
<br/>