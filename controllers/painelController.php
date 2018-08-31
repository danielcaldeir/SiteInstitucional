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
class painelController extends Controller{
    private $user;
    
    public function __construct() {
        $this->user = array();
        if (isset($_SESSION['user'])){
            $this->user['nome'] = $_SESSION['user']['nome'];
            $this->user['email'] = $_SESSION['user']['email'];
            //$this->user['senha'] =$_SESSION['user']['senha'];
            $this->user['telefone'] = $_SESSION['user']['telefone'];
        }
        if (count($this->user) == 0){
            $login = new loginController();
            $login->index();
            exit();
        }
        //global $config;
        //$this->config = $config;
        //parent::__construct();
    }
    
    //put your code here
    public function index() {
        //$paginas = new Paginas();
        
        $dados = array();
        $dados['nome'] = "Administrador: ".$this->user['nome'];
        //$dados['paginas'] = $paginas->selecionarALLPaginas();
        
        $this->loadPainel("home", $dados);
    }
    
    public function menus($confirme = "") {
        $menus = new Menu("menu");
        
        $dados = array();
        $dados['nome'] = "Administrador: ".$this->user['nome'];
        $dados['menus'] = $menus->selecionarALLMenu();
        $dados['excluir'] = $confirme;
        
        $this->loadPainel("selMenus", $dados);
    }
    
    public function paginas() {
        $paginas = new Paginas();
        
        $dados = array();
        $dados['nome'] = "Administrador: ".$this->user['nome'];
        $dados['paginas'] = $paginas->selecionarALLPaginas();
        $this->loadPainel("selPaginas", $dados);
    }
	
	public function portfolio() {
        $dados = array ();
        
        $portfolio = new Portfolio();
        $dados['portfolio'] = $portfolio->getTrabalhos();
        
        $this->loadPainel("selPortfolio", $dados);
    }
    
	public function sobre() {
        $dados = array ();
        $this->loadPainel("selSobre", $dados);
    }
	
	public function servicos() {
        $dados = array ();
        $this->loadPainel("selServicos", $dados);
    }
	
    public function addMenu($confirme = ""){
        $dados = array();
        $dados['confirme'] = $confirme;
        $this->loadPainel("addMenu", $dados);
    }
    
    public function editMenu($id, $confirme = ""){
        $dados = array();
        $menu = new Menu("menu");
        $dados['confirme'] = $confirme;
        $dados['id'] = $id;
        $dados['menu'] = $menu->selecionarMenuID($id);
        
        $this->loadPainel("editMenu", $dados);
    }
    
    public function excluirMenu($id){
        $dados = array();
        $menu = new Menu("menu");
        $dados['id'] = $id;
        $dados['menu'] = $menu->selecionarMenuID($id);
        
        $this->loadPainel("excluirMenu", $dados);
    }
    
    public function sisAddMenu() {
        $menu = new Menu("menu");
        $nome = addslashes($_POST['nome']);
        $url = addslashes($_POST['url']);
        
        if (!empty($nome) && !empty($url)){
            $menu->incluirMenu($nome, $url);
            //$confirme = "success";
            header("Location: ".BASE_URL."painel/addMenu/success");
        } else {
            header("Location: ".BASE_URL."painel/addMenu/error");
            //$confirme = "error";
        }
        
        //$this->addMenu($confirme);
    }
    
    public function sisEditarMenu(){
        if (isset($_POST['id']) && !empty($_POST['id'])){
            $id = addslashes($_POST['id']);
            $nome = utf8_decode(addslashes($_POST['nome']) );
            $url = addslashes($_POST['url']);
            
            if (!empty($nome) && !empty($url) ){
                $menu = new Menu("menu");
                $menu->atualizarMenuNomeURL($id, $nome, $url);
                
                header("Location: ".BASE_URL."painel/editMenu/".$id."/sucess");
            } else {
                //header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
                header("Location: ".BASE_URL."painel/editMenu/".$id."/error");
            }
        } else{
            //header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
            header("Location: ".BASE_URL."painel/editMenu/".$id."/error");
        }
    }
    
    public function sisExcluirMenu() {
        $menu = new Menu("menu");
        if (count($_POST) > 0){
            $id = $_POST['id'];
        } else {
            $id = $_GET['id'];
        }
        $menu->selecionarMenuID($id);
        if ($menu->numRows() > 0){
            $menu->deletarMenuID($id);
            //$confirme = "success";
            header("Location: ".BASE_URL."painel/menus/success");
        } else {
            //$confirme = "error";
            header("Location: ".BASE_URL."painel/menus/error");
        }
        //$this->menus($confirme);
    }
    
    public function addPagina($confirme = ""){
        $dados = array();
        $dados['confirme'] = $confirme;
        $this->loadPainel("addPagina", $dados);
    }
    
    public function editPagina($id, $confirme = ""){
        $dados = array();
        $pagina = new Paginas();
        $dados['confirme'] = $confirme;
        $dados['id'] = $id;
        $dados['pagina'] = $pagina->selecionarPaginasID($id);
        
        $this->loadPainel("editPagina", $dados);
    }
    
    public function excluirPagina($id){
        $dados = array();
        $pagina = new Paginas();
        $dados['id'] = $id;
        $dados['pagina'] = $pagina->selecionarPaginasID($id);
        
        $this->loadPainel("excluirPagina", $dados);
    }
    
    public function sisAddPagina() {
        $pagina = new Paginas();
        $url = addslashes($_POST['url']);
        $titulo = addslashes($_POST['titulo']);
        $corpo = addslashes($_POST['corpo']);
        
        if (!empty($url) && !empty($titulo)){
            $pagina->incluirPaginaURLTituloCorpo($url, $titulo, $corpo);
            //$confirme = "success";
            header("Location: ".BASE_URL."painel/addPagina/success");
        } else {
            header("Location: ".BASE_URL."painel/addPagina/error");
            //$confirme = "error";
        }
        
        //$this->addMenu($confirme);
    }
    
    public function sisEditarPagina(){
        if (isset($_POST['id']) && !empty($_POST['id'])){
            $id = addslashes($_POST['id']);
            $url = addslashes($_POST['url']);
            $titulo = utf8_decode(addslashes($_POST['titulo']) );
            $corpo = addslashes($_POST['corpo']);
            
            if (!empty($titulo) && !empty($url) ){
                $pagina = new Paginas();
                $pagina->atualizarPaginaURLTituloCorpo($id, $url, $titulo, $corpo);
                
                header("Location: ".BASE_URL."painel/editPagina/".$id."/sucess");
            } else {
                //header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
                header("Location: ".BASE_URL."painel/editPagina/".$id."/error");
            }
        } else{
            //header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
            header("Location: ".BASE_URL."painel/editPagina/".$id."/error");
        }
    }
    
    public function sisExcluirPagina() {
        $pagina = new Paginas();
        if (count($_POST) > 0){
            $id = $_POST['id'];
        } else {
            $id = $_GET['id'];
        }
        $pagina->selecionarPaginasID($id);
        if ($pagina->numRows() > 0){
            $pagina->deletarPaginaID($id);
            //$confirme = "success";
            header("Location: ".BASE_URL."painel/paginas/success");
        } else {
            //$confirme = "error";
            header("Location: ".BASE_URL."painel/paginas/error");
        }
        //$this->menus($confirme);
    }
	
	public function addPortfolio($confirme = ""){
		if (isset($_FILES['fotos'])) {
            $fotos = $_FILES['fotos'];
        } else {
            $fotos = array();
        }
        print_r($fotos);
        //exit();
        
		$fotoCTRL = new fotoController();
        $fotoCTRL->addPortfolio($fotos);
		
		$dados = array();
        $dados['sucess'] = TRUE;
        $this->loadPainel("addPortfolio", $dados);
    }
    
    public function delPortfolio($id){
        $dados = array();
        $portfolio = new Portfolio;
        $dados['id'] = $id;
        $dados['portfolio'] = $portfolio->deletarPortfolio($id);
        
        $this->loadPainel("delPortfolio", $dados);
    }
    
    public function sisEditPropriedade() {
        $config = new Config();
        if (isset($_POST['site_title']) && !empty($_POST['site_title'])){
            $title = addslashes($_POST['site_title']);
            $config->setConfigPropriedade('site_title',$title);
        }
        if (isset($_POST['site_template']) && !empty($_POST['site_template'])){
            $template = addslashes($_POST['site_template']);
            $config->setConfigPropriedade('site_template',$template);
        }
        if (isset($_POST['site_welcome']) && !empty($_POST['site_welcome'])){
            $welcome = addslashes($_POST['site_welcome']);
            $config->setConfigPropriedade('site_welcome',$welcome);
        }
        if (isset($_POST['site_color']) && !empty($_POST['site_color'])){
            $color = addslashes($_POST['site_color']);
            $config->setConfigPropriedade('site_color',$color);
        }
        header("Location: ".BASE_URL."painel");
        exit();
        //$config->setConfigPropriedade('site_template',$template);
        //if ($pagina->numRows() > 0){
        //    $pagina->deletarPaginaID($id);
        //    //$confirme = "success";
        //    header("Location: ".BASE_URL."painel/paginas/success");
        //} else {
        //    //$confirme = "error";
        //    header("Location: ".BASE_URL."painel/paginas/error");
        //}
        //$this->menus($confirme);
    }
}
