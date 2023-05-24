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
    private $id_empresa;
	private $nome;
    private $url;
    private $tipo;
    private $tabela;
    
    private function incluirElementos($elementos = array()) {
        if (count($elementos) == 1){
            foreach ($elementos as $item) {
                $this->setID($item['id']);
                $this->setIDEmpresa($item['id_empresa']);
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
        $colunas = array ("id", "id_empresa", "nome", "url", "tipo");
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
        $colunas = array ("id", "id_empresa", "nome", "url", "tipo");
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
        $colunas = array ("id", "id_empresa", "nome", "url", "tipo");
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
    
	public function getALLMenuIDEmpresa($idEmpresa){
        $where = array();
        $where['id_empresa'] = $idEmpresa;
        return $this->selecionarALLMenu($where);
    }
	
    public function incluirMenu($nome, $url, $tipo=null, $idEmpresa=null){
        if (is_null($tipo)){
            $tipo = 'pagina';
        }
        if (is_null($idEmpresa)){
            $idEmpresa = 0;
        }
		$tabela = $this->tabela;
        $dados = array();
            $dados["nome"] = $nome;
            $dados["url"] = $url;
            $dados["tipo"] = $tipo;
			$dados["id_empresa"] = $idEmpresa;
		//);
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->array;
    }
    
    public function atualizarMenuNomeURL($id, $nome, $url, $tipo=null, $idEmpresa=null){
        if (is_null($tipo)){
            $tipo = 'pagina';
        }
        if (is_null($idEmpresa)){
            $idEmpresa = 0;
        }
		$tabela = $this->tabela;
        $dados = array();
            $dados["nome"] = $nome;
            $dados["url"] = $url;
            $dados["tipo"] = $tipo;
			$dados["id_empresa"] = $idEmpresa;
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
    
	public function setIDEmpresa($id_empresa) { $this->id_empresa = $id_empresa; }
    public function getIDEmpresa() { return $this->id_empresa; }
	
    public function setNome($nome) { $this->nome = $nome; }
    public function getNome() { return $this->nome; }
    
    public function setURL($url) { $this->url = $url; }
    public function getURL() { return $this->url; }
    
    public function setTipo($tipo) { $this->tipo = $tipo; }
    public function getTipo() { return $this->tipo; }
}
