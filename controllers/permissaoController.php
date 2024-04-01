<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of permissaoController
 *
 * @author daniel
 */
class permissaoController extends Controller
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

            if (!$this->user->validarPermissao('add_permissao')) {
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

        $this->arrayInfo["menuActive"] = "permissao";
        $this->arrayInfo["user"] = $this->user;
        $empresa = new Empresa();
        $empresa->selecionarEmpresaID(md5($this->user->getIdEmpresa()));
        $this->arrayInfo["empresa"] = $empresa;
        $this->arrayInfo["permissao"] = $this->user->getPermissoes();

        //global $config;
        //$this->config = $config;
        parent::__construct();
    }

    //put your code here
    public function index($mensagem = "")
    {
        $permissao = new Permissao();
        $perItens = new PermissaoItem();

        //$this->arrayInfo['permissao'] = ($permissao);
        $IDEmpresa = $this->user->getIdEmpresa();
        $this->arrayInfo['permitido'] = $permissao->getAllPermissaoGrupo($IDEmpresa);
        $this->arrayInfo['permissaoItens'] = $perItens->selecionarPermissaoItemIDEmpresa($IDEmpresa);
        $this->arrayInfo['mensagem'] = $mensagem;

        $this->loadPainel("selPermissao", $this->arrayInfo);
    }

    // public function itemPermissao($mensagem = "") {
    //     //$dados = array();
    //     $perItens = new PermissaoItem();
    //     $permissao = new Permissao();
    //     //$this->arrayInfo['permissao'] = ($permissao);
    //     $IDEmpresa = $this->user->getIdEmpresa();
    //     $this->arrayInfo['permitido'] = $permissao->getAllPermissaoGrupo($IDEmpresa);
    //     $this->arrayInfo['mensagem'] = $mensagem;
    //     $this->arrayInfo['permissaoItens'] = $perItens->selecionarPermissaoItemIDEmpresa($IDEmpresa);
    //     //$dados['sidebar'] = FALSE;
    //     $this->loadPainel("permissaoItem", $this->arrayInfo);
    // }

    public function del($id)
    {
        $permissao = new Permissao();
        $perGrupo = new PermissaoGrupo();
        $IDEmpresa = $this->user->getIdEmpresa();

        $perGrupo->selecionarPermissaoGrupoID($id);
        $id_grupo = $perGrupo->getID();
        if ($permissao->validarDelPermissao($id_grupo, $IDEmpresa)) { //($IDEmpresa, $id_grupo)){
            $this->index("Permissao Deletada com Sucesso!");
        } else {
            $this->index("Nao tem permissao para deletar!");
        }
    }

    public function delItem($id)
    {
        $permissao = new Permissao();
        $perItem = new PermissaoItem();
        $IDEmpresa = $this->user->getIdEmpresa();

        $perItem->selecionarPermissaoItemID($id);
        $id_item = $perItem->getID();
        if ($permissao->validatePermissaoItem($id_item, $IDEmpresa)) { //($IDEmpresa, $id_item)){
            $permissao->delPermissaoIDItem($id_item);
            $perItem->delPermissaoItemID($id_item);
            $this->index("Permissao Deletada com Sucesso!");
        } else {
            $this->index("Nao tem permissao para deletar!");
        }
    }

    public function add($mensagem = "")
    {
        //$dados = array();
        $perItens = new PermissaoItem();
        $permissao = new Permissao();

        $IDEmpresa = $this->user->getIdEmpresa();
        //$this->arrayInfo['permissao'] = ($permissao);
        $this->arrayInfo['permitido'] = $permissao->getAllPermissaoGrupo($IDEmpresa);
        $this->arrayInfo['permissaoItens'] = $perItens->selecionarPermissaoItemIDEmpresa($IDEmpresa);
        $this->arrayInfo['mensagem'] = $mensagem;

        $this->loadPainel("addPermissao", $this->arrayInfo);
    }

    private function addPermissaoItem($id_grupo, $items, $allItens = array())
    {
        $permissao = new Permissao();
        $perItens = new PermissaoItem();
        $IDEmpresa = $this->user->getIdEmpresa();

        if (count($allItens) == 0) {
            $allItens = $perItens->selecionarPermissaoItemIDEmpresa($IDEmpresa);
        }
        //echo ("<pre>");
        foreach ($allItens as $item) {
            $id_item = $item['id'];
            //echo ("<br>in_array: ");
            //print_r(in_array($id_item, $items));
            if (in_array($id_item, $items)) {
                $permissao->addPermissao($id_grupo, $id_item, '1', $IDEmpresa);
            } else {
                $permissao->addPermissao($id_grupo, $id_item, '0', $IDEmpresa);
            }
        }
        //echo ("</pre>");
    }

    public function addAction($mensagem = "")
    {
        //$dados = array();
        //$permissao = new Permissao();
        $perGrupo = new PermissaoGrupo();
        //$perItens = new PermissaoItem();

        if (!empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $IDEmpresa = $this->user->getIdEmpresa();
            $array = $perGrupo->addPermissaoGrupo($nome, $IDEmpresa); //($IDEmpresa, $nome);
            if (count($array) > 0) {
                foreach ($array as $item) {
                    $id_grupo = $item['ID'];
                    if (isset($_POST['items']) && count($_POST['items'])) {
                        $items = ($_POST['items']);
                        $this->addPermissaoItem($id_grupo, $items);
                        $mensagem = "Permissao Incluida com sucesso!!";
                    } else {
                        $mensagem = "Nao ha Items!";
                    }
                }
            } else {
                $mensagem = "Nao foi possivel incluir um grupo de permissao!";
            }
        } else {
            $mensagem = "Nao foi vinculado uma permissao!";
        }

        //$this->add($mensagem);
        $this->index($mensagem);
    }

    public function addItem($mensagem = "")
    {
        $perItens = new PermissaoItem();
        $permissao = new Permissao();

        //$this->arrayInfo['permissao'] = ($permissao);
        $IDEmpresa = $this->user->getIdEmpresa();
        $this->arrayInfo['permitido'] = $permissao->getAllPermissaoGrupo($IDEmpresa);
        $this->arrayInfo['permissaoItens'] = $perItens->selecionarPermissaoItemIDEmpresa($IDEmpresa);
        $this->arrayInfo['mensagem'] = $mensagem;

        $this->loadPainel("addPermissaoItem", $this->arrayInfo);
    }

    public function addItemAction($mensagem = "")
    {
        //$dados = array();
        //$permissao = new Permissao();
        //$perGrupo = new PermissaoGrupo();
        $perItens = new PermissaoItem();

        if (!empty($_POST['nome']) && !empty($_POST['slug'])) {
            $nome = addslashes($_POST['nome']);
            $slug = addslashes($_POST['slug']);
            $IDEmpresa = $this->user->getIdEmpresa();
            $perItens->addPermissaoItem($nome, $slug, $IDEmpresa); //($IDEmpresa, $nome, $slug);
            $mensagem = "Item Adicionado com Sucesso!";
        } else {
            $mensagem = "Nao foi vinculado uma permissao!";
        }

        //$this->addItem($mensagem);
        $this->index($mensagem);
    }

    public function editItem($id = null, $mensagem = "")
    {
        //$dados = array();
        $perItens = new PermissaoItem();
        $permissao = new Permissao();

        if (!empty($id)) {
            $perItens->selecionarPermissaoItemID($id);
            if ($perItens->numRows() > 0) {
                $this->arrayInfo['nomeItem'] = $perItens->getNome();
                $this->arrayInfo['slug'] = $perItens->getSlug();
                $this->arrayInfo['id_Item'] = $perItens->getID();
            } else {
                $mensagem = "Nao foi possivel encontrar o Item!!";
            }
        } else {
            $mensagem = "Para poder Editar é necessário um ID vinculado!!";
            $this->index($mensagem);
            exit();
        }
        $this->arrayInfo['mensagem'] = $mensagem;

        $this->loadPainel("editPermissaoItem", $this->arrayInfo);
    }

    public function editItemAction($id, $mensagem = "")
    {
        $perItens = new PermissaoItem();
        //$perItens = new PermissaoItem();
        if (!empty($id)) {
            $perItens->selecionarPermissaoItemID($id);
            if ($perItens->numRows() > 0) {
                $id_item = $perItens->getID();
                if ((isset($_POST['nome'])) && (!empty($_POST['nome']))) {
                    $nome = addslashes($_POST['nome']);
                    $perItens->editPermissaoItem($id_item, $nome);
                    $mensagem = "O Item foi editado com Sucesso!";
                } else {
                    $mensagem = "Nao foi informado nenhum nome!";
                }
            } else {
                $mensagem = "Nao foi encontrado o Item Selecionado.";
            }

            $this->editItem($id, $mensagem);
        } else {
            $this->index($mensagem);
        }
    }

    public function edit($id = null, $mensagem = "")
    {
        $perItens = new PermissaoItem();
        $perGrupo = new PermissaoGrupo();
        $permissao = new Permissao();
        $IDEmpresa = $this->user->getIdEmpresa();

        if (!empty($id)) {
            $perGrupo->selecionarPermissaoGrupoID($id);
            if ($perGrupo->numRows() > 0) {
                $this->arrayInfo['nomeGrupo'] = $perGrupo->getNome();
                $idGrupo = $perGrupo->getID();
                $this->arrayInfo['id_grupo'] = $idGrupo;
                $this->arrayInfo['grupoPermissao'] = $permissao->getSelectIDGrupo($idGrupo); //$permissao->getPermissaoIDGrupo($IDEmpresa, $idGrupo);
            } else {
                $mensagem = "Nao foi possivel encontrar o Item!!";
            }
        } else {
            $mensagem = "Para poder Editar é necessário um ID vinculado!!";
            $this->index($mensagem);
            exit();
        }

        $this->arrayInfo['permitido'] = $permissao->getAllPermissaoGrupo(); //($IDEmpresa);
        $where['id_empresa'] = $IDEmpresa;
        $this->arrayInfo['permissaoItens'] = $perItens->selecionarALLPermissaoItem($where);
        $this->arrayInfo['mensagem'] = $mensagem;

        $this->loadPainel("editPermissao", $this->arrayInfo);
    }

    private function editPermissaoItem($id_grupo, $items)
    {
        $permissao = new Permissao();
        $perItens = new PermissaoItem();
        $IDEmpresa = $this->user->getIdEmpresa();

        $verificar = $permissao->selecionarPermissaoIDEmpresa($id_grupo, $IDEmpresa); //($IDEmpresa, $id_grupo);
        $allItens = $perItens->selecionarPermissaoItemIDEmpresa($IDEmpresa);
        //echo ("<br>Todos os Itens:<pre>");
        //print_r($allItens);
        //echo ("</pre>IDGrupo<pre>");
        //print_r($verificar);
        //echo ("</pre>");
        //exit();
        if (count($allItens) == count($verificar)) {
            foreach ($allItens as $item) {
                $id_item = $item['id'];
                //echo ("<br>in_array: ");
                //print_r(in_array($id_item, $items));
                if (in_array($id_item, $items)) {
                    $permissao->editPermissao($id_grupo, $id_item, '1');
                } else {
                    $permissao->editPermissao($id_grupo, $id_item, '0');
                }
            }
        } else {
            $permissao->delPermissaoIDGrupo($id_grupo, $IDEmpresa); //($IDEmpresa, $id_grupo);
            $this->addPermissaoItem($id_grupo, $items, $allItens);
            //foreach ($allItens as $item) {
            //    $id_item = $item['id'];
            //    //echo ("<br>in_array: ");
            //    //print_r(in_array($id_item, $items));
            //    if (in_array($id_item, $items)){
            //        $permissao->addPermissao($IDEmpresa, $id_grupo, $id_item, '1');
            //    } else {
            //        $permissao->addPermissao($IDEmpresa, $id_grupo, $id_item, '0');
            //    }
            //}
        }
    }

    public function editAction($id, $mensagem = "")
    {
        $perGrupo = new PermissaoGrupo();
        //$perItens = new PermissaoItem();
        if (!empty($id)) {
            $perGrupo->selecionarPermissaoGrupoID($id);
            if ($perGrupo->numRows() > 0) {
                $id_grupo = $perGrupo->getID();
                if (!empty($_POST['nome'])) {
                    $nome = addslashes($_POST['nome']);
                    $perGrupo->editPermissaoGrupo($id_grupo, $nome);
                    if (isset($_POST['items']) && count($_POST['items'])) {
                        $items = ($_POST['items']);
                        $this->editPermissaoItem($id_grupo, $items);
                    } else {
                        $mensagem = "Nao ha Items!";
                    }
                } else {
                    $mensagem = "Nao foi vinculado uma permissao!";
                }
            } else {
                $mensagem = "Nao foi encontrado um grupo vinculado.";
            }

            $this->edit($id, $mensagem);
        } else {
            $this->index($mensagem);
        }
    }
}
