<div class="home-contato">
    <h1>Contato</h1>
    
    <form action="<?php echo BASE_URL; ?>enviarEmail" method="POST">
        Seu nome:<br>
        <input type="text" name="nome" /><br><br>
        Seu E-Mail:<br>
        <input type="text" name="email" /><br><br>
        Mensagem:<br>
        <textarea name="mensagem"></textarea><br><br>
        <input type="submit" name="enviar" value="Enviar Mensagem" />
    </form>
</div>