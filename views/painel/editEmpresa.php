    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Empresas
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL); ?>empresas/"><i class="fa fa-building"></i>Empresas</a></li>
        <li class="active"><i class="fa fa-anchor"></i>Editar Empresas</li>
      </ol>
    </section>
    
    <?php if ( !empty($id) ) : ?>
    <!-- Main content -->
    <section class="content container-fluid">
        
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <!--<pre><?php print_r($empresa);?></pre>-->
        <!--<pre><?php print_r($selectedEmpresa);?></pre>-->
        <!--<pre><?php print_r($empresa_cnae);?></pre>-->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Editar Empresas</h3>
                
            </div>
            <div class="box-body">
                <hr class="headline">
                <div id="tabs" class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="btn btn-primary active">
                            <a href="#tabs1" data-toggle="tab" aria-expanded="true">Principal</a>
                        </li>
                        <li class="btn btn-primary">
                            <a href="#tabs2" data-toggle="tab" aria-expanded="false">Auxiliar</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tabs1" class="tab-pane active">
                            <?php foreach ($selectedEmpresa as $item) :?>
                            <form action="<?php echo BASE_URL; ?>empresas/editAction/" method="POST" onSubmit="return cadastroPrincipal(this)">
                                <div class="row">
                                    <div class="col-sm-3 col-lg-3">
                                        <div class="form-group">
                                        <label class="control-label" for="cnpj_label">CNPJ:</label>
                                        <div class="input-group">
                                            <input type="text" name="cnpj" id="cnpj" class="form-control" value="<?php echo($item['cpf_cnpj']);?>" onBlur="verificarCNPJ(this)" required/>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <label class="control-label" for="razao_label">Razao Social:</label>
                                        <div class="input-group">
                                            <input type="text" name="razao" id="razao" class="form-control" value="<?php echo($item['razao_social']);?>" required/>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-lg-3">
                                        <div class="form-group">
                                        <label class="control-label" for="nome_label">Nome:</label>
                                        <div class="input-group">
                                            <input type="text" name="fantasia" id="fantasia" class="form-control" value="<?php echo($item['nome']);?>" required/>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <label class="control-label" for="fundacao_label">Data Fundacao:</label>
                                        <div class="input-group">
                                            <input type="date" name="fundacao" id="fundacao" class="form-control" value="<?php echo date_format(date_create($item['dt_fundacao']), 'Y-m-d');?>" required/>
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
                                                <option value="1" <?php echo(($item['regime']==1)?'selected':'');?>>Simples Nacional</option>
                                                <option value="3" <?php echo(($item['regime']==3)?'selected':'');?>>Regime Normal</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="id" name="id" value="<?php echo md5($item['id']); ?>" />
                                <input type="submit" id="botaoEnviarForm" value="Editar" class="btn btn-success" />
                            </form>
                            <?php endforeach; ?>
                        </div>
                        <div id="tabs2" class="tab-pane">
                            <!--<div class="box">-->
                                <?php foreach ($selectedEmpresa as $item) :?>
                                <form method="POST" action="<?php echo BASE_URL; ?>empresas/editEnderecoAction" onsubmit="return cadastroAuxiliar(this)">
                                
                                    <div class="row">
                                        <div class="form-group col-sm-3 col-lg-3">
                                            <label class="control-label" for="cep">CEP:</label>
                                            <div class="input-group">
                                                <i class="glyphicon glyphicon-search input-group-addon"></i>
                                                <input type="text" name="cep" id="cep" value="<?php echo($item['endereco_cep']);?>" class="form-control" onblur="consultaCEP()" />
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3 col-lg-3">
                                            <label class="control-label" for="endereco">Endereco:</label>
                                            <div class="input-group-sm">
                                                <input type="text" name="endereco" id="endereco" value="<?php echo($item['endereco']);?>" class="form-control" />
                                            </div>
                                            <label class="control-label" for="numero">Numero:</label>
                                            <div class="input-group">
                                                <input type="text" name="numero" id="numero" value="<?php echo($item['endereco_numero']);?>" class="form-control" />
                                            </div>
                                            <label class="control-label" for="adicional">Complemento:</label>
                                            <div class="input-group">
                                                <input type="text" name="adicional" id="adicional" value="<?php echo($item['endereco_adicional']);?>" class="form-control" />
                                            </div>
                                            <label class="control-label" for="bairro">Bairro:</label>
                                            <div class="input-group">
                                                <input type="text" name="bairro" id="bairro" value="<?php echo($item['endereco_bairro']);?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3 col-lg-3">
                                            <label class="control-label" for="estado">Estado:</label>
                                            <div class="input-group-sm">
                                                <select name="estado" id="estado" class="form-control" onchange="buscarEstados(this)">
                                                    <?php foreach ($estados as $estado) :?>
                                                    <option value="<?php echo($estado['CodigoUf']);?>" <?php echo (($estado['CodigoUf']==$item['endereco_estado'])?"selected":"")?>>
                                                        <?php echo ($estado['Nome']);?></option>
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
                                                <input type="text" name="pais" id="pais" value="<?php echo($item['endereco_pais']);?>" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="id" name="id" value="<?php echo md5($item['id']); ?>" />
                                    <input type="submit" id="botaoEnviarForm" value="Editar" class="btn btn-success" />
                                </form>
                                <?php endforeach; ?>
                            <!--</div>-->
                        </div>
                    </div>
                </div>
                <?php foreach ($selectedEmpresa as $item) :?>
                <!--<form action="<?php echo BASE_URL; ?>empresas/editAction/" method="POST">
                <!--    <div class="row">
                <!--        <div class="col-sm-3 col-lg-3">
                <!--            <div class="form-group">
                <!--            <label class="control-label" for="cnpj_label">CNPJ:</label>
                <!--            <div class="input-group">
                <!--                <input type="text" name="cnpj" id="cnpj" class="form-control" value="<?php echo($item['cpf_cnpj']);?>" onBlur="verificarCNPJ(this)" required/>
                <!--            </div>
                <!--            </div>
                <!--            <div class="form-group">
                <!--            <label class="control-label" for="razao_label">Razao Social:</label>
                <!--            <div class="input-group">
                <!--                <input type="text" name="razao" id="razao" class="form-control" value="<?php echo($item['razao_social']);?>" required/>
                <!--            </div>
                <!--            </div>
                <!--        </div>
                <!--        <div class="col-sm-3 col-lg-3">
                <!--            <div class="form-group">
                <!--            <label class="control-label" for="nome_label">Nome:</label>
                <!--            <div class="input-group">
                <!--                <input type="text" name="fantasia" id="fantasia" class="form-control" value="<?php echo($item['nome']);?>" required/>
                <!--            </div>
                <!--            </div>
                <!--            <div class="form-group">
                <!--            <label class="control-label" for="fundacao_label">Data Fundacao:</label>
                <!--            <div class="input-group">
                <!--                <input type="date" name="fundacao" id="fundacao" class="form-control" value="<?php echo date_format(date_create($item['dt_fundacao']), 'Y-m-d');?>" required/>
                <!--            </div>
                <!--            </div>
                <!--        </div>
                <!--        <div class="col-sm3 col-lg-3">
                <!--            <div class="form-group">
                <!--                <label class="control-label" for="cnae_label">CNAE</label>
                <!--                <div class="input-group">
                <!--                    <select name="cnae_secao" id="cnae_secao" class="form-control" onchange="buscarCnae(this)">
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
                <!--                </div>
                <!--                
                <!--            </div>
                <!--        </div>
                <!--        <div class="col-sm-3 col-lg-3">
                <!--            <label class="control-label" for="regime_add">Regime:</label>
                <!--            <div class="input-group">
                <!--                <select name="regime" id="regime" class="form-control">
                <!--                    <option value="1" <?php echo(($item['regime']==1)?'selected':'');?>>Simples Nacional</option>
                <!--                    <option value="3" <?php echo(($item['regime']==3)?'selected':'');?>>Regime Normal</option>
                <!--                </select>
                <!--            </div>
                <!--        </div>
                <!--    </div>
                <!--    <input type="hidden" id="id" name="id" value="<?php echo md5($item['id']); ?>" />
                <!--    <input type="submit" id="botaoEnviarForm" value="Editar" class="btn btn-success" />
                <!--</form>
                -->
                <?php endforeach; ?>
            </div>
        </div>
        
        <script>
            
            window.onload = function() {
                    var obj = [];
                    <?php foreach ($empresa_cnae as $cnae_for) :?>
                        <?php foreach ($cnae_for as $key => $cnae) :?>
                            obj['<?php echo($key);?>'] = '<?php echo($cnae);?>';
                        <?php endforeach;?>
                    <?php endforeach;?>
                    atualizarCnae(obj,'0');
                    <?php foreach ($selectedEmpresa as $item) :?>
                    obj['codEstado'] = '<?php echo($item['endereco_estado']);?>';
                    obj['codCidade'] = '<?php echo($item['endereco_cidade']);?>';
                    <?php endforeach; ?>
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
    <br/><br/><br/><br/>

  <?php else : ?>
        <div class="container">
            <h3 class="h3">N達o foi informado um identificador.</h3>
            <a href="<?php echo BASE_URL; ?>adminLTE/categoria/" class="btn btn-info">VOLTAR</a>
        </div>
        
        
  <?php endif; ?>

<!--<hr/> -->
