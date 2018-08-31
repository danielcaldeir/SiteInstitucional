<div class="home-contato">
    <h1><?php echo($titulo);?></h1>
    
    <form action="<?php echo BASE_URL; ?>enviarEmail" method="POST">
		<?php foreach($formularios as $form):?>
			<label for="<?php echo($form['label']); ?>"><?php echo($form['label']); ?>:</label><br/>
			<?php if ($form['tipo'] == 'textarea'): ?>
				<textarea name="<?php echo($form['label']);?>" id="<?php echo($form['label']);?>">
				</textarea>
			<?php else: ?>
			<input type="<?php echo($form['tipo']);?>" name="<?php echo($form['label']);?>" id="<?php echo($form['label']);?>" />
			<?php endif; ?>
			<br/><br/>
		<?php endforeach; ?>
		
        <input type="hidden" name="email" id="email" value="<?php echo($email);?>" />
		<input type="hidden" name="titulo" id="titulo" value="<?php echo($titulo); ?>" />
        <input type="submit" name="enviar" value="Enviar Mensagem" />
    </form>
</div>