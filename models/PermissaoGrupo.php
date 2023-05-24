<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PermissaoGrupo
 *
 * @author daniel
 */
class PermissaoGrupo extends Model{
    private $id;
	private $id_empresa;
    private $nome;
    
    private function incluirElementos($elementos = array()) {
        if (count($elementos) == 1){
            foreach ($elementos as $item) {
                $this->setID($item['id']);
				$this->setIDEmpresa($item['id_empresa']);
                $this->setNome($item['nome']);
            }
        }
    }
    //put your code here
    public function selecionarALLPermissaoGrupo($where = array()){
        $tabela = "permissao_grupo";
        $colunas = array("id","id_empresa","nome");
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
    
    public function delPermissaoGrupoID($id) {
        $tabela = "permissao_grupo";
        $where = array ();
            $where["id"] = $id;
        $this->delete($tabela, $where);
        return null;    
    }
    
    public function selecionarPermissaoGrupoID($id) {
        $tabela = "permissao_grupo";
        $colunas = array("id","id_empresa","nome");
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
    
	public function selecionarPermissaoGrupoIDEmpresa($id_empresa) {
        $tabela = "permissao_grupo";
        $colunas = array("id","id_empresa","nome");
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
	
    public function getAllPermissaoGrupo($where = array()) {
        $tabela = "permissao_grupo as grupo LEFT JOIN (SELECT id_grupo, count(id) as total_user FROM usuarios group by id_grupo) as user ON user.id_grupo = grupo.id";
        $colunas = array("grupo.id","grupo.id_empresa","grupo.nome","user.total_user");
        //$where = array();
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else{
            $array = array();
        }
        return $array;
    }
    
    public function addPermissaoGrupo($nome, $IdEmpresa=null) {//($IdEmpresa, $nome)
        if ((isset($IdEmpresa) && isset($nome))&&(!empty($IdEmpresa)&&!empty($nome))){
        // if ( isset($nome) && !empty($nome) ){
            $tabela = "permissao_grupo";
            $dados = array ();
                $dados["id_empresa"] = $IdEmpresa;
                $dados["nome"] = $nome;

            $this->insert($tabela, $dados);
            $this->query("SELECT LAST_INSERT_ID() as ID");
            $array = $this->result();
        } else {
            $array = array();
        }
        return $array;
    }
    
    public function editPermissaoGrupo($id_grupo, $nome) {
        $tabela = "permissao_grupo";
        $dados = array ();
            $dados["nome"] = $nome;
        $where = array();
            $where["id"] = $id_grupo;
        
        $this->update($tabela, $dados, $where);
    }
    
    //GET an SET
    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    
	public function setIDEmpresa($id_empresa) { $this->id_empresa = $id_empresa; }
    public function getIDEmpresa() { return $this->id_empresa; }
	
    public function setNome($nome) { $this->nome = $nome; }
    public function getNome() { return $this->nome; }
}
