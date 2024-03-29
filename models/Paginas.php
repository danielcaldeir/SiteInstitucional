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
	private $id_empresa;
    private $url;
    private $titulo;
    private $corpo;
	
	private function incluirElementos($elementos = array()) {
        if (count($elementos) == 1){
            foreach ($elementos as $item) {
                $this->setID($item['id']);
                $this->setIDEmpresa($item['id_empresa']);
                $this->setURL($item['url']);
                $this->setTitulo($item['titulo']);
                $this->setCorpo($item['corpo']);
            }
        }
    }
	
    //put your code here
    public function selecionarALLPaginas($where = array()){
        $tabela = "paginas";
        $colunas = array ("id", "id_empresa", "url", "titulo", "corpo");
        $where_cond = "AND";
        $groupBy = array();
        $this->selectTable($tabela, $colunas, $where, $where_cond, $groupBy);
        if($this->numRows() > 0){
            $array = $this->result();
			$this->incluirElementos($array);
        } else {
            $array = array();
        }
        return $array;
    }
	
	public function getALLPaginasIDEmpresa($idEmpresa){
        $where = array();
        $where['id_empresa'] = $idEmpresa;
        return $this->selecionarALLPaginas($where);
    }
	
	public function selecionarPaginasURL($url){
        $tabela = "paginas";
        $colunas = array ("id", "id_empresa", "url", "titulo", "corpo");
        $where = array();
            $where["url"] = $url;
        //);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
			$this->incluirElementos($array);
            // foreach ($array as $item) {
            //     $this->id = $item['id'];
            //     $this->url = $item['url'];
            //     $this->titulo = $item['titulo'];
            //     $this->corpo = $item['corpo'];
            // }
        } else{
            $array = array();
        }
        return $array;
    }
    
    public function selecionarPaginasID($id){
        $tabela = "paginas";
        $colunas = array ("id", "id_empresa", "url", "titulo", "corpo");
        $where = array();
            $where["md5(id)"] = $id;
        //);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
			$this->incluirElementos($array);
            // foreach ($array as $item) {
            //    $this->id = $item['id'];
            //    $this->url = $item['url'];
            //    $this->titulo = $item['titulo'];
            //    $this->corpo = $item['corpo'];
            // }
        } else{
            $array = array();
        }
        return $array;
    }
    
    public function incluirPaginaURLTituloCorpo($url,$titulo, $corpo){
        $tabela = "paginas";
        $dados = array ();
            $dados["url"] = $url;
            $dados["titulo"] = $titulo;
            $dados["corpo"] = $corpo;
        //);
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->array;
    }
    
    public function atualizarPaginaURLTituloCorpo($id, $url, $titulo, $corpo){
        $tabela = "paginas";
        $dados = array ();
            $dados["url"] = $url;
            $dados["titulo"] = $titulo;
            $dados["corpo"] = $corpo;
        //);
        $where = array ();
            $where["id"] = $id;
        //);
        $this->update($tabela, $dados, $where);
    }
    
    public function deletarPaginaID($id){
        $tabela = "paginas";
        $where = array();
            $where['id'] = $id;
        $this->delete($tabela, $where);
        return null;
    }
    
    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    
    public function setIDEmpresa($id_empresa) { $this->id_empresa = $id_empresa; }
    public function getIDEmpresa() { return $this->id_empresa; }
    
    public function setURL($url) { $this->url = $url; }
    public function getURL() { return $this->url; }
    
    public function setTitulo($titulo) { $this->titulo = $titulo; }
    public function getTitulo() { return $this->titulo; }
    
    public function setCorpo($corpo) { $this->corpo = $corpo; }
    public function getCorpo() { return $this->corpo; }
}
