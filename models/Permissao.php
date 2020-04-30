<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Permissao
 *
 * @author daniel
 */
class Permissao extends Model{
    private $id;
    private $id_grupo;
    private $id_item;
    private $permitido;
    
    private function incluirElementos($elementos = array()) {
        if (count($elementos) == 1){
            foreach ($elementos as $item) {
                $this->setID($item['id']);
                //$this->setIDEmpresa($item['id_empresa']);
                $this->setIDGrupo($item['id_grupo']);
                $this->setIDItem($item['id_item']);
                $this->setPermitido($item['permitido']);
            }
        }
    }
    //put your code here
    
    public function validarDelPermissao($id_grupo){//($id_empresa, $id_grupo) {
        $user = new Usuario();
        $permissaoGrupo = new PermissaoGrupo();
        
        if ($user->validatePermissaoGrupo($id_grupo)){
            $this->delPermissaoIDGrupo($id_grupo);
            $permissaoGrupo->delPermissaoGrupoID($id_grupo);
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    //public function validarDelPermissaoItem($id_empresa, $id_item) {
    //    $perItem = new PermissaoItem();
    //    if ($this->validatePermissaoItem($id_empresa, $id_item)){
    //        $this->delPermissaoIDItem($id_item);
    //        $perItem->delPermissaoItemID($id_item);
    //        return TRUE;
    //    }else{
    //        return FALSE;
    //    }
    //}
    
    public function validatePermissaoItem($id_item){//($id_empresa, $id_item) {
        $tabela = "permissao";
        $colunas = array ("id", "id_grupo", "id_item", "permitido");
        $where = array();
            //$where['id_empresa'] = $id_empresa;
            $where['id_item'] = $id_item;
            $where['permitido'] = 1;
        
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    public function selecionarALLPermissao($where = array()){
        $tabela = "permissao";
        $colunas = array("id","id_grupo","id_item","permitido");
        //$where_cond = "AND";
        //$groupBy = array("group by user.id_grupo");
        //$this->selecionarTabelas($tabela, $colunas, $where, $where_cond, $groupBy);
        //$arrPermissao = $this->selecionarTabelas($tabela, $colunas, $where);
        $this->selectTable($tabela, $colunas, $where);
        if($this->numRows() > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else {
            $array = array();
        }
        return $array;
        //return $this->returnElementos($arrPermissao);
    }
    
    public function selecionarPermissaoID($id) {
        $tabela = "permissao";
        $colunas = array("id","id_grupo","id_item","permitido");
        $where = array();
            $where["id"] = $id;
        //);
        //$arrPermissao = $this->selecionarTabelas($tabela, $colunas, $where);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else{
            $array = array();
        }
        return $array;
        //return $this->returnElementos($arrPermissao);
    }
    
    public function selecionarPermissaoIDEmpresa($id_grupo) {//(%id_empresa, $id_grupo)
        $tabela = "permissao";
        $colunas = array("id","id_grupo","id_item","permitido");
        $where = array();
            $where["id_grupo"] = $id_grupo;
            //$where["id_empresa"] = $id_empresa;
        //);
        //$arrPermissao = $this->selecionarTabelas($tabela, $colunas, $where);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else{
            $array = array();
        }
        return $array;
        //return $this->returnElementos($arrPermissao);
    }
    
    public function selectIDGrupo($id_grupo, $permitido = 1) {
        $tabela = "permissao";
        $colunas = array("id","id_grupo","id_item","permitido");
        $where = array();
            $where["id_grupo"] = $id_grupo;
            $where["permitido"] = $permitido;
            //$where["id_empresa"] = $id_empresa;
        //);
        //$arrPermissao = $this->selecionarTabelas($tabela, $colunas, $where);
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else{
            $array = array();
        }
        return $array;
        //return $this->returnElementos($arrPermissao);
    }
    
    public function getSelectIDGrupo($id_grupo,$permitido = 1) {
        $pItem = new PermissaoItem();
        $slugs = array();
        
        $this->selectIDGrupo($id_grupo, $permitido);
        $idItem = array();
        foreach ($this->result() as $item) {
            $idItem[] = $item['id_item'];
            //$pItem->selecionarPermissaoItemID($item['id_item']);
            //$this->permissoes[] = $pItem->getSlug();
        }
        $where = array();
        $where['id'] = $idItem;
        //$where['id_empresa'] = $id_empresa;
        $arrSlugs = $pItem->selecionarALLPermissaoItem($where);
        foreach ($arrSlugs as $item) {
            $slugs[] = $item['slug'];
        }
        
        return $slugs;
    }
    
    public function getAllPermissaoGrupo(){//($id_empresa = 0) {
        $per = new PermissaoGrupo();
        //if ($id_empresa == 0){
        //    $per->getAllPermissaoGrupo();
        //} else {
        //    $where['id_empresa'] = $id_empresa;
        //    $per->getAllPermissaoGrupo($where);
        //}
        $per->getAllPermissaoGrupo();
        
        $array = array();
        foreach ($per->result() as $item) {
            if (is_null($item['total_user'])){
                $item['total_user'] = 0;
                $array[] = $item;
            } else {
                $array[] = $item;
            }
        }
        return $array;
    }
    
    public function delPermissaoIDGrupo($id_grupo) {//($id_empresa, $id_grupo)
        $tabela = "permissao";
        $where = array ();
            $where["id_grupo"] = $id_grupo;
            //$where["id_empresa"] = $id_empresa;
        $this->delete($tabela, $where);
        return null;    
    }
    
    public function delPermissaoIDItem($id_item) {
        $tabela = "permissao";
        $where = array();
            $where["id_item"] = $id_item;
        $this->delete($tabela, $where);
        return null;    
    }
    
    public function addPermissao($id_grupo, $id_item, $permitido) {//($id_empresa, $id_grupo, $id_item, $permitido)
        $tabela = "permissao";
        $dados = array ();
            //$dados["id_empresa"] = $id_empresa;
            $dados["id_grupo"] = $id_grupo;
            $dados["id_item"] = $id_item;
            $dados["permitido"] = $permitido;
        
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->array;
    }
    
    public function editPermissao($id_grupo, $id_item, $permitido) {
        $tabela = "permissao";
        $dados = array ();
            $dados["permitido"] = $permitido;
        $where = array();
            $where["id_grupo"] = $id_grupo;
            $where["id_item"] = $id_item;
        
        $this->update($tabela, $dados, $where);
    }
    
    //GET and SET
    public function setID($id) { $this->id = $id; } 
    public function getID() { return $this->id; }
    
    //public function setIDEmpresa($id_empresa){ $this->id_empresa = $id_empresa; }
    //public function getIDEmpresa(){ return $this->id_empresa; }
    
    public function setIDGrupo($id_grupo) { $this->id_grupo = $id_grupo; }
    public function getIDGrupo() { return $this->id_grupo; }
    
    public function setIDItem($id_item) { $this->id_item = $id_item; }
    public function getIDItem() { return $this->id_item; }
    
    public function setPermitido($permitido) { $this->permitido = $permitido; }
    public function getPermitido() { return $this->permitido; }
}
