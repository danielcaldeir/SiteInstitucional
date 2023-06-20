<div style="background-image: url('<?php echo(BASE_URL.'asserts/images/'.$this->config['site_banner']);?>'); background-repeat: no-repeat; background-position: center;">
		<?php echo("Bom Dia ".$nome);  ?>
        <br/>
        <?php echo($this->config['site_painel_welcome']);?>
        <br/><br/>
        
		<h1 class="h1">Configurações</h1>
        <!--<pre><?php //print_r($this->config)?></pre>-->
        <!--<pre><?php //print_r($permissao)?></pre>-->
    <div id="tabs" class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active btn btn-primary">
                <a href="#tabs1" data-toggle="tab" aria-expanded="true">Página Principal</a>
            </li>
            <li class="btn btn-primary">
                <a href="#tabs2" data-toggle="tab" aria-expanded="false">Página do Administrador</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="tabs1" class="tab-pane active">
            <fieldset style="border: 1px solid; border-color: #000">
                <legend>Página Principal</legend>
                <form action="<?php echo BASE_URL; ?>painel/sisEditPropriedade" method="POST">
                    <div class="form-group">
                       <label>Template</label>
                    <select name="site_template" class="form-control">
                        <option 
                            value="Padrao" 
                            <?php echo( ($this->config['site_template'] == 'Padrao')?('selected'):('') ); ?>
                            >Padrao</option>
                        <option 
                            value="Natal" 
                            <?php echo( ($this->config['site_template'] == 'Natal')?('selected'):('') ); ?>
                            >Padrao Natal</option>
                        <option 
                            value="Institucional" 
                            <?php echo( ($this->config['site_template'] == 'Institucional')?('selected'):('') ); ?>
                            >Institucional</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" name="site_title" class="form-control" value="<?php echo($this->config['site_title']);?>"/>
                    </div>
                    <div class="form-group">
                        <label>Cor</label>
                        <input type="text" name="site_color" class="form-control" value="<?php echo($this->config['site_color']);?>"/>
                    </div>
                    <div class="form-group">
                        <label>Banner</label>
                        <input type="text" name="site_banner" class="form-control" value="<?php echo($this->config['site_banner']);?>"/>
                    </div>
                    <div class="form-group">
                        <label>Texto de Boas Vindas</label>
                        <textarea name="site_welcome" class="form-control" id="site_welcome">
                            <?php echo($this->config['site_welcome']);?>
                        </textarea>
                        <!--<input type="text" name="site_welcome" value="<?php echo($this->config['site_welcome']);?>"/><br/><br/>-->
                    </div>
                    <input type="submit" name="Enviar" class="btn button" value="Enviar Dados"/>
                </form>
            </fieldset>
            </div>
            <div id="tabs2" class="tab-pane">
            <fieldset style="border: 1px groove; border-color: #000">
                <legend>Página do Administrador</legend>
                <form action="<?php echo BASE_URL; ?>painel/sisEditPropriedadeADMIN" method="POST">
                    <div class="form-group">
                        <label for="site_painel"><h2>ADMIN</h2></label>
                        <select name="site_painel" class="form-control">
                            <option value="painel" <?php echo( ($this->config['site_painel'] == 'painel')?('selected'):('') ); ?>>
                                Padrao
                            </option>
                            <option value="template" <?php echo( ($this->config['site_painel'] == 'template')?('selected'):('') ); ?>>
                                Padrao Novo
                            </option>
                        </select>
                        <!--<input type="text" class="form-control" id="site_painel" name="site_painel" value="<?php echo($this->config['site_painel']);?>" disabled=""/>-->
            	    </div>
                    <div class="form-group">
                        <label for="site_painel_title"><h4>Titulo ADMIN</h4></label>
                        <input type="text" class="form-control" id="site_painel_title" name="site_painel_title" value="<?php echo($this->config['site_painel_title']);?>"/>
                    </div>
                    <div class="form-group">
                        <label for="site_painel_welcome"><h4>Welcome ADMIN</h4></label>
                        <textarea name="site_painel_welcome" id="site_painel_welcome" class="form-control">
                            <?php echo($this->config['site_painel_welcome']);?>
                        </textarea>
                        <!--<input type="text" class="form-control" id="site_painel_welcome" name="site_painel_welcome" value="<?php echo($this->config['site_painel_welcome']);?>"/>-->
                    </div>
                    <input type="submit" name="Enviar" class="button" value="Enviar Dados"/>
                </form>
                <br/><br/>
                <br/><br/>
                <br/><br/>
            </fieldset>
            </div>
        </div>
    </div>
    
	<br/><br/><br/>
<!--<hr>
<!--	<div>
<!--        <?php echo("Bom Dia ".$nome);  ?>
<!--        <br>
<!--        <?php echo($this->config['site_painel_welcome']);?>
<!--        <br><br>
<!--        <!--<h1 class="h1">Configurações</h1>-->
<!--        <!--<h3><pre><?php //print_r($this->config)?></pre></h3>-->
<!--        <fieldset style="border: 1px solid; border-color: #000">
<!--            <legend>Configurações</legend>
<!--			<!--<br/><br/>-->
<!--			<div id="tabs" class="nav-tabs-custom">
<!--				<ul class="nav nav-tabs">
<!--					<li class="active btn btn-primary">
<!--						<a href="#tabs3" data-toggle="tab" aria-expanded="true">Página Principal</a>
<!--					</li>
<!--					<li class="btn btn-primary">
<!--						<a href="#tabs4" data-toggle="tab" aria-expanded="false">Página do Administrador</a>
<!--					</li>
<!--				</ul>
<!--				<div class="tab-content">
<!--				<div id="tabs3" class="tab-pane active">
<!--					<form action="<?php echo BASE_URL; ?>painel/sisEditPropriedade" method="POST">
<!--						<h2>Template</h2>
<!--						
<!--						<select name="site_template">
<!--							<option value="DEFAULT" <?php echo( ($this->config['site_template'] == 'DEFAULT')?('selected'):('') ); ?> >Padrao</option>
<!--							<option value="DefaultNatal" <?php echo( ($this->config['site_template'] == 'DefaultNatal')?('selected'):('') ); ?> >Padrao Natal</option>
<!--						</select>
<!--						
<!--						<input type="text" name="site_title" value="<?php echo($this->config['site_title']);?>"/><br/><br/>
<!--						<input type="text" name="site_color" value="<?php echo($this->config['site_color']);?>"/><br/><br/>
<!--						<input type="text" name="site_banner" value="<?php echo($this->config['site_banner']);?>"/><br/><br/>
<!--						<input type="text" name="site_welcome" value="<?php echo($this->config['site_welcome']);?>"/><br/><br/>
<!--						<input type="submit" name="Enviar" class="button" value="Enviar Dados"/>
<!--					</form>
<!--				</div>
<!--				<div id="tabs4" class="tab-pane">
<!--					<fieldset style="border: 1px groove; border-color: #000">
<!--						<legend>Página do Administrador</legend>
<!--						<form action="<?php echo BASE_URL; ?>painel/sisEditPropriedadeADMIN" method="POST">
<!--							<h2>ADMIN</h2>
<!--							<input type="text" name="site_painel" value="<?php //echo($this->config['site_painel']);?>"/><br/><br/>
<!--							<h4>Titulo ADMIN</h4>
<!--							<input type="text" name="site_title_painel" value="<?php //echo($this->config['site_title_painel']);?>"/><br/><br/>
<!--							<h4>Welcome ADMIN</h4>
<!--							<input type="text" name="painel_welcome" value="<?php //echo($this->config['painel_welcome']);?>"/><br/><br/>
<!--							<input type="submit" name="Enviar" class="button" value="Enviar Dados"/>
<!--						</form>
<!--					</fieldset>
<!--				</div>
<!--				</div>
<!--			</div>
<!--        </fieldset>
<!--        <br/><br/>
<!--	</div>    
<!--<br/><br/><br/><br/>
-->
<script type="text/javascript">
    function verificarDataHora() {
        var now = new Date(); 
        var hrs = now.getHours(); 
        var msg = ""; 
        if (hrs > 0) msg = "Mornin' Sunshine!"; 
        // REALLY early 
        if (hrs > 6) msg = "Good morning"; 
        // After 6am 
        if (hrs > 12) msg = "Good afternoon"; 
        // After 12pm 
        if (hrs > 17) msg = "Good evening"; 
        // After 5pm 
        if (hrs > 22) msg = "Go to bed!"; 
        // After 10pm 
        alert(msg);
    }
    
    
    window.onload = function(){
        CKEDITOR.replace("site_welcome");
        CKEDITOR.replace("site_painel_welcome");
    };
</script>