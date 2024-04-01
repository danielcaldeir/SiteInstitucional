<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of perfilController
 *
 * @author daniel
 */
class perfilController extends Controller
{
    private $user;
    private $empresa;
    private $arrayInfo;

    public function __construct()
    {
        $this->user = new Usuario();
        $this->arrayInfo = array();
        //$adminLTE = new adminLTEController();

        if (!empty($_SESSION['token'])) {
            //print_r($_SESSION['token']);
            if (!$this->user->isLogado($_SESSION['token'])) {
                loginController::logout();
                exit();
            }
            //$this->permissao->getPermissaoIDGrupo($this->user->getIDGrupo());

            //if (!$this->user->validarPermissao('view_perfil')){
            //    //header("Location: ".BASE_URL."adminLTE");
            //    $filtro = array('permission'=>1);
            //    //loginController::login($filtro);
            //    $login = new loginController();
            //    $login->index($filtro);
            //    exit();
            //}
        } else {
            $login = new loginController();
            $login->index();
            exit();
        }
        $this->arrayInfo["menuActive"] = "perfil";
        $this->arrayInfo["user"] = $this->user;
        $this->empresa = new Empresa();
        $this->empresa->selecionarEmpresaID(md5($this->user->getIdEmpresa()));
        $this->arrayInfo["empresa"] = $this->empresa;
        $this->arrayInfo["permissao"] = $this->user->getPermissoes();

        //global $config;
        //$this->config = $config;
        parent::__construct();
    }

    //put your code here
    public function index($mensagem = "")
    {
        //$cliente = new Clientes();
        $estado = new Estado();
        $cnae = new Cnae();
        //$IDEmpresa = $this->user->getIdEmpresa();
        //$empresa = new Empresa();
        //$empresa->selecionarEmpresaID($this->user->getIDEmpresa());
        //$this->arrayInfo["empresa"] = $empresa;

        //$this->arrayInfo['cliente'] = $cliente->getAllCliente($filtro, $offset, $limit);
        $this->arrayInfo['permissao'] = $this->user->getPermissoes();
        $this->arrayInfo['mensagem'] = $mensagem;

        //$TotalItems = count($cliente->getTotalCliente($filtro));
        //$this->arrayInfo['paginaAtual'] = $paginaAtual;
        $this->arrayInfo['estados'] = $estado->selecionarALLEstado();
        $this->arrayInfo['cnae'] = $cnae->getFiltroSecao();
        $where['classe'] = $this->empresa->getCNAE();
        $this->arrayInfo['empresa_cnae'] = $cnae->selecionarALLCnae($where);
        //$this->arrayInfo['numeroPaginas'] = ceil($TotalItems/$limit);
        //$this->arrayInfo['filtro'] = $filtro;

        $this->loadPainel("selPerfil", $this->arrayInfo);
    }

    //public function addEmpresa($confirme = ""){
    //    if (!$this->user->validarPermissao('add_empresa')){
    //            //header("Location: ".BASE_URL."adminLTE");
    //            $filtro = array('permission'=>1);
    //            //loginController::login($filtro);
    //            $login = new loginController();
    //            $login->index($filtro);
    //            //$adminLTE->index();
    //            exit();
    //        }
    //    //$cliente = new Clientes();
    //    $estado = new Estado();
    //    $cnae = new Cnae();
    //    //$IDEmpresa = $this->user->getIdEmpresa();
    //    
    //    $this->arrayInfo['mensagem'] = $confirme;
    //    $this->arrayInfo['estados'] = $estado->selecionarALLEstado();
    //    $this->arrayInfo['cnae'] = $cnae->getFiltroSecao();
    //    //$where['classe'] = $empresa->getCNAE();
    //    //$this->arrayInfo['empresa_cnae'] = $cnae->selecionarALLCnae($where);
    //    
    //    $this->loadPainel("addEmpresa", $this->arrayInfo);
    //}

    //public function addActionEmpresa() {
    //    if (!$this->user->validarPermissao('add_empresa')){
    //            //header("Location: ".BASE_URL."adminLTE");
    //            $filtro = array('permission'=>1);
    //            //loginController::login($filtro);
    //            $login = new loginController();
    //            $login->index($filtro);
    //            //$adminLTE->index();
    //            exit();
    //        }
    //    $empresa = new Empresa();
    //    $cnpj = addslashes($_POST['cnpj']);
    //    $razao = addslashes($_POST['razao']);
    //    $fantasia = addslashes($_POST['fantasia']);
    //    $fundacao = addslashes($_POST['fundacao']);
    //    $cnae = addslashes($_POST['cnae']);
    //    $regime = addslashes($_POST['regime']);
    //    if (!empty($cnpj) && !empty($fantasia)){
    //        $empresa->addEmpresa($cnpj, $fantasia, $razao, $fundacao, $cnae, $regime);
    //        //$confirme = "success";
    //        //header("Location: ".BASE_URL."painel/addMenu/success");
    //        $mensagem = "Inclusao da Empresa realizado com sucesso!";
    //        $this->index($mensagem);
    //    } else {
    //        //header("Location: ".BASE_URL."painel/addMenu/error");
    //        //$confirme = "error";
    //        $mensagem = "Inclusao nao realizada!";
    //        $this->index($mensagem);
    //    }
    //    //$this->addMenu($confirme);
    //}

    //private function atualizarPrincipal($idHash, $principal = array()) {
    //    $empresa = new Empresa();
    //    if (count($principal)>0){
    //        if (!empty($principal['cnpj'])&& !empty($principal['fantasia'])){
    //            $empresa->selecionarEmpresaID($idHash);
    //            if ($empresa->numRows() > 0){
    //                $idEmpresa = $empresa->getID();
    //                $empresa->editEmpresa($idEmpresa, $principal['cnpj'], $principal['fantasia'], $principal['razao'], 
    //                        $principal['fundacao'], $principal['cnae'], $principal['regime']);
    //                $mensagem = "Alteracao efetuada com sucesso!";
    //            } 
    //            else { $mensagem = "Nao foi encontrado um Identificador Valido!"; }
    //        } 
    //        else { $mensagem = "Nao foi possivel realizar a Alteracao!"; }
    //    } 
    //    else { $mensagem = "Nao ha valores para serem modificados"; }
    //    return $mensagem;
    //}

    //public function editPrincipalAction() {
    //    if (!$this->user->validarPermissao('edit_config')){
    //            //header("Location: ".BASE_URL."adminLTE");
    //            $filtro = array('permission'=>1);
    //            //loginController::login($filtro);
    //            $login = new loginController();
    //            $login->index($filtro);
    //            //$adminLTE->index();
    //            exit();
    //        }
    //    //$empresa = new Empresa();
    //    $principal = array();
    //    $principal['id'] = addslashes($_GET['id']);
    //    $principal['cnpj'] = addslashes($_GET['cnpj']);
    //    $principal['razao'] = addslashes($_GET['razao']);
    //    $principal['fantasia'] = addslashes($_GET['fantasia']);
    //    $principal['fundacao'] = addslashes($_GET['fundacao']);
    //    $principal['cnae'] = addslashes($_GET['cnae']);
    //    $principal['regime'] = addslashes($_GET['regime']);
    //    $idHash = $principal['id'];
    //    
    //    $mensagem = $this->atualizarPrincipal($idHash, $principal);
    //    $this->index($mensagem);
    //}

    //public function editEmprPrincipalAction() {
    //    if (!$this->user->validarPermissao('edit_empresa')){
    //            //header("Location: ".BASE_URL."adminLTE");
    //            $filtro = array('permission'=>1);
    //            //loginController::login($filtro);
    //            $login = new loginController();
    //            $login->index($filtro);
    //            //$adminLTE->index();
    //            exit();
    //        }
    //    //$empresa = new Empresa();
    //    $principal = array();
    //    $principal['id'] = addslashes($_GET['id']);
    //    $principal['cnpj'] = addslashes($_GET['cnpj']);
    //    $principal['razao'] = addslashes($_GET['razao']);
    //    $principal['fantasia'] = addslashes($_GET['fantasia']);
    //    $principal['fundacao'] = addslashes($_GET['fundacao']);
    //    $principal['cnae'] = addslashes($_GET['cnae']);
    //    $principal['regime'] = addslashes($_GET['regime']);
    //    $idHash = $principal['id'];
    //    
    //    $mensagem = $this->atualizarPrincipal($idHash, $principal);
    //    $this->empresa($mensagem);
    //}

    //private function atualizarEndereco($idHash, $endereco = array()) {
    //    $empresa = new Empresa();
    //    if (count($empresa)>0){
    //        if (!empty($endereco['cep'])&& !empty($endereco['endereco'])){
    //            $empresa->selecionarEmpresaID($idHash);
    //            if ($empresa->numRows() > 0){
    //                $idEmpresa = $empresa->getID();
    //                $empresa->editEmpEndereco($idEmpresa, $endereco['cep'], $endereco['endereco'], $endereco['numero'], 
    //                        $endereco['adicional'], $endereco['bairro'], $endereco['estado'], $endereco['cidade'], 
    //                        $endereco['pais']);
    //                $mensagem = "Alteracao efetuada com sucesso!";
    //            } 
    //            else { $mensagem = "Nao foi encontrado um Identificador Valido!"; }
    //        } 
    //        else { $mensagem = "Nao foi possivel realizar a Alteracao!"; }
    //    } 
    //    else { $mensagem = "Nao ha valores para serem modificados"; }
    //    return $mensagem;
    //}

    //public function editAuxiliarAction() {
    //    if (!$this->user->validarPermissao('edit_config')){
    //            //header("Location: ".BASE_URL."adminLTE");
    //            $filtro = array('permission'=>1);
    //            //loginController::login($filtro);
    //            $login = new loginController();
    //            $login->index($filtro);
    //            //$adminLTE->index();
    //            exit();
    //        }
    //    //$empresa = new Empresa();
    //    $endereco = array();
    //    $endereco['id'] = addslashes($_GET['id']);
    //    $endereco['cep'] = addslashes($_GET['cep']);
    //    $endereco['endereco'] = addslashes($_GET['endereco']);
    //    $endereco['numero'] = addslashes($_GET['numero']);
    //    $endereco['adicional'] = addslashes($_GET['adicional']);
    //    $endereco['bairro'] = addslashes($_GET['bairro']);
    //    $endereco['estado'] = addslashes($_GET['estado']);
    //    $endereco['cidade'] = addslashes($_GET['cidade']);
    //    $endereco['pais'] = addslashes($_GET['pais']);
    //    $idHash = $endereco['id'];
    //    
    //    $mensagem = $this->atualizarEndereco($idHash, $endereco);
    //    $this->index($mensagem);
    //}

    //public function editEmprAuxiliarAction() {
    //    if (!$this->user->validarPermissao('edit_empresa')){
    //            //header("Location: ".BASE_URL."adminLTE");
    //            $filtro = array('permission'=>1);
    //            //loginController::login($filtro);
    //            $login = new loginController();
    //            $login->index($filtro);
    //            //$adminLTE->index();
    //            exit();
    //        }
    //    //$empresa = new Empresa();
    //    $endereco = array();
    //    $endereco['id'] = addslashes($_GET['id']);
    //    $endereco['cep'] = addslashes($_GET['cep']);
    //    $endereco['endereco'] = addslashes($_GET['endereco']);
    //    $endereco['numero'] = addslashes($_GET['numero']);
    //    $endereco['adicional'] = addslashes($_GET['adicional']);
    //    $endereco['bairro'] = addslashes($_GET['bairro']);
    //    $endereco['estado'] = addslashes($_GET['estado']);
    //    $endereco['cidade'] = addslashes($_GET['cidade']);
    //    $endereco['pais'] = addslashes($_GET['pais']);
    //    $idHash = $endereco['id'];
    //    
    //    $mensagem = $this->atualizarEndereco($idHash, $endereco);
    //    $this->empresa($mensagem);
    //}

    private function gerarFiltroCnae($allEmpresa = array())
    {
        $cnae = new Cnae();

        $where = array();
        $where['classe']['!='] = '';
        $array = $cnae->selecionarALLCnae($where);

        $object = new ArrayObject();
        //$cnaeInfo = array();
        foreach ($array as $cn) {
            $object->offsetSet($cn['classe'], $cn); //cnaeInfo[$cn['classe']] = $cn;
        }
        //$object = new ArrayObject($cnaeInfo);
        $filtroCnae = new ArrayObject();
        foreach ($allEmpresa as $item) {
            for ($iterator = $object->getIterator(); $iterator->valid(); $iterator->next()) {
                if ($iterator->key() === $item['cnae']) {
                    if (!($filtroCnae->offsetExists($item['cnae']))) {
                        $filtroCnae->offsetSet($iterator->key(), $iterator->current());
                    }
                    //$filtroCnae[$iterator->key()] = $iterator->current();
                }
            }
        }
        //$arrayObject = new ArrayObject($filtroCnae);
        $filtroCnae->ksort();
        return $filtroCnae->getArrayCopy();
    }

    public function empresa($mensagem = "")
    {
        if (!$this->user->validarPermissao('view_empresa')) {
            //header("Location: ".BASE_URL."adminLTE");
            $filtro = array('permission' => 1);
            //loginController::login($filtro);
            $login = new loginController();
            $login->index($filtro);
            //$adminLTE->index();
            exit();
        }

        $empresa = new Empresa();


        if (isset($_GET['pagAtual']) && !(empty($_GET['pagAtual']))) {
            $pagina = intval($_GET['pagAtual']);
            $paginaAtual = (($pagina < 1) ? 1 : $pagina);
        } else {
            $paginaAtual = 1;
        }

        $limit = 10;
        $offset = ($paginaAtual * $limit) - $limit;

        $filtro = array("cnpj" => NULL, "regime" => NULL, "status" => NULL, "nome" => NULL, "cnae" => NULL);
        //$filtro = array("permissao"=>NULL, "status"=>NULL, "nome"=>NULL, "email"=>NULL);
        if (!empty($_GET['cnpj'])) {
            $filtro['cnpj'] = $_GET['cnpj'];
        }
        if (!empty($_GET['status'])) {
            $filtro['status'] = (intval($_GET['status']) - 1);
        }
        if (!empty($_GET['nome'])) {
            $filtro['nome'] = $_GET['nome'];
        }
        if (!empty($_GET['regime'])) {
            $filtro['regime'] = $_GET['regime'];
        }
        if (!empty($_GET['cnae'])) {
            $filtro['cnae'] = $_GET['cnae'];
        }

        $allEmpresa = $empresa->getAllEmpresa($filtro, $offset, $limit);
        $this->arrayInfo["allEmpresa"] = $allEmpresa;
        //$this->arrayInfo['cliente'] = $cliente->getAllCliente($filtro, $offset, $limit);
        $this->arrayInfo['permissao'] = $this->user->getPermissoes();
        $this->arrayInfo['mensagem'] = $mensagem;

        $arrayCNAE = array();
        $arrayCNPJ = array();
        $this->arrayInfo['totalEmpresa'] = count($allEmpresa);
        foreach ($allEmpresa as $item) {
            $arrayCNAE[$item['id']] = $item['descricao'];
            $arrayCNPJ[$item['id']] = $item['cpf_cnpj'];
            //echo (array_search($item['cnae'], $cnaeInfo[0]));
        }

        //$where['classe'] = $empresa->getCNAE();
        //$this->arrayInfo['empresa_cnae'] = $cnae->selecionarALLCnae($where);
        //$TotalItems = count($empresa->getTotalEmpresa($filtro));
        $TotalEmpresa = $empresa->getTotalEmpresa($filtro);
        $TotalItems = count($TotalEmpresa);
        $this->arrayInfo['paginaAtual'] = $paginaAtual;
        $this->arrayInfo['numeroPaginas'] = ceil($TotalItems / $limit);
        $this->arrayInfo['filtro'] = $filtro;
        $filtroCNAE = $this->gerarFiltroCnae($TotalEmpresa);
        //echo ("<pre>");
        //print_r($filtroCNAE);
        //echo ("</pre>");
        $this->arrayInfo['cnae'] = $arrayCNAE;
        $this->arrayInfo['cnpj'] = $arrayCNPJ;
        $this->arrayInfo['cnaeFiltro'] = $filtroCNAE;

        $this->loadPainel("selEmpresas", $this->arrayInfo);
    }

    //public function editEmpresa($id, $mensagem = "") {
    //    if (!$this->user->validarPermissao('edit_empresa')){
    //            //header("Location: ".BASE_URL."adminLTE");
    //            $filtro = array('permission'=>1);
    //            //loginController::login($filtro);
    //            $login = new loginController();
    //            $login->index($filtro);
    //            //$adminLTE->index();
    //            exit();
    //        }
    //    //$cliente = new Clientes();
    //    $estado = new Estado();
    //    $cnae = new Cnae();
    //    $empresa = new Empresa();
    //    
    //    if (!empty($id)){
    //        //$user->setID($id);
    //        $empresa->selecionarEmpresaID($id);
    //        if ($empresa->numRows() > 0) {
    //            $this->arrayInfo['selectedEmpresa'] = $empresa->result();
    //            $this->arrayInfo['permissao'] = $this->user->getPermissoes();
    //            $this->arrayInfo['mensagem'] = $mensagem;
    //        }else{
    //            $mensagem = "Nao foi possivel encontrar nenhum Item";
    //            $this->empresa($mensagem);
    //            exit();
    //        }
    //    } else {
    //        $mensagem = "Para poder Editar e necessario um ID vinculado";
    //        $this->empresa($mensagem);
    //        exit();
    //    }
    //    
    //    //$TotalItems = count($cliente->getTotalCliente($filtro));
    //    //$this->arrayInfo['paginaAtual'] = $paginaAtual;
    //    $this->arrayInfo['estados'] = $estado->selecionarALLEstado();
    //    $this->arrayInfo['cnae'] = $cnae->getFiltroSecao();
    //    $where['classe'] = $empresa->getCNAE();
    //    $this->arrayInfo['empresa_cnae'] = $cnae->selecionarALLCnae($where);
    //    //$this->arrayInfo['numeroPaginas'] = ceil($TotalItems/$limit);
    //    //$this->arrayInfo['filtro'] = $filtro;
    //    
    //    $this->loadPainel("editEmpresas", $this->arrayInfo);
    //}
}
