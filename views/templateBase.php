<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Titulo do Site</title>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>asserts/css/style.css" />
    </head>
    <body>
        <h1>Topo do Site</h1>
        <table>
            <tr>
                <td><a href="<?php echo BASE_URL; ?>">Home</a></td>
                <td><a href="<?php echo BASE_URL; ?>home/posts">Posts</a></td>
                <td><a href="<?php echo BASE_URL; ?>home/sobre">Sobre</a></td>
            </tr>
        </table>
        <?php
        $this->loadView($viewName, $viewData)
        ?>
        <h1>Rodape do Site</h1>
    </body>
</html>
