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
        $this->config = array();
        $cfg = new Config();
        $array = $cfg->selecionarALLConfig();
        foreach ($array as $item) {
            $this->config[$item['nome']] = $item['valor'];
        }
    }
    
    public function loadView($viewName, $viewData = array()) {
        extract($viewData);
        include ("views/".$viewName.".php");
    }
    
    public function loadTemplate($viewName, $viewData = array()) {
        //print_r($this->config);
        include ("views/template/".$this->config['site_template'].".php");
    }
    
    public function loadPainel($viewName, $viewData = array()) {
        //echo ("<br>Nome: ".$viewName);
        //include ("views/painel/". $this->config['site_painel'].".php");
	include ("views/painel/template.php");
    }
    
    public function loadViewInPainel($viewName, $viewData = array()) {
        extract($viewData);
        include ("views/painel/".$viewName.".php");
    }
    
    public function loadMenu() {
        $menu = new Menu("menu");
        $viewMenu = array();
        $viewMenu['menu'] = $menu->selecionarALLMenu();
        $this->loadView('menu', $viewMenu);
    }
    
    public function loadMenuPainel() {
        $menu = new Menu("menu");
        $viewMenu = array();
        $viewMenu['menu'] = $menu->selecionarALLMenu();
        $this->loadViewInPainel('menu', $viewMenu);
    }
}
