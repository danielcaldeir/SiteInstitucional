<?php 
//echo("<pre>");
//print_r ($paginas);
//echo ("</pre>");
?>

<?php foreach ($paginas as $item): ?>
<div class="home-sobre">
    <h1 class="h1"><?php echo($item['titulo']);?></h1>
    <?php echo($item['corpo']);?>
</div>
<?php endforeach; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>News</h2>
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="" data-toggle="collapse" data-parent="#accordion" href="#september-10-2016">
                                <span class="post-date">September 10, 2016</span>
                            </a>
                        </div>
                    </div>
                    <div id="september-10-2016" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <h3>Manila Bridge Re-construction</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus placerat enim et urna sagittis, rhoncus euismod...</p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="" data-toggle="collapse" data-parent="#accordion" href="#september-12-2016">
                                <span class="post-date">September 12, 2016</span>
                            </a>
                        </div>
                    </div>
                    <div id="september-12-2016" class="panel-collapse collapse">
                        <div class="panel-body">
                            <h3>Manila Bridge Re-construction</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus placerat enim et urna sagittis, rhoncus euismod...</p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="" data-toggle="collapse" data-parent="#accordion" href="#september-14-2016">
                                <span class="post-date">September 14, 2016</span>
                            </a>
                        </div>
                    </div>
                    <div id="september-14-2016" class="panel-collapse collapse">
                        <div class="panel-body">
                            <h3>Manila Bridge Re-construction</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus placerat enim et urna sagittis, rhoncus euismod...</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <p><a href="#" class="btn btn-sm btn-special">More News</a></p>
        </div>
        <!-- END News -->
        
        
        <!--<div class="col-md-5 col-md-push-1">
        <!--    <h2>Testimonials</h2>
        <!--    <?php foreach ($depoimentos as $item) :?>
        <!--        <blockquote>
        <!--            <p>&ldquo;<?php echo(utf8_encode($item['texto'])); ?>. &ldquo;</p>
        <!--            <p class="author"><cite>&mdash; <?php echo($item['nome']); ?></cite></p>
        <!--        </blockquote>
        <!--    <?php endforeach; ?>
        </div>
        -->
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-head with-border">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#testemunho" aria-expanded="false">
                        <div class="box-title"><h2>Testimonials</h2></div>
                        <div class="box-tools pull-right"></div>
                    </a>
                </div>
                <div class="box-body">
                    <div id="testemunho" class="panel-collapse collapse" aria-expanded="false">
                        <?php foreach ($depoimentos as $item) :?>
                        <blockquote>
                            <p>&ldquo;<?php echo(utf8_encode($item['texto'])); ?>. &ldquo;</p>
                            <p class="author"><cite>&mdash; <?php echo($item['nome']); ?></cite></p>
                        </blockquote>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="home-portfolio">
    <h4>Meu portfolio</h4>
    <?php foreach ($portfolio as $item): ?>
    <div class="portfolio-item">
        <img src="<?php echo BASE; ?>imagem/portfolio/<?php echo($item['imagem']); ?>" border="0" width="200" height="150">
    </div>
    <?php endforeach; ?>
    <div style="clear: both"></div>
</div>

        
