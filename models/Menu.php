<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author Daniel_Caldeira
 */
class Menu extends Model{
    private $id;
    private $nome;
    private $url;
    private $tipo;
    private $tabela;
    
    private function incluirElementos($elementos = array()) {
        if (count($elementos) == 1){
            foreach ($elementos as $item) {
                $this->setID($item['id']);
                $this->setNome($item['nome']);
                $this->setURL($item['url']);
                $this->setTipo($item['tipo']);
            }
        }
    }
    //put your code here
    
    public function __construct($tabela) {
        $this->tabela = $tabela;
        parent::__construct();
    }
    
    public function selecionarMenuID($id){
        $tabela = $this->tabela;
        $colunas = array ("id", "nome", "url", "tipo");
        $where = array();
            $where["md5(id)"] = $id;
        //);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
            //foreach ($array as $item) {
            //    $this->id = $item['id'];
            //    $this->nome = $item['nome'];
            //    $this->url = $item['url'];
            //    $this->tipo = $item['tipo'];
            //}
        } else{
            $array = array();
        }
        return $array;
    }
    
    public function selecionarMenuURL($url){
        $tabela = $this->tabela;
        $colunas = array ("id", "nome", "url", "tipo");
        $where = array();
            $where["url"] = $url;
        //);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
            //foreach ($array as $item) {
            //    $this->id = $item['id'];
            //    $this->nome = $item['nome'];
            //    $this->url = $item['url'];
            //    $this->tipo = $item['tipo'];
            //}
        } else{
            $array = array();
        }
        return $array;
    }
	
    public function selecionarALLMenu($where = array()){
        $tabela = $this->tabela;
        $colunas = array ("id", "nome", "url", "tipo");
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
    
    public function incluirMenu($nome, $url, $tipo){
        $tabela = $this->tabela;
        $dados = array();
            $dados["nome"] = $nome;
            $dados["url"] = $url;
            $dados["tipo"] = $tipo;
        //);
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->array;
    }
    
    public function atualizarMenuNomeURL($id, $nome, $url, $tipo){
        $tabela = $this->tabela;
        $dados = array();
            $dados["nome"] = $nome;
            $dados["url"] = $url;
            $dados["tipo"] = $tipo;
        //);
        $where = array();
            $where["md5(id)"] = $id;
        //);
        $this->update($tabela, $dados, $where);
    }
    
    public function deletarMenuID($id){
        $tabela = $this->tabela;
        $where = array();
        $where['id'] = $id;
        $this->delete($tabela, $where);
        return null;
    }
    
    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    
    public function setNome($nome) { $this->nome = $nome; }
    public function getNome() { return $this->nome; }
    
    public function setURL($url) { $this->url = $url; }
    public function getURL() { return $this->url; }
    
    public function setTipo($tipo) { $this->tipo = $tipo; }
    public function getTipo() { return $this->tipo; }
}
