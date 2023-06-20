<?php
// require_once ('conexao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categorias
 *
 * @author Daniel_Caldeira
 */
class categorias extends Model{
    private $id;
    private $id_empresa;
    private $nome;
    
    public function selecionarCategoriasID($id = null){
        $tabela = "categorias";
        $colunas = array ("id", "id_empresa", "nome");
        $where = array();
        if(is_null($id)){ $where["md5(id)"] = $this->id; } 
        else { $where["md5(id)"] = $id; }
        // $where = array();
        //     $where["md5(id)"] = $this->id;
        // );
        $this->selectTable($tabela, $colunas, $where);
        if($this->numRows() > 0){
            $array = $this->result();
        } else {
            $array = array();
        }
        return $array;
    }
    
    public function selecionarAllCategorias(){
        $tabela = "categorias";
        $colunas = array ("id", "id_empresa", "nome");
        $where = array();
        $this->selectTable($tabela, $colunas, $where);
        if($this->numRows() > 0){
            $array = $this->result();
        } else {
            $array = array();
        }
        return $array;
    }
    
    public function selecionarCategoriasIDEmpresa(){
        $tabela = "categorias";
        $colunas = array ("id", "id_empresa", "nome");
        $where = array(
            "id_empresa" => $this->id_empresa
        );
        $this->selectTable($tabela, $colunas, $where);
        if($this->numRows() > 0){
            $array = $this->result();
        } else {
            $array = array();
        }
        return $array;
    }

    public function addCategorias($IDEmpresa, $nome) {
        $tabela = "categorias";
        $dados = array ();
            $dados["id_empresa"] = $IDEmpresa;
            $dados["nome"] = $nome;
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->result();
    }

    public function editCategoria($id, $IDEmpresa, $nome) {
        $tabela = "categorias";
        $dados = array ();
            $dados["id_empresa"] = $IDEmpresa;
            $dados["nome"] = $nome;
        $where = array();
            $where["id"] = $id;
        $this->update($tabela, $dados, $where);
    }

    //put your code here
    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    
    public function setIDEmpresa($idEmpresa) { $this->id_empresa = $idEmpresa; }
    public function getIDEmpresa() { return $this->id_empresa; }

    public function setNome($nome) { $this->nome = $nome; }
    public function getNome() { return $this->nome; }
}
