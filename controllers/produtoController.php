<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of produtoController
 *
 * @author Daniel_Caldeira
 */
class produtoController extends Controller
{
    private $user;
    private $arrayInfo;

    public function __construct()
    {
        $this->user = new Usuario();
        $this->arrayInfo = array();

        if (!empty($_SESSION['token'])) {
            //print_r($_SESSION['token']);
            if (!$this->user->isLogado($_SESSION['token'])) {
                //adminLTEController::logout();
                loginController::logout();
                exit();
            }
            //$this->permissao->getPermissaoIDGrupo($this->user->getIDGrupo());
            if (!$this->user->validarPermissao('add_permissao')) {
                $filtro = array('permission' => 1);
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
        // echo ("<pre>");
        // print_r($_SESSION);
        // echo ("</pre>");
        $this->arrayInfo["menuActive"] = "produto";
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
    public function index($confirme = "")
    {
        $anun = new anuncios();
        $cat = new categorias();

        $anun->setIDUsuario($this->user->getID());
        $this->arrayInfo['anuncios'] = $anun->selecionarAnuncios();
        $this->arrayInfo['cats'] = $cat->selecionarAllCategorias();
        $this->arrayInfo['mensagem'] = $confirme;
        $this->loadPainel("selAnuncios", $this->arrayInfo);
        // $id_usuario = $_SESSION['id'];
        // $anun->setIDUsuario($id_usuario);
        // $anuncios = $anun->selecionarAnuncios();
        // if ($anun->numRows() == 1){
        //     $anuncios = array();
        //     $anuncios[] = $anun->result();
        // }
        // $dados = array (
        //     "anuncios" => $anuncios,
        //     "confirme" => $confirme
        // );
        // $this->loadTemplate("meusAnuncios", $dados);
    }

    public function add()
    {
        $cat = new categorias();
        $this->arrayInfo['cats'] = $cat->selecionarAllCategorias();
        $this->loadPainel("addAnuncio", $this->arrayInfo);
    }

    public function addAction()
    {
        $dados = array();
        if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
            // $usuario = addslashes($_POST['usuario']);
            $usuario = $this->user->getID();
            $IDEmpresa = $this->user->getIDEmpresa();
            $titulo = addslashes($_POST['titulo']);
            $categoria = addslashes($_POST['categoria']);
            $valor = addslashes($_POST['valor']);
            $descricao = addslashes($_POST['descricao']);
            $estado = addslashes($_POST['estado']);

            if (!empty($titulo) && !empty($categoria) && !empty($valor)) {
                $anuncio = new anuncios();
                $anuncio->setIDUsuario($usuario);
                $anuncio->setTitulo($titulo);
                $anuncio->setIDCategoria($categoria);
                $anuncio->setIDEmpresa($IDEmpresa);
                $anuncio->setValor($valor);
                $anuncio->setDescricao($descricao);
                $anuncio->setEstado($estado);

                $anuncio->incluirAnuncios();
                // header("Location: ../index.php?pag=addAnuncio&sucess=true");
                // $dados["sucess"] = "true";
                $mensagem = "Inclusao da Empresa realizado com sucesso!";
            } else {
                // header("Location: ../index.php?pag=addAnuncio&error=true");
                // $dados["error"] = "true";
                $mensagem = "Inclusao nao realizada!";
            }
        } else {
            // header("Location: ../index.php?pag=addAnuncio&error=true");
            // $dados["error"] = "true";
            $mensagem = "Inclusao nao realizada!";
        }
        $this->index($mensagem);
        // $c = new categorias();
        // $cats = $c->selecionarAllCategorias();
        // $dados["cats"] = $cats;
        // $this->loadTemplate("addAnuncio", $dados);
    }

    public function edit($id, $confirme = "")
    {
        $anuncio = new anuncios();
        $anuncio->setID($id);
        // $info = $anuncio->selecionarAnunciosID();
        // $info = $anuncio->result();

        $anunImagens = new anunciosImagens();
        $anunImagens->setIDAnuncio($id);
        $anunImagens->selecionarAnunciosImagens();

        if ($anunImagens->numRows() > 0) {
            $fotosArray = $anunImagens->result();
            $fotos = true;
        } else {
            $fotosArray = array();
            $fotos = false;
        }
        $cat = new categorias();
        $this->arrayInfo['id'] = $id;
        $this->arrayInfo['mensagem'] = $confirme;
        $this->arrayInfo['info'] = $anuncio->selecionarAnunciosID();
        $this->arrayInfo['cats'] = $cat->selecionarAllCategorias();
        $this->arrayInfo['fotos'] = $fotos;
        $this->arrayInfo['fotosArray'] = $fotosArray;

        $this->loadPainel("editAnuncio", $this->arrayInfo);
    }

    public function editAction()
    {
        $anuncio = new anuncios();
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);
            $IDEmpresa = $this->user->getIDEmpresa();
            // $usuario = addslashes($_POST['usuario']);
            $usuario = $this->user->getID();
            $titulo = addslashes($_POST['titulo']);
            $categoria = addslashes($_POST['categoria']);
            $valor = addslashes($_POST['valor']);
            $descricao = addslashes($_POST['descricao']);
            $estado = addslashes($_POST['estado']);
            if (isset($_FILES['fotos'])) {
                $fotos = $_FILES['fotos'];
            } else {
                $fotos = array();
            }
            // print_r($fotos);
            // exit();

            if (!empty($titulo) && !empty($categoria) && !empty($valor)) {
                $anuncio->setID($id);
                $anuncio->setIDUsuario($usuario);
                $anuncio->setIDEmpresa($IDEmpresa);
                $anuncio->setTitulo($titulo);
                $anuncio->setIDCategoria($categoria);
                $anuncio->setValor($valor);
                $anuncio->setDescricao($descricao);
                $anuncio->setEstado($estado);
                $anuncio->atualizarAnuncios();

                $array = $anuncio->selecionarAnunciosID();
                foreach ($array as $key => $value) {
                    $idAnuncio = $value['id'];
                }

                $fotoCTRL = new fotoController();
                $fotoCTRL->addFoto($idAnuncio, $fotos);
                // exit();
                // header("Location: ../index.php?pag=editarAnuncio&sucess=true&id=".$id);
                // header("Location: ".BASE_URL."produto/editarAnuncio/".$id."/sucess");
                $confirme = "Atualização realizada com sucesso!";
                $this->edit($id, $confirme);
            } else {
                // header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
                // header("Location: ".BASE_URL."produto/editarAnuncio/".$id."/error");
                $confirme = "Nao foi informado um ID valido";
                $this->edit($id, $confirme);
            }
        } else {
            // header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
            // header("Location: ".BASE_URL."produto/editarAnuncio/".$id."/error");
            $confirme = "Nao foi informado um ID valido";
            $this->edit(null, $confirme);
        }
    }

    public function delAction($id)
    {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];

            $imagem = new anunciosImagens();
            $imagem->setIDAnuncio($id);
            $imagem->deletarAnunciosImagens();

            $anuncio = new anuncios();
            $anuncio->setID($id);
            $anuncio->deletarAnuncios();

            //header("Location: ../index.php?pag=meusAnuncios&excluir=true");
            $dados = array(
                "confirme" => "excluir"
            );
            $this->loadTemplate("meusAnuncios", $dados);
        } else {
            $this->excluirAnuncio(null);
            // $dados = array(
            //     "id" => NULL
            // );
            // $this->loadTemplate("excluirAnuncio", $dados);
        }
    }

    public function addAnuncio($confirme = null)
    {
        $c = new categorias();
        $cats = $c->selecionarAllCategorias();
        $this->arrayInfo['cats'] = $cats;
        $this->arrayInfo['mensagem'] = $confirme;
        // $dados = array ();
        //     $dados["cats"] = $cats;
        // );
        $this->loadPainel("addAnuncio", $this->arrayInfo);
    }

    public function adicionarAnuncio()
    {
        $dados = array();
        if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
            // $usuario = addslashes($_POST['usuario']);
            $usuario = $this->user->getID();
            $IDEmpresa = $this->user->getIDEmpresa();
            $titulo = addslashes($_POST['titulo']);
            $categoria = addslashes($_POST['categoria']);
            $valor = addslashes($_POST['valor']);
            $descricao = addslashes($_POST['descricao']);
            $estado = addslashes($_POST['estado']);

            if (!empty($titulo) && !empty($categoria) && !empty($valor)) {
                $anuncio = new anuncios();
                $anuncio->setIDUsuario($usuario);
                $anuncio->setTitulo($titulo);
                $anuncio->setIDCategoria($categoria);
                $anuncio->setIDEmpresa($IDEmpresa);
                $anuncio->setValor($valor);
                $anuncio->setDescricao($descricao);
                $anuncio->setEstado($estado);

                $anuncio->incluirAnuncios();
                //exit();
                //header("Location: ../index.php?pag=addAnuncio&sucess=true");
                // $dados["sucess"] = "true";
                $confirme = "Parabens Anuncio Realizado!";
                //exit();
            } else {
                //header("Location: ../index.php?pag=addAnuncio&error=true");
                // $dados["error"] = "true";
                $confirme = "Preencha todos os Campos";
            }
        } else {
            //header("Location: ../index.php?pag=addAnuncio&error=true");
            // $dados["error"] = "true";
            $confirme = "Preencha todos os Campos";
        }
        $this->addAnuncio($confirme);
        // $c = new categorias();
        // $cats = $c->selecionarAllCategorias();
        // $dados["cats"] = $cats;
        // $this->loadTemplate("addAnuncio", $dados);
    }

    public function editarAnuncio($id, $confirme = "")
    {
        $anuncio = new anuncios();
        $anuncio->setID($id);
        // $info = $anuncio->selecionarAnunciosID();
        // $info = $anuncio->result();

        $anunImagens = new anunciosImagens();
        $anunImagens->setIDAnuncio($id);
        $anunImagens->selecionarAnunciosImagens();
        if ($anunImagens->numRows() > 0) {
            $fotosArray = $anunImagens->result();
            $fotos = true;
        } else {
            $fotosArray = array();
            $fotos = false;
        }
        $c = new categorias();
        // $cats = $c->selecionarAllCategorias();

        $this->arrayInfo['id'] = $id;
        $this->arrayInfo['confirme'] = $confirme;
        $this->arrayInfo['info'] = $anuncio->selecionarAnunciosID();
        $this->arrayInfo['fotos'] = $fotos;
        $this->arrayInfo['cats'] = $c->selecionarAllCategorias();
        $this->arrayInfo['fotosArray'] = $fotosArray;
        // $dados = array (
        //     "id" => $id,
        //     "confirme" => $confirme,
        //     "info" => $info,
        //     "fotos" => $fotos,
        //     "cats" => $cats,
        //     "fotosArray" => $fotosArray
        // );
        $this->loadPainel("editarAnuncio", $this->arrayInfo);
    }

    public function sisEditarAnuncio()
    {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);
            // $usuario = addslashes($_POST['usuario']);
            $usuario = $this->user->getID();
            $IDEmpresa = $this->user->getIDEmpresa();
            $titulo = addslashes($_POST['titulo']);
            $categoria = addslashes($_POST['categoria']);
            $valor = addslashes($_POST['valor']);
            $descricao = addslashes($_POST['descricao']);
            $estado = addslashes($_POST['estado']);
            if (isset($_FILES['fotos'])) {
                $fotos = $_FILES['fotos'];
            } else {
                $fotos = array();
            }
            // print_r($fotos);
            // exit();

            if (!empty($titulo) && !empty($categoria) && !empty($valor)) {
                $anuncio = new anuncios();
                $anuncio->setID($id);
                $anuncio->setIDUsuario($usuario);
                $anuncio->setTitulo($titulo);
                $anuncio->setIDCategoria($categoria);
                $anuncio->setIDEmpresa($IDEmpresa);
                $anuncio->setValor($valor);
                $anuncio->setDescricao($descricao);
                $anuncio->setEstado($estado);
                $anuncio->atualizarAnuncios();

                $array = $anuncio->selecionarAnunciosID();
                foreach ($array as $key => $value) {
                    $idAnuncio = $value['id'];
                }

                $fotoCTRL = new fotoController();
                $fotoCTRL->addFoto($idAnuncio, $fotos);

                // print "<br><br>Quantidade: ".count($fotos['tmp_name']);
                // if (count($fotos['tmp_name']) > 0){
                //     $destino = (".\\upload\\");
                //     print "<br><br>";
                //     print_r($destino);
                //     for ($q=0; $q<count($fotos['tmp_name']); $q++){
                //         $tipo = $fotos['type'][$q];
                //         print "<br><br>";
                //         print_r($tipo);
                //         if (in_array($tipo, array('image/jpg','image/png','image/jpeg'))) {
                //             $nomeFoto = time().rand("0","0.99").$fotos['name'][$q];
                //             move_uploaded_file($fotos['tmp_name'][$q], $destino.$nomeFoto);
                //             print "<br><br>";
                //             print_r($nomeFoto);
                //             list($larguraOriginal, $alturaOriginal) = getimagesize($destino.$nomeFoto);
                //             $ratio = $larguraOriginal / $alturaOriginal;
                //             $largura = "500";
                //             $altura = "500";
                //             if ($largura / $altura > $ratio) {
                //                 $largura = $altura * $ratio;
                //             } else {
                //                 $altura = $largura / $ratio;
                //             }
                //             $imagemFinal = imagecreatetruecolor($largura, $altura);
                //             if ($tipo == "image/jpg"){
                //                 $imageOriginal = imagecreatefromjpeg($destino.$nomeFoto);
                //             } elseif ($tipo == "image/jpeg") {
                //                 $imageOriginal = imagecreatefromjpeg($destino.$nomeFoto);
                //             } elseif ($tipo == "image/png") {
                //                 $imageOriginal = imagecreatefrompng($destino.$nomeFoto);
                //             }
                //             imagecopyresampled($imagemFinal, $imageOriginal, 0, 0, 0, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);
                //             imagejpeg($imagemFinal, $destino.$nomeFoto,80);
                //             print "<br><br>";
                //             $anunImagens = new anunciosImagens();
                //             $anunImagens->setIDAnuncio($id);
                //             $anunImagens->setURL($nomeFoto);
                //             $anunImagens->incluirAnunciosImagens();
                //         }
                //     }
                // }
                //exit();
                //header("Location: ../index.php?pag=editarAnuncio&sucess=true&id=".$id);
                header("Location: " . BASE_URL . "produto/editarAnuncio/" . $id . "/sucess");
            } else {
                //header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
                header("Location: " . BASE_URL . "produto/editarAnuncio/" . $id . "/error");
            }
        } else {
            $id = null;
            //header("Location: ../index.php?pag=editarAnuncio&error=true&id=".$id);
            header("Location: " . BASE_URL . "produto/editarAnuncio/" . $id . "/error");
        }
    }

    public function excluirAnuncio($id)
    {
        // $dados = array (
        //     "id" => $id
        // );
        $this->arrayInfo['id'] = $id;
        $this->loadPainel("excluirAnuncio", $this->arrayInfo);
    }

    public function sisExcluirAnuncio($id)
    {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];

            $imagem = new anunciosImagens();
            $imagem->setIDAnuncio($id);
            $imagem->deletarAnunciosImagens();

            $anuncio = new anuncios();
            $anuncio->setID($id);
            $anuncio->deletarAnuncios();

            //header("Location: ../index.php?pag=meusAnuncios&excluir=true");
            $dados = array(
                "confirme" => "excluir"
            );
            $this->loadTemplate("meusAnuncios", $dados);
        } else {
            $this->excluirAnuncio(null);
            // $dados = array(
            //     "id" => NULL
            // );
            // $this->loadTemplate("excluirAnuncio", $dados);
        }
    }

    public function meusAnuncios($confirme = "")
    {
        $a = new anuncios();
        // $id_usuario = $this->user->getID(); //$_SESSION['id'];
        $a->setIDUsuario($this->user->getID());
        $anuncios = $a->selecionarAnuncios();
        // if ($a->numRows() == 1){
        //     $anuncios = array();
        //     $anuncios[] = $a->result();
        // }
        $this->arrayInfo['anuncios'] = $anuncios;
        $this->arrayInfo['confirme'] = $confirme;
        $this->loadPainel("meusAnuncios", $this->arrayInfo);
        // $dados = array (
        //     "anuncios" => $anuncios,
        //     "confirme" => $confirme
        // );
        // $this->loadTemplate("meusAnuncios", $dados);
    }

    public function abrir($id)
    {

        if (empty($id)) {
            header("Location: " . BASE_URL);
            exit();
        }

        $anunImagens = new anunciosImagens();
        $anunImagens->setIDAnuncio($id);
        $fotos = $anunImagens->selecionarAnunciosImagens();

        if ($anunImagens->numRows() == 1) {
            $fotos = array();
            $fotos[] = $anunImagens->result();
        }

        $anuncio = new anuncios();
        $anuncio->setID($id);
        $result = $anuncio->selecionarAnunciosID();

        $usuario = new usuario();
        $usuario->setID($result['id_usuario']);
        $user = $usuario->selecionarUser();

        $dados = array(
            "fotos" => $fotos,
            "result" => $result,
            "user" => $user
        );

        $this->loadTemplate("produto", $dados);
    }
}
