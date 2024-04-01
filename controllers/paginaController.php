<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of paginaController
 *
 * @author daniel
 */
class paginaController extends Controller
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

            if (!$this->user->validarPermissao('edit_pagina')) {
                $filtro = array('permission' => 1);
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

        $this->arrayInfo["menuActive"] = "pagina";
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
    public static function pagina($param = null)
    {
        $pag = new Paginas();
        //$IDEmpresa = $this->user->getIDEmpresa();
        $dados = array();
        if (!(is_null($param))) {
            if (is_array($param)) {
                $url = $param[0];
            } else {
                $url = $param;
            }
            // $url = $param[0];
            $pag->selecionarPaginasURL($url);
            $dados["url"] = $pag->getURL();
            $dados["titulo"] = $pag->getTitulo();
            $dados["corpo"] = $pag->getCorpo();
        }
        //echo ("<pre>");
        //print_r($param);
        //echo ("</pre>");

        return $dados;
    }

    public function index($confirme = null)
    {
        $pag = new Paginas();
        $menu = new Menu('Menu');
        $IDEmpresa = $this->user->getIDEmpresa();

        if (!empty($_GET['pagAtual'])) {
            $paginaAtual = intval($_GET['pagAtual']);
        } else {
            $paginaAtual = 1;
        }

        $limit = 10;
        $offset = ($paginaAtual * $limit) - $limit;

        //$dados = array();
        //$dados['nome'] = "Administrador: ".$this->user['nome'];
        //$dados['paginas'] = $pag->selecionarALLPaginas();

        $arrayMenu = $menu->getALLMenuIDEmpresa($IDEmpresa);
        $arrayPaginas = $pag->getALLPaginasIDEmpresa($IDEmpresa);
        $TotalItems = count($arrayPaginas);

        $menuItem = array();
        foreach ($arrayMenu as $item) {
            $pag->selecionarPaginasURL($item['url']);
            if ($pag->numRows() == 0) {
                $menuItem[] = $item['url'];
            }
        }

        $this->arrayInfo['nome'] = "Administrador: " . $this->user->getNome();
        $this->arrayInfo['paginas'] = $arrayPaginas;
        $this->arrayInfo['mensagem'] = $confirme;
        $this->arrayInfo['menuItem'] = $menuItem;
        $this->arrayInfo['paginaAtual'] = $paginaAtual;
        $this->arrayInfo['numeroPaginas'] = ceil($TotalItems / $limit);

        $this->loadPainel("selPaginas", $this->arrayInfo);
    }

    public function addPagina($confirme = "")
    {
        $pag = new Paginas();
        $menu = new Menu('menu');
        //$dados = array();
        //$dados['confirme'] = $confirme;

        $arrayMenu = $menu->selecionarALLMenu();
        $menuItem = array();
        foreach ($arrayMenu as $item) {
            $pag->selecionarPaginasURL($item['url']);
            if ($pag->numRows() == 0) {
                $menuItem[] = $item['url'];
            }
        }

        $this->arrayInfo['mensagem'] = $confirme;
        $this->arrayInfo['menuItem'] = $menuItem;
        $this->loadPainel("addPagina", $this->arrayInfo);
    }

    public function edit($id, $confirme = "")
    {
        $pagina = new Paginas();

        $this->arrayInfo['id'] = $id;
        $this->arrayInfo['mensagem'] = $confirme;
        $this->arrayInfo['pagina'] = $pagina->selecionarPaginasID($id);

        $this->loadPainel("editPagina", $this->arrayInfo);
    }

    public function editPagina($id, $confirme = "")
    {
        $pagina = new Paginas();

        //$dados = array();
        //$dados['confirme'] = $confirme;
        //$dados['id'] = $id;
        //$dados['pagina'] = $pagina->selecionarPaginasID($id);

        $this->arrayInfo['id'] = $id;
        $this->arrayInfo['mensagem'] = $confirme;
        $this->arrayInfo['pagina'] = $pagina->selecionarPaginasID($id);

        $this->loadPainel("editPagina", $this->arrayInfo);
    }

    public function excluirPagina($id)
    {
        $dados = array();
        $pagina = new Paginas();
        $dados['id'] = $id;
        $dados['pagina'] = $pagina->selecionarPaginasID($id);

        $this->loadPainel("excluirPagina", $dados);
    }

    public function addAction()
    {
        $pagina = new Paginas();
        if (isset($_POST['url']) && !empty($_POST['url'])) {
            $url = addslashes($_POST['url']);
        } else {
            $url = addslashes($_POST['titulo']);
        }
        //$url = addslashes($_POST['url']);
        $titulo = addslashes($_POST['titulo']);
        $corpo = addslashes($_POST['corpo']);

        if (!empty($url) && !empty($titulo)) {
            $pagina->incluirPaginaURLTituloCorpo($url, $titulo, $corpo);
            if (!isset($_POST['add_menu']) && !empty($_POST['add_menu'])) {
                $menu = new Menu("menu");
                $tipo = "pagina";
                $menu->incluirMenu($titulo, $url, $tipo);
            }
            $confirme = "Pagina Incluida com Sucesso";
            $this->addPagina($confirme);
        } else {
            $confirme = "Nao foi informado a URL ou Titulo na pagina";
            $this->addPagina($confirme);
        }
    }

    public function addPaginaAction()
    {
        $pagina = new Paginas();
        $url = addslashes($_POST['url']);
        $titulo = addslashes($_POST['titulo']);
        $corpo = addslashes($_POST['corpo']);

        if (!empty($url) && !empty($titulo)) {
            $pagina->incluirPaginaURLTituloCorpo($url, $titulo, $corpo);
            if (!isset($_POST['add_menu']) && !empty($_POST['add_menu'])) {
                $menu = new Menu("menu");
                $tipo = "pagina";
                $menu->incluirMenu($titulo, $url, $tipo);
            }
            $confirme = "success";
            $this->addPagina($confirme);
        } else {
            $confirme = "error";
            $this->addPagina($confirme);
        }
    }

    public function editAction()
    {
        $pagina = new Paginas();
        $id = addslashes($_POST['id']);
        $url = addslashes($_POST['url']);
        $titulo = utf8_decode(addslashes($_POST['titulo']));
        $corpo = addslashes($_POST['corpo']);

        if (!empty($titulo) && !empty($url)) {
            $pagina->selecionarPaginasID($id);
            if ($pagina->numRows() > 0) {
                $idPagina = $pagina->getID();
                $pagina->atualizarPaginaURLTituloCorpo($idPagina, $url, $titulo, $corpo);
                $confirme = "Registro Editado com Sucesso.";
                $this->edit($id, $confirme);
            } else {
                $confirme = "Nao foi encontrado um Identificador valido";
                $this->edit($id, $confirme);
            }
        } else {
            $confirme = "Nao foi encontrada um URL valida";
            $this->edit($id, $confirme);
        }
    }

    public function editPaginaAction()
    {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);
            $url = addslashes($_POST['url']);
            $titulo = utf8_decode(addslashes($_POST['titulo']));
            $corpo = addslashes($_POST['corpo']);

            if (!empty($titulo) && !empty($url)) {
                $pagina = new Paginas();
                $pagina->atualizarPaginaURLTituloCorpo($id, $url, $titulo, $corpo);
                //header("Location: ".BASE_URL."painel/editPagina/".$id."/sucess");
                $confirme = "Pagina Editada com Sucesso";
                $this->editPagina($id, $confirme);
            } else {
                //header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
                //header("Location: ".BASE_URL."painel/editPagina/".$id."/error");
                $confirme = "Nao foi Informado uma URL ou Titulo valido";
                $this->editPagina($id, $confirme);
            }
        } else {
            //header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
            //header("Location: ".BASE_URL."painel/editPagina/".$id."/error");
            $confirme = "Nao foi informado um ID valido.";
            $this->editPagina($id, $confirme);
        }
    }

    public function delAction($id = null)
    {
        $pagina = new Paginas();
        if (is_null($id)) {
            if (count($_POST) > 0) {
                $id = $_POST['id'];
            } else {
                $id = $_GET['id'];
            }
        }

        $pagina->selecionarPaginasID($id);
        if ($pagina->numRows() > 0) {
            $idPagina = $pagina->getID();
            $pagina->deletarPaginaID($idPagina);

            $confirme = "O Registro foi Excluido com sucesso";
            //header("Location: ".BASE_URL."painel/paginas/success");
            $this->index($confirme);
        } else {
            $confirme = "Nao foi Informado um ID valido";
            //header("Location: ".BASE_URL."painel/paginas/error");
            $this->index($confirme);
        }
    }

    public function excluirPaginaAction()
    {
        $pagina = new Paginas();
        if (count($_POST) > 0) {
            $id = $_POST['id'];
        } else {
            $id = $_GET['id'];
        }

        $pagina->selecionarPaginasID($id);
        if ($pagina->numRows() > 0) {
            $pagina->deletarPaginaID($id);

            $confirme = "success";
            //header("Location: ".BASE_URL."painel/paginas/success");
            $this->index($confirme);
        } else {
            $confirme = "error";
            //header("Location: ".BASE_URL."painel/paginas/error");
            $this->index($confirme);
        }
    }
}
