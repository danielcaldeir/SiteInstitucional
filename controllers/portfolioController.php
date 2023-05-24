<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of portfolioController
 *
 * @author daniel
 */
class portfolioController extends controller{
    private $user;
    private $arrayInfo;
    
    public function __construct() {
        $this->user = new Usuario();
        $this->arrayInfo = array();
        
        if (!empty($_SESSION['token'])){
            //print_r($_SESSION['token']);
            if (!$this->user->isLogado($_SESSION['token'])){
                //adminLTEController::logout();
                loginController::logout();
                exit();
            }
            //$this->permissao->getPermissaoIDGrupo($this->user->getIDGrupo());
            
            if (!$this->user->validarPermissao('view_portfolio')){
                $filtro = array('permission'=>1);
                //loginController::login($filtro);
                $login = new loginController();
                $login->index($filtro);
                exit();
            }
        } else {
            //$admin = new adminLTEController();
            $login = new loginController();
            $login->index();
            exit();
        }
        
        $this->arrayInfo["menuActive"] = "portfolio";
        $this->arrayInfo["user"] = $this->user;
        $empresa = new Empresa();
        $empresa->selecionarEmpresaID(md5($this->user->getIdEmpresa()));
        $this->arrayInfo["empresa"] = $empresa;
        $this->arrayInfo["permissao"] = $this->user->getPermissoes();
        
        //global $config;
        //$this->config = $config;
        parent::__construct();
    }
    
    //put your code here
    public function index($confirme=null) {
        $portfolio = new Portfolio();
        
        $this->arrayInfo['portfolio'] = $portfolio->getTrabalhos();
        $this->arrayInfo['nome'] = "Administrador: ".$this->user->getNome();
        $this->arrayInfo['mensagem'] = $confirme;
        
        $this->loadPainel("selPortfolio", $this->arrayInfo);
    }
    
	public function add($confirme = "") {
        // $user = new Usuarios();
        // $per = new Permissao();
        $IDEmpresa = $this->user->getIDEmpresa();
        
        // $this->arrayInfo['permissaoGrupo'] = $per->getAllPermissaoGrupo($IDEmpresa);
        $this->arrayInfo['mensagem'] = $confirme;
        
        $this->loadPainel("addPortfolio", $this->arrayInfo);
    }
	
    public function addPortfolio(){
        if (isset($_FILES['fotos'])) {
            $fotos = $_FILES['fotos'];
        } else {
            $fotos = array();
        }
        print_r($fotos);
        //exit();
        
        $fotoCTRL = new fotoController();
        $fotoCTRL->addPortfolio($fotos);
        
        //$dados = array();
        //$dados['sucess'] = TRUE;
        $confirme = "Foto Cadastrada com Sucesso";
        $this->index($confirme);
    }
    
    public function delPortfolio($id){
        $portfolio = new Portfolio;
		$fotoCTRL = new fotoController();
		$dados = array();
		$portfolio->getPortfolioID($id);
		
		$dados['id'] = $portfolio->getID();
		$dados['imagem'] = $portfolio->getImagem();
		
		$destino = (".\\imagem\\portfolio\\");
		if (file_exists($destino.$portfolio->getImagem())){
			$destinoFinal = $destino.$portfolio->getImagem();
			print ('Verdadeiro');
			print ('<br/>');
			$fotoCTRL->delPortfolio($portfolio->getImagem(), $destinoFinal);
		} else{
			print ($portfolio->getImagem());
			print ('<br/>');
			print ('Falso');
		}
		
        //$dados['portfolio'] = $portfolio->deletarPortfolio($id);
        //exit();
        $this->loadPainel("delPortfolio", $dados);
    }
}
