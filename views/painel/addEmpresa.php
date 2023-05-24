    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Empresa
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL); ?>empresas/"><i class="fa fa-address-book"></i>Empresas</a></li>
        <li class="active"><i class="fa fa-anchor"></i>Adicionar Empresa</li>
      </ol>
    </section>
    
    
    <!-- Main content -->
    <section class="content container-fluid">
        
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
    <!--<div id="ConfigPrincipal" class="collapse panel-collapse">-->
        <div class="box">
            <form action="<?php echo BASE_URL; ?>empresas/addAction" method="POST" enctype="multipart/form-data" onsubmit="return cadastroPrincipal(this)">
                <div class="box-header">
                    <h3 class="box-title">Adicionar Empresa</h3>
                    <div class="box-tools">
                        <input type="submit" id="botaoEnviarForm" value="Adicionar" class="btn btn-success" />
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label" for="cnpj_add">CNPJ:</label><br>
                        <div class="input-group">
                            <i class="glyphicon glyphicon-search input-group-addon"></i>
                            <input type="text" name="cnpj" id="cnpj" value="" class="form-control" onblur="verificarCNPJ(this)"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="razao_add">Razão Social:</label><br>
                        <div class="input-group">
                            <i class="glyphicon glyphicon-search input-group-addon"></i>
                            <input type="text" name="razao" id="razao" value="" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="fantasia_add">Nome Fantasia:</label><br>
                        <div class="input-group">
                            <i class="glyphicon glyphicon-search input-group-addon"></i>
                            <input type="text" name="fantasia" id="fantasia" value="" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="fundacao_add">Fundação:</label><br>
                        <div class="input-group">
                            <i class="glyphicon glyphicon-search input-group-addon"></i>
                            <input type="date" name="fundacao" id="fundacao" value="" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="cnae_add">CNAE:</label><br>
                        <div class="input-group">
                            <select name="cnae_secao" id="cnae_secao" class="form-control" onchange="buscarCnae(this)">
                                <?php foreach ($cnae as $cn) :?>
                                <option value="<?php echo($cn['secao']);?>"><?php echo utf8_encode($cn['descricao']);?></option>
                                <?php endforeach;?>
                            </select>
                            <select name="cnae" id="cnae_divisao" class="form-control" onchange="buscarCnae(this)">
                                <option value="0">0</option>
                            </select>
                            <select name="cnae" id="cnae_grupo" class="form-control" onchange="buscarCnae(this)">
                                <option value="0">0</option>
                            </select>
                            <select name="cnae" id="cnae" class="form-control">
                                <option value="0">0</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="regime_add">Regime:</label><br>
                        <div class="input-group">
                            <select name="regime" id="regime" class="form-control">
                                <option value="1">Simples Nacional</option>
                                <option value="3">Regime Normal</option>
                            </select>
                        </div>
                    </div>
                    <!--<div class="row">
                    <!--    <div class="col-sm-3 col-lg-3">
                    <!--        <label class="control-label" for="cnpj_add">CNPJ:</label><br>
                    <!--        <div class="input-group">
                    <!--            <i class="glyphicon glyphicon-search input-group-addon"></i>
                    <!--            <input type="text" name="cnpj" id="cnpj" value="" class="form-control" onblur="verificarCNPJ(this)"/>
                    <!--        </div>
                    <!--        <label class="control-label" for="razao_add">Razão Social:</label><br>
                    <!--        <div class="input-group">
                    <!--            <i class="glyphicon glyphicon-search input-group-addon"></i>
                    <!--            <input type="text" name="razao" id="razao" value="" class="form-control"/>
                    <!--        </div>
                    <!--    </div>
                    <!--    <div class="col-sm-3 col-lg-3">
                    <!--        <label class="control-label" for="fantasia_add">Nome Fantasia:</label><br>
                    <!--        <div class="input-group">
                    <!--            <i class="glyphicon glyphicon-search input-group-addon"></i>
                    <!--            <input type="text" name="fantasia" id="fantasia" value="" class="form-control"/>
                    <!--        </div>
                    <!--        <label class="control-label" for="fundacao_add">Fundação:</label><br>
                    <!--        <div class="input-group">
                    <!--            <i class="glyphicon glyphicon-search input-group-addon"></i>
                    <!--            <input type="date" name="fundacao" id="fundacao" value="" class="form-control"/>
                    <!--        </div>
                    <!--    </div>
                    <!--    <div class="form-group col-sm-3 col-lg-3">
                    <!--        <label class="control-label" for="cnae_add">CNAE:</label><br>
                    <!--        <div class="input-group">
                    <!--            <select name="cnae_secao" id="cnae_secao" class="form-control" onchange="buscarCnae(this)">
                    <!--                <?php foreach ($cnae as $cn) :?>
                    <!--                <option value="<?php echo($cn['secao']);?>"><?php echo utf8_encode($cn['descricao']);?></option>
                    <!--                <?php endforeach;?>
                    <!--            </select>
                    <!--            <select name="cnae" id="cnae_divisao" class="form-control" onchange="buscarCnae(this)">
                    <!--                <option value="0">0</option>
                    <!--            </select>
                    <!--            <select name="cnae" id="cnae_grupo" class="form-control" onchange="buscarCnae(this)">
                    <!--                <option value="0">0</option>
                    <!--            </select>
                    <!--            <select name="cnae" id="cnae" class="form-control">
                    <!--                <option value="0">0</option>
                    <!--            </select>
                    <!--        </div>
                    <!--    </div>
                    <!--    <div class="col-sm-3 col-lg-3">
                    <!--        <label class="control-label" for="regime_add">Regime:</label><br>
                    <!--        <div class="input-group">
                    <!--            <select name="regime" id="regime" class="form-control">
                    <!--                <option value="1">Simples Nacional</option>
                    <!--                <option value="3">Regime Normal</option>
                    <!--            </select>
                    <!--        </div>
                    <!--    </div>
                    <!--</div>
                    -->
                </div>
            </form>
            <!--<a href="#ConfigPrincipal" class="btn btn-default" data-toggle="collapse">
            <!--    <i class="fa fa-sign-out"></i>FECHAR
            <!--</a>
            -->
        </div>
    <!--</div>-->
    
    <hr/>
        
    </section>
    
    <br/><br/>
    <br/><br/>
<!--<hr>
<!--<div class="container-fluid">
<!--    <div class="navbar topnav">
<!--        <h2 class="logo">Cadastrar Empresa</h2>
<!--    </div>
<!--    <?php if ( $mensagem == "error" ) :?>
<!--            <div class="alert-warning">
<!--                <label>Preencha todos os Campos</label>
<!--            </div>
<!--    <?php endif; ?>
<!--    <?php if ( $mensagem == "success" ) :?>
<!--            <div class="alert-success">
<!--                <label>Registro inserido com sucesso</label>
<!--                <a href="<?php echo(BASE_URL); ?>config/">
<!--                    Acesse o Link para visualizar.
<!--                </a>
<!--            </div>
<!--    <?php endif; ?>
<!--    <?php if ( $mensagem == "existe" ) :?>
<!--            <div class="alert-warning">
<!--                <label>Este registro ja existe!</label><br/>
<!--                <a href="<?php echo BASE_URL; ?>config/">Acesse o Menu.</a>
<!--            </div>
<!--    <?php endif; ?>
<!--    <form action="<?php echo BASE_URL; ?>config/addActionEmpresa" method="POST" enctype="multipart/form-data" onsubmit="return cadastroPrincipal(this)">
<!--        <div class="form-group">
<!--                    <label class="control-label" for="cnpj_add">CNPJ:</label><br>
<!--                    <div class="input-group">
<!--                        <i class="glyphicon glyphicon-search input-group-addon"></i>
<!--                        <input type="text" name="cnpj" id="cnpj" value="" class="form-control" onblur="verificarCNPJ(this)"/>
<!--                    </div>
<!--        </div>
<!--        <div class="form-group">
<!--                    <label class="control-label" for="razao_add">Razão Social:</label><br>
<!--                    <div class="input-group">
<!--                        <i class="glyphicon glyphicon-search input-group-addon"></i>
<!--                        <input type="text" name="razao" id="razao" value="" class="form-control"/>
<!--                    </div>
<!--        </div>
<!--        <div class="form-group">
<!--                    <label class="control-label" for="fantasia_add">Nome Fantasia:</label><br>
<!--                    <div class="input-group">
<!--                        <i class="glyphicon glyphicon-search input-group-addon"></i>
<!--                        <input type="text" name="fantasia" id="fantasia" value="" class="form-control"/>
<!--                    </div>
<!--        </div>
<!--        <div class="form-group">
<!--                    <label class="control-label" for="fundacao_add">Fundação:</label><br>
<!--                    <div class="input-group">
<!--                        <i class="glyphicon glyphicon-search input-group-addon"></i>
<!--                        <input type="date" name="fundacao" id="fundacao" value="" class="form-control"/>
<!--                    </div>
<!--        </div>
<!--        <div class="form-group">
<!--                    <label class="control-label" for="cnae_add">CNAE:</label><br>
<!--                    <div class="input-group">
<!--                        <select name="cnae_secao" id="cnae_secao" class="form-control" onchange="buscarCnae(this)">
<!--                            <?php foreach ($cnae as $cn) :?>
<!--                            <option value="<?php echo($cn['secao']);?>"><?php echo utf8_encode($cn['descricao']);?></option>
<!--                            <?php endforeach;?>
<!--                        </select>
<!--                        <select name="cnae" id="cnae_divisao" class="form-control" onchange="buscarCnae(this)">
<!--                            <option value="0">0</option>
<!--                        </select>
<!--                        <select name="cnae" id="cnae_grupo" class="form-control" onchange="buscarCnae(this)">
<!--                            <option value="0">0</option>
<!--                        </select>
<!--                        <select name="cnae" id="cnae" class="form-control">
<!--                            <option value="0">0</option>
<!--                        </select>
<!--                    </div>
<!--        </div>
<!--        <div class="form-group">
<!--                    <label class="control-label" for="regime_add">Regime:</label><br>
<!--                    <div class="input-group">
<!--                        <select name="regime" id="regime" class="form-control">
<!--                            <option value="1">Simples Nacional</option>
<!--                            <option value="3">Regime Normal</option>
<!--                        </select>
<!--                    </div>
<!--        </div>
<!--        <input type="submit" id="botaoEnviarForm" value="Adicionar" class="home_cta_button"/>
<!--    </form>
<!--    
<!--    <br/><br/><br/><br/>
<!--</div>
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
                window.alert(cnpj.value);
                window.alert(razao.value);
                window.alert(fantasia.value);
                window.alert(fundacao.value);
                window.alert(cnae.value);
                return ret;
            };
        </script>
        
        