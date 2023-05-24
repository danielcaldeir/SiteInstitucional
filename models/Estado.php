<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Estado
 *
 * @author daniel
 */
class Estado extends Model{
    private $id;
    private $CodigoUf;
    private $Nome;
    private $Uf;
    private $Regiao;
    
    private function incluirElementos($elementos = array()) {
        if (count($elementos) == 1){
            foreach ($elementos as $item) {
                $this->id = $item['id'];
                $this->CodigoUf = $item['CodigoUf'];
                $this->Nome = $item['Nome'];
                $this->Uf = $item['Uf'];
                $this->Regiao = $item['Regiao'];
            }
        }
    }
    //put your code here
    
    public function inserirEstado($CodigoUf, $Nome, $Uf, $Regiao) {
        $tabela = "estado";
        $dados = array();
            $dados['CodigoUf'] = $CodigoUf;
            $dados['Nome'] = $Nome;
            $dados['Uf'] = $Uf;
            $dados['Regiao'] = $Regiao;
        //);
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->result();
    }
    
    public function selecionarEstadoCodigoUf($CodigoUf) {
        $tabela = "estado";
        $colunas = array("id","CodigoUf","Nome","Uf","Regiao");
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
    
    public function selecionarEstadoRegiao($Regiao) {
        $tabela = "estado";
        $colunas = array("id","CodigoUf","Nome","Uf","Regiao");
        $where = array();
            $where["Regiao"] = $Regiao;
        //);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else { $array = array(); }
        return $array;
    }
    
    public function selecionarEstadoID($id) {
        $tabela = "estado";
        $colunas = array ("id","CodigoUf","Nome","Uf","Regiao");
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
    
    public function selecionarALLEstado($where = array()) {
        $tabela = "estado";
        $colunas = array ("id","CodigoUf","Nome","Uf","Regiao");
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else{
            $array = array();
        }
        return $array;
    }
    
    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    
    public function setCodigoUf($CodigoUf) { $this->CodigoUf = $CodigoUf; }
    public function getCodigoUf() { return $this->CodigoUf; }
    
    public function setNome($Nome) { $this->Nome = $Nome; }
    public function getNome() { return $this->Nome; }
    
    public function setUf($Uf) { $this->Uf = $Uf; }
    public function getUf() { return $this->Uf; }
    
    public function setRegiao($Regiao) { $this->Regiao = $Regiao; }
    public function getRegiao() { return $this->Regiao; }
}
