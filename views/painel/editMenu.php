
<div class="container-fluid">
    <div class="navbar topnav">
        <h2 class="logo">Editar Menu</h2>
    </div>
    <?php if ( $confirme == "error") :?>
            <div class="alert-warning">
                <label>Preencha todos os Campos</label>
            </div>
    <?php endif; ?>
    <?php if ( $confirme == "sucess" ) :?>
            <div class="alert-success">
                <strong>Registro Editado com Sucesso!</strong>
            </div>
    <?php endif; ?>
    <?php if ( !empty($id) ) : ?>
    <?php foreach ($menu as $info) :?>
    <form action="<?php echo BASE_URL; ?>painel/sisEditarMenu/" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="Nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo($info['nome']);?>"/>
        </div>
        <div class="form-group">
            <label for="URL">URL:</label>
            <input type="text" name="url" id="url" class="form-control" value="<?php echo($info['url']); ?>"/>
        </div>
		<div class="form-group">
            <label for="Tipo">Tipo:</label>
            <select name="tipo" id="tipo" class="form-control">
				<option value="pagina">Página</option>
				<option value="formulario">Formulario</option>
				<option value="portfolio">Portfolio</option>
			</select>
        </div>
        <input type="hidden" id="id" name="id" value="<?php echo($info['id']); ?>"/>
        <input type="submit" id="botaoEnviarForm" value="SALVAR" class="home_cta_button"/> | 
        <a href="<?php echo BASE_URL; ?>painel/menus/" class="btn home_cta_button">VOLTAR</a>
    </form>
    <?php endforeach; ?>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <?php else : ?>
    <form action="<?php echo BASE_URL; ?>painel/menus/" method="POST">
        <div class="form-group">
            <label>Não foi informado um identificador.</label>
        </div>
        <input type="submit" class="button" value="VOLTAR"/>
    </form>
    
    <?php endif; ?>
    
</div>
