<div class="container-fluid">
    <div class="navbar topnav">
        <h2 class="logo">Cadastrar Menu</h2>
    </div>
    <?php if ( $confirme == "error" ) :?>
            <div class="alert-warning">
                <label>Preencha todos os Campos</label>
            </div>
    <?php endif; ?>
    <?php if ( $confirme == "success" ) :?>
            <div class="alert-success">
                <label>Registro inserido com sucesso</label>
                <a href="<?php echo(BASE."painel/menus"); ?>">
                    Acesse o Link para visualizar.
                </a>
            </div>
    <?php endif; ?>
    <?php if ( $confirme == "existe" ) :?>
            <div class="alert-warning">
                <label>Este registro ja existe!</label><br/>
                <a href="<?php echo BASE_URL; ?>painel/menus">Acesse o Menu.</a>
            </div>
    <?php else :?>
    <form action="<?php echo BASE_URL; ?>painel/sisAddMenu" method="POST">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="email">URL:</label>
            <input type="text" name="url" id="url" class="form-control"/>
        </div>
		<div class="form-group">
            <label for="tipo">TIPO:</label>
			<select name="tipo" id="tipo" class="form-control">
				<option value="pagina">Página</option>
				<option value="formulario">Formulario</option>
				<option value="portfolio">Portfolio</option>
			</select>
        </div>
        <input type="submit" id="botaoEnviarForm" value="Adicionar" class="home_cta_button"/>
    </form>
    <?php endif; ?>
    
    <br/>
    <br/>
    <br/>
    <br/>
</div>