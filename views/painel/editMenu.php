    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Menus
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL); ?>menu/"><i class="fa fa-address-book"></i>Menu</a></li>
        <li class="active"><i class="fa fa-anchor"></i>Editar Menu</li>
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
                <h3 class="box-title">Editar Menu</h3>
                
            </div>
            <div class="box-body">
                <hr class="headline">
                <?php foreach ($menu as $item) :?>
                <form action="<?php echo BASE_URL; ?>menu/editAction/" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="<?php echo($item['nome']);?>" required/>
                    </div>
                    <div class="form-group">
                        <label for="url">URL:</label>
                        <input type="text" name="url" id="url" class="form-control" value="<?php echo($item['url']);?>" required/>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo:</label>
                        <!--<select name="status" id="status" class="form-control" onchange="verificarStatus()">-->
                        <select name="tipo" id="tipo" class="form-control">
                            <option <?php echo ($item['tipo']==='pagina')?'selected':'';?> value="pagina">
                                PÁGINA
                            </option>
                            <option <?php echo ($item['tipo']==='formulario')?'selected':'';?> value="formulario">
                                FORMULÁRIO
                            </option>
                            <option <?php echo ($item['tipo']==='portfolio')?'selected':'';?> value="portfolio">
                                PORTFOLIO
                            </option>
                        </select>
                    </div>
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
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
    <!--<br/>-->
  <?php else : ?>
        <div class="container">
            <h3 class="h3">Não foi informado um identificador.</h3>
            <a href="<?php echo BASE_URL; ?>menu/" class="btn btn-info">VOLTAR</a>
        </div>
  <?php endif; ?>

<br/><br/><br/><br/>

<!--<hr/>
<!--<div class="container-fluid">
<!--    <div class="navbar topnav">
<!--        <h2 class="logo">Editar Menu</h2>
<!--    </div>
<!--    <?php if ( $confirme == "error") :?>
<!--            <div class="alert-warning">
<!--                <label>Preencha todos os Campos</label>
<!--            </div>
<!--    <?php endif; ?>
<!--    <?php if ( $confirme == "sucess" ) :?>
<!--            <div class="alert-success">
<!--                <strong>Registro Editado com Sucesso!</strong>
<!--            </div>
<!--    <?php endif; ?>
<!--    <?php if ( !empty($id) ) : ?>
<!--    <?php foreach ($menu as $info) :?>
<!--    <form action="<?php echo BASE_URL; ?>menu/editMenuAction/" method="POST" enctype="multipart/form-data">
<!--        <div class="form-group">
<!--            <label for="Nome">Nome:</label>
<!--            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo($info['nome']);?>"/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="URL">URL:</label>
<!--            <input type="text" name="url" id="url" class="form-control" value="<?php echo($info['url']); ?>"/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="Tipo">Tipo:</label>
<!--            <select name="tipo" id="tipo" class="form-control">
<!--                <option value="pagina">Página</option>
<!--                <option value="formulario">Formulario</option>
<!--                <option value="portfolio">Portfolio</option>
<!--            </select>
<!--        </div>
<!--        <input type="hidden" id="id" name="id" value="<?php echo($info['id']); ?>"/>
<!--        <input type="submit" id="botaoEnviarForm" value="SALVAR" class="home_cta_button"/> | 
<!--        <a href="<?php echo BASE_URL; ?>menu/" class="btn home_cta_button">VOLTAR</a>
<!--    </form>
<!--    <?php endforeach; ?>
<!--    <br/><br/><br/><br/>
<!--    <?php else : ?>
<!--    <form action="<?php echo BASE_URL; ?>menu/" method="POST">
<!--        <div class="form-group">
<!--            <label>Não foi informado um identificador.</label>
<!--        </div>
<!--        <input type="submit" class="button" value="VOLTAR"/>
<!--    </form>
<!--    <?php endif; ?>
<!--</div>
<!--<br/><br/><br/><br/>
-->