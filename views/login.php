        <div class="container-fluid">
            <div class="jumbotron">
                <h2>Página de Login!!</h2>
            </div>
            <?php if (!empty($error)) :?>
            <div class="alert-warning">
                <label>Preencha um E-mail valido!</label>
            </div>
            <?php endif; ?>
            <?php if (!empty($validateLogin)) :?>
            <div class="alert-warning">
                <label>E-mail ou Senha Invalido!</label>
            </div>
            <?php endif; ?>
            <?php if (!empty($habilitado)) :?>
            <div class="alert-warning">
                <label>Usuário sem Permissao neste site ou Desabilitado!</label>
            </div>
            <?php endif; ?>
            <?php if (!empty($permission)) :?>
              <?php if ($permission) :?>
                <div class="callout callout-danger">
                  <label>Usuario nao tem permissao nesta area do SITE!</label>
                </div>
              <?php endif; ?>
            <?php endif; ?>
            <form action="<?php echo BASE_URL; ?>login/logar/" method="POST">
                E-Mail:
                <input class="item" type="text" name="email" value=""><br>
                Senha:
                <input class="item" type="password" name="senha" value=""><br>
                <input class="btn-success" type="submit" id="botaoEnviarForm" value="Entrar">
            </form>
            <a href="<?php echo BASE_URL; ?>login/esqueciSenha/">Esqueceu a senha!</a><br>
            <!--<a href="<?php echo BASE_URL; ?>cadastrar/gerenciaUsuario/">Gerenciamento de Usuarios</a>-->
			<a href="<?php echo BASE_URL; ?>login/cadastrar/">Cadastrar Usuarios</a>
        </div>
