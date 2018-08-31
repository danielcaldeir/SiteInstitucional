<div>
        <?php //echo("Bom Dia ".$nome);  ?>
        <br>
        <?php //echo($this->config['painel_welcome']);?>
        <br><br>
	
    <div style="clear: both"></div>
        <h1 class="h1">Portfolio</h1>
		<form action="<?php echo(BASE."painel/addPortfolio"); ?>" method="POST" enctype="multipart/form-data">
			<fieldset style="border: 1px solid; border-color: #000">
				<legend>Adicionar Imagem</legend>
				<input type="file" name="fotos[]" multiple />
				<input type="submit" value="Enviar" />
			</fieldset>
		</form>
        <!--<a href="<?php echo(BASE."painel/addPortfolio");?>" class="home_cta_button">Adicionar Imagem</a>-->
		<div style="clear: both"></div>
        <?php foreach ($portfolio as $item): ?>
		<div class="portfolio-painel">
			<img src="<?php echo BASE; ?>imagem/portfolio/<?php echo($item['imagem']); ?>" border="0" width="200" height="150">
			<a href="<?php echo(BASE."painel/excluirPortfolio/".$item['id']); ?>">Excluir Imagem</a> <br/>
		</div>
		<?php endforeach; ?>
	<div style="clear: both"></div>
</div>
        
