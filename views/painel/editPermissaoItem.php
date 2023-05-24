    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tela de Item de Permissao
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?php echo(BASE_URL); ?>permissao/"><i class="fa fa-plane"></i>Permissao</a></li>
        <li class="active"><i class="fa fa-anchor"></i>Editar Item de Permissao</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        
        <form action="<?php echo BASE_URL; ?>permissao/editItemAction/<?php echo(md5($id_Item));?>" method="POST">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Editar Item de Permissões</h3>
                    <div class="box-tools">
                        <input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success"/>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="nomeItem">Nome do Item:</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="<?php echo ($nomeItem);?>" required/>
                    </div>
                    <div class="form-group">
                        <label for="SLUG">Slug:</label>
                        <input type="text" name="slug" id="slug" class="form-control" value="<?php echo ($slug);?>" disabled/>
                    </div>
                </div>
            </div>
        </form>
        
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
    <!-- /.content -->
<br/><br/><br/><br/>

<!--<hr/>
<!--<div class="container-fluid">
<!--    <div class="navbar topnav">
<!--        <h2 class="logo">Editar Item de Permissao</h2>
<!--    </div>
<!--    <?php if ( $mensagem == "error") :?>
<!--            <div class="alert-warning">
<!--                <label>Preencha todos os Campos</label>
<!--            </div>
<!--    <?php endif; ?>
<!--    <?php if ( $mensagem == "sucess" ) :?>
<!--            <div class="alert-success">
<!--                <strong>Registro Editado com Sucesso!</strong>
<!--            </div>
<!--    <?php endif; ?>
<!--    <form action="<?php echo BASE_URL; ?>permissao/editItemAction/<?php echo($id_Item);?>" method="POST" enctype="multipart/form-data">
<!--        <div class="form-group">
<!--            <label for="nomeItem">Nome do Item:</label>
<!--            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo ($nomeItem);?>" required/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="SLUG">Slug:</label>
<!--            <input type="text" name="slug" id="slug" class="form-control" value="<?php echo ($slug);?>" disabled/>
<!--        </div>
<!--        <input type="submit" id="botaoEnviarForm" value="SALVAR" class="home_cta_button"/> | 
<!--        <a href="<?php echo BASE_URL; ?>permissao/" class="btn home_cta_button">VOLTAR</a>
<!--    </form>
<!--</div>
<!--<br/><br/><br/><br/>
-->
