    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Permissao
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL); ?>permissao/"><i class="fa fa-plane"></i>Permissao</a></li>
        <li class="active"><i class="fa fa-anchor"></i>Adicionar Permissao</li>
      </ol>
    </section>
    
    
    <!-- Main content -->
    <section class="content container-fluid">
        
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        
        <!--<div id="AddPermissao" class="collapse panel-collapse">-->
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
                                <!--<a href="#AddPermissao" class="btn btn-default" data-toggle="collapse">
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
    
<!--<hr>
<!--<div class="container-fluid">
<!--    <div class="navbar topnav">
<!--        <h2 class="logo">Cadastrar Permissao</h2>
<!--    </div>
<!--    <?php if ( $mensagem == "error" ) :?>
<!--            <div class="alert-warning">
<!--                <label>Preencha todos os Campos</label>
<!--            </div>
<!--    <?php endif; ?>
<!--    <?php if ( $mensagem == "success" ) :?>
<!--            <div class="alert-success">
<!--                <label>Registro inserido com sucesso</label>
<!--                <a href="<?php echo(BASE_URL); ?>menu/">
<!--                    Acesse o Link para visualizar.
<!--                </a>
<!--            </div>
<!--    <?php endif; ?>
<!--    <form action="<?php echo BASE_URL; ?>permissao/addAction" method="POST">
<!--        <div class="form-group">
<!--            <label for="nome">Nome:</label>
<!--            <input type="text" name="nome" id="nome" class="form-control" required/>
<!--        </div>
<!--        <?php foreach ($permissaoItens as $item) :?>
<!--        <div class="form-group">
<!--            <input type="checkbox" name="items[]" value="<?php echo ($item['id']);?>" id="item-<?php echo($item['id']);?>"/>
<!--            <label for="item-<?php echo($item['id']);?>"><?php echo($item['nome']);?></label>
<!--        </div>
<!--        <?php endforeach; ?>
<!--        <input type="submit" id="botaoEnviarForm" value="Adicionar" class="home_cta_button"/>
<!--    </form>
<!--</div>
<!--<br/><br/><br/><br/>
-->
