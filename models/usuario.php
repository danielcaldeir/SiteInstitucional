<?php
//require_once ('conexao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario
 *
 * @author Daniel_Caldeira
 */
class Usuario extends Model{
    private $id;
    private $id_grupo;
	private $id_empresa;
    private $nome;
    private $email;
    private $senha;
    private $status;
    private $telefone;
    private $token;
    private $permissoes;

    private function incluirElementos($elementos = array()) {
        if (count($elementos) == 1){
            foreach ($elementos as $item) {
                $this->setID($item['id']);
                $this->setIDGrupo($item['id_grupo']);
				$this->setIDEmpresa($item['id_empresa']);
                $this->setNome($item['nome']);
                $this->setEmail($item['email']);
                $this->setSenha($item['senha']);
                $this->setStatus($item['status']);
                $this->setTelefone($item['telefone']);
                $this->setToken($item['token']);
            }
        }
    }
    
	// private function atualizarToken($idUsuario=null, $token=null) {
    //     $tabela = "usuarios";
    //     $dados = array ();
    //     if (is_null($token)){ $dados["token"] = $this->token; } 
    //     else { $dados["token"] = $token; }
    //     $where = array();
    //     if (is_null($idUsuario)){ $where["id"] = $this->id; } 
    //     else { $where["id"] =$idUsuario; }
    //     $this->update($tabela, $dados, $where);
    // }
	
	private function organizarFiltro($filtro = array()) {
        if (!is_null($filtro['empresa'])){ $filtro['user.id_empresa'] = $filtro['empresa']; }
        if (!is_null($filtro['permissao'])) { $filtro['user.id_grupo'] = $filtro['permissao']; }
        if (!is_null($filtro['status'])){ $filtro['user.status'] = $filtro['status']; }
        if (!is_null($filtro['nome'])){
            $chave = array();
            $chave['LIKE'] = $filtro['nome'];
            $filtro['user.nome'] = $chave;
        }
        if (!is_null($filtro['email'])){
            $chave = array();
            $chave['LIKE'] = $filtro['email'];
            $filtro['user.email'] = $chave;
        }
        unset($filtro['empresa']);
        unset($filtro['permissao']);
        unset($filtro['status']);
        unset($filtro['nome']);
        unset($filtro['email']);
        return $filtro;
    }
	
	public function selecionarALLUser($where = array()){
        $tabela = "usuarios as user";
        $colunas = array ("id", "id_grupo", "id_empresa", "nome", "email", "senha", "status", "telefone", "token");
        $where_cond = "AND";
        $groupBy = array();
		$this->selectTable($tabela, $colunas, $where, $where_cond, $groupBy);
        if ($this->numRows > 0){
            $array = $this->result();
            $this->incluirElementos($array);
        } else{
            $array = array();
        }
        return $array;
    }
	
    public function selecionarEmailSenha($email=null, $senha=null, $idEmpresa=null){
        $colunas = array ("id", "id_grupo", "id_empresa", "nome", "email", "senha", "status", "telefone", "token");
        $tabela = "usuarios";
        $where = array();
        if (is_null($email) && is_null($senha)){
            $where["email"] = $this->email;
            $where["senha"] = $this->senha;
        } else {
            $where["email"] = $email;
            $where["senha"] = $senha;
        }
		if (!(is_null($idEmpresa))){
            $where["id_empresa"] = $idEmpresa;
        }
        //$where = array();
        //    $where["email"] = $this->email;
        //    $where["senha"] = $this->senha;
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
    
    public function selecionarEmail($email=null, $idEmpresa=null){
        $tabela = "usuarios";
        $colunas = array ("id", "id_grupo", "id_empresa", "nome", "email", "senha", "status", "telefone", "token");
        $where = array();
        if (is_null($email)){
            $where["email"] = $this->email;
        } else {
            $where["email"] = $email;
        }
		if (!(is_null($idEmpresa))){
            $where["id_empresa"] = $idEmpresa;
        }
        //$where = array();
        //    $where["email"] = $this->email;
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
    
    public function selecionarUser($id=null){
        $tabela = "usuarios";
        $colunas = array ("id", "id_grupo", "id_empresa", "nome", "email", "senha", "status", "telefone", "token");
        $where = array();
        if (is_null($id)){
            $where["md5(id)"] = $this->id;
        } else{
            $where["md5(id)"] = $id;
        }
        //$where = array();
        //    $where["id"] = $this->id;
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
    
    public function getTotalUser($filtro = array()) {
        $where = $this->organizarFiltro($filtro);
        return $this->selecionarALLUser($where);
    }
    
    public function getAllUsuarios($filtro = array(), $offset = 0, $limit = 20) {
        $where = $this->organizarFiltro($filtro);
        return $this->selecionarUserPagination($where, $offset, $limit);
    }
    
    public function selecionarUserPagination($where = array(), $offset = 0, $limit = 20){
        $tabela = "usuarios as user LEFT JOIN permissao_grupo ON permissao_grupo.id = user.id_grupo";
        $colunas = array (
            "user.id", 
            "user.id_empresa",
            "user.id_grupo", 
            "user.nome", 
            "user.email", 
            "user.senha", 
            "user.status", 
            "user.telefone", 
            "user.token", 
            "permissao_grupo.nome as permissao_nome"
        );
        $where_cond = "AND";
        $groupBy = array("ORDER BY user.status DESC, user.nome ASC", "LIMIT $offset, $limit");
        $this->selectTable($tabela, $colunas, $where, $where_cond, $groupBy);
        if($this->numRows() > 0){
            $array = $this->result();
        } else {
            $array = array();
        }
        return $array;
    }
    
    public function incluirNomeEmailSenha($nome=null, $email=null, $senha=null, $telefone=null, $idEmpresa=null){
        $dados = array();
        if (is_null($nome)){ $dados["nome"] = $this->nome; } 
        else { $dados["nome"] = $nome; }
        
        if (is_null($email)){ $dados["email"] = $this->email; } 
        else { $dados["email"] = $email; }
        
        if (is_null($senha)){ $dados["senha"] = md5($this->senha); } 
        else { $dados["senha"] = md5($senha); }
        
        if (is_null($telefone)){ $dados["telefone"] = $this->telefone; } 
        else { $dados["telefone"] = $telefone; }
		
		if (is_null($idEmpresa)){
            $dados["id_empresa"] = 0;
        } else {
            $dados["id_empresa"] = $idEmpresa;
        }
        //$dados = array ();
        //    $dados["nome"] = $this->nome;
        //    $dados["email"] = $this->email;
        //    $dados["senha"] = md5($this->senha);
        //    $dados["status"] = 0;
        //    $dados["telefone"] = $this->telefone;
        //);
		$tabela = "usuarios";
        $this->insert($tabela, $dados);
        $this->query("SELECT LAST_INSERT_ID() as ID");
        return $this->array;
    }
    
	public function atualizarNomeEmail($idUsuario, $nome=null, $email=null, $telefone=null, $idEmpresa=null){
        // ($idUsuario, $IdEmpresa, $nome, $email, $senha, $telefone){
        $dados = array ();
        if(is_null($nome)){ $dados["nome"] = $this->nome; } 
        else { $dados["nome"] = $nome; }
        
        if(is_null($email)){ $dados["email"] = $this->email; } 
        else { $dados["email"] = $email; }
        
        if(is_null($telefone)){ $dados["telefone"] = $this->telefone; } 
        else { $dados["telefone"] = $telefone; }
        
        if (is_null($idEmpresa)){
            $dados["id_empresa"] = 0;
        } else {
            $dados["id_empresa"] = $idEmpresa;
        }
        
        $tabela = "usuarios";
        $where = array ();
            $where["id"] = $idUsuario;
        //);
        $this->update($tabela, $dados, $where);
    }
	
    public function validarPermissao($permissao_slug) {
        //print_r($permissao_slug);
        //echo ("<br>");
        //print_r($this->permissoes);
        if (in_array($permissao_slug, $this->permissoes)){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function isLogado($token) {
        $permissao = new Permissao();
        $where = array();
            $where['token'] = $token;
        $array = $this->selecionarALLUser($where);
		
        // $tabela = "usuarios";
        // $colunas = array ("id", "id_grupo", "nome", "email", "senha", "status", "telefone", "token");
        // $where = array();
        //     $where['token'] = $token;
        // $this->selectTable($tabela, $colunas, $where);
		
        if (count($array) > 0){
            // $array = $this->result();
            $this->incluirElementos($array);
            // echo ("<br>");
            // echo ("IDGrupo: ");  print_r($this->getIDGrupo());
            // echo ("<br>");
            $slugs = $permissao->getSelectIDGrupo($this->getIDGrupo());
            $this->setPermissoes($slugs);
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    public function validatePermissaoGrupo($id_grupo, $idEmpresa=null){//($id_empresa, $id_grupo) {
        $where = array();
            $where['id_grupo'] = $id_grupo;
            //$where['id_empresa'] = $id_empresa;
        if (!(is_null($idEmpresa))){
            $where['id_empresa'] = $idEmpresa;
        }
        $array = $this->selecionarALLUser($where);
		
		// $tabela = "usuarios";
        // $colunas = array ("id", "id_grupo", "nome", "email", "senha", "status", "telefone", "token");
        // $where = array();
        //     $where['id_grupo'] = $id_grupo;
        //     //$where['id_empresa'] = $id_empresa;
        // $this->selectTable($tabela, $colunas, $where);
		
        if (count($array) === 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    public function validateLogin($email, $senha, $idEmpresa=null) {
        if (is_null($idEmpresa)){
            $this->selecionarEmailSenha($email, $senha);
        } else {
            $this->selecionarEmailSenha($email, $senha, $idEmpresa);
        }
        //$this->selecionarEmailSenha($email, $senha);
        if ($this->numRows == 1){
            switch ($this->getStatus()) {
                case '2': $token = md5(time(). rand(0, 999).$this->id); break;  // Perfil Administrativo
                case '1': $token = md5(time().$this->id); break;                // Perfil Habilitado
                case '0': $token = $this->id; break;                            // Perfil Desabilitado
                default : $token = 0; break;                                    // ERROR
            }
            $this->setToken($token);
            $this->atualizarToken($this->id, $token);
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    public function atualizarToken($idUsuario=null, $token=null) {
        $tabela = "usuarios";
        $dados = array ();
        if (is_null($token)){
            $dados["token"] = $this->token;
        } else {
            $dados["token"] = $token;
        }
        
        $where = array();
        if (is_null($idUsuario)){
            $where["id"] = $this->id;
        } else {
            $where["id"] =$idUsuario;
        }
        
        $this->update($tabela, $dados, $where);
    }
    
    public function atualizarStatus($id=null, $status=null) {
        $tabela = "usuarios";
        $dados = array();
        if (is_null($status)){
            $dados["status"] = $this->status;
        } else {
            $dados["status"] = $status;
        }
        
        $where = array();
        if (is_null($id)){
            $where["md5(id)"] = $this->id;
        } else {
            $where["md5(id)"] = $id;
        }
        
        return $this->update($tabela, $dados, $where);
    }
    
    public function atualizarPermissao($id=null, $grupo=null) {
        $tabela = "usuarios";
        $dados = array();
        if (is_null($grupo)){
            $dados["id_grupo"] = $this->id_grupo;
        } else {
            $dados["id_grupo"] = $grupo;
        }
        
        $where = array();
        if (is_null($id)){
            $where["id"] = $this->id;
        } else {
            $where["id"] = $id;
        }
        
        return $this->update($tabela, $dados, $where);
    }
    
    public function atualizarSenha($id=null, $senha=null){
        $tabela = "usuarios";
        $dados = array();
        if (is_null($senha)){
            $dados["senha"] = md5($this->senha);
        } else {
            $dados["senha"] = md5($senha);
        }
        
        $where = array();
        if (is_null($id)){
            $where["id"] = $this->id;
        } else {
            $where["id"] = $id;
        }
        
        $this->update($tabela, $dados, $where);
    }
	
    // falta Analisar daqui para baixo.
    //public function confirmarEmail($id=null, $status=null) {
    //    $tabela = "usuarios";
    //    $dados = array();
    //    if (is_null($status)){
    //        $dados["status"] = '1';
    //    } else {
    //        $dados["status"] = intval($status);
    //    }
    //    //$dados = array();
    //    //    $dados["status"] = '1';
    //    //);
    //    $where = array();
    //    if (is_null($id)){
    //        $where["md5(id)"] = $this->id;
    //    } else {
    //        $where["md5(id)"] = $id;
    //    }
    //    //$where = array();
    //    //    $where["md5(id)"] = $this->id;
    //    //);
    //    return $this->update($tabela, $dados, $where);
    //}
    
    //put your code here
    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    
    public function setIDGrupo($id_grupo) { $this->id_grupo = $id_grupo; }
    public function getIDGrupo() { return $this->id_grupo; }
    
	public function setIDEmpresa($idEmpresa) { $this->id_empresa = $idEmpresa; }
    public function getIDEmpresa() { return $this->id_empresa; }
	
    public function setNome($nome) { $this->nome = $nome; }
    public function getNome() { return $this->nome; }
    
    public function setEmail($email) { $this->email = $email; }
    public function getEmail() { return $this->email; }
    
    public function setSenha($senha) { $this->senha = $senha; }
    public function getSenha() { return $this->senha; }
    
    public function setStatus($status) { $this->status = $status; }
    public function getStatus() { return $this->status; }
    
    public function setTelefone($telefone) { $this->telefone = $telefone; }
    public function getTelefone() { return $this->telefone; }
    
    public function setToken($token) { $this->token = $token; }
    public function getToken() { return $this->token; }
    
    public function setPermissoes($permissoes) { $this->permissoes = $permissoes; }
    public function getPermissoes() { return $this->permissoes; }
}
