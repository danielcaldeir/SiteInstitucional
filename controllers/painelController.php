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
class painelController extends controller{
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
            
            //if (!$this->user->validarPermissao('home')){
            //    $filtro = array('permission'=>1);
            //    loginController::login($filtro);
            //    exit();
            //}
        } else {
            //$admin = new adminLTEController();
            $login = new loginController();
            $login->index();
            exit();
        }
        
        $this->arrayInfo["menuActive"] = "home";
        $this->arrayInfo["user"] = $this->user;
        
        //$this->user = array();
        //if (isset($_SESSION['user'])){
        //    $this->user['id'] = $_SESSION['user']['id'];
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
        
    }
    
    //put your code here
    public function index() {
        //$paginas = new Paginas();
        $menu = new Menu("menu");
        //$user = new Usuario();
        
        //$dados = array();
        //$dados['nome'] = "Administrador: ".$this->user->getNome();
        //$dados['menus'] = $menu->selecionarALLMenu();
        //$dados['paginas'] = $paginas->selecionarALLPaginas();
        $this->arrayInfo['nome'] = "Administrador: ".$this->user->getNome();
        $this->arrayInfo['menus'] = $menu->selecionarALLMenu();
        
        
        $this->loadPainel("home", $this->arrayInfo);
    }
    
    //public function menus($confirme = "") {
    //    $menus = new Menu("menu");
    //    
    //    $dados = array();
    //    $dados['nome'] = "Administrador: ".$this->user['nome'];
    //    $dados['menus'] = $menus->selecionarALLMenu();
    //    $dados['excluir'] = $confirme;
    //    
    //    $this->loadPainel("selMenus", $dados);
    //}
    
    //public function pagina($url = null) {
    //    //$paginas = new Paginas();
    //    $pag = new Paginas();
    //    $dados = array();
    //    if (is_null($url)){
    //        $dados['nome'] = "Administrador: ".$this->user['nome'];
    //        //$dados['paginas'] = $paginas->selecionarALLPaginas();
    //        $dados['paginas'] = $pag->selecionarALLPaginas();
    //        $this->loadPainel("selPaginas", $dados);
    //    } else {
    //        $pag->selecionarPaginasURL($url);
    //        $dados['nome'] = "Administrador: ".$this->user['nome'];
    //        $id = $pag->getID();
    //        $dados["id"] = $id;
    //        $dados['confirme'] = "";
    //        $dados['pagina'] = $pag->selecionarPaginasID($id);
    //        $this->loadPainel("editPagina", $dados);
    //    }
    //}
    
    //public function portfolio() {
    //    //$dados = array ();
    //    $portfolio = new Portfolio();
    //    
    //    //$dados['portfolio'] = $portfolio->getTrabalhos();
    //    //$dados['nome'] = "Administrador: ".$this->user->getNome();
    //    
    //    $this->arrayInfo['portfolio'] = $portfolio->getTrabalhos();
    //    $this->arrayInfo['nome'] = "Administrador: ".$this->user->getNome();
    //    
    //    $this->loadPainel("selPortfolio", $this->arrayInfo);
    //}
    
    //public function sobre() {
    //    $dados = array ();
    //    $this->loadPainel("selSobre", $dados);
    //}
    
    public function formulario($titulo = null, $confirme = null) {
        $dados = array();
        $formulario = new Formulario();
        $dados['nome'] = "Administrador: ".$this->user->getNome();
        $dados['formulario'] = $formulario->selecionarFormularioTitulo($titulo);
        $dados['titulo'] = $titulo;
        $dados['confirme'] = $confirme;
        
        $this->loadPainel("selFormulario", $dados);
    }
    
    //public function addMenu($confirme = ""){
    //    $dados = array();
    //    $dados['confirme'] = $confirme;
    //    $this->loadPainel("addMenu", $dados);
    //}
    
    //public function editMenu($id, $confirme = ""){
    //    $dados = array();
    //    $menu = new Menu("menu");
    //    $dados['confirme'] = $confirme;
    //    $dados['id'] = $id;
    //    $dados['menu'] = $menu->selecionarMenuID($id);
    //    
    //    $this->loadPainel("editMenu", $dados);
    //}
    
    //public function excluirMenu($id){
    //    $dados = array();
    //    $menu = new Menu("menu");
    //    $dados['id'] = $id;
    //    $dados['menu'] = $menu->selecionarMenuID($id);
    //    
    //    $this->loadPainel("excluirMenu", $dados);
    //}
    
    //public function sisAddMenu() {
    //    $menu = new Menu("menu");
    //    $nome = addslashes($_POST['nome']);
    //    $url = addslashes($_POST['url']);
    //    $tipo = addslashes($_POST['tipo']);
    //    
    //    if (!empty($nome) && !empty($url)){
    //        $menu->incluirMenu($nome, $url, $tipo);
    //        //$confirme = "success";
    //        header("Location: ".BASE_URL."painel/addMenu/success");
    //    } else {
    //        header("Location: ".BASE_URL."painel/addMenu/error");
    //        //$confirme = "error";
    //    }
    //    
    //    //$this->addMenu($confirme);
    //}
    
    //public function sisEditarMenu(){
    //    if (isset($_POST['id']) && !empty($_POST['id'])){
    //        $id = addslashes($_POST['id']);
    //        $nome = utf8_decode(addslashes($_POST['nome']) );
    //        $url = addslashes($_POST['url']);
    //        $tipo = addslashes($_POST['tipo']);
    //        
    //        if (!empty($nome) && !empty($url) ){
    //            $menu = new Menu("menu");
    //            $menu->atualizarMenuNomeURL($id, $nome, $url, $tipo);
    //            
    //            header("Location: ".BASE_URL."painel/editMenu/".$id."/sucess");
    //        } else {
    //            //header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
    //            header("Location: ".BASE_URL."painel/editMenu/".$id."/error");
    //        }
    //    } else{
    //        //header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
    //        header("Location: ".BASE_URL."painel/editMenu/".$id."/error");
    //    }
    //}
    
    //public function sisExcluirMenu() {
    //    $menu = new Menu("menu");
    //    if (count($_POST) > 0){
    //        $id = $_POST['id'];
    //    } else {
    //        $id = $_GET['id'];
    //    }
    //    $menu->selecionarMenuID($id);
    //    if ($menu->numRows() > 0){
    //        $menu->deletarMenuID($id);
    //        //$confirme = "success";
    //        header("Location: ".BASE_URL."painel/menus/success");
    //    } else {
    //        //$confirme = "error";
    //        header("Location: ".BASE_URL."painel/menus/error");
    //    }
    //    //$this->menus($confirme);
    //}
    
    //public function addPagina($confirme = ""){
    //    $dados = array();
    //    $dados['confirme'] = $confirme;
    //    $this->loadPainel("addPagina", $dados);
    //}
    
    //public function editPagina($id, $confirme = ""){
    //    $dados = array();
    //    $pagina = new Paginas();
    //    $dados['confirme'] = $confirme;
    //    $dados['id'] = $id;
    //    $dados['pagina'] = $pagina->selecionarPaginasID($id);
    //    
    //    $this->loadPainel("editPagina", $dados);
    //}
    
    //public function excluirPagina($id){
    //    $dados = array();
    //    $pagina = new Paginas();
    //    $dados['id'] = $id;
    //    $dados['pagina'] = $pagina->selecionarPaginasID($id);
    //    
    //    $this->loadPainel("excluirPagina", $dados);
    //}
    
    //public function sisAddPagina() {
    //    $pagina = new Paginas();
    //    $url = addslashes($_POST['url']);
    //    $titulo = addslashes($_POST['titulo']);
    //    $corpo = addslashes($_POST['corpo']);
    //    
    //    if (!empty($url) && !empty($titulo)){
    //        $pagina->incluirPaginaURLTituloCorpo($url, $titulo, $corpo);
    //        //$confirme = "success";
    //        header("Location: ".BASE_URL."painel/addPagina/success");
    //    } else {
    //        header("Location: ".BASE_URL."painel/addPagina/error");
    //        //$confirme = "error";
    //    }
    //    
    //    //$this->addMenu($confirme);
    //}
    
    //public function sisEditarPagina(){
    //    if (isset($_POST['id']) && !empty($_POST['id'])){
    //        $id = addslashes($_POST['id']);
    //        $url = addslashes($_POST['url']);
    //        $titulo = utf8_decode(addslashes($_POST['titulo']) );
    //        $corpo = addslashes($_POST['corpo']);
    //        
    //        if (!empty($titulo) && !empty($url) ){
    //            $pagina = new Paginas();
    //            $pagina->atualizarPaginaURLTituloCorpo($id, $url, $titulo, $corpo);
    //            
    //            header("Location: ".BASE_URL."painel/editPagina/".$id."/sucess");
    //        } else {
    //            //header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
    //            header("Location: ".BASE_URL."painel/editPagina/".$id."/error");
    //        }
    //    } else{
    //        //header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
    //        header("Location: ".BASE_URL."painel/editPagina/".$id."/error");
    //    }
    //}
    
    //public function sisExcluirPagina() {
    //    $pagina = new Paginas();
    //    if (count($_POST) > 0){
    //        $id = $_POST['id'];
    //    } else {
    //        $id = $_GET['id'];
    //    }
    //    $pagina->selecionarPaginasID($id);
    //    if ($pagina->numRows() > 0){
    //        $pagina->deletarPaginaID($id);
    //        //$confirme = "success";
    //        header("Location: ".BASE_URL."painel/paginas/success");
    //    } else {
    //        //$confirme = "error";
    //        header("Location: ".BASE_URL."painel/paginas/error");
    //    }
    //    //$this->menus($confirme);
    //}
    
    //public function addPortfolio($confirme = ""){
    //    if (isset($_FILES['fotos'])) {
    //        $fotos = $_FILES['fotos'];
    //    } else {
    //        $fotos = array();
    //    }
    //    print_r($fotos);
    //    //exit();
    //    
    //    $fotoCTRL = new fotoController();
    //    $fotoCTRL->addPortfolio($fotos);
    //    
    //    $dados = array();
    //    $dados['sucess'] = TRUE;
    //    $this->loadPainel("addPortfolio", $dados);
    //}
    
    //public function delPortfolio($id){
    //    $portfolio = new Portfolio;
    //    $fotoCTRL = new fotoController();
    //    $dados = array();
    //    $portfolio->getPortfolioID($id);
    //    $dados['id'] = $portfolio->getID();
    //    $dados['imagem'] = $portfolio->getImagem();
    //    $destino = (".\\imagem\\portfolio\\");
    //    if (file_exists($destino.$portfolio->getImagem())){
    //        $destinoFinal = $destino.$portfolio->getImagem();
    //        print ('Verdadeiro');
    //        print ('<br/>');
    //        $fotoCTRL->delPortfolio($portfolio->getImagem(), $destinoFinal);
    //    } else{
    //        print ($portfolio->getImagem());
    //        print ('<br/>');
    //        print ('Falso');
    //    }
    //    //$dados['portfolio'] = $portfolio->deletarPortfolio($id);
    //    //exit();
    //    $this->loadPainel("delPortfolio", $dados);
    //}
    
    public function addFormulario($confirme = ""){
        $formulario = new Formulario();
        $titulo = addslashes($_POST['titulo']);
        $label = addslashes($_POST['label']);
        $tipo = addslashes($_POST['tipo']);
        
        if (!empty($titulo) && !empty($label)){
            $formulario->incluirFormularioTituloLabelTipo($titulo, $label, $tipo);
            //$confirme = "success";
            header("Location: ".BASE_URL."painel/formulario/".$titulo."/success");
        } else {
            header("Location: ".BASE_URL."painel/formulario/error");
            //$confirme = "error";
        }
        
        //$this->addMenu($confirme);
    }
    
    public function delFormulario($id = ""){
        $formulario = new Formulario();
        //$titulo = addslashes($_POST['titulo']);
        //$label = addslashes($_POST['label']);
        //$tipo = addslashes($_POST['tipo']);
        
        if (!empty($id) ){
            $formulario->selecionarFormularioID($id);
            $titulo = $formulario->getTitulo();
            $formulario->deletarFormularioID($id);
            //$confirme = "success";
            header("Location: ".BASE_URL."painel/formulario/".$titulo."/success");
        } else {
            header("Location: ".BASE_URL."painel/formulario/error");
            //$confirme = "error";
        }
        
        //$this->addMenu($confirme);
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
