<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cnae
 *
 * @author daniel
 */
class Cnae extends Model{
    private $id;
    private $secao;
    private $divisao;
    private $grupo;
    private $classe;
    private $descricao;
    
    private function incluirElementos($elementos = array()) {
        if (count($elementos) == 1){
            foreach ($elementos as $item) {
                $this->setID($item['id']);
                $this->setSecao($item['secao']);
                $this->setDivisao($item['divisao']);
                $this->setGrupo($item['grupo']);
                $this->setClasse($item['classe']);
                $this->setDescricao($item['descricao']);
            }
        }
    }
    //put your code here
    
    public function selecionarALLCnae($where = array()) {
        $tabela = "cnae";
        $colunas = array("id","secao","divisao","grupo","classe","descricao");
        $where_cond = "AND";
        $groupBy = array("ORDER BY secao, divisao, grupo, classe");
        $this->selectTable($tabela, $colunas, $where, $where_cond, $groupBy);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else{
            $array = array();
        }
        return $array;
    }
    
    public function getFiltroSecao() {
        $where = array();
        $where['divisao'] = "";
        $where['grupo'] = "";
        return $this->selecionarALLCnae($where);
    }
    
    public function getFiltroDivisao($filtro = array()) {
        $where = array();
        $where['secao'] = $filtro['secao'];
        $where['grupo'] = "";
        //$where['divisao']['!='] = '';
        return $this->selecionarALLCnae($where);
    }
    
    public function getFiltroGrupo($filtro = array()) {
        $where = array();
        $where['secao'] = $filtro['secao'];
        $where['divisao'] = $filtro['divisao'];
        $where['classe'] = '';
        return $this->selecionarALLCnae($where);
    }
    
    public function getFiltroClasse($filtro = array()) {
        $where = array();
        $where['secao'] = $filtro['secao'];
        $where['divisao'] = $filtro['divisao'];
        $where['grupo'] = $filtro['grupo'];
        //$where['classe']['!='] = '';
        return $this->selecionarALLCnae($where);
    }
    
    public function getCnaeID($id) {
        $where = array();
        $where['id'] = $id;
        return $this->selecionarALLCnae($where);
    }
    
    public function getCnaeClasse($classe = null) {
        $where = array();
        $where['classe'] = $classe;
        return $this->selecionarALLCnae($where);
    }
    
    public function setID($id){ $this->id = $id; }
    public function getID() {   return $this->id; }
    
    public function setSecao($secao){ $this->secao = $secao; }
    public function getSecao() {   return $this->secao; }
    
    public function setDivisao($divisao){ $this->divisao = $divisao; }
    public function getDivisao() {    return $this->divisao; }
    
    public function setGrupo($grupo){ $this->grupo = $grupo; }
    public function getGrupo() {     return $this->grupo; }
    
    public function setClasse($classe){ $this->classe = $classe; }
    public function getClasse() {     return $this->classe; }
    
    public function setDescricao($descricao){ $this->descricao = $descricao; }
    public function getDescricao() {     return $this->descricao; }
}
