<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Depoimentos
 *
 * @author daniel
 */
class Depoimentos extends Model{
    private $id;
    private $nome;
    private $texto;
    
    private function incluirElementos($elementos = array()) {
        if (count($elementos) == 1){
            foreach ($elementos as $item) {
                $this->setID($item['id']);
                $this->setNome($item['nome']);
                $this->setTexto($item['texto']);
            }
        }
    }
    //put your code here
    
    public function selecionarDepoimentosID($id){
        $tabela = "depoimentos";
        $colunas = array ("id", "nome", "texto");
        $where = array();
            $where["id"] = $id;
        //);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
            //foreach ($array as $item) {
            //    $this->id = $item['id'];
            //    $this->nome = $item['nome'];
            //    $this->texto = $item['texto'];
            //}
        } else{
            $array = array();
        }
        return $array;
    }
    
    public function selecionarALLDepoimentos($offset = 0, $limit = 0, $where = array()){
        $tabela = "depoimentos";
        $colunas = array ("id", "nome", "texto");
        $where_cond = "AND";
        $groupBy = array();
        $groupBy[] = ("ORDER BY RAND()");
        if ($limit > 0){
            $groupBy[] = ("LIMIT $offset, $limit");
        }
        $this->selectTable($tabela, $colunas, $where, $where_cond, $groupBy);
        if($this->numRows() > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else {
            $array = array();
        }
        return $array;
    }
    
    public function getDepoimentos($limit=0) {
        if ($limit > 0){
            $offset=0;
            $array = $this->selecionarALLDepoimentos($offset, $limit);
        }else{
            $array = $this->selecionarALLDepoimentos();
        }
        return $array;
    }
    
    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    
    public function setNome($nome) { $this->nome = $nome; }
    public function getNome() { return $this->nome; }
    
    public function setTexto($texto) { $this->texto = $texto; }
    public function getTexto() { return $this->texto; }
}
