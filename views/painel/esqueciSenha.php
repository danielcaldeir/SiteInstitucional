<!--<!DOCTYPE html>
<!--<html>
<!--<head>
<!--  <meta charset="utf-8">
<!--  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--  <title>AdminLTE 3 | Forgot Password</title>
<!--  <!-- Tell the browser to be responsive to screen width -->
<!--  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--  <!-- Font Awesome -->
<!--  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
<!--  <!-- Ionicons -->
<!--  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!--  <!-- icheck bootstrap -->
<!--  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!--  <!-- Theme style -->
<!--  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
<!--  <!-- Google Font: Source Sans Pro -->
<!--  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!--</head>
<!--<body class="hold-transition login-page">
    -->
<div class="login-box">
    <!-- Content Header (Page header) -->
    <!--<section class="content-header">
    <!--    <h1>
    <!--        <a href="<?php echo(BASE_URL); ?>painel/"><b>Painel Administrativo</b> CA Contabilidade</a>
    <!--        <small><?php echo($mensagem);?></small>
    <!--    </h1>
    <!--</section>
    <!-- /.section -->
    <div class="login-logo">
        <a href="<?php echo(BASE_URL); ?>painel/"><b>Painel Administrativo</b> CA Contabilidade</a>
    </div>
    <!-- /.login-logo -->
  <div class="login-box-body card">
    <div class="card-body login-card-body">
      <!--<p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>-->
      <p class="login-box-msg">Esqueceu sua senha? <br/> Aqui você pode recuperar facilmente uma nova senha.</p>

      <form action="<?php echo BASE_URL; ?>login/addEsqueciSenha/" method="post">
          <div class="form-group has-feedback">
              <input type="email" name="email" class="form-control" placeholder="Email">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="row">
              <div class="col-xs-8">
                  <a href="<?php echo BASE_URL; ?>login/">Login</a>
              </div>
              <div class="col-xs-4">
                  <!--<button type="submit" class="btn btn-primary btn-block">Request new password</button>-->
                  <button type="submit" class="btn btn-primary btn-block">Nova Senha</button>
              </div>
          </div>
        <!--<div class="input-group mb-3">
        <!--  <input type="email" class="form-control" placeholder="Email">
        <!--  <div class="input-group-append">
        <!--    <div class="input-group-text">
        <!--      <span class="fas fa-envelope"></span>
        <!--    </div>
        <!--  </div>
        <!--</div>
        <!--<div class="row">
        <!--  <div class="col-12">
        <!--    <button type="submit" class="btn btn-primary btn-block">Request new password</button>
        <!--  </div>
        <!--  <!-- /.col -->
        <!--</div>
          -->
      </form>

      <!--<p class="mt-3 mb-1">
      <!--  <a href="login.html">Login</a>
      <!--</p>
      <!--<p class="mb-0">
      <!--  <a href="register.html" class="text-center">Register a new membership</a>
      <!--</p>
      -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!--<!-- jQuery -->
<!--<script src="../../plugins/jquery/jquery.min.js"></script>
<!--<!-- Bootstrap 4 -->
<!--<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--<!-- AdminLTE App -->
<!--<script src="../../dist/js/adminlte.min.js"></script>
<!--</body>
<!--</html>
-->