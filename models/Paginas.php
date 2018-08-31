<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Paginas
 *
 * @author Daniel_Caldeira
 */
class Paginas extends Model{
    private $id;
    private $url;
    private $titulo;
    private $corpo;
    //put your code here
    
    public function selecionarPaginasURL($url){
        $tabela = "paginas";
        $colunas = array ("id", "url", "titulo", "corpo");
        $where = array(
            "url" => $url
        );
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            foreach ($array as $item) {
                $this->id = $item['id'];
                $this->url = $item['url'];
                $this->titulo = $item['titulo'];
                $this->corpo = $item['corpo'];
            }
        } else{
            $array = array();
        }
        return $array;
    }
    
    public function selecionarPaginasID($id){
        $tabela = "paginas";
        $colunas = array ("id", "url", "titulo", "corpo");
        $where = array(
            "id" => $id
        );
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            foreach ($array as $item) {
                $this->id = $item['id'];
                $this->url = $item['url'];
                $this->titulo = $item['titulo'];
                $this->corpo = $item['corpo'];
            }
        } else{
            $array = array();
        }
        return $array;
    }
    
    public function selecionarALLPaginas($where = array()){
        $tabela = "paginas";
        $colunas = array ("id", "url", "titulo", "corpo");
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
    
    public function incluirPaginaURLTituloCorpo($url,$titulo, $corpo){
        $tabela = "paginas";
        $dados = array (
            "url" => $url,
            "titulo" => $titulo,
            "corpo" => $corpo
        );
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->array;
    }
    
    public function atualizarPaginaURLTituloCorpo($id, $url, $titulo, $corpo){
        $tabela = "paginas";
        $dados = array (
            "url" => $url,
            "titulo" => $titulo,
            "corpo" => $corpo
        );
        $where = array (
            "id" => $id
        );
        $this->update($tabela, $dados, $where);
    }
    
    public function deletarPaginaID($id){
        $tabela = "paginas";
        $where = array();
        $where['id'] = $id;
        $this->delete($tabela, $where);
        return null;
    }
    
    public function setID($id) {
        $this->id = $id;
    }
    public function getID() {
        return $this->id;
    }
    
    public function setURL($url) {
        $this->url = $url;
    }
    public function getURL() {
        return $this->url;
    }
    
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    public function getTitulo() {
        return $this->titulo;
    }
    
    public function setCorpo($corpo) {
        $this->corpo = $corpo;
    }
    public function getCorpo() {
        return $this->corpo;
    }
}
