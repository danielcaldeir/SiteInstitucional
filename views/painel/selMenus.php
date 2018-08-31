<div>
        <?php echo("Bom Dia ".$nome);  ?>
        <br>
        <?php //echo($this->config['painel_welcome']);?>
        <br><br>
        <h1 class="h1">Menus</h1>
        <a class="home_cta_button" href="<?php echo(BASE_URL."painel/addMenu");?>">Adicionar Menu</a>
    <?php if (isset($excluir) && $excluir == "error" ) :?>
            <div class="alert-warning">
                <label>Não foi possivel excluir esse registro</label>
            </div>
    <?php endif; ?>
    <?php if (isset($excluir) && $excluir == "success" ) :?>
            <div class="alert-success">
                <label>Registro excluido com sucesso</label>
            </div>
    <?php endif; ?>
        <table width="100%" border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>URL</th>
				<th>TIPO</th>
                <th class="text-center">Ações</th>
            </tr>
            <?php foreach ($menus as $item): ?>
            <tr>
                <td><?php echo($item['id']); ?></td>
                <td><?php echo (utf8_encode($item['nome'])); ?></td>
                <td><?php echo($item['url'] );?></td>
				<td><?php echo($item['tipo'] );?></td>
                <td class="text-center">
                    <a class="home_cta_button" href="<?php echo(BASE_URL."painel/editMenu/".$item['id']); ?>">Editar Menu</a> 
                    <a class="home_cta_button" href="<?php echo(BASE_URL."painel/excluirMenu/".$item['id']); ?>">Excluir Menu</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
</div>
        
