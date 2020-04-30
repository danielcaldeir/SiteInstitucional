<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author Daniel_Caldeira
 */

class Model {
    
    protected $pdo;
    protected $numRows;
    protected $array;
    
    //put your code here
    public function __construct() {
        global $config;
        $dsn = "mysql:dbname=".$config['dbname'].";host=".$config['host'];
        $dbuser = $config['dbuser'];
        $dbpass = $config['dbpass'];
        
        try {
            $this->pdo = new PDO($dsn, $dbuser, $dbpass);
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            echo '<br>';
            echo $exc->getMessage();
        }
    }
    
    public function query($sql){
        try {
            $query = $this->pdo->query($sql);
            $this->numRows = $query->rowCount();
            $this->array = $query->fetchALL();
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            echo ("<br><br>");
            echo $exc->getMessage();
        }
        //echo ("Array: ".$this->array."<br>");
        //echo ("sql: ".$sql."<br>");
    }
    
    private function montarWhere($where = array()) {
        $dados = array();
        foreach ($where as $chave => $valor) {
            if (is_array($valor)){
                if (array_key_exists('>', $valor)){
                    foreach ($valor as $key => $VLitem) {
                                //list($CHitem)  = array_keys($VLitem);
                                $dados[] = $chave." ".$key."= '".$VLitem."'";
                    }
                } elseif (array_key_exists('<', $valor)){
                    foreach ($valor as $key => $VLitem) {
                                //list($CHitem) = array_keys($VLitem);
                                $dados[] = $chave." ".$key."= '".$VLitem."'";
                    }
                }elseif (array_key_exists('!=', $valor)){
                    foreach ($valor as $key => $VLitem) {
                                //list($CHitem) = array_keys($VLitem);
                                $dados[] = $chave." ".$key." '".$VLitem."'";
                    }
                }elseif (array_key_exists('LIKE', $valor)){
                    foreach ($valor as $key => $VLitem) {
                                //list($CHitem) = array_keys($VLitem);
                                $dados[] = $chave." ".$key." '%".$VLitem."%'";
                    }
                } elseif (array_key_exists('BETWEEN', $valor)){
                    foreach ($valor as $key => $VLitem) {
                                //list($CHitem) = array_keys($VLitem);
                                $dados[] = $chave." ".$key." '".implode("' AND '", $VLitem)."' ";
                    }
                } else {
                    $dados[] = $chave." IN ('".implode("','", $valor)."')";
                }
            } else {
                $dados[] = $chave." = '".addslashes($valor)."'";
            }
        }
        return $dados;
    }
    
    public function insert($table, $data){
        if (!empty($table) && (is_array($data) && count($data)>0 ) ){
            $sql = "INSERT INTO ".$table." SET ";
            $dados = array();
            foreach ($data as $chave => $valor) {
                $dados[] = $chave." = '".addslashes($valor)."'";
            }
            $sql = $sql.implode(", ", $dados);
            //echo $sql;
            try {
                return $this->pdo->query($sql);
            } catch (PDOException $exc) {
                echo $exc->getTraceAsString();
                echo ("<br><br>");
                echo $exc->getMessage();
            }
        }
    }
    
    public function update($table, $data, $where = array(), $where_cond = "AND"){
        if (!empty($table) && (is_array($data) && count($data)) && is_array($where)){
            $sql = "UPDATE ".$table." SET ";
            $dados = array();
            foreach ($data as $chave => $valor) {
                $dados[] = $chave." = '".addslashes($valor)."'";
            }
            $sql = $sql.implode(", ", $dados);
            if (count($where) > 0) {
                //$dados = array();
                //foreach ($where as $chave => $valor) {
                //    $dados[] = $chave." = '".addslashes($valor)."'";
                //}
                $dados = $this->montarWhere($where);
                $sql = $sql." WHERE ";
                $sql = $sql.implode(" ".$where_cond." ", $dados);
            }
            //echo $sql;
            try {
                return $this->pdo->query($sql);
            } catch (PDOException $exc) {
                echo $exc->getTraceAsString();
                echo ("<br><br>");
                echo $exc->getMessage();
            }
        }
    }
    
    public function delete($table, $where = array(), $where_cond = "AND"){
        if (!empty($table) && is_array($where)){
            $sql = "DELETE FROM ".$table;
            if (count($where) > 0) {
                //$dados = array();
                //foreach ($where as $chave => $valor) {
                //    $dados[] = $chave." = '".addslashes($valor)."'";
                //}
                $dados = $this->montarWhere($where);
                $sql = $sql." WHERE ";
                $sql = $sql.implode(" ".$where_cond." ", $dados);
            }
            //echo $sql;
            try {
                return $this->pdo->query($sql);
            } catch (PDOException $exc) {
                echo $exc->getTraceAsString();
                echo ("<br><br>");
                echo $exc->getMessage();
            }
        }
    }
    
    public function selectTable($tabela, $colunas, $where = array(), $where_cond = "AND", $groupBy = array()) {
        if (!empty($tabela) && (is_array($colunas) && count($colunas)>0 ) ){
            $sql = "SELECT ";
            $sql = $sql.implode(", ", $colunas);
            $sql = $sql." FROM ".$tabela." ";
            if (count($where) > 0) {
                //$dados = array();
                //foreach ($where as $chave => $valor) {
                //    $dados[] = $chave." = '".addslashes($valor)."'";
                //}
                $dados = $this->montarWhere($where);
                $sql = $sql."WHERE ";
                $sql = $sql.implode(" ".$where_cond." ", $dados);
            }
            if (count($groupBy) > 0) {
                $sql = $sql.implode(" ", $groupBy);
            }
            //echo $sql;
            $this->query($sql);
        }
    }
    
    public function numRows(){
        return $this->numRows;
    }
    
    public function result(){
        return $this->array;
    }
}
