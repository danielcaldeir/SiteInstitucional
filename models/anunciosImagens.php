<?php
// require_once ('conexao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of anuncios
 *
 * @author Daniel_Caldeira
 */
class anunciosImagens extends Model{
    private $id;
    private $id_empresa;
    private $id_anuncio;
    private $url;
    
    public function incluirAnunciosImagens(){
        $tabela = "anuncios_imagens";
        $dados = array (
            "id_anuncio" => $this->id_anuncio,
            "id_empresa" => $this->id_empresa,
            "url" => $this->url
        );
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->array;
    }
    
    public function selecionarAnunciosID(){
        $tabela = "anuncios_imagens";
        $colunas = array ("id", "id_empresa", "id_anuncio", "url");
        $where = array(
            "id" => $this->id
        );
        $this->selectTable($tabela, $colunas, $where);
        if($this->numRows() > 0){
            $array = $this->result();
        } else {
            $array = array();
        }
        return $array;
    }
    
    public function selecionarAnunciosImagens(){
        $tabela = "anuncios_imagens";
        $colunas = array ("id", "id_empresa", "id_anuncio", "url");
        $where = array(
            "md5(id_anuncio)" => $this->id_anuncio
        );
        $this->selectTable($tabela, $colunas, $where);
        if($this->numRows() > 0){
            $array = $this->result();
        } else {
            $array = array();
        }
        return $array;
    }
    
    public function deletarAnunciosID(){
        $tabela = "anuncios_imagens";
        $where = array( 
            "id" => $this->id 
        );
        $this->delete($tabela, $where);
        return null;
    }
    
    public function deletarAnunciosImagens(){
        $tabela = "anuncios_imagens";
        $where = array( 
            "id_anuncio" => $this->id_anuncio 
        );
        $this->delete($tabela, $where);
        return null;
    }
    
    public function atualizarAnunciosImagens(){
        $tabela = "anuncios_imagens";
        $dados = array (
            "url" => $this->url
        );
        $where = array (
            "id_anuncio" => $this->id_anuncio
        );
        $this->update($tabela, $dados, $where);
    }
    
    //put your code here
    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    
    public function setIDEmpresa($idEmpresa) { $this->id_empresa = $idEmpresa; }
    public function getIDEmpresa() { return $this->id_empresa; }

    public function setIDAnuncio($id_anuncio) { $this->id_anuncio = $id_anuncio; }
    public function getIDAnuncio() { return $this->id_anuncio; }
    
    public function setURL($url) { $this->url = $url; }
    public function getURL() { return $this->url; }
}
