
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo(BASE_URL); ?>painel/"><b>Painel Administrativo</b> CA Contabilidade</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Faça Login no Painel Administrativo</p>
    <?php if (!empty($error)) :?>
      <div class="callout callout-danger">
        <label>Preencha um E-mail valido!</label>
      </div>
    <?php endif; ?>
    <?php if (!empty($habilitado)) :?>
      <div class="callout callout-danger">
        <label>Usuário Desabilitado ou E-mail Invalido!</label>
      </div>
    <?php endif; ?>
    <?php if (!empty($validateLogin)) :?>
      <div class="callout callout-danger">
        <label>E-mail ou Senha Invalido!</label>
      </div>
    <?php endif; ?>
    <form action="<?php echo BASE_URL; ?>login/logar/" method="post">
      <div class="form-group has-feedback">
          <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
          <input type="password" name="senha" class="form-control" placeholder="Senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
            <a href="<?php echo BASE_URL; ?>login/esqueciSenha/">Esqueci minha senha!</a>
    <!--      <div class="checkbox icheck">
    <!--        <label>
    <!--          <input type="checkbox"> Remember Me
    <!--        </label>
    <!--      </div>
            -->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    
<!--    <div class="social-auth-links text-center">
<!--      <p>- OR -</p>
<!--      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat">
<!--          <i class="fa fa-facebook"></i> 
<!--          Sign in using Facebook
<!--      </a>
<!--      <a href="#" class="btn btn-block btn-social btn-google btn-flat">
<!--          <i class="fa fa-google-plus"></i> 
<!--          Sign in using Google+
<!--      </a>
<!--    </div>
    <!-- /.social-auth-links -->
<!--
    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>
-->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="<?php echo BASE_URL; ?>assets/iCheck/icheck.min.js"></script>
<!--<script src="../../plugins/iCheck/icheck.min.js"></script>-->
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>