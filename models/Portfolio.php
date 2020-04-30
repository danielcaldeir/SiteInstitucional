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
    
    private function incluirElementos($elementos = array()) {
        if (count($elementos) == 1){
            foreach ($elementos as $item) {
                $this->setID($item['id']);
                $this->setImagem($item['imagem']);
            }
        }
    }
    
    //put your code here
    public function getPortfolioID($id){
        $tabela = "portfolio";
        $colunas = array ("id", "imagem");
        $where = array();
            $where["id"] = $id;
        //);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows() > 0){
            $array = $this->result();
            $this->setID($array['id']);
            $this->setImagem($array['imagem']);
            return $array;
        } else {
            return array();
        }
        //return $this->result();
    }
    
    public function getPortfolioImagem($imagem){
        $tabela = "portfolio";
        $colunas = array ("id", "imagem");
        $where = array();
            $where["imagem"] = $imagem;
        //);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows() == 1){
            $array = $this->result();
            $this->setID($array['id']);
            $this->setImagem($array['imagem']);
            return $array;
        } else {
            return array();
        }
        //return $this->result();
    }
    
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
                    "ORDER BY RAND()",
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
    
    public function incluirPortfolio($imagem){
        $tabela = "portfolio";
        $dados = array ();
            $dados["imagem"] = $imagem;
        //);
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->array;
    }
    
    public function deletarPortfolio($id){
        $tabela = "portfolio";
        $where = array();
            $where["id"] = $id;
        //);
        $this->delete($tabela, $where);
        return null;
    }
    
    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    
    public function setImagem($imagem) { $this->imagem = $imagem; }
    public function getImagem() { return $this->imagem; }
}
