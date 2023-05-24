<?php
// require_once ('conexao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of post
 *
 * @author Daniel_Caldeira
 */
class Post extends Model{
    private $id;
	private $titulo;
    private $data;
    private $corpo;
    private $autor;
	
	private function incluirElementos($elementos = array()) {
        if (count($elementos) == 1){
            foreach ($elementos as $item) {
                $this->setID($item['id']);
                $this->setTitulo($item['titulo']);
                $this->setCorpo($item['corpo']);
                $this->setAutor($item['autor']);
                $this->setData($item['data_criado']);
            }
        }
    }
	
	//put your code here
    public function incluirPost($titulo=null,$corpo=null,$autor=null,$data=null){
		$dados = array();
		if (is_null($titulo)){
			$dados['titulo'] = $this->titulo;
		} else {
			$dados['titulo'] = $titulo;
		}
		if (is_null($data)){
			$dados['data_criado'] = $this->data;
		} else {
			$dados['data_criado'] = $data;
		}
		if (is_null($corpo)){
			$dados['corpo'] = $this->corpo;
		}else {
			$dados['corpo'] = $corpo
		}
		if (is_null($autor)){
			$dados['autor'] = $this->autor;
		} else {
			$dados['autor'] = $autor;
		}
		$tabela = "posts";
		$this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->array;
        // try {
        //     $titulo = $this->titulo;
        //     $data = $this->data;
        //     $corpo = $this->corpo;
        //     $autor = $this->autor;
        //     $sql = "INSERT INTO posts SET titulo='$titulo', data_criado=now(), corpo='$corpo', autor='$autor'";
        //     $query = $this->pdo->query($sql);
        //     return $this->pdo->lastInsertId();
        // } catch (Exception $exc) {
        //     echo $exc->getTraceAsString();
        //     echo '<br>';
        //     echo $exc->getMessage();
        // }
    }
    
    public function deletarPost($id){
        $tabela = "posts";
        $where = array();
            $where["id"] = $id;
        // );
        $this->delete($tabela, $where);
        return null;
		// try {
        //     $tabela = "posts";
        //     $where = array(
        //         "id" => $id
        //     );
        //     $this->delete($tabela, $where);
        //     //$sql = "DELETE FROM posts where id = '$id'";
        //     return null;//$this->pdo->query($sql);
        // } catch (Exception $exc) {
        //     echo $exc->getTraceAsString();
        //     echo '<br>';
        //     echo $exc->getMessage();
        // }
    }
    
    public function selecionarALLPosts(){
        $tabela = "posts";
        $colunas = array("id","titulo","corpo","autor","data_criado");
        $where = array();
		$this->selectTable($tabela, $colunas, $where);
        if ($this->numRows() > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else {
            $array = array();
        }
        return $array;
		// try {
        //     $sql = "SELECT * FROM posts";
        //     $query = $this->pdo->query($sql);
        //     $this->numRows = $query->rowCount();
        //     $this->array = $query->fetchAll();
        //     return $this->result();
        // } catch (Exception $exc) {
        //     echo $exc->getTraceAsString();
        //     echo '<br>';
        //     echo $exc->getMessage();
        // }
    }
    
    public function selecionarPosts($id=null){
        $tabela = "posts";
        $colunas = array("id","titulo","corpo","autor","data_criado");
        $where = array();
		if (is_null($id)){
			$where['id'] = $this->id;
		} else {
			$where['id'] = $id;
		}
		$this->selectTable($tabela, $colunas, $where);
        if ($this->numRows() > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else {
            $array = array();
        }
		return $array;
        // $id = $this->id;
        // $titulo = $this->titulo;
        // $data = $this->data;
        // $corpo = $this->corpo;
        // $autor = $this->autor;
        
        // if (is_null($id)){
        //     $sql = "SELECT id, titulo, data_criado, corpo, autor FROM posts WHERE autor = ?";
        //     $stmt = $this->pdo->prepare($sql);
        //     $stmt->execute(array($autor));
        //     $this->numRows = $stmt->rowCount();
        //     $this->array = $stmt->fetchALL();
        // } else {
        //     $sql = "SELECT id, titulo, data_criado, corpo, autor FROM posts where id = :id";
        //     $stmt = $this->pdo->prepare($sql);
        //     $stmt->bindValue(":id", $id);
        //     $stmt->execute();
        //     $this->numRows = $stmt->rowCount();
        //     $this->array = $stmt->fetch();
        // }
        
        // return $this->result();
    }
        
    public function setTitulo($titulo){
        if (is_string($titulo)){
            $this->titulo = $titulo;
        }
    }
    public function getTitulo() { return $this->titulo; }
    
    public function setData($data){
        $this->data = $data;
    }
    public function getData() { return $this->data; }
    
    public function setCorpo($corpo){
        if (is_string($corpo)){
            $this->corpo = $corpo;
        }
    }
    public function getCorpo() { return $this->corpo; }
    
    public function setAutor($autor){
        if (is_string($autor)) {
            $this->autor = $autor;
        }
    }
    public function getAutor() { return $this->autor; }
    
    public function setID($id){
        if (is_string($id)) {
            $this->id = $id;
        }
    }
    public function getID() { return $this->id; }
}
