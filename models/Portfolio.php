<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Portifolio
 *
 * @author vouteligar
 */
class Portfolio extends model{
    private $id;
    private $imagem;
    //put your code here
    
    public function getTrabalhos($n = null) {
        $tabela = "portfolio";
        $colunas = array ("id", "imagem");
        $where = array();
        $where_cond = "AND";
        if (empty($n)){
            $groupBy = array();
        } else {
            if (is_numeric($n)){
                $groupBy = array(
                    "LIMIT ".$n
                );
            } else {
                $groupBy = array();
            }
        }
        $this->selectTable($tabela, $colunas, $where, $where_cond, $groupBy);
        if ($this->numRows() > 0){
            return $this->result();
        } else {
            return array();
        }
    }
    
    public function setID($id) {
        $this->id = $id;
    }
    public function getID() {
        return $this->id;
    }
    
    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }
    public function getImagem() {
        return $this->imagem;
    }
}
