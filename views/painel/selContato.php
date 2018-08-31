<div>
        <?php echo("Bom Dia ".$nome);  ?>
        <br>
	
    <div style="clear: both"></div>
    <h1 class="h1">Contato</h1>
	<form action="<?php echo(BASE."painel/addContato"); ?>" method="POST" enctype="multipart/form-data">
		<label>Novo Label</label>
		<input type="text" name="label" />
	</form>
    <label><?php echo($nome);?></label><br/>
	<label><?php echo($email);?></label><br/>
	<label><?php echo($mensagem);?></label><br/>
	<div style="clear: both"></div>
    <?php foreach ($contatos as $item): ?>
		<div class="portfolio-painel">
			<img src="<?php echo BASE; ?>imagem/portfolio/<?php echo($item['imagem']); ?>" border="0" width="200" height="150">
			<a href="<?php echo(BASE."painel/delPortfolio/".$item['id']); ?>">Excluir Imagem</a> <br/>
		</div>
	<?php endforeach; ?>
	<div style="clear: both"></div>
</div>