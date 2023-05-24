<!--<!DOCTYPE html>
<!--<html>
<!--<head>
<!--    <meta charset="utf-8">
<!--    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--    <title>AdminLTE 3 | Recover Password</title>
<!--    <!-- Tell the browser to be responsive to screen width -->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--    <!-- Font Awesome -->
<!--    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
<!--    <!-- Ionicons -->
<!--    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!--    <!-- icheck bootstrap -->
<!--    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!--    <!-- Theme style -->
<!--    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
<!--    <!-- Google Font: Source Sans Pro -->
<!--    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!--</head>
<!--<body class="hold-transition login-page">
-->
<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo(BASE_URL); ?>painel/"><b>Painel Administrativo</b> CA Contabilidade</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <!--<p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>-->
            <p class="login-box-msg">Você está a apenas um passo de sua nova senha, recupere sua senha agora.</p>
            <small><?php echo($mensagem);?></small>
            <form action="<?php echo($link); ?>" method="post" onsubmit="return verificarSenha()">
                <div class="form-group has-feedback">
                    <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="confirmeSenha" id="confirmeSenha" class="form-control" placeholder="Confirme a Senha">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <!--<div class="input-group mb-3">
                <!--    <input type="password" class="form-control" placeholder="Password">
                <!--    <div class="input-group-append">
                <!--        <div class="input-group-text">
                <!--            <span class="fas fa-lock"></span>
                <!--        </div>
                <!--    </div>
                <!--</div>
                -->
                <!--<div class="input-group mb-3">
                <!--    <input type="password" class="form-control" placeholder="Confirm Password">
                <!--    <div class="input-group-append">
                <!--        <div class="input-group-text">
                <!--            <span class="fas fa-lock"></span>
                <!--        </div>
                <!--    </div>
                <!--</div>
                -->
                <div class="row">
                    <div class="col-xs-12">
                        <!--<button type="submit" class="btn btn-primary btn-block">Change password</button>-->
                        <button type="submit" class="btn btn-primary btn-block">Mudar Senha</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!--<p class="mt-3 mb-1">
            <!--    <a href="login.html">Login</a>
            <!--</p>
            -->
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<script>
    function verificarSenha() {
        senha = document.getElementById('senha');
        confimeSenha = document.getElementById('confirmeSenha');
        if (senha.value === confimeSenha.value){
            return true;
        } else {
            alert("As duas Senhas nao sao iguais");
            return false;
        }
    }
</script>
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