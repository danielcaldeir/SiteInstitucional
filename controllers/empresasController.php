<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of empresasController
 *
 * @author daniel
 */
class empresasController extends controller{
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
            
            if (!$this->user->validarPermissao('view_empresa')){
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
        
        $this->arrayInfo["menuActive"] = "empresa";
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
    
    private function gerarFiltroCnae($allEmpresa = array()) {
        $cnae = new Cnae();
        
        $where = array();
        //$where['classe']['!='] = '';
        $array = $cnae->selecionarALLCnae($where);
        
        $object = new ArrayObject();
        //$cnaeInfo = array();
        foreach ($array as $cn) {
            $object->offsetSet($cn['classe'], $cn);//cnaeInfo[$cn['classe']] = $cn;
        }
        //$object = new ArrayObject($cnaeInfo);
        $filtroCnae = new ArrayObject();
        foreach ($allEmpresa as $item) {
            for ($iterator = $object->getIterator(); $iterator->valid(); $iterator->next()){
                if ($iterator->key() === $item['cnae']){
                    if (!($filtroCnae->offsetExists($item['cnae']))){
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
    
    //put your code here
    public function index($confirme = "") {
        $empresas = new Empresa();
        $estado = new Estado();
        $cnae = new Cnae();
        
        //$dados = array();
        //$dados['nome'] = "Administrador: ".$this->user['nome'];
        //$dados['menus'] = $menus->selecionarALLMenu();
        //$dados['excluir'] = $confirme;
        
        if (!empty($_GET['pagAtual'])){ $paginaAtual = intval($_GET['pagAtual']); } 
        else { $paginaAtual = 1; }
        
        $filtro = array("cnpj"=>NULL,"regime"=>NULL, "status"=>NULL, "nome"=>NULL, "cnae"=>NULL);
        //$filtro = array("permissao"=>NULL, "status"=>NULL, "nome"=>NULL, "email"=>NULL);
        if (!empty($_GET['cnpj']))
            { $filtro['cnpj'] = $_GET['cnpj']; }
        if (!empty($_GET['status']))
            { $filtro['status'] = (intval($_GET['status'])-1); }
        if (!empty($_GET['nome']))
            { $filtro['nome'] = $_GET['nome']; }
        if (!empty($_GET['regime']))
            { $filtro['regime'] = $_GET['regime']; }
        if (!empty($_GET['cnae']))
            { $filtro['cnae'] = $_GET['cnae']; }
        
        $limit = 10;
        $offset = ($paginaAtual * $limit) - $limit;
        
        $arrayEmpresas = $empresas->getAllEmpresa($filtro, $offset, $limit);
        $TotalItems = count($arrayEmpresas);
        $filtroCNAE = $this->gerarFiltroCnae($arrayEmpresas);
        
        $this->arrayInfo['nome'] = "Administrador: ".$this->user->getNome();
        $this->arrayInfo['empresas'] = $arrayEmpresas;
        $this->arrayInfo['mensagem'] = $confirme;
        
        $this->arrayInfo['estados'] = $estado->selecionarALLEstado();
        $this->arrayInfo['cnae'] = $cnae->getFiltroSecao();
        $this->arrayInfo['filtro'] = $filtro;
        $this->arrayInfo['paginaAtual'] = $paginaAtual;
        $this->arrayInfo['numeroPaginas'] = ceil($TotalItems/$limit);
        $this->arrayInfo['cnaeFiltro'] = $filtroCNAE;
        
        $this->loadPainel("selEmpresas", $this->arrayInfo);
    }
    
    public function add($confirme = ""){
        if (!$this->user->validarPermissao('add_empresa')){
                //header("Location: ".BASE_URL."adminLTE");
                $filtro = array('permission'=>1);
                //loginController::login($filtro);
                $login = new loginController();
                $login->index($filtro);
                //$adminLTE->index();
                exit();
            }
        //$dados = array();
        //$dados['confirme'] = $confirme;
		$cnae = new Cnae();
		$estado = new Estado();
        
        $this->arrayInfo['mensagem'] = $confirme;
		$this->arrayInfo['cnae'] = $cnae->getFiltroSecao();
		$this->arrayInfo['estados'] = $estado->selecionarALLEstado();
        $this->loadPainel("addEmpresa", $this->arrayInfo);
    }
    
    public function edit($id, $confirme = ""){
        if (!$this->user->validarPermissao('edit_empresa')){
                //header("Location: ".BASE_URL."adminLTE");
                $filtro = array('permission'=>1);
                //loginController::login($filtro);
                $login = new loginController();
                $login->index($filtro);
                //$adminLTE->index();
                exit();
            }
        //$cliente = new Clientes();
        $estado = new Estado();
        $cnae = new Cnae();
        $empresa = new Empresa();
        
        if (!empty($id)){
            //$user->setID($id);
            $empresa->selecionarEmpresaID($id);
            if ($empresa->numRows() > 0) {
                $this->arrayInfo['selectedEmpresa'] = $empresa->result();
                $this->arrayInfo['permissao'] = $this->user->getPermissoes();
                $this->arrayInfo['mensagem'] = $confirme;
            }else{
                $mensagem = "Nao foi possivel encontrar nenhum Item";
                $this->empresa($mensagem);
                exit();
            }
        } else {
            $mensagem = "Para poder Editar e necessario um ID vinculado";
            $this->empresa($mensagem);
            exit();
        }
        
        //$TotalItems = count($cliente->getTotalCliente($filtro));
        //$this->arrayInfo['paginaAtual'] = $paginaAtual;
        $this->arrayInfo['estados'] = $estado->selecionarALLEstado();
        $this->arrayInfo['cnae'] = $cnae->getFiltroSecao();
        $where['classe'] = $empresa->getCNAE();
        $this->arrayInfo['empresa_cnae'] = $cnae->selecionarALLCnae($where);
        //$this->arrayInfo['numeroPaginas'] = ceil($TotalItems/$limit);
        $this->arrayInfo['id'] = $id;
        
        $this->loadPainel("editEmpresa", $this->arrayInfo);
    }
    
    public function excluirEmpresa($id){
        if (!$this->user->validarPermissao('del_empresa')){
                //header("Location: ".BASE_URL."adminLTE");
                $filtro = array('permission'=>1);
                //loginController::login($filtro);
                $login = new loginController();
                $login->index($filtro);
                //$adminLTE->index();
                exit();
            }
        $dados = array();
        $empresa = new Empresa();
        $dados['id'] = $id;
        $dados['empresa'] = $empresa->selecionarEmpresaID($id);
        
        $this->loadPainel("excluirEmpresa", $dados);
    }
    
    public function addAction() {
        if (!$this->user->validarPermissao('add_empresa')){
                //header("Location: ".BASE_URL."adminLTE");
                $filtro = array('permission'=>1);
                //loginController::login($filtro);
                $login = new loginController();
                $login->index($filtro);
                //$adminLTE->index();
                exit();
            }
        $empresa = new Empresa();
        
        $cnpj = addslashes($_POST['cnpj']);
        $razao = addslashes($_POST['razao']);
        $fantasia = addslashes($_POST['fantasia']);
        $fundacao = addslashes($_POST['fundacao']);
        $cnae = addslashes($_POST['cnae']);
        $regime = addslashes($_POST['regime']);
        
        if (!empty($cnpj) && !empty($fantasia)){
            $empresa->addEmpresa($cnpj, $fantasia, $razao, $fundacao, $cnae, $regime);
            
            //$confirme = "success";
            //header("Location: ".BASE_URL."painel/addMenu/success");
            $mensagem = "Inclusao da Empresa realizado com sucesso!";
            $this->index($mensagem);
        } else {
            //header("Location: ".BASE_URL."painel/addMenu/error");
            //$confirme = "error";
            $mensagem = "Inclusao nao realizada!";
            $this->index($mensagem);
        }
        //$this->addMenu($confirme);
    }
    
    //public function addEmpresaAction() {
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
    //    $nome = addslashes($_POST['nome']);
    //    $url = addslashes($_POST['url']);
    //    $tipo = addslashes($_POST['tipo']);
    //    
    //    if (!empty($nome) && !empty($url)){
    //        $empresa->addEmpresa($cpfCnpj,$nome,$razao,$DTFundacao,$cnae,$regime);
    //        
    //        $confirme = "success";
    //        //header("Location: ".BASE_URL."painel/addMenu/success");
    //        $this->addMenu($confirme);
    //    } else {
    //        //header("Location: ".BASE_URL."painel/addMenu/error");
    //        $confirme = "error";
    //        $this->addMenu($confirme);
    //    }
    //    //$this->addMenu($confirme);
    //}
    
    private function atualizarPrincipal($idHash, $principal = array()) {
        $empresa = new Empresa();
        if (count($principal)>0){
            if (!empty($principal['cnpj'])&& !empty($principal['fantasia'])){
                $empresa->selecionarEmpresaID($idHash);
                if ($empresa->numRows() > 0){
                    $idEmpresa = $empresa->getID();
                    $empresa->editEmpresa($idEmpresa, $principal['cnpj'], $principal['fantasia'], $principal['razao'], 
                            $principal['fundacao'], $principal['cnae'], $principal['regime']);
                    $mensagem = "Alteracao efetuada com sucesso!";
                } 
                else { $mensagem = "Nao foi encontrado um Identificador Valido!"; }
            } 
            else { $mensagem = "Nao foi possivel realizar a Alteracao!"; }
        } 
        else { $mensagem = "Nao ha valores para serem modificados"; }
        return $mensagem;
    }
    
    public function editAction(){
        if (!$this->user->validarPermissao('edit_empresa')){
                //header("Location: ".BASE_URL."adminLTE");
                $filtro = array('permission'=>1);
                //loginController::login($filtro);
                $login = new loginController();
                $login->index($filtro);
                //$adminLTE->index();
                exit();
            }
        //$empresa = new Empresa();
        $principal = array();
        $principal['id'] = addslashes($_POST['id']);
        $principal['cnpj'] = addslashes($_POST['cnpj']);
        $principal['razao'] = addslashes($_POST['razao']);
        $principal['fantasia'] = addslashes($_POST['fantasia']);
        $principal['fundacao'] = addslashes($_POST['fundacao']);
        $principal['cnae'] = addslashes($_POST['cnae']);
        $principal['regime'] = addslashes($_POST['regime']);
        $idHash = $principal['id'];
        
        $mensagem = $this->atualizarPrincipal($idHash, $principal);
        $this->index($mensagem);
    }
    
    private function atualizarEndereco($idHash, $endereco = array()) {
        $empresa = new Empresa();
        if (count($endereco)>0){
            if (!empty($endereco['cep'])&& !empty($endereco['endereco'])){
                $empresa->selecionarEmpresaID($idHash);
                if ($empresa->numRows() > 0){
                    $idEmpresa = $empresa->getID();
                    $empresa->editEmpEndereco($idEmpresa, $endereco['cep'], $endereco['endereco'], $endereco['numero'], 
                            $endereco['adicional'], $endereco['bairro'], $endereco['estado'], $endereco['cidade'], 
                            $endereco['pais']);
                    $mensagem = "Alteracao efetuada com sucesso!";
                } 
                else { $mensagem = "Nao foi encontrado um Identificador Valido!"; }
            } 
            else { $mensagem = "Nao foi possivel realizar a Alteracao!"; }
        } 
        else { $mensagem = "Nao ha valores para serem modificados"; }
        return $mensagem;
    }
    
    public function editEnderecoAction() {
        if (!$this->user->validarPermissao('edit_empresa')){
                //header("Location: ".BASE_URL."adminLTE");
                $filtro = array('permission'=>1);
                //loginController::login($filtro);
                $login = new loginController();
                $login->index($filtro);
                //$adminLTE->index();
                exit();
            }
        //$empresa = new Empresa();
        $endereco = array();
        $endereco['id'] = addslashes($_POST['id']);
        $endereco['cep'] = addslashes($_POST['cep']);
        $endereco['endereco'] = addslashes($_POST['endereco']);
        $endereco['numero'] = addslashes($_POST['numero']);
        $endereco['adicional'] = addslashes($_POST['adicional']);
        $endereco['bairro'] = addslashes($_POST['bairro']);
        $endereco['estado'] = addslashes($_POST['estado']);
        $endereco['cidade'] = addslashes($_POST['cidade']);
        $endereco['pais'] = addslashes($_POST['pais']);
        $idHash = $endereco['id'];
        
        $mensagem = $this->atualizarEndereco($idHash, $endereco);
        $this->index($mensagem);
    }
    
    public function excluirEmpresaAction() {
        if (!$this->user->validarPermissao('del_empresa')){
                //header("Location: ".BASE_URL."adminLTE");
                $filtro = array('permission'=>1);
                //loginController::login($filtro);
                $login = new loginController();
                $login->index($filtro);
                //$adminLTE->index();
                exit();
            }
        $empresa = new Empresa();
        if (count($_POST) > 0){ $id = $_POST['id']; } 
        else { $id = $_GET['id']; }
        
        $empresa->selecionarEmpresaID($id);
        if ($empresa->numRows() > 0){
            $empresa->delEmpresaID($id);
            
            $confirme = "success";
            //header("Location: ".BASE_URL."painel/menus/success");
            $this->index($confirme);
        } else {
            $confirme = "error";
            //header("Location: ".BASE_URL."painel/menus/error");
            $this->index($confirme);
        }
        //$this->menus($confirme);
    }
    
    public function delAction() {
        if (!$this->user->validarPermissao('del_empresa')){
                //header("Location: ".BASE_URL."adminLTE");
                $filtro = array('permission'=>1);
                //loginController::login($filtro);
                $login = new loginController();
                $login->index($filtro);
                //$adminLTE->index();
                exit();
            }
        $empresa = new Empresa();
        if (count($_POST) > 0){ $id = $_POST['id']; } 
        else { $id = $_GET['id']; }
        
        $empresa->selecionarEmpresaID($id);
        if ($empresa->numRows() > 0){
            $idEmpresa = $empresa->getID();
            $empresa->delEmpresaID($idEmpresa);
            
            $confirme = "Registro Deletado com sucesso";
            //header("Location: ".BASE_URL."painel/menus/success");
            $this->index($confirme);
        } else {
            $confirme = "Nao foi Informado um ID valido";
            //header("Location: ".BASE_URL."painel/menus/error");
            $this->index($confirme);
        }
        //$this->menus($confirme);
    }
}
