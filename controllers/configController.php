<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of configController
 *
 * @author daniel
 */
class configController extends controller{
    private $user;
    private $empresa;
    private $arrayInfo;
    
    public function __construct() {
        $this->user = new Usuario();
        $this->arrayInfo = array();
        //$adminLTE = new adminLTEController();
        
        if (!empty($_SESSION['token'])){
            //print_r($_SESSION['token']);
            if (!$this->user->isLogado($_SESSION['token'])){
                loginController::logout();
                exit();
            }
            //$this->permissao->getPermissaoIDGrupo($this->user->getIDGrupo());
            
            if (!$this->user->validarPermissao('view_config')){
                //header("Location: ".BASE_URL."adminLTE");
                $filtro = array('permission'=>1);
                //loginController::login($filtro);
                $login = new loginController();
                $login->index($filtro);
                exit();
            }
        } else {
            $login = new loginController();
            $login->index();
            exit();
        }
        $this->arrayInfo["menuActive"] = "config";
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
    public function index($mensagem = "") {
        //$cliente = new Clientes();
        $estado = new Estado();
        $cnae = new Cnae();
        //$IDEmpresa = $this->user->getIdEmpresa();
        //$empresa = new Empresa();
        //$empresa->selecionarEmpresaID($this->user->getIDEmpresa());
        //$this->arrayInfo["empresa"] = $empresa;
        
        //if (isset($_GET['pagAtual']) && !(empty($_GET['pagAtual'])) ){ 
        //    $pagina = intval($_GET['pagAtual']); 
        //    $paginaAtual = (($pagina < 1) ? 1 : $pagina);
        //} else { $paginaAtual = 1; }
        
        //$limit = 10;
        //$offset = ($paginaAtual * $limit) - $limit;
        
        //$filtro = array("empresa"=>$IDEmpresa,"FiltroEstrela"=>NULL, "FiltroCEP"=>NULL, "FiltroNome"=>NULL, "FiltroCpfCnpj"=>NULL);
        //if (!empty($_GET['estrela']))
        //    { $filtro['FiltroEstrela'] = $_GET['estrela']; }
        //if (!empty($_GET['cep']))
        //    { $filtro['FiltroCEP'] = intval($_GET['cep']); }
        //if (!empty($_GET['nome']))
        //    { $filtro['FiltroNome'] = $_GET['nome']; }
        //if (!empty($_GET['cpfCnpj']))
        //    { $filtro['FiltroCpfCnpj'] = $_GET['cpfCnpj']; }
        
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
        
        $this->loadPainel("selConfig", $this->arrayInfo);
    }
    
    
    
    
    
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
    
    
    
    private function gerarFiltroCnae($allEmpresa = array()) {
        $cnae = new Cnae();
        
        $where = array();
        $where['classe']['!='] = '';
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
    
    public function empresa($mensagem = "") {
        if (!$this->user->validarPermissao('view_empresa')){
                //header("Location: ".BASE_URL."adminLTE");
                $filtro = array('permission'=>1);
                //loginController::login($filtro);
                $login = new loginController();
                $login->index($filtro);
                //$adminLTE->index();
                exit();
            }
        //$cliente = new Clientes();
        //$estado = new Estado();
        //$cnae = new Cnae();
        $empresa = new Empresa();
        //$IDEmpresa = $this->user->getIdEmpresa();
        //$empresa->selecionarEmpresaID($this->user->getIDEmpresa());
        //$this->arrayInfo["empresa"] = $empresa;
        
        //if (isset($_GET['pagAtual']) && !(empty($_GET['pagAtual'])) ){ 
        //    $pagina = intval($_GET['pagAtual']); 
        //    $paginaAtual = (($pagina < 1) ? 1 : $pagina);
        //} else { $paginaAtual = 1; }
        //$limit = 10;
        //$offset = ($paginaAtual * $limit) - $limit;
        
        //$filtro = array("cnpj"=>NULL,"regime"=>NULL, "status"=>NULL, "nome"=>NULL, "cnae"=>NULL);
        //if (!empty($_GET['cnpj']))
        //    { $filtro['cnpj'] = $_GET['cnpj']; }
        //if (!empty($_GET['status']))
        //    { $filtro['status'] = (intval($_GET['status'])-1); }
        //if (!empty($_GET['nome']))
        //    { $filtro['nome'] = $_GET['nome']; }
        //if (!empty($_GET['regime']))
        //    { $filtro['regime'] = $_GET['regime']; }
        //if (!empty($_GET['cnae']))
        //    { $filtro['cnae'] = $_GET['cnae']; }
        //$allEmpresa = $empresa->getAllEmpresa($filtro, $offset, $limit);
        
        $allEmpresa = $empresa->selecionarAllEmpresa();
        $this->arrayInfo["allEmpresa"] = $allEmpresa;
        //$this->arrayInfo['cliente'] = $cliente->getAllCliente($filtro, $offset, $limit);
        $this->arrayInfo['permissao'] = $this->user->getPermissoes();
        $this->arrayInfo['mensagem'] = $mensagem;
        
        //$arrayCnae = array();
        //foreach ($allEmpresa as $item) {
        //    if (!(array_key_exists($item['cnae'], $arrayCnae))){
        //        $cnae->getCnaeClasse($item['cnae']);
        //        $arrayCnae[$cnae->getClasse()] = utf8_encode($cnae->getDescricao());
        //    }
        //}
        
        $arrayCNAE = array();
        $arrayCNPJ = array();
        $this->arrayInfo['totalEmpresa'] = count($allEmpresa);
        foreach ($allEmpresa as $item) {
            $arrayCNAE[$item['id']] = $item['cnae'];
            $arrayCNPJ[$item['id']] = $item['cpf_cnpj'];
            //echo (array_search($item['cnae'], $cnaeInfo[0]));
        }
        
        //$where['classe'] = $empresa->getCNAE();
        //$this->arrayInfo['empresa_cnae'] = $cnae->selecionarALLCnae($where);
        //$TotalItems = count($empresa->getTotalEmpresa($filtro));
        
        //$TotalEmpresa = $empresa->getTotalEmpresa($filtro);
        //$TotalItems = count($TotalEmpresa);
        //$this->arrayInfo['paginaAtual'] = $paginaAtual;
        //$this->arrayInfo['numeroPaginas'] = ceil($TotalItems/$limit);
        //$this->arrayInfo['filtro'] = $filtro;
        //$filtroCNAE = $this->gerarFiltroCnae($TotalEmpresa);
        
        //echo ("<pre>");
        //print_r($filtroCNAE);
        //echo ("</pre>");
        //$this->arrayInfo['cnaeFiltro'] = $filtroCNAE;
        $this->arrayInfo['cnae'] = $arrayCNAE;
        $this->arrayInfo['cnpj'] = $arrayCNPJ;
        
        $this->loadPainel("modifyEmpresa", $this->arrayInfo);
    }
    
    public function editEmpresa($id, $mensagem = "") {
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
                $this->arrayInfo['mensagem'] = $mensagem;
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
        //$this->arrayInfo['filtro'] = $filtro;
        
        $this->loadPainel("editEmpresas", $this->arrayInfo);
    }
    
    private function addPermissao($id_grupo, $idEmpresa, $items, $allItens = array()) {
        $permissao = new Permissao();
        $perItens = new PermissaoItem();
        //$IDEmpresa = $this->user->getIdEmpresa();
        //if (count($allItens) == 0){
        //    $allItens = $perItens->selecionarPermissaoItemIDEmpresa($idEmpresa);
        //}
        
        $verificar = $permissao->selecionarPermissaoIDEmpresa($id_grupo, $idEmpresa);//($IDEmpresa, $id_grupo);
        $itemsVer = array();
        foreach ($verificar as $item){
            $itemsVer[] = $item['id_item'];
        }
        
        //echo ("<pre>");
        foreach ($allItens as $item) {
            $id_item = $item['id'];
            //echo ("<br>Incluir Permissao: ");
            //print_r(in_array($id_item, $itemsVer));
            if (!in_array($id_item, $itemsVer)){
                $permissao->addPermissao($id_grupo, $id_item, '0', $idEmpresa);
                //$perItens->addPermissaoItem($nome, $slug, $idEmpresa);
                //$permissao->addPermissao($id_grupo, $id_item, '1');
            }
        }
        //echo ("<pre>");
        foreach ($allItens as $item) {
            $id_item = $item['id'];
            $slug = $item['slug'];
            //echo ("<br>Editar Permissao: ");
            //print_r(in_array($slug, $items));
            if (in_array($slug, $items)){
                $permissao->editPermissao($id_grupo, $id_item, '1', $idEmpresa);
            } else {
                $permissao->editPermissao($id_grupo, $id_item, '0', $idEmpresa);
            }
        }
        //echo ("</pre>");
    }
    
    private function addPermissaoGrupo($idEmpresa, $allItensAnt = array()) {
        $perGrupo = new PermissaoGrupo();
        $IDEmpresa = $this->user->getIdEmpresa();
        if (count($allItensAnt) == 0){
            $allItensAnt = $perGrupo->selecionarPermissaoGrupoIDEmpresa($IDEmpresa);
        }
        $allItensNew = $perGrupo->selecionarPermissaoGrupoIDEmpresa($idEmpresa);
        $items = [];
        $grupos = $allItensNew;
        foreach ($allItensNew as $item){
            $items[] = $item['nome'];
        }
        echo ("<pre>");
        print_r($allItensNew);
        echo ("</pre>");
        foreach ($allItensAnt as $item) {
            //$slug = $item['slug'];
            $nome = $item['nome'];
            //echo ("<br>in_array: ");
            //print_r(in_array($nome, $items));
            if (!in_array($nome, $items)){
                $GrupoNew = $perGrupo->addPermissaoGrupo($nome, $idEmpresa);
                foreach ($GrupoNew as $value){
                    $grupos[] = $perGrupo->selecionarPermissaoGrupoID(md5($value['ID']));
                }
                //$perItens->addPermissaoItem($nome, $slug, $idEmpresa);
                //$permissao->addPermissao($id_grupo, $id_item, '1');
            }
        }
        echo ("<pre>");
        print_r($grupos);
        echo ("</pre>");
        return $grupos;
    }
    
    private function addItem($idEmpresa, $allItens = array()) {
        //$permissao = new Permissao();
        $perItens = new PermissaoItem();
        $IDEmpresa = $this->user->getIdEmpresa();
        if (count($allItens) == 0){
            $allItens = $perItens->selecionarPermissaoItemIDEmpresa($IDEmpresa);
        }
        
        $items = $perItens->selecionarPermissaoItemSlugs($idEmpresa);
        $itemSlugs = array();
        foreach ($items as $key=>$item){
            $itemSlugs[$key] = $item;
        }
        //echo ("<pre>");
        foreach ($allItens as $item) {
            $slug = $item['slug'];
            $nome = $item['nome'];
            //echo ("<br>in_array: ");
            //print_r(in_array($slug, $items));
            if (!in_array($slug, $items)){
                $itemSlugs[] = $perItens->addPermissaoItem($nome, $slug, $idEmpresa);
                //$permissao->addPermissao($id_grupo, $id_item, '1');
            }
        }
        //echo ("<pre>");
        //print_r($itemSlugs);
        return $itemSlugs;
    }
    
    private function verificarItemPermissao($idHash, $permissoes = array()) {
        $empresa = new Empresa();
        $perItem = new PermissaoItem();
        $perGrupo = new PermissaoGrupo();
        $allItens = $perItem->selecionarPermissaoItemIDEmpresa($this->user->getIdEmpresa());
        $empresa->selecionarEmpresaID($idHash);
        if ($empresa->numRows() > 0){
            $idEmpresa = $empresa->getID();
            $itemSlugs = $this->addItem($idEmpresa, $allItens);
            
            $allItensAnt = $perGrupo->selecionarPermissaoGrupoIDEmpresa($this->user->getIDEmpresa());
            $grupos = $this->addPermissaoGrupo($idEmpresa, $allItensAnt);
            
            $idGrupo = $this->user->getIDGrupo();
            $grupo = $perGrupo->selecionarPermissaoGrupoID(md5($idGrupo));
            $nomes = [];
            foreach ($grupo as $item){
                $nomes[$item['id']] = $item['nome'];
            }
            foreach ($grupos as $grp){
                $id_grupo = $grp['id'];
                $nome = $grp['nome'];
                if (in_array($nome, $nomes)){
                    $idGrupo = $id_grupo;
                }
            }
            //echo ("<pre>");
            //print_r($permissoes);
            //exit();
            $allItensNew = $perItem->selecionarPermissaoItemIDEmpresa($idEmpresa);
            $this->addPermissao($idGrupo, $idEmpresa, $permissoes, $allItensNew);
            
            $idUser = $this->user->getID();
            $this->user->atualizarPermissao(md5($idUser), $idGrupo);
            $mensagem = "Empresa encontrada com sucesso!";
        } else {
            $id_grupo = 0;
            $mensagem = "Empresa nao encontrada, Identificador inValido!";
        }
        return $mensagem;
    }
    
    public function selected($id, $mensagem = "") {
        if (!$this->user->validarPermissao('view_config')){
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
                $mensagem = $this->verificarItemPermissao($id, $this->user->getPermissoes());
                foreach($empresa->result() as $item){
                    $idEmpresa = $item['id'];
                    $nome= $this->user->getNome();
                    $email = $this->user->getEmail();
                    $telefone = $this->user->getTelefone();
                    $idUsuario = $this->user->getID();
                    $this->user->atualizarNomeEmail($idUsuario, $nome, $email, $telefone, $idEmpresa);
                }
                $this->arrayInfo['selectedEmpresa'] = $empresa->result();
                
                $this->arrayInfo['permissao'] = $this->user->getPermissoes();
                $this->arrayInfo['mensagem'] = $mensagem;
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
        //$this->arrayInfo['filtro'] = $filtro;
        $this->arrayInfo['id'] = $id;
        
        $this->loadPainel("editEmpresa", $this->arrayInfo);
    }
}
