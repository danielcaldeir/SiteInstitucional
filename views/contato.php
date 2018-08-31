<div class="home-contato">
    <h1>Contato</h1>
    
    <form action="<?php echo BASE_URL; ?>enviarEmail" method="POST">
        <label>Seu nome:</label><br/>
        <input type="text" name="nome" /><br/><br/>
        <label>Seu E-Mail:</label><br/>
        <input type="text" name="email" /><br/><br/>
        <label>Mensagem:</label><br/>
        <textarea name="mensagem"></textarea><br/><br/>
		<input type="hidden" name="titulo" id="titulo" value="Contato"/>
        <input type="submit" name="enviar" value="Enviar Mensagem" />
    </form>
</div>