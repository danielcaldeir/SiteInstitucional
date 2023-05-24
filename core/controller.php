<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller
 *
 * @author Daniel_Caldeira
 */
class Controller {
    private $config;
    
    //put your code here
    public function __construct() {
		global $config;
        $this->config = array();
        $cfg = new Config();
		if (!empty($_SESSION['token'])){
            $array = $cfg->getALLConfigIDEmpresa($_SESSION['idEmpresa']);
        } else {
            $array = $cfg->getALLConfigIDEmpresa($config['idEmpresa']);
        }
        // $array = $cfg->selecionarALLConfig();
        foreach ($array as $item) {
            $this->config[$item['nome']] = $item['valor'];
        }
    }
    
    public function loadView($viewName, $viewData = array()) {
        extract($viewData);
        include ("views/".$viewName.".php");
    }
    
    public function loadTemplate($viewName, $viewData = array()) {
        // print_r($this->config);
		if (!file_exists('views/templates/'.$this->config['site_template'].'.php')){
            include ("views/templates/default.php");
        } else {
            include ("views/templates/". $this->config['site_template'].".php");
        }
        // include ("views/template/".$this->config['site_template'].".php");
    }
    
    public function loadPainel($viewName, $viewData = array()) {
        // echo ("<br>Nome: ".$viewName);
        if (!file_exists('views/painel/'.$this->config['site_painel'].'.php')){
            include ("views/painel/template.php");
        } else {
            include ("views/painel/". $this->config['site_painel'].".php");
        }
        // include ("views/painel/". $this->config['site_painel'].".php");
		// include ("views/painel/template.php");
    }
    
    public function loadViewInPainel($viewName, $viewData = array()) {
        extract($viewData);
        include ("views/painel/".$viewName.".php");
    }
    
    public function loadMenu() {
		$menu = new Menu("menu");
		global $config;
        $viewMenu = array();
		$viewMenu['menu'] = $menu->getALLMenuIDEmpresa($config['idEmpresa']);
        // $viewMenu['menu'] = $menu->selecionarALLMenu();
        $this->loadView('menu', $viewMenu);
    }
    
    public function loadMenuPainel($menuActive = "") {
        $menu = new Menu("menuadmin");
		global $config;
		$viewMenu = array();
		$viewMenu['menu'] = $menu->getALLMenuIDEmpresa($config['idEmpresa']);
        // $viewMenu['menu'] = $menu->selecionarALLMenu();
		$viewMenu['menuActive'] = $menuActive;
        $this->loadViewInPainel('menu', $viewMenu);
    }
	
	public function setConfig($nome=null, $valor=null) {
        if (!(is_null($nome)) && !(is_null($valor)) ){
            $this->config[$nome] = $valor;
        }
    }
}
