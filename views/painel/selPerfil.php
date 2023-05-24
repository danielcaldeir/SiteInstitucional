<?php 
    $add = null;
    $edit = null;
    $del = null;
    foreach ($permissao as $perItem) {
        if (!is_null($add)){
            if (!strcmp($perItem, "add_perfil")){
                $add = TRUE;
            }
        }
        if (!is_null($edit)){
            if (!strcmp($perItem, "edit_perfil")){
                $edit = TRUE;
            }
        }
        if (!is_null($del)){
            if (!strcmp($perItem, "del_perfil")){
                $del = TRUE;
            }
        }
    }
?>

    <!-- Content Header (Page header) -->
    <pre>
        <?php echo ("ADD: ");echo (($add)?'Verdadeiro':(is_null($add)?'Nao se Aplica':'Falso'));?>
        <?php echo ("EDIT: ");echo (($edit)?'Verdadeiro':(is_null($edit)?'Nao se Aplica':'Falso'));?>
        <?php echo ("DEL: ");echo (($del)?'Verdadeiro':(is_null($del)?'Nao se Aplica':'Falso'));?>
    </pre>
    
    <section class="content-header">
      <h1>
        Tela de Perfil
        <small><?php echo($mensagem);?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo(BASE_URL); ?>painel/"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="<?php echo(BASE_URL); ?>perfil/"><i class="fa fa-address-book"></i>Perfil</a></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content container-fluid">
        
        <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <!--<pre><?php //print_r($this->config)?></pre>-->
        
        <div class="box">
            <div class="box-header">
                <!--<h1 class="h1"><?php echo($this->config['painel_welcome']);?></h1>
                <!--<br/><br/>
                -->
                <h1 class="box-title">Escolha a visualização do seu PERFIL</h1>
                <div class="box-tools">
                    <!--<input type="hidden" value="<?php echo md5($empresa->getID());?>" name="id">-->
                    <!--<input type="submit" value="Gravar" class="btn btn-primary"/>-->
                </div>
            </div>
            <div class="box-body">
                <div id="tabs" class="nav-tabs-custom">
                    <!--<ul class="nav nav-tabs">
                    <!--    <li class="btn btn-primary">
                    <!--        <a href="#tabs1" data-toggle="tab" aria-expanded="false">Página Principal</a>
                    <!--    </li>
                    <!--    <li class="btn btn-primary active">
                    <!--        <a href="#tabs2" data-toggle="tab" aria-expanded="true">Página do Administrador</a>
                    <!--    </li>
                    <!--</ul>
                    -->
                    <div class="tab-content">
                        <!--<div id="tabs1" class="tab-pane">
                        <!--<fieldset style="border: 1px solid; border-color: #000">
                        <!--    <legend>Página Principal</legend>
                        <!--    <form action="<?php echo BASE_URL; ?>painel/sisEditPropriedade" method="POST">
                        <!--        <div class="form-group">
                        <!--           <label>Template</label>
                        <!--        <select name="site_template" class="form-control">
                        <!--            <option 
                        <!--                value="default" 
                        <!--                <?php echo( ($this->config['site_template'] == 'default')?('selected'):('') ); ?>
                        <!--                >Padrao</option>
                        <!--            <option 
                        <!--                value="defaultNatal" 
                        <!--                <?php echo( ($this->config['site_template'] == 'defaultNatal')?('selected'):('') ); ?>
                        <!--                >Padrao Natal</option>
                        <!--        </select>
                        <!--        </div>
                        <!--        <div class="form-group">
                        <!--            <label>Titulo</label>
                        <!--        <input type="text" name="site_title" class="form-control" value="<?php echo($this->config['site_title']);?>"/>
                        <!--        <!--<br/><br/>-->
                        <!--        </div>
                        <!--        <div class="form-group">
                        <!--            <label>Cor</label>
                        <!--        <input type="text" name="site_color" class="form-control" value="<?php echo($this->config['site_color']);?>"/>
                        <!--        <!--<br/><br/>-->
                        <!--        </div>
                        <!--        <div class="form-group">
                        <!--            <label>Banner</label>
                        <!--        <input type="text" name="site_banner" class="form-control" value="<?php echo($this->config['site_banner']);?>"/>
                        <!--        <!--<br/><br/>-->
                        <!--        </div>
                        <!--        <div class="form-group">
                        <!--            <label>Texto de Boas Vindas</label>
                        <!--        <textarea name="site_welcome" class="form-control" id="site_welcome"><?php echo($this->config['site_welcome']);?></textarea>
                        <!--        <!--<input type="text" name="site_welcome" value="<?php echo($this->config['site_welcome']);?>"/><br/><br/>-->
                        <!--        </div>
                        <!--        <input type="submit" name="Enviar" class="btn button" value="Enviar Dados"/>
                        <!--    </form>
                        <!--</fieldset>
                        <!--</div>
                        -->
                        <div id="tabs2" class="tab-pane active">
                        <!--<fieldset style="border: 1px groove; border-color: #000">-->
                            <!--<legend>Escolha a visualização do seu PERFIL</legend>-->
                            <form action="<?php echo BASE_URL; ?>painel/sisEditPropriedadeADMIN" method="POST">
                                <div class="form-group">
                                    <label for="site_painel"><h2>Tela</h2></label>
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
                                    <label for="site_painel_color"><h3>Cor</h3></label>
                                    <select id="site_painel_color" name="site_painel_color" class="form-control">
                                        <option value="skin-blue" <?php echo(($this->config['site_painel_color'] == 'skin-blue')?'selected':'');?>>Azul</option>
                                        <option value="skin-black" <?php echo(($this->config['site_painel_color'] == 'skin-black')?'selected':'');?>>Preto</option>
                                        <option value="skin-green" <?php echo(($this->config['site_painel_color'] == 'skin-green')?'selected':'');?>>Verde</option>
                                        <option value="skin-purple" <?php echo(($this->config['site_painel_color'] == 'skin-purple')?'selected':'');?>>Roxo</option>
                                        <option value="skin-red" <?php echo(($this->config['site_painel_color'] == 'skin-red')?'selected':'');?>>Vermelho</option>
                                        <option value="skin-yellow" <?php echo(($this->config['site_painel_color'] == 'skin-yellow')?'selected':'');?>>Amarelo</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="site_painel_avatar"><h3>Avatar</h3></label>
                                    <select id="site_painel_avatar" name="site_painel_avatar" class="form-control">
                                        <option value="avatar1" <?php echo(($this->config['site_painel_avatar'] == 'avatar1')?'selected':'');?>>avatar1</option>
                                        <option value="avatar2" <?php echo(($this->config['site_painel_avatar'] == 'avatar2')?'selected':'');?>>avatar2</option>
                                        <option value="avatar3" <?php echo(($this->config['site_painel_avatar'] == 'avatar3')?'selected':'');?>>avatar3</option>
                                        <option value="avatar4" <?php echo(($this->config['site_painel_avatar'] == 'avatar4')?'selected':'');?>>avatar4</option>
                                        <option value="avatar5" <?php echo(($this->config['site_painel_avatar'] == 'avatar5')?'selected':'');?>>avatar5</option>
                                    </select>
                                </div>
                                <!--<div class="form-group">
                                <!--    <label for="site_title_painel"><h4>Titulo ADMIN</h4></label>
                                <!--    <input type="text" class="form-control" id="site_title_painel" name="site_title_painel" value="<?php echo($this->config['site_title_painel']);?>"/>
                                <!--</div>
                                <!--<div class="form-group">
                                <!--    <label for="painel_welcome"><h4>Welcome ADMIN</h4></label>
                                <!--    <textarea name="painel_welcome" id="painel_welcome" class="form-control">
                                <!--        <?php echo($this->config['site_painel_welcome']);?>
                                <!--    </textarea>
                                <!--    <!--<input type="text" class="form-control" id="painel_welcome" name="painel_welcome" value="<?php echo($this->config['painel_welcome']);?>"/>-->
                                <!--</div>
                                -->
                                <input type="submit" name="Enviar" class="button" value="Enviar Dados"/>
                            </form>
                            <!--<br/><br/>-->
                            <!--<br/><br/>-->
                            <!--<br/><br/>-->
                        <!--</fieldset>-->
                        </div>
                    </div>
                </div>
            </div>
            <br/><br/>
        </div>
    </section>

        
<br/><br/><br/><br/>
<script type="text/javascript">
    window.onload = function(){
        CKEDITOR.replace("site_welcome");
    };

</script>