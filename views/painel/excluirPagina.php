
<div class="container-fluid">
    <div class="navbar topnav">
        <h2 class="logo">Excluir Pagina</h2>
    </div>
    
    <?php if ( !empty($id) ) : ?>
        <form action="<?php echo BASE_URL; ?>pagina/excluirPaginaAction/" method="GET">
            <div class="form-group">
                <label>Tem certeza que deseja excluir essa pagina?</label>
            </div>
            <table width="100%" border="1">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">URL</th>
                <th class="text-center">Titulo</th>
                <th class="text-center">Corpo</th>
            </tr>
            <?php foreach ($pagina as $item): ?>
            <tr class="text-center">
                <td><?php echo($item['id']); ?></td>
                <td><?php echo (utf8_encode($item['url'])); ?></td>
                <td><?php echo (utf8_encode($item['titulo'])); ?></td>
                <td><?php echo($item['corpo'] );?></td>
            </tr>
            <?php endforeach; ?>
        </table>
            <input type="hidden" name="id" value="<?php echo($id); ?>"/>
            <input type="submit" class="btn btn-success" value="SIM"/>
            <a href="<?php echo BASE_URL; ?>pagina/" class="btn btn-danger">NÃO</a>
        </form>
    <?php else : ?>
    <form action="<?php echo BASE_URL; ?>pagina/" method="GET">
        <div class="form-group">
            <label>Não foi informado um identificador.</label>
        </div>
        <input type="submit" class="btn btn-default" value="VOLTAR"/>
    </form>
    
    <?php endif; ?>
    
</div>
