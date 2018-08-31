<div>
        <?php echo("Bom Dia ".$nome);  ?>
        <br/>
	<?php if (isset($confirme) && $confirme == "success" ) :?>
            <div class="alert-success">
                <label>Registro modificado com sucesso</label>
            </div>
    <?php endif; ?>
	<?php if (isset($titulo) && $titulo == "error" ) :?>
            <div class="alert-success">
                <label>Nao foi possivel modificar o Registro</label>
            </div>
    <?php endif; ?>
    <div style="clear: both"></div>
    <h1 class="h1"><?php echo($titulo);?></h1>
	<form action="<?php echo(BASE."painel/addFormulario"); ?>" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<!--<label for="titulo">Titulo</label>-->
			<input type="hidden" name="titulo" class="form-control" value="<?php echo($titulo);?>" />
		</div>
		<div class="form-group">
			<label for="label">Novo Label</label>
			<input type="text" name="label" class="form-control"/>
		</div>
		<div>
			<label for="tipo">Tipo</label>
			<select name="tipo" class="form-control">
				<option value="text">text</option>
				<option value="password">password</option>
				<option value="email">email</option>
				<option value="date">date</option>
				<option value="number">number</option>
				<option value="radio">radio</option>
				<option value="checkbox">checkbox</option>
				<option value="textarea">textarea</option>
			</select>
		</div>
		<input type="submit" name="Enviar" value="Enviar" class="bg-info"/>
	</form>
    
	<div style="clear: both"></div>
    <?php foreach ($formulario as $form): ?>
		<div class="portfolio-painel">
			<label><?php echo($form['label']);?></label>
			<?php if ($form['tipo'] == 'textarea'): ?>
				<textarea name="<?php echo($form['label']);?>" id="<?php echo($form['label']);?>">
				</textarea>
			<?php else: ?>
			<input type="<?php echo($form['tipo']);?>" name="<?php echo($form['label']);?>" id="<?php echo($form['label']);?>" />
			<?php endif; ?>
			<a href="<?php echo(BASE."painel/delFormulario/".$form['id']); ?>">Excluir</a>
		</div>
	<?php endforeach; ?>
	<div style="clear: both"></div>
</div>