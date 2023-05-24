    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuarios
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL); ?>usuario/"><i class="fa fa-user"></i>Usuarios</a></li>
        <li class="active"><i class="fa fa-anchor"></i>Adicionar Usuario</li>
      </ol>
    </section>
    
    
    <!-- Main content -->
    <section class="content container-fluid">
        
      <!--------------------------
        | Your Page Content Here |
        -------------------------->

    <!--<div id="AddUsuario" class="collapse panel-collapse">-->
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
                                <?php foreach ($permissaoGrupo as $item) :?>
                                <option value="<?php echo($item['id']);?>">
                                    <?php echo($item['nome']);?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <!--<a href="#AddUsuario" class="btn btn-default" data-toggle="collapse">
                    <!--    <i class="fa fa-sign-out"></i>FECHAR
                    <!--</a>
                    -->
                </div>
            </div>
        </form>
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
            
            
            function verificarStatus() {
                var status = document.getElementById('add_menu');
                var select = document.getElementById('url_select');
                var label = document.getElementById('url_label');
                alert('Verificar Status: '+status.checked);
                if (status.checked === true){
                    select.style.display = 'none';
                    select.removeAttribute('required');
                    select.disabled = true;
                    label.style.display = 'none';
                } else {
                    select.style.display = 'block';
                    select.required = 'true';
                    select.removeAttribute('disabled');
                    label.style.display = 'block';
                }
            }
            
            window.onload = function(){
                CKEDITOR.replace("corpo");
            };
        </script>
    </section>
<br/><br/><br/>
<!--<hr/>
<!--<div class="container-fluid">
<!--	<div style="clear: both"></div>
<!--    <h1 class="h1">Cadastrar Usuário</h1>
<!--    <br/>
<!--    <?php if ( $confirme == "error" ) :?>
<!--            <div class="alert-warning">
<!--                <label>Preencha todos os Campos</label>
<!--            </div>
<!--    <?php endif; ?>
<!--    <?php if ( $confirme == "existe" ) :?>
<!--            <div class="alert-warning">
<!--                <label>Este usuario ja existe!</label><br>
<!--                <a href="<?php echo BASE_URL; ?>login/">Faca o login.</a>
<!--            </div>
<!--    <?php endif; ?>
<!--    <?php if ( $confirme == "sucess" ) :?>
<!--            <div class="alert-success">
<!--                <strong>Parabens Cadastro Realizado!</strong>
<!--                <a href="<?php echo($link); ?>">
<!--                    Acesse o Link para confirmar o cadastro.
<!--                </a>
<!--            </div>
<!--    <?php endif; ?>
<!--    <form action="<?php echo BASE_URL; ?>cadastrar/addUser" method="POST">
<!--        <div class="form-group">
<!--            <label for="nome">Nome:</label>
<!--            <input type="text" name="nome" id="nome" class="form-control"/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="email">E-Mail:</label>
<!--            <input type="email" name="email" id="email" class="form-control"/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="senha">Senha:</label>
<!--            <input type="password" name="senha" id="senha" class="form-control"/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="telefone">Telefone:</label>
<!--            <input type="text" name="telefone" id="telefone" class="form-control"/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="permissao">Nivel do Grupo:</label>
<!--            <select name="permissao" id="permissao" class="form-control" required>
<!--                <option value="0"></option>
<!--                <?php foreach ($permissaoGrupo as $item) :?>
<!--                <option value="<?php echo($item['id']);?>">
<!--                    <?php echo($item['nome']);?>
<!--                </option>
<!--                <?php endforeach; ?>
<!--            </select>
<!--        </div>
<!--        <input type="submit" id="botaoEnviarForm" value="Cadastrar" class="btn-default"/>
<!--    </form>
<!--    <br/><br/><br/><br/>
<!--</div>
-->