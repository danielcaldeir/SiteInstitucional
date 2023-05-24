<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config
 *
 * @author Daniel_Caldeira
 */
class Config extends Model{
    private $id;
    private $id_empresa;
	private $nome;
    private $valor;
    
    //put your code here
    private function incluirElementos($elementos = array()) {
        if (count($elementos) == 1){
            foreach ($elementos as $item) {
                $this->setID($item['id']);
                $this->setIDEmpresa($item['id_empresa']);
                $this->setNome($item['nome']);
                $this->setValor($item['valor']);
            }
        }
    }
	
	public function selecionarConfigID($id){
        $tabela = "config";
        $colunas = array ("id", "id_empresa", "nome", "valor");
        $where = array();
            $where["id"] = $id;
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
    
    public function selecionarALLConfig($where = array()){
        $tabela = "config";
        $colunas = array ("id", "id_empresa", "nome", "valor");
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
    
	public function getALLConfigIDEmpresa($idEmpresa){
        $where = array();
        $where['id_empresa'] = $idEmpresa;
        return $this->selecionarALLConfig($where);
    }
	
    public function setConfigPropriedade($idEmpresa, $nome, $valor){
        $tabela = "config";
        $dados = array ();
            $dados["valor"] = $valor;
        //);
        $where = array ();
            $where["nome"] = $nome;
			$where["id_empresa"] = $idEmpresa;
		//);
        $array = $this->selecionarALLConfig($where);
        if (count($array) > 0){
            $this->update($tabela, $dados, $where);
        } else {
            foreach ($where as $key => $valor){
                $dados[$key] = $valor;
            }
            $this->insert($tabela, $dados);
        }
        return $this->viewSQL();
    }
    
    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    
    public function setIDEmpresa($id_empresa) { $this->id_empresa = $id_empresa; }
    public function getIDEmpresa() { return $this->id_empresa; }
    
    public function setNome($nome) { $this->nome = $nome; }
    public function getNome() { return $this->nome; }
    
    public function setValor($valor) { $this->valor = $valor; }
    public function getValor() { return $this->valor; }
}
