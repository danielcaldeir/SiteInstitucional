    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pagina
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL."pagina/"); ?>"><i class="fa fa-link"></i>Pagina</a></li>
        <li class="active"><i class="fa fa-anchor"></i>Adicionar Menu</li>
      </ol>
    </section>
    
    
    <!-- Main content -->
    <section class="content container-fluid">
        
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        
        <!--<div id="AddUsuario" class="collapse panel-collapse">-->
            <form action="<?php echo BASE_URL; ?>pagina/addAction" method="POST">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            <h3 class="h3">Adicionar Pagina</h3>
                        </div>
                        <div class="box-tools">
                            <input type="submit" id="botaoEnviarForm" value="Adicionar" class="btn btn-success" />
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="url">URL:</label>
                            <select name="url" id="url" class="form-control" required>
                                <?php foreach ($menuItem as $item) :?>
                                <option value="<?php echo($item); ?>"><?php echo($item); ?></option>
                                <?php endforeach;?>
                            </select>
                            <!--<input type="text" name="url" id="url" class="form-control" required/>-->
                        </div>
                        <div class="form-group">
                            <label for="menu">Criar menu automiticamente:</label>
                            <input type="checkbox" name="add_menu" id="add_menu" class="form-inline" value="TRUE"/>
                        </div>
                        <div class="form-group">
                            <label for="titulo">Titulo:</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="corpo">Corpo</label>
                            <textarea name="corpo" id="corpo" class="form-control" required></textarea>
                            <!--<select name="tipo" id="tipo" class="form-control" required>
                            <!--    <option value="pagina">Página</option>
                            <!--    <option value="formulario">Formulário</option>
                            <!--    <option value="portfolio">Portfolio</option>
                            <!--</select>
                            -->
                        </div>
                    <!--    <a href="#AddUsuario" class="btn btn-default" data-toggle="collapse">
                    <!--        <i class="fa fa-sign-out"></i>FECHAR
                    <!--    </a>
                    -->
                    </div>
                </div>
            </form>
        <!--</div>-->
        <pre>
            <?php print_r($menuItem);?>
        </pre>
        
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


<!--<div class="container-fluid">
<!--    <div class="navbar topnav">
<!--        <h2 class="logo">Cadastrar Pagina</h2>
<!--    </div>
<!--    <?php if ( $confirme == "error" ) :?>
<!--            <div class="alert-warning">
<!--                <label>Preencha todos os Campos</label>
<!--            </div>
<!--    <?php endif; ?>
<!--    <?php if ( $confirme == "success" ) :?>
<!--            <div class="alert-success">
<!--                <label>Registro inserido com sucesso</label>
<!--                <a href="<?php echo(BASE_URL."pagina/"); ?>">
<!--                    Acesse o Link para visualizar.
<!--                </a>
<!--            </div>
<!--    <?php endif; ?>
<!--    <?php if ( $confirme == "existe" ) :?>
<!--            <div class="alert-warning">
<!--                <label>Este registro ja existe!</label><br/>
<!--                <a href="<?php echo BASE_URL; ?>pagina/">Gerencie as Pagina.</a>
<!--            </div>
<!--    <?php else :?>
<!--    <form action="<?php echo BASE_URL; ?>pagina/addPaginaAction" method="POST">
<!--        <div class="form-group">
<!--            <label for="nome">URL:</label>
<!--            <input type="text" name="url" id="url" class="form-control"/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="menu" >Criar menu automiticamente:</label>
<!--            <input type="checkbox" name="add_menu" id="add_menu" class="form-inline" value="SIM"/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="email">Titulo:</label>
<!--            <input type="text" name="titulo" id="titulo" class="form-control"/>
<!--        </div>
<!--        <div class="form-group">
<!--            <label for="email">Corpo:</label>
<!--            <textarea name="corpo" id="corpo" class="form-control"></textarea>
<!--        </div>
<!--        <input type="submit" id="botaoEnviarForm" value="Adicionar" class="home_cta_button"/>
<!--    </form>
<!--    <?php endif; ?>
<!--    
<!--    <br/><br/><br/><br/>
<!--</div>
-->
<script type="text/javascript">
    //window.onload = function(){
    //    CKEDITOR.replace("corpo");
    //};
</script>