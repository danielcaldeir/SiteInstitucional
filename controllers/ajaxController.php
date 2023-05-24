<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ajaxController
 *
 * @author daniel
 */
class ajaxController {
    private $user;
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
            
            //if (!$this->user->validarPermissao('view_config')){
            //    //header("Location: ".BASE_URL."adminLTE");
            //    $filtro = array('permission'=>1);
            //    loginController::login($filtro);
            //    //$adminLTE->index();
            //    exit();
            //}
        } else {
            $login = new loginController();
            $login->index();
            exit();
        }
        //$this->arrayInfo["menuActive"] = "ajax";
        //$this->arrayInfo["nome"] = $this->user;
        //$empresa = new Empresa();
        //$empresa->selecionarEmpresaID($this->user->getIdEmpresa());
        //$this->arrayInfo["empresa"] = $empresa;
        //global $config;
        //$this->config = $config;
        //parent::__construct();
    }
    //put your code here
    public function index($mensagem = "") {
        $data = Array();
        $dt['error'] = ("Nao foi possivel encontrar o metodo!!");
        array_push($data, $dt);
        echo json_encode($data);
    }
    
    private function createFiltroCliente() {
        $IDEmpresa = $this->user->getIdEmpresa();
        $filtro = array();
            $filtro["empresa"] = $IDEmpresa;
            $filtro["FiltroEstrela"] = NULL;
            $filtro["FiltroCEP"] = NULL;
            $filtro["FiltroNome"] = NULL;
            $filtro["FiltroCpfCnpj"] = NULL;
        return $filtro;
    }
    
    private function ajaxOrganizerCliente($arrayCliente = Array()) {
        if (count($arrayCliente) > 0){
            $data = Array();
            foreach ($arrayCliente as $item) {
                $dt['id'] = $item['id'];
                $dt['empresa'] = $item['id_empresa'];
                $dt['cpfCnpj'] = $item['cpf_cnpj'];
                $dt['nome'] = utf8_encode($item['nome']);
                $dt['email'] = $item['email'];
                $dt['telefone'] = $item['telefone'];
                $dt['cidade'] = utf8_encode($item['endereco_cidade']);
                $dt['estado'] = utf8_encode($item['endereco_estado']);
                $dt['pais'] = utf8_encode($item['endereco_pais']);
                $dt['cep'] = $item['endereco_cep'];
                $dt['estrela'] = $item['estrela'];
                $dt['link'] = BASE_URL."clientes/edit/".md5($item['id']);
                //$dt = $item['nome'];
                array_push($data, $dt);
            }
        } else { $data = Array(); }
        return $data;
    }
    
    //private function ajaxOrganizerCPF($arrayCPF = Array()) {
    //    if (count($arrayCPF) > 0){
    //        $data = Array();
    //        foreach ($arrayCPF as $item) {
    //            $dt = $item['cpf_cnpj'];
    //            array_push($data, $dt);
    //        }
    //    } else {
    //        $data = Array();
    //    }
    //    return $data;
    //}
    
    private function xmlOrganizerCliente($arrayCliente = Array()) {
        if (count($arrayCliente) > 0){
            #versao do encoding xml
            $data = new DOMDocument("1.0", "ISO-8859-1");
            #retirar os espacos em branco
            $data->preserveWhiteSpace = false;
            #gerar o codigo
            $data->formatOutput = true;
            #criando o nó principal (root)
            $root = $data->createElement("clientes");
            
            foreach ($arrayCliente as $item) {
                $cliente = $this->addClienteXml($data, $item);
                $root->appendChild($cliente);
            }
            $data->appendChild($root);
        } else { $data = new DOMDocument("1.0", "ISO-8859-1"); }
        return $data;
    }
    
    private function addClienteXml($dom, $itemCliente) {
        #criar contato 
        $cliente = $dom->createElement("cliente");
        $link = BASE_URL."clientes/edit/".md5($itemCliente['id']);
        
        #criando os nós do Cliente 
        $idCliente = $dom->createElement("id", $itemCliente['id']);
        $empresa = $dom->createElement("empresa", $itemCliente['id_empresa']);
        $cpfCnpj = $dom->createElement("cpfCnpj", $itemCliente['cpf_cnpj']);
        $nome = $dom->createElement("nome", utf8_encode($itemCliente['nome']));
        $email = $dom->createElement("email", $itemCliente['email']);
        $telefone = $dom->createElement("telefone", $itemCliente['telefone']);
        $cidade = $dom->createElement("cidade", utf8_encode($itemCliente['endereco_cidade']));
        $estado = $dom->createElement("estado", utf8_encode($itemCliente['endereco_estado']));
        $pais = $dom->createElement("pais", utf8_encode($itemCliente['endereco_pais']));
        $cep = $dom->createElement("cep", $itemCliente['endereco_cep']);
        $estrela = $dom->createElement("estrela", $itemCliente['estrela']);
        $linkCliente = $dom->createElement("link", $link);
        
        #associando ao Cliente
        $cliente->appendChild($idCliente);
        $cliente->appendChild($empresa);
        $cliente->appendChild($cpfCnpj);
        $cliente->appendChild($nome);
        $cliente->appendChild($email);
        $cliente->appendChild($telefone);
        $cliente->appendChild($cidade);
        $cliente->appendChild($estado);
        $cliente->appendChild($pais);
        $cliente->appendChild($cep);
        $cliente->appendChild($estrela);
        $cliente->appendChild($linkCliente);
        
        return $cliente;
    }
    
    public function seachCliente($dataType = 'json') {
        //$IDEmpresa = $this->user->getIdEmpresa();
        //$filtro = array("empresa"=>$IDEmpresa, "FiltroEstrela"=>NULL, "FiltroCEP"=>NULL, "FiltroNome"=>NULL, "FiltroCpfCnpj"=>NULL);
        $cliente = new Clientes();
        $filtro = $this->createFiltroCliente();
        if (isset($_GET['dataType']) && !empty($_GET['dataType'])){
            $dataType = addslashes($_GET['dataType']);
        }
        if (isset($_GET['q']) && !empty($_GET['q'])){
            //$nome = addslashes($_GET['q']);
            //$filtro['FiltroNome'] = $nome;
            $filtro['FiltroNome'] = addslashes($_GET['q']);
            $arrayCliente = $cliente->getClienteNome($filtro,0,10);
            //$data = $this->ajaxOrganizerCliente($arrayCliente);
        }
        if (isset($_GET['term']) && !empty($_GET['term'])){
            //$nome = addslashes($_GET['term']);
            //$filtro['FiltroNome'] = $nome;
            $filtro['FiltroNome'] = addslashes($_GET['term']);
            $arrayCliente = $cliente->getClienteNome($filtro,0,10);
            //$data = $this->ajaxOrganizerCliente($arrayCliente);
        }
        if ($dataType === 'json'){
            $data = $this->ajaxOrganizerCliente($arrayCliente);
            echo json_encode($data);
        } else {
            $data = $this->xmlOrganizerCliente($arrayCliente);
            echo $data->saveXML();
        }
    }
    
    public function seachClienteCPF($dataType = 'json') {
        //$IDEmpresa = $this->user->getIdEmpresa();
        //$filtro = array("empresa"=>$IDEmpresa, "FiltroEstrela"=>NULL, "FiltroCEP"=>NULL, "FiltroNome"=>NULL, "FiltroCpfCnpj"=>NULL);
        $cliente = new Clientes();
        $filtro = $this->createFiltroCliente();
        if (isset($_GET['dataType']) && !empty($_GET['dataType'])){
            $dataType = addslashes($_GET['dataType']);
        }
        if (isset($_GET['cpf']) && !empty($_GET['cpf'])){
            //$nome = addslashes($_GET['cpf']);
            //$filtro['FiltroCpfCnpj'] = $nome;
            $filtro['FiltroCpfCnpj'] = addslashes($_GET['cpf']);
            $arrayCPF = $cliente->getClienteNome($filtro,0,10);
            //$data = $this->ajaxOrganizerCPF($arrayCPF);
            //$data = $this->ajaxOrganizerCliente($arrayCPF);
        }
        if (isset($_GET['term']) && !empty($_GET['term'])){
            //$nome = addslashes($_GET['term']);
            //$filtro['FiltroCpfCnpj'] = $nome;
            $filtro['FiltroCpfCnpj'] = addslashes($_GET['term']);
            $arrayCPF = $cliente->getClienteNome($filtro,0,10);
            //$data = $this->ajaxOrganizerCPF($arrayCPF);
            //$data = $this->ajaxOrganizerCliente($arrayCPF);
        }
        if ($dataType === 'json') {
            $data = $this->ajaxOrganizerCliente($arrayCPF);
            echo json_encode($data);
        } else {
            $data = $this->xmlOrganizerCliente($arrayCPF);
            echo $data->saveXML();
        }
        
    }
    
    private function createFiltroProduto() {
        $IDEmpresa = $this->user->getIdEmpresa();
        $filtro = array();
            $filtro["empresa"] = $IDEmpresa;
            $filtro["categoria"] = NULL;
            $filtro["marca"] = NULL;
            $filtro["nome"] = NULL;
            $filtro["descricao"] = NULL;
        return $filtro;
    }
    
    private function ajaxOrganizerProduto($arrayProduto = Array()) {
        if (count($arrayProduto) > 0){
            $data = Array();
            foreach ($arrayProduto as $item) {
                $dt['id'] = $item['id'];
                $dt['empresa'] = $item['id_empresa'];
                $dt['categoria'] = $item['id_categoria'];
                $dt['marca'] = $item['id_marca'];
                $dt['nome'] = utf8_encode($item['nome']);
                //$dt['descricao'] = $item['descricao'];
                $dt['quant'] = $item['quant'];
                $dt['min_quant'] = utf8_encode($item['min_quant']);
                $dt['preco'] = utf8_encode($item['preco']);
                $dt['preco_ant'] = utf8_encode($item['preco_ant']);
                $dt['peso'] = $item['peso'];
                $dt['altura'] = $item['altura'];
                $dt['largura'] = $item['largura'];
                $dt['comprimento'] = $item['comprimento'];
                $dt['diametro'] = $item['diametro'];
                $dt['marca_nome'] = utf8_encode($item['marca_nome']);
                $dt['categoria_nome'] = utf8_encode($item['categoria_nome']);
                $dt['link'] = BASE_URL."produto/edit/".md5($item['id']);
                //$dt = $item['nome'];
                array_push($data, $dt);
            }
        } else { $data = Array(); }
        return $data;
    }
    
    private function xmlOrganizerProduto($arrayProduto = Array()) {
        if (count($arrayProduto) > 0){
            #versao do encoding xml
            $data = new DOMDocument("1.0", "ISO-8859-1");
            #retirar os espacos em branco
            $data->preserveWhiteSpace = false;
            #gerar o codigo
            $data->formatOutput = true;
            #criando o nó principal (root)
            $root = $data->createElement("produtos");
            
            foreach ($arrayProduto as $item) {
                $produto = $this->addProdutoXml($data, $item);
                $root->appendChild($produto);
            }
            $data->appendChild($root);
        } else { $data = new DOMDocument("1.0", "ISO-8859-1"); }
        return $data;
    }
    
    private function addProdutoXml($dom, $itemProduto) {
        #criar contato 
        $produto = $dom->createElement("produto");
        $link = BASE_URL."produto/edit/".md5($itemProduto['id']);
        
        #criando os nós do Produto 
        $idCliente = $dom->createElement("id", $itemProduto['id']);
        $empresa = $dom->createElement("empresa", $itemProduto['id_empresa']);
        $categoria = $dom->createElement("categoria", $itemProduto['id_categoria']);
        $marca = $dom->createElement("marca", $itemProduto['id_marca']);
        $nome = $dom->createElement("nome", utf8_encode($itemProduto['nome']));
        //$descricao = $dom->createElement("descricao", utf8_encode($itemProduto['descricao']));
        $quant = $dom->createElement("quant", $itemProduto['quant']);
        $min_quant = $dom->createElement("min_quant", $itemProduto['min_quant']);
        $preco = $dom->createElement("preco", utf8_encode($itemProduto['preco']));
        $preco_ant = $dom->createElement("preco_ant", utf8_encode($itemProduto['preco_ant']));
        $peso = $dom->createElement("peso", utf8_encode($itemProduto['peso']));
        $altura = $dom->createElement("altura", $itemProduto['altura']);
        $largura = $dom->createElement("largura", $itemProduto['largura']);
        $comprimento = $dom->createElement("comprimento", ($itemProduto['comprimento']));
        $diametro = $dom->createElement("diametro", ($itemProduto['diametro']));
        $marca_nome = $dom->createElement("marca_nome", utf8_encode($itemProduto['marca_nome']));
        $categoria_nome = $dom->createElement("categoria_nome", utf8_encode($itemProduto['categoria_nome']));
        $linkProduto = $dom->createElement("link", $link);
        
        #associando ao Produto
        $produto->appendChild($idCliente);
        $produto->appendChild($empresa);
        $produto->appendChild($categoria);
        $produto->appendChild($marca);
        $produto->appendChild($nome);
        //$produto->appendChild($descricao);
        $produto->appendChild($quant);
        $produto->appendChild($min_quant);
        $produto->appendChild($preco);
        $produto->appendChild($preco_ant);
        $produto->appendChild($peso);
        $produto->appendChild($altura);
        $produto->appendChild($largura);
        $produto->appendChild($comprimento);
        $produto->appendChild($diametro);
        $produto->appendChild($marca_nome);
        $produto->appendChild($categoria_nome);
        $produto->appendChild($linkProduto);
        
        return $produto;
    }
    
    public function seachProduto($dataType = 'json') {
        //$IDEmpresa = $this->user->getIdEmpresa();
        $produto = new Produtos();
        $filtro = $this->createFiltroProduto();
        if (isset($_GET['dataType']) && !empty($_GET['dataType'])){
            $dataType = addslashes($_GET['dataType']);
        }
        if (isset($_GET['q']) && !empty($_GET['q'])){
            //$nome = addslashes($_GET['q']);
            //$filtro['FiltroNome'] = $nome;
            $filtro['nome'] = addslashes($_GET['q']);
            $arrayProduto = $produto->getAllProdutos($filtro,0,10);
            //$data = $this->ajaxOrganizerProduto($arrayProduto);
        }
        if (isset($_GET['term']) && !empty($_GET['term'])){
            //$nome = addslashes($_GET['term']);
            //$filtro['FiltroNome'] = $nome;
            $filtro['nome'] = addslashes($_GET['term']);
            $arrayProduto = $produto->getAllProdutos($filtro,0,10);
            //$data = $this->ajaxOrganizerProduto($arrayProduto);
        }
        if ($dataType === 'json') {
            $data = $this->ajaxOrganizerProduto($arrayProduto);
            echo json_encode($data);
        } else {
            $data = $this->xmlOrganizerProduto($arrayProduto);
            echo $data->saveXML();
        }
    }
    
    public function addCliente() {
        $cliente = new Clientes();
        $IDEmpresa = $this->user->getIdEmpresa();
        if (isset($_POST['nome']) && !empty($_POST['nome'])){
            $nome = addslashes($_POST['nome']);
            $cpfCnpj = addslashes($_POST['cpfCnpj']);
            $array = $cliente->incluirCliente($IDEmpresa, $cpfCnpj, $nome);
            foreach ($array as $item) {
                $idCliente = $item['ID'];
            }
            $arrayCliente = $cliente->selecionarClienteID(md5($idCliente));
            $dados = $this->ajaxOrganizerCliente($arrayCliente);
        }
        echo json_encode($dados);
    }
    
    private function createFiltroMunicipio() {
        $filtro = array();
            $filtro["FiltroCodigoUf"] = NULL;
            $filtro["FiltroCodigo"] = NULL;
            $filtro["FiltroNome"] = NULL;
            $filtro["FiltroUf"] = NULL;
        return $filtro;
    }
    
    private function ajaxOrganizerMunicipio($arrayMunicipio = Array()) {
        if (count($arrayMunicipio) > 0){
            $data = Array();
            foreach ($arrayMunicipio as $item) {
                $dt['id'] = $item['id'];
                $dt['CodigoUf'] = $item['CodigoUf'];
                $dt['Codigo'] = $item['Codigo'];
                $dt['Nome'] = utf8_encode($item['Nome']);
                $dt['Uf'] = $item['Uf'];
                //$dt = $item['nome'];
                array_push($data, $dt);
            }
        } else { $data = Array(); }
        return $data;
    }
    
    private function xmlOrganizerMunicipio($arrayMunicipio = Array()) {
        if (count($arrayMunicipio) > 0){
            #versao do encoding xml
            $data = new DOMDocument("1.0", "ISO-8859-1");
            #retirar os espacos em branco
            $data->preserveWhiteSpace = false;
            #gerar o codigo
            $data->formatOutput = true;
            #criando o nó principal (root)
            $root = $data->createElement("clientes");
            
            foreach ($arrayMunicipio as $item) {
                $municipio = $this->addMunicipioXml($data, $item);
                $root->appendChild($municipio);
            }
            $data->appendChild($root);
        } else { $data = new DOMDocument("1.0", "ISO-8859-1"); }
        return $data;
    }
    
    private function addMunicipioXml($dom, $itemMunicipio) {
        #criar contato 
        $municipio = $dom->createElement("municipio");
        //$link = BASE_URL."clientes/edit/".md5($itemMunicipio['id']);
        
        #criando os nós do Cliente 
        $idMunicipio = $dom->createElement("id", $itemMunicipio['id']);
        $CodigoUf = $dom->createElement("CodigoUf", $itemMunicipio['CodigoUf']);
        $Codigo = $dom->createElement("Codigo", $itemMunicipio['Codigo']);
        $Nome = $dom->createElement("Nome", ($itemMunicipio['Nome']));
        $Uf = $dom->createElement("Uf", $itemMunicipio['Uf']);
        
        #associando ao Cliente
        $municipio->appendChild($idMunicipio);
        $municipio->appendChild($CodigoUf);
        $municipio->appendChild($Codigo);
        $municipio->appendChild($Nome);
        $municipio->appendChild($Uf);
        
        return $municipio;
    }
    
    public function seachCidades($dataType = 'json') {
        //$IDEmpresa = $this->user->getIdEmpresa();
        //$filtro = array("empresa"=>$IDEmpresa, "FiltroEstrela"=>NULL, "FiltroCEP"=>NULL, "FiltroNome"=>NULL, "FiltroCpfCnpj"=>NULL);
        $municipio = new Municipio();
        $filtro = $this->createFiltroMunicipio();
        if (isset($_GET['dataType']) && !empty($_GET['dataType'])){
            $dataType = addslashes($_GET['dataType']);
        }
        if (isset($_GET['q']) && !empty($_GET['q'])){
            //$codigoUF = addslashes($_GET['q']);
            //$filtro['FiltroCodigoUf'] = $codigoUF;
            $filtro['FiltroCodigoUf'] = addslashes($_GET['q']);
            $arrayMunicipio = $municipio->getMunicipio($filtro);
            //$data = $this->ajaxOrganizerMunicipio($arrayMunicipio);
        }
        if (isset($_GET['term']) && !empty($_GET['term'])){
            //$codigoUF = addslashes($_GET['term']);
            //$filtro['FiltroCodigoUf'] = $codigoUF;
            $filtro['FiltroCodigoUf'] = addslashes($_GET['term']);
            $arrayMunicipio = $municipio->getMunicipio($filtro);
            //$data = $this->ajaxOrganizerMunicipio($arrayMunicipio);
        }
        if ($dataType === 'json'){
            $data = $this->ajaxOrganizerMunicipio($arrayMunicipio);
            echo json_encode($data);
        } else {
            $data = $this->xmlOrganizerMunicipio($arrayMunicipio);
            echo $data->saveXML();
        }
    }
    
    private function createFiltroCnae() {
        $filtro = array();
            $filtro["secao"] = NULL;
            $filtro["divisao"] = NULL;
            $filtro["grupo"] = NULL;
            $filtro["classe"] = NULL;
        return $filtro;
    }
    
    private function ajaxOrganizerCnae($arrayCnae = Array()) {
        if (count($arrayCnae) > 0){
            $data = Array();
            foreach ($arrayCnae as $item) {
                $dt['id'] = $item['id'];
                $dt['secao'] = $item['secao'];
                $dt['divisao'] = $item['divisao'];
                $dt['grupo'] = $item['grupo'];
                $dt['classe'] = $item['classe'];
                $dt['descricao'] = utf8_encode($item['descricao']);
                //$dt = $item['nome'];
                array_push($data, $dt);
            }
        } else { $data = Array(); }
        return $data;
    }
    
    private function xmlOrganizerCnae($arrayCnae = Array()) {
        if (count($arrayCnae) > 0){
            #versao do encoding xml
            $data = new DOMDocument("1.0", "ISO-8859-1");
            #retirar os espacos em branco
            $data->preserveWhiteSpace = false;
            #gerar o codigo
            $data->formatOutput = true;
            #criando o nó principal (root)
            $root = $data->createElement("cnaes");
            
            foreach ($arrayCnae as $item) {
                $cnae = $this->addCnaeXml($data, $item);
                $root->appendChild($cnae);
            }
            $data->appendChild($root);
        } else { $data = new DOMDocument("1.0", "ISO-8859-1"); }
        return $data;
    }
    
    private function addCnaeXml($dom, $itemCnae) {
        #criar contato 
        $cnae = $dom->createElement("cnae");
        //$link = BASE_URL."clientes/edit/".md5($itemMunicipio['id']);
        
        #criando os nós do Cliente 
        $idCnae = $dom->createElement("id", $itemCnae['id']);
        $secao = $dom->createElement("Secao", $itemCnae['secao']);
        $divisao = $dom->createElement("Divisao", $itemCnae['divisao']);
        $grupo = $dom->createElement("Grupo", $itemCnae['grupo']);
        $classe = $dom->createElement("Classe", $itemCnae['classe']);
        $descricao = $dom->createElement("Descricao", ($itemCnae['descricao']));
        
        
        #associando ao Cliente
        $cnae->appendChild($idCnae);
        $cnae->appendChild($secao);
        $cnae->appendChild($divisao);
        $cnae->appendChild($grupo);
        $cnae->appendChild($classe);
        $cnae->appendChild($descricao);
        
        return $cnae;
    }
    
    public function seachCnaes($dataType = 'json') {
        //$IDEmpresa = $this->user->getIdEmpresa();
        //$filtro = array("empresa"=>$IDEmpresa, "FiltroEstrela"=>NULL, "FiltroCEP"=>NULL, "FiltroNome"=>NULL, "FiltroCpfCnpj"=>NULL);
        $cnae = new Cnae();
        $filtro = $this->createFiltroCnae();
        if (isset($_GET['dataType']) && !empty($_GET['dataType'])){
            $dataType = addslashes($_GET['dataType']);
        }
        if (isset($_GET['secao']) && !empty($_GET['secao'])){
            $filtro['secao'] = addslashes($_GET['secao']);
            //$arrayCnae = $cnae->getFiltroDivisao($filtro);
        }
        if (isset($_GET['divisao']) && !empty($_GET['divisao'])){
            //$filtro['secao'] = addslashes($_GET['secao']);
            $filtro['divisao'] = addslashes($_GET['divisao']);
            //$arrayCnae = $cnae->getFiltroGrupo($filtro);
        }
        if (isset($_GET['grupo']) && !empty($_GET['grupo'])){
            //$filtro['secao'] = addslashes($_GET['secao']);
            //$filtro['divisao'] = addslashes($_GET['divisao']);
            $filtro['grupo'] = addslashes($_GET['grupo']);
            //$arrayCnae = $cnae->getFiltroClasse($filtro);
        }
        if (is_null($filtro['divisao'])){
            $arrayCnae = $cnae->getFiltroDivisao($filtro);
        } else {
            if (is_null($filtro['grupo'])){
                $arrayCnae = $cnae->getFiltroGrupo($filtro);
            } else {
                if (is_null($filtro['classe'])){
                    $arrayCnae = $cnae->getFiltroClasse($filtro);
                }
            }
        }
        
        if ($dataType === 'json'){
            $data = $this->ajaxOrganizerCnae($arrayCnae);
            echo json_encode($data);
        } else {
            $data = $this->xmlOrganizerCnae($arrayCnae);
            echo $data->saveXML();
        }
    }
}
