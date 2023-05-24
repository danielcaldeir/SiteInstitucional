<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menuController
 *
 * @author daniel
 */
class menuController extends controller{
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
            
            if (!$this->user->validarPermissao('add_menu')){
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
        
        $this->arrayInfo["menuActive"] = "menu";
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
    public function index($confirme = "") {
        $menus = new Menu("menu");
		$IDEmpresa = $this->user->getIDEmpresa();
        
        //$dados = array();
        //$dados['nome'] = "Administrador: ".$this->user['nome'];
        //$dados['menus'] = $menus->selecionarALLMenu();
        //$dados['excluir'] = $confirme;
        
        if (!empty($_GET['pagAtual'])){ $paginaAtual = intval($_GET['pagAtual']); } 
        else { $paginaAtual = 1; }
        
        $limit = 10;
        $offset = ($paginaAtual * $limit) - $limit;
        
        $arrayMenus = $menus->getALLMenuIDEmpresa($IDEmpresa);
        $TotalItems = count($arrayMenus);
        
        $this->arrayInfo['nome'] = "Administrador: ".$this->user->getNome();
        $this->arrayInfo['menus'] = $arrayMenus;
        $this->arrayInfo['mensagem'] = $confirme;
        
        $this->arrayInfo['paginaAtual'] = $paginaAtual;
        $this->arrayInfo['numeroPaginas'] = ceil($TotalItems/$limit);
        
        $this->loadPainel("selMenus", $this->arrayInfo);
    }
    
    public function addMenu($confirme = ""){
        //$dados = array();
        //$dados['confirme'] = $confirme;
        
        $this->arrayInfo['mensagem'] = $confirme;
        $this->loadPainel("addMenu", $this->arrayInfo);
    }
    
    public function edit($id, $confirme = ""){
        $menu = new Menu("menu");
        
        $this->arrayInfo['mensagem'] = $confirme;
        $this->arrayInfo['id'] = $id;
        $this->arrayInfo['menu'] = $menu->selecionarMenuID($id);
        
        $this->loadPainel("editMenu", $this->arrayInfo);
    }
    
    // public function editMenu($id, $confirme = ""){
    //     $menu = new Menu("menu");
    //     $this->arrayInfo['mensagem'] = $confirme;
    //     $this->arrayInfo['id'] = $id;
    //     $this->arrayInfo['menu'] = $menu->selecionarMenuID($id);
    //     $this->loadPainel("editMenu", $this->arrayInfo);
    // }
    
    public function excluirMenu($id){
        $dados = array();
        $menu = new Menu("menu");
        $dados['id'] = $id;
        $dados['menu'] = $menu->selecionarMenuID($id);
        
        $this->loadPainel("excluirMenu", $dados);
    }
    
    public function addAction() {
        $menu = new Menu("menu");
		$IDEmpresa = $this->user->getIDEmpresa();
        $nome = addslashes($_POST['nome']);
        $url = addslashes($_POST['url']);
        if (isset($_POST['tipo']) && !empty($_POST['tipo']) ){
            $tipo = addslashes($_POST['tipo']);
        } else {
            $tipo = NULL;
        }
        
        if (!empty($nome) && !empty($url)){
            $menu->selecionarMenuURL($url);
            if ($menu->numRows() == 0){
                $menu->incluirMenu($nome, $url, $tipo, $IDEmpresa);
                $confirme = "Registro Incluido com Sucesso.";
                //header("Location: ".BASE_URL."painel/addMenu/success");
                $this->addMenu($confirme);
            } else {
                $menu->incluirMenu($nome, $url, $tipo, $IDEmpresa);
                $confirme = "Ja existe a url solicitada.";
                //header("Location: ".BASE_URL."painel/addMenu/success");
                $this->addMenu($confirme);
            }
        } else {
            //header("Location: ".BASE_URL."painel/addMenu/error");
            $confirme = "Nao foi possivel incluir o registro";
            $this->addMenu($confirme);
        }
    }
    
    // public function addMenuAction() {
    //     $menu = new Menu("menu");
    //     $nome = addslashes($_POST['nome']);
    //     $url = addslashes($_POST['url']);
    //     $tipo = addslashes($_POST['tipo']);
    //     if (!empty($nome) && !empty($url)){
    //         $menu->incluirMenu($nome, $url, $tipo);
    //         $confirme = "success";
    //         $this->addMenu($confirme);
    //     } else {
    //         $confirme = "error";
    //         $this->addMenu($confirme);
    //     }
    // }
    
    public function editAction(){
		$IDEmpresa = $this->user->getIDEmpresa();
        if (isset($_POST['id']) && !empty($_POST['id'])){
            $id = addslashes($_POST['id']);
            $nome = utf8_decode(addslashes($_POST['nome']) );
            $url = addslashes($_POST['url']);
            if (isset($_POST['tipo']) && !empty($_POST['tipo']) ){
                $tipo = addslashes($_POST['tipo']);
            } else {
                $tipo = NULL;
            }
            
            if (!empty($nome) && !empty($url) ){
                $menu = new Menu("menu");
                $menu->atualizarMenuNomeURL($id, $nome, $url, $tipo, $IDEmpresa);
                //header("Location: ".BASE_URL."painel/editMenu/".$id."/sucess");
                $confirme = "Registro Editado com Sucesso";
                $this->editMenu($id, $confirme);
            } else {
                //header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
                //header("Location: ".BASE_URL."painel/editMenu/".$id."/error");
                $confirme = "Nao foi informado um Nome valido";
                $this->editMenu($id, $confirme);
            }
        } else{
            //header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
            //header("Location: ".BASE_URL."painel/editMenu/".$id."/error");
            $confirme = "Nao foi informado um ID valido";
            $this->editMenu($id, $confirme);
        }
    }
    
    public function excluirMenuAction() {
        $menu = new Menu("menu");
        if (count($_POST) > 0){ $id = $_POST['id']; } 
        else { $id = $_GET['id']; }
        
        $menu->selecionarMenuID($id);
        if ($menu->numRows() > 0){
            $menu->deletarMenuID($id);
            
            $confirme = "success";
            //header("Location: ".BASE_URL."painel/menus/success");
            $this->index($confirme);
        } else {
            $confirme = "error";
            //header("Location: ".BASE_URL."painel/menus/error");
            $this->index($confirme);
        }
    }
    
    public function delAction() {
        $menu = new Menu("menu");
        if (count($_POST) > 0){ $id = $_POST['id']; } 
        else { $id = $_GET['id']; }
        
        $menu->selecionarMenuID($id);
        if ($menu->numRows() > 0){
            $idMenu = $menu->getID();
            $menu->deletarMenuID($idMenu);
            
            $confirme = "Registro Deletado com sucesso";
            //header("Location: ".BASE_URL."painel/menus/success");
            $this->index($confirme);
        } else {
            $confirme = "Nao foi Informado um ID valido";
            //header("Location: ".BASE_URL."painel/menus/error");
            $this->index($confirme);
        }
    }
}
