<?php
// require_once ('conexao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuarios_token
 *
 * @author Daniel_Caldeira
 */
class usuarios_token extends Model{
    private $id;
    private $id_usuario;
    private $hash;
    private $usado;
    private $expirado_em;
    
	private function incluirElementos($elementos = array()) {
        if (count($elementos) == 1){
            foreach ($elementos as $item) {
                $this->setID($item['id']);
                $this->setIDUsuario($item['id_usuario']);
                $this->setHash($item['hash']);
                $this->setUsado($item['usado']);
                $this->setExpiradoEm($item['expirado_em']);
            }
        }
    }
    //put your code here
    public function selecionarAllUsuariosToken($where = array()) {
        $tabela = "usuarios_token";
        $colunas = array("id","id_usuario","hash","usado","expirado_em");
        //$where = array();
        $where_cond = "AND";
        $groupBy = array();
        $this->selectTable($tabela, $colunas, $where, $where_cond, $groupBy);
        if ($this->numRows() > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else {
            $array = array();
        }
        return $array;
    }
	
    public function atualizarUsado($hash=null, $usado=null){
		if (is_null($hash)){
            $where = array();
                $where["hash"] = $this->hash;
        } else {
            $where = array();
                $where["hash"] = $hash;
        }
        if (is_null($usado)){
            $dados = array();
                $dados["usado"] = $this->usado;
        } else {
            $dados = array();
                $dados["usado"] = $usado;
        }
        $tabela = "usuarios_token";
        // $dados = array (
        //     "usado" => $this->usado
        // );
        // $where = array (
        //     "hash" => $this->hash
        // );
        $this->update($tabela, $dados, $where);
    }
    
    public function selecionarToken($hash=null) {
		if (is_null($hash)){
            $where = array();
                $where["hash"] = $this->hash;
                $where["usado"] = 0;
        } else {
            $where = array();
                $where["hash"] = $hash;
                $where["usado"] = 0;
        }
		return $this->selecionarAllUsuariosToken($where);
    }
    
    public function incluirUsuariosToken($idUsuario=null, $hash=null, $expiradoEm=null) {
		if (is_null($idUsuario)&& is_null($hash)&& is_null($expiradoEm)){
            $dados = array();
                $dados["id_usuario"] = $this->id_usuario;
                $dados["hash"] = $this->hash;
                $dados["expirado_em"] = $this->expirado_em;
        } else {
            $dados = array();
                $dados["id_usuario"] = $idUsuario;
                $dados["hash"] = $hash;
                $dados["expirado_em"] = $expiradoEm;
        }
        $tabela = "usuarios_token";
        // $dados = array (
        //     "id_usuario" => $this->id_usuario,
        //     "hash" => $this->hash,
        //     "expirado_em" => $this->expirado_em
        // );
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->array;
    }
	
    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    
    public function setIDUsuario($idUsuario) { $this->id_usuario = $idUsuario; }
    public function getIDUsuario() { return $this->id_usuario; }
    
    public function setHash($hash) { $this->hash = $hash; }
    public function getHash() { return $this->hash; }
    
    public function setUsado($usado) { $this->usado = $usado; }
    public function getUsado() { return $this->usado; }
    
    public function setExpiradoEm($expiradoEm) { $this->expirado_em = $expiradoEm; }
    public function getExpiradoEm() { return $this->expirado_em; }
}
