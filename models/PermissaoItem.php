<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PermissaoItem
 *
 * @author daniel
 */
class PermissaoItem extends Model{
    private $id;
	private $id_empresa;
    private $nome;
    private $slug;
    
    private function incluirElementos($elementos = array()) {
        if (count($elementos) == 1){
            foreach ($elementos as $item) {
                $this->setID($item['id']);
                $this->setIDEmpresa($item['id_empresa']);
                $this->setNome($item['nome']);
                $this->setSlug($item['slug']);
            }
        }
    }
    //put your code here
    public function selecionarALLPermissaoItem($where = array()){
        $tabela = "permissao_item";
        $colunas = array("id","id_empresa","nome","slug");
        //$where_cond = "AND";
        //$groupBy = array();
        //$this->selecionarTabelas($tabela, $colunas, $where, $where_cond, $groupBy);
        $this->selectTable($tabela, $colunas, $where);
        if($this->numRows() > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else {
            $array = array();
        }
        return $array;
    }
    
    public function selecionarPermissaoItemID($id) {
        $tabela = "permissao_item";
        $colunas = array("id","id_empresa","nome","slug");
        $where = array();
            $where["md5(id)"] = $id;
        //);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else{
            $array = array();
        }
        return $array;
    }
    
    public function selecionarPermissaoItemIDEmpresa($id_empresa) {
        $tabela = "permissao_item";
        $colunas = array("id","id_empresa","nome","slug");
        $where = array();
            $where["id_empresa"] = $id_empresa;
        //);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else{
            $array = array();
        }
        return $array;
    }
    
	public function selecionarPermissaoItemSlugs($id_empresa) {
        $array = $this->selecionarPermissaoItemIDEmpresa($id_empresa);
        $slugs = [];
        foreach($array as $item){
            $slugs[$item['id']] = $item['slug'];
        }
        return $slugs;
    }
	
    public function addPermissaoItem($nome, $slug, $idEmpresa = null) {
        $tabela = "permissao_item";
        $dados = array ();
            $dados['id_empresa'] = $idEmpresa;
            $dados["nome"] = $nome;
            $dados["slug"] = $slug;
        
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->result();
    }
    
    public function delPermissaoItemID($id) {
        $tabela = "permissao_item";
        $where = array();
            $where["id"] = $id;
        $this->delete($tabela, $where);
        return null;    
    }
    
    public function editPermissaoItem($id_item, $nome) {
        $tabela = "permissao_item";
        $dados = array ();
            $dados["nome"] = $nome;
        $where = array();
            $where["id"] = $id_item;
        
        $this->update($tabela, $dados, $where);
    }
    
	
    //GET and SET
    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    
    public function setIDEmpresa($id_empresa) { $this->id_empresa = $id_empresa; }
    public function getIDEmpresa() { return $this->id_empresa; }
    
    public function setNome($nome) { $this->nome = $nome; }
    public function getNome() { return $this->nome; }
    
    public function setSlug($slug) { $this->slug = $slug; }
    public function getSlug() { return $this->slug; }
}
