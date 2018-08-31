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
class Formulario extends Model{
    private $id;
    private $titulo;
    private $label;
    private $tipo;
    //put your code here
    
    public function selecionarFormularioTitulo($titulo){
        $tabela = "formulario";
        $colunas = array ("id", "titulo", "label", "tipo");
        $where = array(
            "titulo" => $titulo
        );
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
			if ($this->numRows == 1){
				foreach ($array as $item) {
					$this->id = $item['id'];
					$this->titulo = $item['titulo'];
					$this->label = $item['label'];
					$this->tipo = $item['tipo'];
				}
			}
        } else{
            $array = array();
        }
        return $array;
    }
    
    public function selecionarFormularioID($id){
        $tabela = "formulario";
        $colunas = array ("id", "titulo", "label", "tipo");
        $where = array(
            "id" => $id
        );
        $this->selectTable($tabela, $colunas, $where);
        if ($this->numRows > 0){
            $array = $this->result();
            foreach ($array as $item) {
                $this->id = $item['id'];
                $this->titulo = $item['titulo'];
				$this->label = $item['label'];
                $this->tipo = $item['tipo'];
            }
        } else{
            $array = array();
        }
        return $array;
    }
    
    public function selecionarALLFormularios($where = array()){
        $tabela = "formulario";
        $colunas = array ("id", "titulo", "label", "tipo");
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
    
    public function incluirFormularioTituloLabelTipo($titulo, $label, $tipo){
        $tabela = "formulario";
        $dados = array (
            "titulo" => $titulo,
			"label" => $label,
            "tipo" => $tipo
        );
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->array;
    }
    
    public function atualizarFormularioTituloLabelTipo($id, $titulo, $label, $tipo){
        $tabela = "formulario";
        $dados = array (
            "titulo" => $titulo,
			"label" => $label,
            "tipo" => $tipo
        );
        $where = array (
            "id" => $id
        );
        $this->update($tabela, $dados, $where);
    }
    
    public function deletarFormularioID($id){
        $tabela = "formulario";
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
    
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    public function getTitulo() {
        return $this->titulo;
    }
    
	public function setLabel($label) {
        $this->label = $label;
    }
    public function getLabel() {
        return $this->label;
    }
	
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    public function getTipo() {
        return $this->tipo;
    }
}
