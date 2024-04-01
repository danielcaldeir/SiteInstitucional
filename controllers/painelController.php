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
class painelController extends Controller
{
    private $user;
    private $arrayInfo;

    public function __construct()
    {
        $this->user = new Usuario();
        $this->arrayInfo = array();

        if (!empty($_SESSION['token'])) {
            //print_r($_SESSION['token']);
            if (!$this->user->isLogado($_SESSION['token'])) {
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
        $empresa = new Empresa();
        $empresa->selecionarEmpresaID(md5($this->user->getIdEmpresa()));
        $this->arrayInfo["empresa"] = $empresa;
        $this->arrayInfo["permissao"] = $this->user->getPermissoes();

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
        //global $config;
        //$this->config = $config;
        parent::__construct();
    }

    //put your code here
    public function index()
    {
        //$paginas = new Paginas();
        $menu = new Menu("menu");
        //$user = new Usuario();

        //$dados = array();
        //$dados['nome'] = "Administrador: ".$this->user->getNome();
        //$dados['menus'] = $menu->selecionarALLMenu();
        //$dados['paginas'] = $paginas->selecionarALLPaginas();
        $this->arrayInfo['nome'] = "Administrador: " . $this->user->getNome();
        $this->arrayInfo['menus'] = $menu->selecionarALLMenu();

        $this->loadPainel("home", $this->arrayInfo);
    }

    //public function sobre() {
    //    $dados = array ();
    //    $this->loadPainel("selSobre", $dados);
    //}

    public function formulario($titulo = null, $confirme = null)
    {
        $dados = array();
        $formulario = new Formulario();
        $dados['nome'] = "Administrador: " . $this->user->getNome();
        $dados['formulario'] = $formulario->selecionarFormularioTitulo($titulo);
        $dados['titulo'] = $titulo;
        $dados['confirme'] = $confirme;

        $this->loadPainel("selFormulario", $dados);
    }

    public function addFormulario($confirme = "")
    {
        $formulario = new Formulario();
        $titulo = addslashes($_POST['titulo']);
        $label = addslashes($_POST['label']);
        $tipo = addslashes($_POST['tipo']);

        if (!empty($titulo) && !empty($label)) {
            $formulario->incluirFormularioTituloLabelTipo($titulo, $label, $tipo);
            //$confirme = "success";
            header("Location: " . BASE_URL . "painel/formulario/" . $titulo . "/success");
        } else {
            header("Location: " . BASE_URL . "painel/formulario/error");
            //$confirme = "error";
        }

        //$this->addMenu($confirme);
    }

    public function delFormulario($id = "")
    {
        $formulario = new Formulario();
        //$titulo = addslashes($_POST['titulo']);
        //$label = addslashes($_POST['label']);
        //$tipo = addslashes($_POST['tipo']);

        if (!empty($id)) {
            $formulario->selecionarFormularioID($id);
            $titulo = $formulario->getTitulo();
            $formulario->deletarFormularioID($id);
            //$confirme = "success";
            header("Location: " . BASE_URL . "painel/formulario/" . $titulo . "/success");
        } else {
            header("Location: " . BASE_URL . "painel/formulario/error");
            //$confirme = "error";
        }

        //$this->addMenu($confirme);
    }

    public function sisEditPropriedade()
    {
        $config = new Config();
        $IDEmpresa = $this->user->getIDEmpresa();
        if (isset($_POST['site_title']) && !empty($_POST['site_title'])) {
            $title = addslashes($_POST['site_title']);
            $config->setConfigPropriedade($IDEmpresa, 'site_title', $title);
            $this->setConfig('site_title', $title);
        }
        if (isset($_POST['site_template']) && !empty($_POST['site_template'])) {
            $template = addslashes($_POST['site_template']);
            $config->setConfigPropriedade($IDEmpresa, 'site_template', $template);
            $this->setConfig('site_template', $template);
        }
        if (isset($_POST['site_welcome']) && !empty($_POST['site_welcome'])) {
            $welcome = addslashes($_POST['site_welcome']);
            $config->setConfigPropriedade($IDEmpresa, 'site_welcome', $welcome);
            $this->setConfig('site_welcome', $welcome);
        }
        if (isset($_POST['site_color']) && !empty($_POST['site_color'])) {
            $color = addslashes($_POST['site_color']);
            $config->setConfigPropriedade($IDEmpresa, 'site_color', $color);
            $this->setConfig('site_color', $color);
        }
        header("Location: " . BASE_URL . "painel");
        exit();
        // $this->index();
    }

    public function sisEditPropriedadeADMIN()
    {
        $config = new Config();
        $IDEmpresa = $this->user->getIDEmpresa();
        $sql = null;
        if (isset($_POST['site_painel_title']) && !empty($_POST['site_painel_title'])) {
            $title = addslashes($_POST['site_painel_title']);
            $sql = $config->setConfigPropriedade($IDEmpresa, 'site_painel_title', $title);
            $this->setConfig('site_painel_title', $title);
        }
        if (isset($_POST['site_painel']) && !empty($_POST['site_painel'])) {
            $template = addslashes($_POST['site_painel']);
            $sql = $config->setConfigPropriedade($IDEmpresa, 'site_painel', $template);
            $this->setConfig('site_painel', $template);
        }
        if (isset($_POST['site_painel_welcome']) && !empty($_POST['site_painel_welcome'])) {
            $welcome = addslashes($_POST['site_painel_welcome']);
            $sql = $config->setConfigPropriedade($IDEmpresa, 'site_painel_welcome', $welcome);
            $this->setConfig('site_painel_welcome', $welcome);
        }
        if (isset($_POST['site_painel_color']) && !empty($_POST['site_painel_color'])) {
            $color = addslashes($_POST['site_painel_color']);
            $sql = $config->setConfigPropriedade($IDEmpresa, 'site_painel_color', $color);
            $this->setConfig('site_painel_color', $color);
        }
        if (isset($_POST['site_painel_avatar']) && !empty($_POST['site_painel_avatar'])) {
            $avatar = addslashes($_POST['site_painel_avatar']);
            $sql = $config->setConfigPropriedade($IDEmpresa, 'site_painel_avatar', $avatar);
            $this->setConfig('site_painel_color', $color);
        }
        //header("Location: ".BASE_URL."painel");
        //echo ("<pre>");
        //echo ("SQL: ");
        //print_r($sql);
        //echo ("<pre>");
        //print_r($this->user);
        //echo ("<pre>");
        //print_r($this->arrayInfo);
        //exit();
        $this->index();
    }
}
