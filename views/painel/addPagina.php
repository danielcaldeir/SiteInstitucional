<div class="container-fluid">
    <div class="navbar topnav">
        <h2 class="logo">Cadastrar Pagina</h2>
    </div>
    <?php if ( $confirme == "error" ) :?>
            <div class="alert-warning">
                <label>Preencha todos os Campos</label>
            </div>
    <?php endif; ?>
    <?php if ( $confirme == "success" ) :?>
            <div class="alert-success">
                <label>Registro inserido com sucesso</label>
                <a href="<?php echo(BASE_URL."painel/paginas"); ?>">
                    Acesse o Link para visualizar.
                </a>
            </div>
    <?php endif; ?>
    <?php if ( $confirme == "existe" ) :?>
            <div class="alert-warning">
                <label>Este registro ja existe!</label><br/>
                <a href="<?php echo BASE_URL; ?>painel/paginas">Acesse o Menu.</a>
            </div>
    <?php else :?>
    <form action="<?php echo BASE_URL; ?>painel/sisAddPagina" method="POST">
        <div class="form-group">
            <label for="nome">URL:</label>
            <input type="text" name="url" id="url" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="menu" >Criar menu automiticamente:</label>
            <input type="checkbox" name="add_menu" id="add_menu" class="form-inline" value="SIM"/>
        </div>
        <div class="form-group">
            <label for="email">Titulo:</label>
            <input type="text" name="titulo" id="titulo" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="email">Corpo:</label>
            <textarea name="corpo" id="corpo" class="form-control"></textarea>
        </div>
        <input type="submit" id="botaoEnviarForm" value="Adicionar" class="home_cta_button"/>
    </form>
    <?php endif; ?>
    
    <br/>
    <br/>
    <br/>
    <br/>
</div>
<script type="text/javascript">
    window.onload = function(){
        CKEDITOR.replace("corpo");
    };
</script>