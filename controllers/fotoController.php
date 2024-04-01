<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fotoController
 *
 * @author Daniel_Caldeira
 */
class fotoController extends Controller
{
    //put your code here
    public function index()
    {
        $dados = array();

        $this->loadTemplate("erro", $dados);
    }

    public function excluirFoto($fotos = array())
    {
        $dados = array();

        $this->loadTemplate("erro", $dados);
    }

    public function addFoto($id = null, $fotos = array())
    {
        // print "<br><br>Quantidade: ".count($fotos['tmp_name']);
        if (count($fotos['tmp_name']) > 0) {
            $destino = (".\\imagem\\produto\\");
            // print "<br><br>";
            // print_r($destino);

            for ($q = 0; $q < count($fotos['tmp_name']); $q++) {
                $tipo = $fotos['type'][$q];
                // print "<br><br>";
                // print_r($tipo);

                if (in_array($tipo, array('image/jpg', 'image/png', 'image/jpeg'))) {
                    $nomeFoto = time() . rand("0", "0.99") . $fotos['name'][$q];
                    move_uploaded_file($fotos['tmp_name'][$q], $destino . $nomeFoto);
                    // print "<br><br>";
                    // print_r($nomeFoto);
                    // print "<br><br>";

                    list($larguraOriginal, $alturaOriginal) = getimagesize($destino . $nomeFoto);
                    $ratio = $larguraOriginal / $alturaOriginal;
                    $largura = "500";
                    $altura = "500";
                    if ($largura / $altura > $ratio) {
                        $largura = $altura * $ratio;
                    } else {
                        $altura = $largura / $ratio;
                    }

                    $imagemFinal = imagecreatetruecolor($largura, $altura);
                    if ($tipo == "image/jpg") {
                        $imageOriginal = imagecreatefromjpeg($destino . $nomeFoto);
                    } elseif ($tipo == "image/jpeg") {
                        $imageOriginal = imagecreatefromjpeg($destino . $nomeFoto);
                    } elseif ($tipo == "image/png") {
                        $imageOriginal = imagecreatefrompng($destino . $nomeFoto);
                    }

                    imagecopyresampled($imagemFinal, $imageOriginal, 0, 0, 0, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);
                    imagejpeg($imagemFinal, $destino . $nomeFoto, 80);

                    $anunImagens = new anunciosImagens();
                    $anunImagens->setIDAnuncio($id);
                    $anunImagens->setURL($nomeFoto);
                    $anunImagens->incluirAnunciosImagens();
                }
            }
        }
    }

    public function addPortfolio($fotos = array())
    {
        //print "<br><br>Quantidade: ".count($fotos['tmp_name']);
        if (count($fotos['tmp_name']) > 0) {
            $destino = (".\\imagem\\portfolio\\");
            //    print "<br><br>";
            //    print_r($destino);

            for ($q = 0; $q < count($fotos['tmp_name']); $q++) {
                $tipo = $fotos['type'][$q];
                //        print "<br><br>";
                //        print_r($tipo);

                if (in_array($tipo, array('image/jpg', 'image/png', 'image/jpeg'))) {
                    //$nomeFoto = time().rand("0","0.99").$fotos['name'][$q];
                    $nomeFoto = $fotos['name'][$q];
                    move_uploaded_file($fotos['tmp_name'][$q], $destino . $nomeFoto);
                    //            print "<br><br>";
                    //            print_r($nomeFoto);
                    //            print "<br><br>";

                    list($larguraOriginal, $alturaOriginal) = getimagesize($destino . $nomeFoto);
                    //    $ratio = $larguraOriginal / $alturaOriginal;
                    //    $largura = "500";
                    //    $altura = "500";
                    //    if ($largura / $altura > $ratio) {
                    //        $largura = $altura * $ratio;
                    //    } else {
                    //        $altura = $largura / $ratio;
                    //    }

                    $imagemFinal = imagecreatetruecolor($larguraOriginal, $alturaOriginal);
                    //    $imagemFinal = imagecreatetruecolor($largura, $altura);
                    if ($tipo == "image/jpg") {
                        $imageOriginal = imagecreatefromjpeg($destino . $nomeFoto);
                    } elseif ($tipo == "image/jpeg") {
                        $imageOriginal = imagecreatefromjpeg($destino . $nomeFoto);
                    } elseif ($tipo == "image/png") {
                        $imageOriginal = imagecreatefrompng($destino . $nomeFoto);
                    }

                    //    imagecopyresampled($imagemFinal, $imageOriginal, 0, 0, 0, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);
                    imagecopyresampled($imagemFinal, $imageOriginal, 0, 0, 0, 0, $larguraOriginal, $alturaOriginal, $larguraOriginal, $alturaOriginal);
                    imagejpeg($imagemFinal, $destino . $nomeFoto, 80);

                    $portfolio = new Portfolio();
                    $portfolio->incluirPortfolio($nomeFoto);
                }
            }
        }
    }

    public function delPortfolio($imagem = null, $destino = null)
    {
        //print ($imagem);
        //print ('<br>');
        //print ($destino);
        $portfolio = new Portfolio();
        $portfolio->getPortfolioImagem($imagem);

        $id = $portfolio->getID();
        if (is_int($id)) {
            //$fp = fopen($destino,'r');
            //$portfolio->deletarPortfolio($id);
            $ret = unlink($destino);
            if ($ret) {
                print('Arquivo Excluido');
                $portfolio->deletarPortfolio($id);
            } else {
                print('Erro ao Excluir');
            }
        } else {
            print('Erro Nao foi encontrado o Portifolio');
        }
    }
}
