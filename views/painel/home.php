<div>
        <?php echo("Bom Dia ".$nome);  ?>
        <br>
        <?php //echo($this->config['painel_welcome']);?>
        <br><br>
        <h1 class="h1">Configurações</h1>
        <h3>
            <pre><?php //print_r($this->config)?></pre>
        </h3>
        <fieldset style="border: 1px solid; border-color: #000">
            <legend>Página Principal</legend>
            <form action="<?php echo BASE_URL; ?>painel/sisEditPropriedade" method="POST">
                <h2>Template</h2>
                <select name="site_template">
                    <option 
                        value="DEFAULT" 
                        <?php //echo( ($this->config['site_template'] == 'DEFAULT')?('selected'):('') ); ?>
                        >Padrao</option>
                    <option 
                        value="DefaultNatal" 
                        <?php //echo( ($this->config['site_template'] == 'DefaultNatal')?('selected'):('') ); ?>
                        >Padrao Natal</option>
                </select>
				<a href="<?php echo BASE; ?>painel/portfolio"><h4>Portfolio</h4></a>
                <!--<input type="text" name="site_title" value="<?php //echo($this->config['site_title']);?>"/><br/><br/>-->
                <a href="<?php echo BASE; ?>painel/sobre"><h4>Sobre</h4></a>
                <!--<input type="text" name="site_color" value="<?php //echo($this->config['site_color']);?>"/><br/><br/>-->
                <a href="<?php echo BASE; ?>painel/servicos"><h4>Servicos</h4></a>
                <!--<input type="text" name="site_banner" value="<?php //echo($this->config['site_banner']);?>"/><br/><br/>-->
                <a href="<?php echo BASE; ?>painel/contato"><h4>Contato</h4></a>
                <!--<input type="text" name="site_welcome" value="<?php //echo($this->config['site_welcome']);?>"/><br/><br/>-->
                <input type="submit" name="Enviar" class="button" value="Enviar Dados"/>
            </form>
        </fieldset>
        <br/><br/>
        <fieldset style="border: 1px groove; border-color: #000">
            <legend>Página do Administrador</legend>
            <form action="<?php echo BASE_URL; ?>painel/sisEditPropriedadeADMIN" method="POST">
                <h2>ADMIN</h2>
                <input type="text" name="site_painel" value="<?php //echo($this->config['site_painel']);?>"/><br/><br/>
                <h4>Titulo ADMIN</h4>
                <input type="text" name="site_title_painel" value="<?php //echo($this->config['site_title_painel']);?>"/><br/><br/>
                <h4>Welcome ADMIN</h4>
                <input type="text" name="painel_welcome" value="<?php //echo($this->config['painel_welcome']);?>"/><br/><br/>
                <input type="submit" name="Enviar" class="button" value="Enviar Dados"/>
            </form>
        </fieldset>
</div>
        
<br/><br/><br/><br/>