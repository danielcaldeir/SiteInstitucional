    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pagina
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL."pagina/"); ?>"><i class="fa fa-link"></i>Pagina</a></li>
        <li class="active"><i class="fa fa-anchor"></i>Editar Pagina</li>
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
                <h3 class="box-title">Editar Pagina</h3>
                
            </div>
            <div class="box-body">
                <hr class="headline">
                <?php foreach ($pagina as $item) :?>
                <form action="<?php echo BASE_URL; ?>pagina/editAction/" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="url">URL:</label>
                        <input type="text" name="url" id="url" class="form-control" value="<?php echo($item['url']);?>" required/>
                    </div>
                    <div class="form-group">
                        <label for="titulo">Titulo:</label>
                        <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo($item['titulo']);?>" required/>
                    </div>
                    <div class="form-group">
                        <label for="corpo">Corpo:</label>
                        <textarea name="corpo" id="corpo" class="form-control"><?php echo($item['corpo']);?></textarea>
                    </div>
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                    <input type="submit" id="botaoEnviarForm" value="Editar" class="btn btn-success" />
                </form>
                <?php endforeach; ?>
            </div>
        </div>
        
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
            
            window.onload = function(){
                CKEDITOR.replace("corpo");
            };
        </script>
    </section>
    <!--<hr/>-->
    <!--<br/>-->
  <?php else : ?>
        <div class="container">
            <h3 class="h3">Não foi informado um identificador.</h3>
            <a href="<?php echo BASE_URL; ?>menu/" class="btn btn-info">VOLTAR</a>
        </div>
  <?php endif; ?>


<!--<div class="container-fluid">
<!--    <div class="navbar topnav">
<!--        <h2 class="logo">Editar Pagina</h2>
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
<!--    <?php foreach ($pagina as $info) :?>
<!--    <form action="<?php echo BASE_URL; ?>pagina/editPaginaAction/" method="POST" enctype="multipart/form-data">
<!--        <div class="form-group">
<!--            <label for="URL">URL:</label>
<!--            <input type="text" name="url" id="url" class="form-control" value="<?php echo($info['url']);?>"/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="Titulo">Titulo:</label>
<!--            <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo($info['titulo']); ?>"/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="Corpo">Corpo:</label>
<!--            <textarea name="corpo" id="corpo" class="form-control"><?php echo($info['corpo']); ?></textarea>
<!--        </div>
<!--        <input type="hidden" id="id" name="id" value="<?php echo($info['id']); ?>"/>
<!--        <input type="submit" id="botaoEnviarForm" value="SALVAR" class="home_cta_button"/> | 
<!--        <a href="<?php echo BASE_URL; ?>pagina/" class="btn home_cta_button">VOLTAR</a>
<!--    </form>
<!--    <?php endforeach; ?>
<!--    <br/><br/><br/><br/><br/>
<!--    <?php else : ?>
<!--    <form action="<?php echo BASE_URL; ?>pagina/" method="POST">
<!--        <div class="form-group">
<!--            <label>Não foi informado um identificador.</label>
<!--        </div>
<!--        <input type="submit" class="button" value="VOLTAR"/>
<!--    </form>
<!--    <?php endif; ?>
<!--</div>
-->
<script type="text/javascript">
    //window.onload = function(){ CKEDITOR.replace("corpo"); };
</script>