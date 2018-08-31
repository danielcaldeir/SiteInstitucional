
<div class="container-fluid">
    <div class="small jumbotron">
        <h4>Adicionar Portfolio</h4>
    </div>
    <?php if ( !empty($error) ) :?>
            <div class="alert-warning">
                <label>Preencha todos os Campos</label>
            </div>
    <?php endif; ?>
    <?php if ( !empty($sucess) ) :?>
            <div class="alert-success">
                <strong>Parabens Anuncio Realizado!</strong>
            </div>
    <?php endif; ?>
    <form action="<?php echo BASE_URL; ?>produto/adicionarAnuncio/" method="POST" enctype="multpart/form-data">
        <div class="form-group">
            <label for="categoria">Categoria:</label>
        </div>
        <div class="form-group">
            <label for="titulo">Titulo:</label>
        </div>
        <div class="form-group">
            <label for="valor">Valor:</label>
        </div>
        <div class="form-group">
            <label for="descricao">Descricao:</label>
        </div>
        <div class="form-group">
            <label for="estado">Estado de Conservacao:</label>
        </div>
        <input type="hidden" id="usuario" name="usuario" value="<?php echo($_SESSION['id']); ?>" />
        <input type="submit" id="botaoEnviarForm" value="ADICIONAR" class=" btn btn-default"/>
        <a href="<?php echo BASE_URL; ?>produto/meusAnuncios/" class="btn btn-default">VOLTAR</a>
    </form>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
</div>