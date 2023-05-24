<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Municipio
 *
 * @author daniel
 */
class Municipio extends Model{
    private $id;
    private $CodigoUf;
    private $Codigo;
    private $Nome;
    private $Uf;
    
    private function incluirElementos($elementos = array()) {
        if (count($elementos) == 1){
            foreach ($elementos as $item) {
                $this->id = $item['id'];
                $this->CodigoUf = $item['CodigoUf'];
                $this->Codigo = $item['Codigo'];
                $this->Nome = $item['Nome'];
                $this->Uf = $item['Uf'];
            }
        }
    }
    //put your code here
    
    public function inserirMunicipio($CodigoUf, $Codigo, $Nome, $Uf) {
        $tabela = "municipio";
        $dados = array();
            $dados['CodigoUf'] = $CodigoUf;
            $dados['Codigo'] = $Codigo;
            $dados['Nome'] = $Nome;
            $dados['Uf'] = $Uf;
        //);
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->result();
    }
    
    public function selecionarALLMunicipio($where = array()) {
        $tabela = "municipio";
        $colunas = array ("id","CodigoUf","Codigo","Nome","Uf");
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else{
            $array = array();
        }
        return $array;
    }
    
    public function selecionarMunicipioCodigoUf($CodigoUf) {
        $tabela = "municipio";
        $colunas = array("id","CodigoUf","Codigo","Nome","Uf");
        $where = array();
            $where["CodigoUf"] = $CodigoUf;
        //);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else{
            $array = array();
        }
        return $array;
    }
    
    public function selecionarMunicipioCodigo($Codigo) {
        $tabela = "municipio";
        $colunas = array("id","CodigoUf","Codigo","Nome","Uf");
        $where = array();
            $where["Codigo"] = $Codigo;
        //);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else { $array = array(); }
        return $array;
    }
    
    public function selecionarMunicipioID($id) {
        $tabela = "municipio";
        $colunas = array ("id","CodigoUf","Codigo","Nome","Uf");
        $where = array();
            $where["id"] = $id;
        //);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
            //foreach ($array as $item) {
            //    $this->id = $item['id'];
            //    $this->id_compra = $item['id_compra'];
            //    $this->id_produto = $item['id_produto'];
            //    $this->quantidade = $item['quantidade'];
            //    $this->preco = $item['preco'];
            //}
        } else {
            $array = array();
        }
        return $array;
    }
    
    //private function createFiltroMunicipio() {
    //    $filtro = array();
    //        $filtro["FiltroCodigoUf"] = NULL;
    //        $filtro["FiltroCodigo"] = NULL;
    //        $filtro["FiltroNome"] = NULL;
    //        $filtro["FiltroUf"] = NULL;
    //    return $filtro;
    //}
    
    private function organizarFiltro($filtro = array()) {
        if (!is_null($filtro['FiltroCodigoUf'])){ $filtro['CodigoUf'] = $filtro['FiltroCodigoUf']; }
        if (!is_null($filtro['FiltroCodigo'])) { $filtro['Codigo'] = $filtro['FiltroCodigo']; }
        if (!is_null($filtro['FiltroUf'])){ $filtro['Uf'] = $filtro['FiltroUf']; }
        if (!is_null($filtro['FiltroNome'])){
            $chave = array();
            $chave['LIKE'] = $filtro['FiltroNome'];
            $filtro['Nome'] = $chave;
        }
        unset($filtro['FiltroCodigoUf']);
        unset($filtro['FiltroCodigo']);
        unset($filtro['FiltroUf']);
        unset($filtro['FiltroNome']);
        return $filtro;
    }
    
    public function getMunicipio($filtro = array()) {
        $where = $this->organizarFiltro($filtro);
        return $this->selecionarALLMunicipio($where);
    }
    
    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    
    public function setCodigoUf($CodigoUf) { $this->CodigoUf = $CodigoUf; }
    public function getCodigoUf() { return $this->CodigoUf; }
    
    public function setCodigo($Codigo) { $this->Codigo = $Codigo; }
    public function getCodigo() { return $this->Codigo; }
    
    public function setNome($Nome) { $this->Nome = $Nome; }
    public function getNome() { return $this->Nome; }
    
    public function setUf($Uf) { $this->Uf = $Uf; }
    public function getUf() { return $this->Uf; }
}
