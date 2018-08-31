
<div class="container-fluid">
    <div class="navbar topnav">
        <h2 class="logo">Editar Pagina</h2>
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
    <?php foreach ($pagina as $info) :?>
    <form action="<?php echo BASE_URL; ?>painel/sisEditarPagina/" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="URL">URL:</label>
            <input type="text" name="url" id="url" class="form-control" value="<?php echo($info['url']);?>"/>
        </div>
        <div class="form-group">
            <label for="Titulo">Titulo:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo($info['titulo']); ?>"/>
        </div>
        <div class="form-group">
            <label for="Corpo">Corpo:</label>
            <textarea name="corpo" id="corpo" class="form-control"><?php echo($info['corpo']); ?></textarea>
        </div>
        <input type="hidden" id="id" name="id" value="<?php echo($info['id']); ?>"/>
        <input type="submit" id="botaoEnviarForm" value="SALVAR" class="home_cta_button"/> | 
        <a href="<?php echo BASE_URL; ?>painel/paginas/" class="btn home_cta_button">VOLTAR</a>
    </form>
    <?php endforeach; ?>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <?php else : ?>
    <form action="<?php echo BASE_URL; ?>painel/paginas/" method="POST">
        <div class="form-group">
            <label>Não foi informado um identificador.</label>
        </div>
        <input type="submit" class="button" value="VOLTAR"/>
    </form>
    
    <?php endif; ?>
    
</div>
<script type="text/javascript">
    window.onload = function(){
        CKEDITOR.replace("corpo");
    };
</script>