<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config
 *
 * @author Daniel_Caldeira
 */
class Config extends Model{
    private $id;
    private $nome;
    private $valor;
    
    
    //put your code here
    
    public function selecionarConfigID($id){
        $tabela = "config";
        $colunas = array ("id", "nome", "valor");
        $where = array();
            $where["id"] = $id;
        //);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            foreach ($array as $item) {
                $this->id = $item['id'];
                $this->nome = $item['nome'];
                $this->email = $item['valor'];
            }
        } else{
            $array = array();
        }
        return $array;
    }
    
    public function selecionarALLConfig($where = array()){
        $tabela = "config";
        $colunas = array ("id", "nome", "valor");
        $where_cond = "AND";
        $groupBy = array();
        $this->selectTable($tabela, $colunas, $where, $where_cond, $groupBy);
        if($this->numRows() > 0){
            $array = $this->result();
        } else {
            $array = array();
        }
        return $array;
    }
    
    public function setConfigPropriedade($nome, $valor){
        $tabela = "config";
        $dados = array ();
            $dados["valor"] = $valor;
        //);
        $where = array ();
            $where["nome"] = $nome;
        //);
        
        $this->update($tabela, $dados, $where);
    }
    
    public function setID($id) {
        $this->id = $id;
    }
    public function getID() {
        return $this->id;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function getNome() {
        return $this->nome;
    }
    
    public function setValor($valor) {
        $this->valor = $valor;
    }
    public function getValor() {
        return $this->valor;
    }
}
