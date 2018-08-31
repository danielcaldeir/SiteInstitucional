<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of homeController
 *
 * @author Daniel_Caldeira
 */
class homeController extends controller{
    //put your code here
    
    public function index() {
        $dados = array ();
		//$dados['nome'] = "Daniel Caldeira";
        
        $portfolio = new Portfolio();
        $dados['portfolio'] = $portfolio->getTrabalhos(4);
		
		$pag = new Paginas();
		$dados['paginas'] = $pag->selecionarAllPaginas();
        
        $this->loadTemplate("home", $dados);
    }
    
    public function portfolio() {
        $dados = array ();
        
        $portfolio = new Portfolio();
        $dados['portfolio'] = $portfolio->getTrabalhos();
        
        $this->loadTemplate("portfolio", $dados);
    }
    
	public function pagina($url){
		$pag = new Paginas();
        $pag->selecionarPaginasURL($url);
        
        $dados = array();
        $dados["url"] = $pag->getURL();
        $dados["titulo"] = $pag->getTitulo();
        $dados["corpo"] = $pag->getCorpo();
        
        $this->loadTemplate("paginas", $dados);
	}
	
	public function formulario($titulo){
		$form = new Formulario();
		global $config;
        
        $dados = array();
        $dados["email"] = $config['email'];
        $dados["titulo"] = $titulo;
        $dados["formularios"] = $form->selecionarFormularioTitulo($titulo);
        
        $this->loadTemplate("formularios", $dados);
	}
	
    //public function sobre() {
    //    $this->loadTemplate("sobre");
    //}
    
    //public function servicos() {
    //    $dados = array();
    //    $this->loadTemplate("servicos" , $dados);
    //}
    
    //public function contato() {
    //    $dados = array();
    //    $this->loadTemplate("contato", $dados);
    //}
	
    public function enviarEmail() {
		if(!empty($_POST['titulo'])) {
			$titulo = $_POST['titulo'];
			unset($_POST['titulo']);
			$label = array_keys($_POST);
			$valor = array();
			if (count($label) > 0){
				for ($i=0; $i<count($label);$i++){
					$valor[] = $_POST[$label[$i]];
				}
			}
			
			$msg = "Os Valores passados foram: <br/>";
			if (count($label) > 0){
				for ($i=0; $i<count($label);$i++){
					$msg = $msg . $label[$i]. " : ". $valor[$i]. "<br/>"; 
				}
			}
            $email = $_POST['email'];
			//$msg = $_POST['mensagem'];
			
			$assunto = "Formulario do Sistema: ".$titulo."!";
            $mensagem = "Clique no link para redefinir sua senha:<br/>";
			$mensagem = $mensagem . $msg;
            
			$headers = 'From: seuemail@seusite.com.br'."\r\n" .
                              'X-Mailer: PHP/'.phpversion();
                
            mail($email, $assunto, $mensagem, $headers);
			
			
                
                echo ("<h2>OK! ".utf8_decode($assunto)."</h2>");
                echo ("<br>");
                echo ("<br>");
                echo ("<h2>E-Mail: ".$email."</h2>");
                //echo ("<a href=".$link.">Clique aqui para redefinir senha</a>");
                
                echo $mensagem;
            exit();    
                //$dados = array();
				//$dados["redefinir"] = "true";
        }
        $dados = array();
        $this->loadTemplate("contato", $dados);
    }
	
    public function indexClassificados() {
        
        $refat = 1;
        
        if (isset($_GET['refat']) && !empty($_GET['refat'])){
            $refat = $_GET['refat'];
        }
        
        $qtdPag = 2;
        
        $anuncio = new anuncios();
        
        $filtros = array(
            'categoria' => '',
            'preco' => '',
            'estado' => ''
        );
        
        if (isset($_GET['filtros'])){
            $filtros = $_GET['filtros'];
            if (!empty($filtros['categoria'])){
                $anuncio->setIDCategoria($filtros['categoria']);
            }
            if (!empty($filtros['preco'])){
                $preco = explode("-", $filtros['preco']);
                //print_r($preco);
                $anuncio->setValor($preco);
            }
            if (!empty($filtros['estado'])){
                $anuncio->setEstado($filtros['estado']);
            }
        }
        
        $result = $anuncio->selecionarALLAnuncios($refat, $qtdPag);
        if ($anuncio->numRows() == 1){
            $result = array();
            $result[] = $anuncio->result();
        }
        
        $categoria = new categorias();
        $categorias = $categoria->selecionarAllCategorias();
        if ($categoria->numRows() == 1){
            $categorias = array();
            $categorias[] = $categoria->result();
        }
        
        $usuario = new usuario();
        $usuario->selecionarALLUser();
        $totUsuarios = $usuario->numRows();
        
        $resultQTD = $anuncio->getQTDAnuncios();
        $totAnuncios = $resultQTD['qtd'];
        
        $totalPag = ceil($totAnuncios / $qtdPag);
        
        $dados = array (
            "refat" => $refat,
            "filtros" => $filtros,
            "result" => $result,
            "categorias" => $categorias,
            "totAnuncios" => $totAnuncios,
            "totUsuarios" => $totUsuarios,
            "totalPag" => $totalPag
        );
        
        $this->loadTemplate("inicial", $dados);
    }
    
    public function sair() {
        session_destroy();
        global $config;
        $config['connect'] = "desconnect";
        
        //exit();
        header("Location: ".BASE_URL);
        //$home = new homeController();
        //$home->index();
    }
    
    public function senha($url) {
        echo ("<br>Vamos trocar a senha!!");
        echo ("<br>Nova senha a ser informada: ".$url);
        
    }
    
    public function posts() {
        $posts = new posts();
        
        $dados['posts'] = $posts->selecionarALL();
        
        //print_r($dados);
        //echo ("<br>");
                
        $this->loadTemplate("posts", $dados);
    }
}
