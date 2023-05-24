
<div class="panel">
    <!-- Content Header (Page header) -->
    <section class="panel-heading">
        <h1 class="h1">
        <a href="<?php echo(BASE_URL); ?>painel/"><b>Painel Administrativo</b> CA Contabilidade</a>
      </h1>
    </section>
    <!--<div class="jumbotron">
    <!--    <label>Redefinir Senha</label>
    <!--</div>
    -->
    <?php if ( !empty($senha) ) :?>
            <div class="alert-warning">
                <label>Informe uma senha Valida!!</label>
            </div>
    <?php endif; ?>
    <?php if ( !empty($error) ) :?>
            <div class="alert-warning">
                <label>Token inválido ou usado!!</label>
            </div>
    <?php endif; ?>
    <?php if ( !empty($redefinir) ) :?>
            <div class="alert-success">
                <strong>Parabens E-Mail Encontrado!</strong>
            </div>
    <?php endif; ?>
    <?php if ( !empty($sucess) ) :?>
            <div class="alert-success">
                <strong>Parabens Senha Alterada com Sucesso!</strong>
                <br/>
                <a href="<?php echo(BASE_URL); ?>login/">Voltar a pagina de login</a>
            </div>
    <?php else :?>
    <div class="panel-body">
        <p class="alert-info">recupere sua senha</p>
        <form action="<?php echo($link); ?>" method="POST">
            <div class="form-group has-feedback">
                <label>Digite a nova senha:</label>
                <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha"/><br/>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <input type="hidden" name="token" value="<?php echo($token); ?>"/>
                    <input type="submit" value="Mudar senha" class="btn-default"/>
                </div>
            </div>
        </form>
    </div>
    <?php endif; ?>
</div>
