<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Empresa
 *
 * @author daniel
 */
class Empresa extends Model{
    private $id;
    private $cpf_cnpj;
    private $dt_fundacao;
    private $nome;
    private $nfe_numero;
    private $razao_social;
    private $ie;
    private $iest;
    private $im;
    private $cnae;
    private $regime;
    private $endereco;
    private $endereco_numero;
    private $endereco_adicional;
    private $endereco_bairro;
    private $endereco_cidade;
    private $endereco_estado;
    private $endereco_pais;
    private $endereco_cep;
    
    private function incluirElementos($elementos = array()) {
        if (count($elementos) == 1){
            foreach ($elementos as $item) {
                $this->setID($item['id']);
                $this->setCpfCnpj($item['cpf_cnpj']);
                $this->setDTFundacao($item['dt_fundacao']);
                $this->setNome($item['nome']);
                $this->setNfeNumero($item['nfe_numero']);
                $this->setRazaoSocial($item['razao_social']);
                $this->setIE($item['ie']);
                $this->setIEST($item['iest']);
                $this->setIM($item['im']);
                $this->setCNAE($item['cnae']);
                $this->setRegime($item['regime']);
                $this->setEndereco($item['endereco']);
                $this->setEnderecoNumero($item['endereco_numero']);
                $this->setEnderecoAdicional($item['endereco_adicional']);
                $this->setEnderecoBairro($item['endereco_bairro']);
                $this->setEnderecoCidade($item['endereco_cidade']);
                $this->setEnderecoEstado($item['endereco_estado']);
                $this->setEnderecoPais($item['endereco_pais']);
                $this->setEnderecoCEP($item['endereco_cep']);
            }
        }
    }
    //put your code here
    public function selecionarALLEmpresa($where = array()){
        $tabela = "empresa as emp";
        $colunas = array("id","cpf_cnpj","dt_fundacao","nome","nfe_numero","razao_social","ie","iest","im","cnae",
            "regime","endereco","endereco_numero","endereco_adicional","endereco_bairro","endereco_cidade",
            "endereco_estado","endereco_pais","endereco_cep");
        //$where_cond = "AND";
        //$groupBy = array();
        //$this->selectTable($tabela, $colunas, $where, $where_cond, $groupBy);
        $this->selectTable($tabela, $colunas, $where);
        if($this->numRows() > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else {
            $array = array();
        }
        return $array;
    }
    
    public function delEmpresaID($id) {
        $tabela = "empresa";
        $where = array ();
            $where["id"] = $id;
        $this->delete($tabela, $where);
        return null;    
    }
    
    public function selecionarEmpresaID($id) {
        $where = array();
        $where["md5(id)"] = $id;
        return $this->selecionarALLEmpresa($where);
        //$tabela = "empresa";
        //$colunas = array("id","cpf_cnpj","dt_fundacao","nome","nfe_numero","razao_social","ie","iest","im","cnae",
        //    "regime","endereco","endereco_numero","endereco_adicional","endereco_bairro","endereco_cidade",
        //    "endereco_estado","endereco_pais","endereco_cep");
        //$where = array();
        //    $where["id"] = $id;
        //$this->selectTable($tabela, $colunas, $where);
        //if ($this->numRows > 0){
        //    $array = $this->result();
        //    $this->incluirElementos($array);
        //} else{
        //    $array = array();
        //}
        //return $array;
    }
    
    public function selecionarEmpPagination($where = array(), $offset = 0, $limit = 20){
        $tabela = "empresa as emp LEFT JOIN cnae ON cnae.classe = emp.cnae";
        $colunas = array ("emp.id", "emp.cpf_cnpj", "emp.dt_fundacao", "emp.nome", "emp.nfe_numero", 
            "emp.razao_social", "emp.cnae", "emp.regime", "emp.endereco","emp.endereco_numero", 
            "emp.endereco_adicional", "emp.endereco_bairro", "emp.endereco_cidade", "emp.endereco_estado", 
            "emp.endereco_pais", "emp.endereco_cep", "emp.ie", "emp.iest", "emp.im", "cnae.descricao"
        );
        //array("id","cpf_cnpj","dt_fundacao","nome","nfe_numero","razao_social","ie","iest","im","cnae",
        //    "regime","endereco","endereco_numero","endereco_adicional","endereco_bairro","endereco_cidade",
        //    "endereco_estado","endereco_pais","endereco_cep");
        $where_cond = "AND";
        $groupBy = array("ORDER BY emp.dt_fundacao DESC, emp.nome ASC", "LIMIT $offset, $limit");
        $this->selectTable($tabela, $colunas, $where, $where_cond, $groupBy);
        if($this->numRows() > 0){
            $array = $this->result();
        } else {
            $array = array();
        }
        return $array;
    }
    
    private function organizarFiltro($filtro = array()) {
        //if (!is_null($filtro['empresa'])){ $filtro['user.id_empresa'] = $filtro['empresa']; }
        if (!is_null($filtro['cnpj'])) { $filtro['emp.cpf_cnpj'] = $filtro['cnpj']; }
        if (!is_null($filtro['regime'])){ $filtro['emp.regime'] = $filtro['regime']; }
        if (!is_null($filtro['cnae'])){ $filtro['emp.cnae'] = $filtro['cnae']; }
        if (!is_null($filtro['status'])){ $filtro['emp.status'] = $filtro['status']; }
        if (!is_null($filtro['nome'])){
            $chave = array();
            $chave['LIKE'] = $filtro['nome'];
            $filtro['emp.nome'] = $chave;
        }
        //if (!is_null($filtro['email'])){
        //    $chave = array();
        //    $chave['LIKE'] = $filtro['email'];
        //    $filtro['user.email'] = $chave;
        //}
        //unset($filtro['empresa']);
        unset($filtro['cnpj']);
        unset($filtro['regime']);
        unset($filtro['cnae']);
        unset($filtro['nome']);
        unset($filtro['status']);
        //unset($filtro['email']);
        return $filtro;
    }
    
    public function getTotalEmpresa($filtro = array()) {
        $where = $this->organizarFiltro($filtro);
        return $this->selecionarALLEmpresa($where);
    }
    
    public function getAllEmpresa($filtro = array(),  $offset = 0, $limit = 20){ //$where = array()) {
        $where = $this->organizarFiltro($filtro);
        return $this->selecionarEmpPagination($where, $offset, $limit);
        //$tabela = "empresa";
        //$colunas = array("id","cpf_cnpj","dt_fundacao","nome","nfe_numero","razao_social","ie","iest","im","cnae",
        //    "regime","endereco","endereco_numero","endereco_adicional","endereco_bairro","endereco_cidade",
        //    "endereco_estado","endereco_pais","endereco_cep");
        //$this->selectTable($tabela, $colunas, $where);
        //if ($this->numRows > 0){
        //    $array = $this->result();
        //    $this->incluirElementos($array);
        //} else{
        //    $array = array();
        //}
        //return $array;
    }
    
    public function addEmpresa($CpfCnpj,$nome,$razao = null,$DTFundacao=null,$cnae = null,$regime = null) {
        $tabela = "empresa";
        $dados = array ();
            $dados["cpf_cnpj"] = $CpfCnpj;
            $dados["nome"] = $nome;
            $dados["razao_social"] = $razao;
            $dados["dt_fundacao"] = $DTFundacao;
            $dados["cnae"] = $cnae;
            $dados["regime"]= $regime;
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->result();
    }
    
    public function editEmpresa($id, $CpfCnpj,$nome,$razao = null,$DTFundacao=null,$cnae = null,$regime = null) {
        $tabela = "empresa";
        $dados = array ();
            $dados["cpf_cnpj"] = $CpfCnpj;
            $dados["nome"] = $nome;
            $dados["razao_social"] = $razao;
            $dados["dt_fundacao"] = $DTFundacao;
            $dados["cnae"] = $cnae;
            $dados["regime"]= $regime;
        $where = array();
            $where["id"] = $id;
        $this->update($tabela, $dados, $where);
    }
    
    public function editEmpEndereco($id, $CEP,$endereco,$numero = null,$adicional=null,$bairro = null,$estado = null,$cidade=null,$pais=null) {
        $tabela = "empresa";
        $dados = array ();
            $dados["endereco_cep"] = $CEP;
            $dados["endereco"] = $endereco;
            $dados["endereco_numero"] = $numero;
            $dados["endereco_adicional"] = $adicional;
            $dados["endereco_bairro"] = $bairro;
            $dados["endereco_cidade"]= $cidade;
            $dados["endereco_estado"]= $estado;
            $dados["endereco_pais"]= $pais;
        $where = array();
            $where["id"] = $id;
        $this->update($tabela, $dados, $where);
    }
    
    public function addNfeNumero($id, $nfe_numero) {
        $tabela = "empresa";
        $dados = array ();
            $dados["nfe_numero"] = $nfe_numero;
        $where = array();
            $where["id"] = $id;
        $this->update($tabela, $dados, $where);
    }
    
    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    
    public function setCpfCnpj($cpf_cnpj) { $this->cpf_cnpj = $cpf_cnpj; }
    public function getCpfCnpj() { return $this->cpf_cnpj; }
    
    public function setDTFundacao($dt_fundacao) { $this->dt_fundacao = $dt_fundacao; }
    public function getDTFundacao() {
        $data = new DateTime($this->dt_fundacao);
        return $data->format('Y-m-d');
        
    }
    
    public function setNome($nome) { $this->nome = $nome; }
    public function getNome() { return $this->nome; }
    
    public function setNfeNumero($nfe_numero) { $this->nfe_numero = $nfe_numero; }
    public function getNfeNumero() { return $this->nfe_numero; }
    
    public function setRazaoSocial($razaoSocial) { $this->razao_social = $razaoSocial; }
    public function getRazaoSocial() { return $this->razao_social; }
    
    public function setIE($ie) { $this->ie = $ie; }
    public function getIE() { return $this->ie; }
    
    public function setIEST($iest) { $this->iest = $iest; }
    public function getIEST() { return $this->iest; }
    
    public function setIM($im) { $this->im = $im; }
    public function getIM() { return $this->im; }
    
    public function setCNAE($cnae) { $this->cnae = $cnae; }
    public function getCNAE() { return $this->cnae; }
    
    public function setRegime($regime) { $this->regime = $regime; }
    public function getRegime() { return $this->regime; }
    
    public function setEndereco($endereco) { $this->endereco = $endereco; }
    public function getEndereco() { return $this->endereco; }
    
    public function setEnderecoNumero($endereco_numero) { $this->endereco_numero = $endereco_numero; }
    public function getEnderecoNumero() { return $this->endereco_numero; }
    
    public function setEnderecoAdicional($endereco_adicional) { $this->endereco_adicional = $endereco_adicional; } 
    public function getEnderecoAdicional() { return $this->endereco_adicional; }
    
    public function setEnderecoBairro($endereco_bairro) { $this->endereco_bairro = $endereco_bairro; } 
    public function getEnderecoBairro() { return $this->endereco_bairro; }
    
    public function setEnderecoCidade($endereco_cidade) { $this->endereco_cidade = $endereco_cidade; }
    public function getEnderecoCidade() { return $this->endereco_cidade; }
    
    public function setEnderecoEstado($endereco_estado) { $this->endereco_estado = $endereco_estado; } 
    public function getEnderecoEstado() { return $this->endereco_estado; }
    
    public function setEnderecoPais($endereco_pais) { $this->endereco_pais = $endereco_pais; }
    public function getEnderecoPais() { return $this->endereco_pais; }
    
    public function setEnderecoCEP($endereco_cep) { $this->endereco_cep = $endereco_cep; }
    public function getEnderecoCEP() { return $this->endereco_cep; }
}
