    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuarios
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL); ?>usuario/"><i class="fa fa-user"></i>Usuarios</a></li>
        <li class="active"><i class="fa fa-anchor"></i>Editar Usuarios</li>
      </ol>
    </section>
    
    <?php if ( !empty($id) ) : ?>
    <!-- Main content -->
    <section class="content container-fluid">
        
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Editar Usuarios</h3>
                
            </div>
            <div class="box-body">
                <hr class="headline">
                <?php foreach ($selectedUser as $item) :?>
                <form action="<?php echo BASE_URL; ?>usuario/editAction/" method="POST">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="<?php echo($item['nome']);?>" required/>
                    </div>
                    <div class="form-group">
                        <label for="email">E-Mail:</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo($item['email']);?>" required/>
                    </div>
                    <!--<div class="form-group">
                    <!--    <label for="senha">Senha:</label>
                    <!--    <input type="password" name="senha" id="senha" class="form-control" value="<?php echo($item['senha']);?>" required/>
                    <!--</div>
					-->
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="text" name="telefone" id="telefone" class="form-control" value="<?php echo($item['telefone']);?>" required/>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <!--<select name="status" id="status" class="form-control" onchange="verificarStatus()">-->
                        <select name="status" id="status" class="form-control">
                            <option <?php echo ($item['status']==0)?'selected':'';?> value="0">
                                DESABILITADO
                            </option>
                            <option <?php echo ($item['status']==1)?'selected':'';?> value="1">
                                HABILITADO
                            </option>
                            <option <?php echo ($item['status']==2)?'selected':'';?> value="2">
                                ADMINISTRATIVO
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="permissao" id="permissao_label" >Grupo:</label>
                        <select name="permissao" id="permissao_select" class="form-control">
                            <option value="0"></option>
                            <?php foreach ($permissaoGrupo as $per) :?>
                            <option <?php echo ($item['id_grupo']==$per['id'])?'selected':'';?> value="<?php echo($per['id']);?>">
                                <?php echo($per['nome']);?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" id="id" name="id" value="<?php echo md5($id); ?>" />
                    <input type="submit" id="botaoEnviarForm" value="Editar" class="btn btn-success" />
                </form>
                <?php endforeach; ?>
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
        </script>
    </section>
    <br/><br/><br/><br/>
    
  <?php else : ?>
        <div class="container">
            <h3 class="h3">Não foi informado um identificador.</h3>
            <a href="<?php echo BASE_URL; ?>adminLTE/categoria/" class="btn btn-info">VOLTAR</a>
        </div>
        
        
  <?php endif; ?>

<!--<hr/>
<!--<div class="container-fluid">
<!--	<div style="clear: both"></div>
<!--    <h1 class="h1">Editar Usuário</h1>
<!--    <br/>
<!--    <?php if ( $confirme == "error" ) :?>
<!--            <div class="alert-warning">
<!--                <label>Preencha todos os Campos</label>
<!--            </div>
<!--    <?php endif; ?>
<!--    <?php if ( $confirme == "existe" ) :?>
<!--            <div class="alert-warning">
<!--                <label>Duplicidade de E-Mail!</label><br>
<!--                <a href="<?php echo BASE_URL; ?>login/">Faca o login.</a>
<!--            </div>
<!--    <?php endif; ?>
<!--    <?php if ( $confirme == "sucess" ) :?>
<!--            <div class="alert-success">
<!--                <strong>Parabens Usuario Editado com Sucesso!</strong>
<!--            </div>
<!--    <?php endif; ?>
<!--    <form action="<?php echo BASE_URL; ?>cadastrar/editarUserControll" method="POST">
<!--        <div class="form-group">
<!--            <label for="nome">Nome:</label>
<!--            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo($dado['nome']);?>"/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="email">E-Mail:</label>
<!--            <input type="email" name="email" id="email" class="form-control" value="<?php echo($dado['email']);?>"/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="senha">Senha:</label>
<!--            <input type="password" name="senha" id="senha" class="form-control"/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="telefone">Telefone:</label>
<!--            <input type="text" name="telefone" id="telefone" class="form-control" value="<?php echo($dado['telefone']);?>"/>
<!--        </div>
<!--        <input type="hidden" name="id" value="<?php echo($dado['id']);?>">
<!--      <?php if ( $confirme == "sucess" ) :?>
<!--        <input type="submit" id="botaoEnviarForm" value="Editar" class="btn-default" disabled="true"/>
<!--      <?php else :?>
<!--        <input type="submit" id="botaoEnviarForm" value="Editar" class="btn-default"/>
<!--      <?php endif;?>
<!--        
<!--    </form>
<!--    <br/>
<!--    <br/>
<!--    <br/>
<!--    <br/>
<!--</div>
-->