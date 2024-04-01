<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loginController
 *
 * @author Daniel_Caldeira
 */
class loginController extends Controller
{
    private function atualizarSession(Usuario $user)
    {
        global $config;
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = array();
        }
        $_SESSION['user']['id'] = $user->getID();
        $_SESSION['user']['nome'] = $user->getNome();
        $_SESSION['user']['email'] = $user->getEmail();
        $_SESSION['user']['senha'] = $user->getSenha();
        $_SESSION['user']['status'] = $user->getStatus();
        $_SESSION['user']['telefone'] = $user->getTelefone();
        $_SESSION['user']['token'] = $user->getToken();
        $_SESSION['token'] = $user->getToken();
        $_SESSION['idEmpresa'] = $user->getIDEmpresa();
        $config['connect'] = "connected";
    }

    private function verificarStatus($dado)
    {
        global $config;
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = array();
        }
        if ($dado['status'] == 1) {
            $_SESSION['user']['id'] = $dado['id'];
            $_SESSION['user']['nome'] = $dado['nome'];
            $_SESSION['user']['email'] = $dado['email'];
            $_SESSION['user']['status'] = $dado['status'];
            $_SESSION['user']['telefone'] = $dado['telefone'];
            $config['connect'] = "connected";

            //header("Location: ".BASE_URL);
            //$painel = new painelController();
            //$painel->index();
            // $dados = array();
            //     $dados['nome'] = "Administrador: ".$dado['nome'];
            // $this->loadPainel("home", $dados);
            header("Location: " . BASE_URL . "painel");
            exit();
        } else {
            //$result = "Usuario desabilitado ou E-Mail Invalido!";
            //header("Location: ".BASE_URL."login/index/true/");
            $dados = array();
            $dados["habilitado"] = "true";
            $this->loadTemplate("login", $dados);
        }
    }

    private function verificarUsuariosEmail($nome, $email, $senha, $telefone)
    {
        $user = new Usuario();
        $array = $user->selecionarUsuariosEmail($email);
        if (count($array) == 0) {
            $user->setNome($nome);
            $user->setEmail($email);
            $user->setSenha($senha);
            if (is_null($telefone)) {
                $tel = "";
            } else {
                $tel = $telefone;
            }
            $user->setTelefone($tel);
            $dados = $this->cadastrarUser($user);
        } else {
            $dados["confirme"] = "existe";
        }
        return $dados;
    }

    private function cadastrarUser(Usuario $user)
    {
        $dados = array();
        //if ($user->numRows() == 0){
        $array = $user->incluirUsuariosNomeEmailSenha();

        $id = $array['ID'];
        $md5 = md5($id);
        $link = BASE_URL . "cadastrar/confirmarEmail/" . $md5;

        $assunto = "Confirme seu cadastro";
        $msg = "Clique no Link abaixo para confirmar seu cadastro:\n\n" . $link;
        $headers = "From: suporte@b7web.com.br" . "\r\n" . "X-Mailer: PHP/" . phpversion();


        $dados["confirme"] = "sucess";
        $dados["link"] = $link;
        //} else {
        //    $dados["confirme"] = "existe";
        //}
        return $dados;
    }

    private function cadastrarToken($email, $id, $token, $expirado_em, $link)
    {
        $userToken = new UsuariosToken();
        $userToken->setIDUsuario($id);
        $userToken->setHash($token);
        $userToken->setExpiradoEm($expirado_em);
        $userToken->incluirUsuariosToken();

        //$link = BASE_URL."login/redefinir/".$token;

        $mensagem = "Clique no link para redefinir sua senha:<br/>";
        $mensagem = $mensagem . "<a href='" . $link . "'>link</a>";

        $assunto = "Redefinição de senha";

        $headers = 'From: seuemail@seusite.com.br' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        //mail($email, $assunto, $mensagem, $headers);

        echo ("<h2>OK! Redefinição de Senha!</h2>");
        echo ("<br>");
        echo ($assunto);
        echo ("<br>");
        echo ("<h2>E-Mail: " . $email . "</h2>");
        echo ("<a href=" . $link . ">Clique aqui para redefinir senha</a>");

        echo $mensagem;

        return TRUE;
    }

    //put your code here
    public function index($filtro = null)
    {
        $dados = array();
        if (!(is_null($filtro))) {
            $dados = $filtro;
        }
        $this->loadTemplate("login", $dados);
    }

    public function esqueciSenha($error = "")
    {
        $dados = array();
        $dados["error"] = $error;
        $dados['mensagem'] = $error;

        $this->loadTemplate("esqueciSenha", $dados);
    }

    public function cadastrar($confirme = "")
    {
        $dados = array();
        $dados['confirme'] = $confirme;

        $this->loadTemplate("painel/cadastrar", $dados);
    }

    public function recuperar($token = "", $mensagem = "")
    {
        $userToken = new UsuariosToken();
        $userToken->selecionarToken($token);
        $dados = array();
        if ($userToken->numRows() > 0) {
            $link = BASE_URL . "login/addSenha/" . $token;
            $dados['token'] = $token;
            $dados['link'] = $link;
            $dados['mensagem'] = $mensagem;
        } else {
            $link = BASE_URL . "login/addSenha/" . $token;
            $dados['token'] = $token;
            $dados['link'] = $link;
            //$mensagem = "Token invalido ou usado!";
            $dados['mensagem'] = $mensagem;
        }

        $this->loadTemplate("painel/recuperar", $dados);
    }

    public function confirmarEmail($token, $confirme = "")
    {
        $dados = array();
        $dados["token"] = $token;
        $dados["confirme"] = $confirme;

        $this->loadTemplate("painel/confirmarEmail", $dados);
    }

    public function logar()
    {
        $user = new Usuario();
        if (isset($_POST['email']) && empty($_POST['email']) == false) {
            $email = addslashes($_POST['email']);
            $senha = md5(addslashes($_POST['senha']));
            //$user->setEmail($email);
            //$user->setSenha($senha);
            //$user->selecionarEmailSenha();
            if ($user->validateLogin($email, $senha)) {
                //echo ("<br>Validar---Passou");
                if ($user->getToken() == $user->getID()) {
                    $dados = array();
                    $dados['habilitado'] = "true";
                    $this->loadView("login", $dados);
                } else {
                    $this->atualizarSession($user);
                    header("Location: " . BASE_URL . "painel/");
                    // $painel = new painelController();
                    // $painel->index();
                }
            } else {
                //$result = "E-mail ou Senha Invalido!";
                //header("Location: ".BASE_URL."login/index/true/");
                $dados = array();
                $dados["validateLogin"] = "true";
                $this->loadTemplate("login", $dados);
            }
            //if ($user->numRows() > 0){
            //    $dados = $user->result();
            //    foreach ($dados as $dduser) {
            //        $this->verificarStatus($dduser);
            //    }
            //    
            //} else {
            //    //$result = "E-mail ou Senha Invalido!";
            //    //header("Location: ".BASE_URL."login/index/true/");
            //    $dados = array ();
            //        $dados["error"] = "true";
            //    $this->loadTemplate("login", $dados);
            //}
        } else {
            $dados = array();
            $dados["error"] = "true";
            $this->loadTemplate("login", $dados);
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['token']);
        // $home = new homeController();
        // $home->index();
        header("Location: " . BASE_URL);
        exit();
    }

    public function addUser()
    {
        $dados = array();
        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $telefone = addslashes($_POST['telefone']);

            if (!empty($nome) && !empty($email) && !empty($senha)) {
                $dados = $this->verificarUsuariosEmail($nome, $email, $senha, $telefone);
            } else {
                $dados["confirme"] = "error";
            }
        } else {
            $dados["confirme"] = "error";
        }
        $this->loadTemplate("painel/cadastrar", $dados);
    }

    public function addEsqueciSenha()
    {
        if (!empty($_POST['email'])) {

            $email = $_POST['email'];

            $user = new Usuario();
            //$user->setEmail($email);
            $user->selecionarUsuariosEmail($email);
            $token = md5(time() . rand(0, 99999) . rand(0, 99999));
            $link = BASE_URL . "login/recuperar/" . $token;

            if ($user->numRows() > 0) {
                $id = $user->getID();
                //$result = $user->result();
                //$id = $result['id'];
                //$token = md5(time().rand(0, 99999).rand(0, 99999));
                $expirado_em = date('Y-m-d H:i', strtotime('+2 months'));

                $this->cadastrarToken($email, $id, $token, $expirado_em, $link);

                //$userToken = new UsuariosToken();
                //$userToken->setIDUsuario($id);
                //$userToken->setHash($token);
                //$userToken->setExpiradoEm($expirado_em);
                //$userToken->incluirUsuariosToken();

                //$link = BASE_URL."login/redefinir/".$token;

                //$mensagem = "Clique no link para redefinir sua senha:<br/>";
                //$mensagem = $mensagem . "<a href='".$link."'>link</a>";

                //$assunto = "Redefinição de senha";

                //$headers = 'From: seuemail@seusite.com.br'."\r\n" .
                //              'X-Mailer: PHP/'.phpversion();

                //mail($email, $assunto, $mensagem, $headers);

                //echo ("<h2>OK! Redefinição de Senha!</h2>");
                //echo ("<br>");
                //echo ($assunto);
                //echo ("<br>");
                //echo ("<h2>E-Mail: ".$email."</h2>");
                //echo ("<a href=".$link.">Clique aqui para redefinir senha</a>");

                //echo $mensagem;

                //$dados = array();
                //    $dados["redefinir"] = "true";
                //    $dados["link"] = $link;
                //    $dados["token"] = $token;
                //);

                //header("Location: ".BASE_URL."login/redefinir/".$token);
                //header("Location: ../index.php?pag=esqueciSenha&sucess=true&link=".$link);
                //exit();
                $error = "E-Mail enviado com sucesso!";
                $this->esqueciSenha($error);
            } else {
                //$dados = array();
                //    $dados["error"] = "true";
                //    $dados["token"] = $token;
                //    $dados["link"] = $link;
                //);
                //$this->loadTemplate("esqueciSenha", $dados);
                //header("Location: ".BASE_URL."login/esqueciSenha/error/");
                $error = "Nao foi possivel localizar o Email.";
                $this->esqueciSenha($error);
            }
        }
    }

    public function sisEsqueciSenha()
    {
        if (!empty($_POST['email'])) {

            $email = $_POST['email'];

            $user = new usuario();
            $user->setEmail($email);
            $user->selecionarEmail();
            $token = md5(time() . rand(0, 99999) . rand(0, 99999));
            $link = BASE_URL . "login/redefinir/" . $token;
            if ($user->numRows() > 0) {

                // $result = $user->result();
                // $id = $result['id'];
                $id = $user->getID();
                //$token = md5(time().rand(0, 99999).rand(0, 99999));
                $expirado_em = date('Y-m-d H:i', strtotime('+2 months'));

                $userToken = new usuarios_token();
                $userToken->setIDUsuario($id);
                $userToken->setHash($token);
                $userToken->setExpiradoEm($expirado_em);
                $userToken->incluirUsuariosToken();
                //$link = BASE_URL."login/redefinir/".$token;

                $mensagem = "Clique no link para redefinir sua senha:<br/>";
                $mensagem = $mensagem . "<a href='" . $link . "'>link</a>";

                $assunto = "Redefinição de senha";

                $headers = 'From: seuemail@seusite.com.br' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                //mail($email, $assunto, $mensagem, $headers);

                echo ("<h2>OK! Redefinição de Senha!</h2>");
                echo ("<br>");
                echo ($assunto);
                echo ("<br>");
                echo ("<h2>E-Mail: " . $email . "</h2>");
                echo ("<a href=" . $link . ">Clique aqui para redefinir senha</a>");

                echo $mensagem;

                $dados = array();
                $dados["redefinir"] = "true";
                $dados["link"] = $link;
                $dados["token"] = $token;

                //print_r($dados);
                //$this->loadTemplate("redefinir", $dados);
                header("Location: " . BASE_URL . "login/redefinir/" . $token);
                //header("Location: ../index.php?pag=esqueciSenha&sucess=true&link=".$link);
                //exit();
            } else {
                $dados = array();
                $dados["error"] = "true";
                $dados["token"] = $token;
                $dados["link"] = $link;

                //$this->loadTemplate("esqueciSenha", $dados);
                header("Location: " . BASE_URL . "login/esqueciSenha/error/");
            }
        }
    }

    public function addSenha($token = "")
    {
        //$token = $_GET['token'];
        $userToken = new UsuariosToken();
        //$userToken->setHash($token);
        $userToken->selecionarToken($token);
        if ($userToken->numRows() > 0) {
            $id = $userToken->getIDUsuario();
            //$result = $userToken->result();
            //$id = $result['id_usuario'];
            if (!empty($_POST['senha'])) {
                $senha = $_POST['senha'];

                $user = new Usuario();
                //$user->setSenha($senha);
                //$user->setID($id);
                $user->atualizarSenha($id, $senha);
                //$userToken->setHash($token);
                //$userToken->setUsado(1);
                $userToken->atualizarUsado($token, 1);
                //echo "Senha alterada com sucesso!";
                //header("Location: ../index.php?pag=redefinir&sucess=true");

                //$link = BASE_URL."login/redefinir/".$token;
                //$dados = array(
                //    "sucess" => "true",
                //    "link" => $link,
                //    "token" => $token
                //);
                //$this->loadTemplate("painel/redefinir", $dados);
                $mensagem = "Senha alterada com sucesso!";
                $this->recuperar($token, $mensagem);
                //exit();
            } else {
                //echo "Informe uma senha valida!";
                //header("Location: ../index.php?pag=redefinir&senha=true&token=".$token);

                //$link = BASE_URL."login/redefinir/".$token;
                //$dados = array(
                //    "senha" => "true",
                //    "token" => $token,
                //    "link" => $link
                //);
                //$this->loadTemplate("painel/redefinir", $dados);
                $mensagem = "Informe uma Senha valida!";
                $this->recuperar($token, $mensagem);
                //exit();
            }
        } else {
            //echo "Token inválido ou usado!";
            //header("Location: ../index.php?pag=redefinir&error=true&token=".$token);

            //$link = BASE_URL."login/redefinir/".$token;
            //$dados = array(
            //    "error" => "true",
            //    "token" => $token,
            //    "link" => $link
            //);
            //$this->loadTemplate("painel/redefinir", $dados);
            $mensagem = "Token invalido ou usado!";
            $this->recuperar($token, $mensagem);
            //exit();
        }
    }

    public function redefinir($token = "")
    {
        if (!empty($_POST['senha'])) {
            //$token = $_GET['token'];

            $userToken = new usuarios_token();
            $userToken->setHash($token);
            $userToken->selecionarToken();

            if ($userToken->numRows() > 0) {
                // $result = $userToken->result();
                // $id = $result['id_usuario'];
                $id = $userToken->getIDUsuario();

                if (!empty($_POST['senha'])) {
                    $senha = $_POST['senha'];

                    $user = new usuario();
                    $user->setSenha($senha);
                    $user->setID($id);
                    $user->atualizarSenha();

                    $userToken->setHash($token);
                    $userToken->setUsado(1);
                    $userToken->atualizarUsado();

                    //echo "Senha alterada com sucesso!";
                    //header("Location: ../index.php?pag=redefinir&sucess=true");
                    $link = BASE_URL . "login/redefinir/" . $token;
                    $dados = array();
                    $dados["sucess"] = "true";
                    $dados["link"] = $link;
                    $dados["token"] = $token;
                    //);
                    $this->loadTemplate("redefinir", $dados);
                    //exit();
                } else {
                    //echo "Informe uma senha valida!";
                    //header("Location: ../index.php?pag=redefinir&senha=true&token=".$token);
                    $link = BASE_URL . "login/redefinir/" . $token;
                    $dados = array();
                    $dados["senha"] = "true";
                    $dados["token"] = $token;
                    $dados["link"] = $link;
                    //);
                    $this->loadTemplate("redefinir", $dados);
                    //exit();
                }
            } else {
                //echo "Token inválido ou usado!";
                //header("Location: ../index.php?pag=redefinir&error=true&token=".$token);
                $link = BASE_URL . "login/redefinir/" . $token;
                $dados = array();
                $dados["error"] = "true";
                $dados["token"] = $token;
                $dados["link"] = $link;
                //);
                $this->loadTemplate("redefinir", $dados);
                //exit();
            }
        } else {
            //echo "Informe uma senha valida!";
            //header("Location: ../index.php?pag=redefinir&senha=true&token=".$token);
            $link = BASE_URL . "login/redefinir/" . $token;
            $dados = array();
            $dados["redefinir"] = "true";
            $dados["token"] = $token;
            $dados["link"] = $link;
            //);
            $this->loadTemplate("redefinir", $dados);
            //exit();
        }
    }
}
