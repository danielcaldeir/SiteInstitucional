<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cadastrarController
 *
 * @author Daniel_Caldeira
 */
class usuarioController extends controller{
    private $user;
    private $arrayInfo;
    
    public function __construct() {
        $this->user = new Usuario();
        $this->arrayInfo = array();
        
        if (!empty($_SESSION['token'])){
            //print_r($_SESSION['token']);
            if (!$this->user->isLogado($_SESSION['token'])){
                //adminLTEController::logout();
                loginController::logout();
                exit();
            }
            //$this->permissao->getPermissaoIDGrupo($this->user->getIDGrupo());
            
            if (!$this->user->validarPermissao('view_usuario')){
                $filtro = array('permission'=>1);
                //loginController::login($filtro);
                $login = new loginController();
                $login->index($filtro);
                exit();
            }
        } else {
            //$admin = new adminLTEController();
            $login = new loginController();
            $login->index();
            exit();
        }
        
        $this->arrayInfo["menuActive"] = "usuario";
        $this->arrayInfo["user"] = $this->user;
        $empresa = new Empresa();
        $empresa->selecionarEmpresaID(md5($this->user->getIdEmpresa()));
        $this->arrayInfo["empresa"] = $empresa;
        $this->arrayInfo["permissao"] = $this->user->getPermissoes();
        
        //if (isset($_SESSION['user'])){
        //    $this->user['nome'] = $_SESSION['user']['nome'];
        //    $this->user['email'] = $_SESSION['user']['email'];
        //    //$this->user['senha'] =$_SESSION['user']['senha'];
        //    $this->user['telefone'] = $_SESSION['user']['telefone'];
        //}
        //if (count($this->user) == 0){
        //    $login = new loginController();
        //    $login->index();
        //    exit();
        //}
        
        //global $config;
        //$this->config = $config;
        parent::__construct();
    }
	
    //put your code here
    public function index($confirme = ""){
        $user = new Usuario();
        $per = new Permissao();
		// $per = new PermissaoGrupo();
        $IDEmpresa = $this->user->getIdEmpresa();
        
        if (!empty($_GET['pagAtual'])){ $paginaAtual = intval($_GET['pagAtual']); } 
        else { $paginaAtual = 1; }
        
        $limit = 10;
        $offset = ($paginaAtual * $limit) - $limit;
        
        $filtro = array("empresa"=>$IDEmpresa,"permissao"=>NULL, "status"=>NULL, "nome"=>NULL, "email"=>NULL);
        // $filtro = array("permissao"=>NULL, "status"=>NULL, "nome"=>NULL, "email"=>NULL);
        if (!empty($_GET['permissao']))
            { $filtro['permissao'] = $_GET['permissao']; }
        if (!empty($_GET['status']))
            { $filtro['status'] = (intval($_GET['status'])-1); }
        if (!empty($_GET['nome']))
            { $filtro['nome'] = $_GET['nome']; }
        if (!empty($_GET['email']))
            { $filtro['email'] = $_GET['email']; }
        $this->arrayInfo['users'] = $user->getAllUsuarios($filtro, $offset, $limit);
        // $where['id_empresa'] = $IDEmpresa;
        $this->arrayInfo['permissaoGrupo'] = $per->getAllPermissaoGrupo($IDEmpresa);
        $this->arrayInfo['mensagem'] = $confirme;
        
        $TotalItems = count($user->getTotalUser($filtro));
        if (!is_null($filtro['status']))
            { $filtro['status'] = ($filtro['status']+1); }
        $this->arrayInfo['filtro'] = $filtro;
        //echo ("<pre>");
        //echo ("Total Items: ".$TotalItems);
        //echo ("<br>Pagina Atual: ".$paginaAtual);
        //echo ("</pre>");
        $this->arrayInfo['paginaAtual'] = $paginaAtual;
        $this->arrayInfo['numeroPaginas'] = ceil($TotalItems/$limit);
        
        $this->loadPainel("selUsuario", $this->arrayInfo);
    }
    
    public function gerenciaUsuario(){
        // put your code here
        $user = new usuario();
        $array = $user->selecionarALLUser();
        if ($user->numRows() == 1){
            $usuarios = $user->result();
        }
        // $dados = array();
		// $dados["usuarios"] = $usuarios;
        $this->arrayInfo["usuarios"] = $array;
        $this->loadPainel("gerenciaUsuario", $this->arrayInfo);
    }
    
    public function excluirUser($id){
        $dados = array();
        $user = new usuario();
		
		$user->setID($id);
        $dados['id'] = $id;
        $dados['usuario'] = $menu->selecionarUser();
        
        $this->loadPainel("excluirUser", $dados);
    }
	
    public function editAction(){
        // put your code here
        $user = new Usuario();
        $id = addslashes($_POST['id']);
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        // $senha = addslashes($_POST['senha']);
        $telefone = addslashes($_POST['telefone']);
        $status = intval($_POST['status']);
        $permissao = intval($_POST['permissao']);
        
        //$sql = $pdo->atualizarNomeEmailSenha($id, $nome, $email, $senha);
        if (!empty($_POST['id'])){
            //$user->setID($id);
            //$user->setNome($nome);
            //$user->setEmail($email);
            //$user->setSenha($senha);
            //if(is_null($telefone)){ $user->setTelefone(""); } 
            //else { $user->setTelefone($telefone); }
            //$user->setStatus($status);
            //$user->setIDGrupo($permissao);
            
            $user->selecionarEmail($email);
            //$dado = array();
            //    $dado["id"] = $id;
            //    $dado["nome"] = $nome;
            //    $dado["email"] = $email;
            //    $dado["telefone"] = $telefone;
            //);
            if ($user->numRows() > 1){
                //$dados = array();
                //$dados["confirme"] = "existe";
                //$dados["dado"] = $dado;
                //$this->loadPainel("editUsuario", $dados);
                $mensagem = "E-Mail ja existente!";
                $this->edit($id, $mensagem);
            } else {
                $user->selecionarUser($id);
                if (($user->numRows() > 0) && (!empty($_POST['nome']))){
                    $idUser = $user->getID();
                    $user->atualizarNomeEmail($idUser, $nome, $email, $telefone);
                    // $user->atualizarSenha($idUser,$senha);
                    $user->atualizarPermissao($idUser, $permissao);
                    $user->atualizarStatus($id,$status);
                    $mensagem = "O Usuario ".$nome." foi Editado com Sucesso!";
                    $this->edit($id, $mensagem);
                    //$sql = $user->atualizarNomeEmailSenha();
                    //$dados = array();
                    //$dados["confirme"] = "sucess";
                    //$dados["dado"] = $dado;
                    //$this->loadPainel("editUsuario", $dados);
                } else {
                    $mensagem = "Nao foi informado um nome.";
                    $this->edit($id, $mensagem);
                }
            }
        }else {
            $mensagem = "Nao foi vinculado um identificador valido.";
            $this->edit($id, $mensagem);
        }
    }
    
    public function add($confirme = "") {
        //$user = new Usuarios();
        //$per = new PermissaoGrupo();
        $per = new Permissao();
        $IDEmpresa = $this->user->getIDEmpresa();
        
        $this->arrayInfo['permissaoGrupo'] = $per->getAllPermissaoGrupo($IDEmpresa);
        $this->arrayInfo['mensagem'] = $confirme;
        
        $this->loadPainel("addUsuario", $this->arrayInfo);
    }
	
	public function addAction($mensagem = "") {
        $user = new Usuario();
        $IDEmpresa = $this->user->getIdEmpresa();
        
        if (!empty($_POST['nome'])){
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $telefone = addslashes($_POST['telefone']);
            $idGrupo = intval($_POST['permissao']);
            
            $user->selecionarEmail($email);
            if ($user->numRows() == 0){
                $array = $user->incluirNomeEmailSenha($nome, $email, $senha, $telefone, $IDEmpresa);
                foreach ($array as $item) {
                    $id = $item['ID'];
                    $user->atualizarPermissao(md5($id), $idGrupo);
                    $user->selecionarUser(md5($id));
                    $mensagem = "O item ".$user->getNome()." foi incluido com sucesso!!";
                }
            } else { $mensagem = "O Email informado ja encontra-se cadastrado."; }
        } else { $mensagem = "Nao foi Informado um Nome!"; }
        
        $this->index($mensagem);
    }
    
    public function del($id){
        $user = new Usuario();
        
        $user->selecionarUser($id);
        if ($user->numRows() > 0){
            $user->atualizarStatus($id, 0);
            $this->index("Usuario Desabilitado com Sucesso!");
        } else {
            $this->index("Nao foi possivel desabilitar o usuario!");
        }
    }
    
    public function addUser(){
        if (isset($_POST['nome']) && empty($_POST['nome'])==false){
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $telefone = addslashes($_POST['telefone']);

            if (!empty($nome) && !empty($email) && !empty($senha)){
                $user = new usuario();
                $user->setNome($nome);
                $user->setEmail($email);
                $user->setSenha($senha);

                if(is_null($telefone)){
                    $user->setTelefone("");
                } else {
                    $user->setTelefone($telefone);
                }

                $user->selecionarEmail();
                if ($user->numRows() == 0){
                    $array = $user->incluirNomeEmailSenha();

                    //$array = $pdo->incluirNomeEmailSenha($nome, $email, $senha);
                    //print_r($pdo->result());
                    //echo ("<br>");
                    //print_r($array);

                    $id = $array['ID'];
                    $md5 = md5($id);
                    $link = BASE_URL."cadastrar/confirmarEmail/".$md5;

                    $assunto = "Confirme seu cadastro";
                    $msg = "Clique no Link abaixo para confirmar seu cadastro:\n\n".$link;
                    $headers = "From: suporte@b7web.com.br"."\r\n"."X-Mailer: PHP/".phpversion();

                    //mail($email, $assunto, $msg, $headers);

                    //echo ("<h2>OK! Confirme seu cadastro agora!</h2>");
                    //echo ("<br>");
                    //echo ($assunto);
                    //echo ("<br>");
                    //echo ("<h2>Nome: ".$nome."</h2>");
                    //echo ("<br>");
                    //echo ("<h2>E-Mail: ".$email."</h2>");
                    //echo ("<a href=".$link.">Clique aqui para confirmar</a>");

                    //header("Location: ../index.php?pag=cadastrar&sucess=true&link=".$link);
                    $dados = array();
                    $dados["confirme"] = "sucess";
                    $dados["link"] = $link;
                    
                    $this->loadPainel("addUsuario", $dados);
                    //exit();
                } else {
                    //header("Location: ../index.php?pag=cadastrar&existe=true");
                    $dados = array();
                    $dados["confirme"] = "existe";
                    
                    $this->loadPainel("addUsuario", $dados);
                }

            } else {
                //header("Location: ../index.php?pag=cadastrar&error=true");
                $dados = array();
                $dados["confirme"] = "error";
                
                $this->loadPainel("addUsuario", $dados);
            }
        } else{
            //header("Location: ../index.php?pag=cadastrar&error=true");
            $dados = array();
            $dados["confirme"] = "error";
            
            $this->loadPainel("addUsuario", $dados);
        }
    }
    
    public function confirmarEmail($token, $confirme = ""){
        $dados = array();
        $dados["token"] = $token;
        $dados["confirme"] = $confirme;
        
        $this->loadPainel("confirmarEmail", $dados);
    }
    
    public function edit($id, $confirme = ""){
        $user = new Usuario();
        $per = new Permissao();
		$IDEmpresa = $this->user->getIDEmpresa();
        
        if (!empty($id)){
            $user->setID($id);
            $user->selecionarUser($id);
            if ($user->numRows() > 0) {
                $this->arrayInfo['selectedUser'] = $user->result();
                $this->arrayInfo['permissaoGrupo'] = $per->getAllPermissaoGrupo($IDEmpresa);
                $this->arrayInfo['id'] = $user->getID();
                $this->arrayInfo['mensagem'] = $confirme;
                //$userSelected = $user->result();
                //$dados = array();
                //$dados["dado"] = $dado;
                //$dados["confirme"] = $confirme;
            }else{
                //header("Location: gerenciaUsuario.php");
                //$dados = array();
                //$dados["dado"] = "";
                //$dados["confirme"] = $confirme;
                $mensagem = "Nao foi possivel encontrar nenhum Item";
                $this->index($mensagem);
                exit();
            }
        } else {
            $mensagem = "Para poder Editar e necessario um ID vinculado";
            $this->index($mensagem);
            exit();
        }
        
        $this->loadPainel("editUsuario", $this->arrayInfo);
    }
    
    public function habilitar($id){
        $user = new Usuario();
        
        $user->selecionarUser($id);
        if ($user->getStatus() == 0){
            $idUser = $user->getID();
            // $user->confirmarEmail(md5($idUser));
			$user->atualizarStatus(md5($idUser), 1);
            $this->index("Usuario Habilitado com Sucesso!");
        } else {
            $this->index("Nao foi possivel Habilitar o usuario!");
        }
    }
    
    public function sisConfirmarEmail(){
        $h = $_POST['h'];
        if (!empty($h)){
            //$pdo = new conexao();
            $user = new usuario();
            $user->setID($h);

            //$pdo->confirmarEmail($h);
            $count = $user->confirmarEmail($h);

            if ($count){
                //echo ("<h2>Cadastro Confirmado com sucesso!</h2>");
                //echo ("<a href=sisAcesso.php> Voltar!! </a>");
                //header("Location: ../index.php?pag=confirmarEmail&sucess=true");
                $dados = array(
                    "confirme" => "sucess"
                );
                $this->loadPainel("confirmarEmail", $dados);
                //exit();
            } else {
                //echo ("<h2>Cadastro Nao Confirmado ou utilizado!</h2>");
                //echo ("<a href=sisAcesso.php> Voltar!! </a>");
                //header("Location: ../index.php?pag=confirmarEmail&error=true");
                $dados = array(
                    "confirme" => "error"
                );
                $this->loadPainel("confirmarEmail", $dados);
                //exit();
            }
        } else {
            //header("Location: ../index.php?pag=cadastrar&error=true");
            $dados = array(
                "confirme" => "error"
            );
            $this->loadPainel("addUsuario", $dados);
            //exit();
        }
    }
}
