<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of notFoundController
 *
 * @author Daniel_Caldeira
 */
class notFoundController extends controller{
    //put your code here
    public function index() {
        $dados = array();
                
        $this->loadTemplate("404", $dados);
    }
}
