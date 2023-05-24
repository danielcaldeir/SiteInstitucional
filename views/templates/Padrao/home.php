<?php if (empty($this->config['site_banner'])):?>
<div class="home_banner" style="background-image: url('null')">
    
</div>
<?php else:?>
<div class="home_banner" style="background-image: url('<?php echo(BASE_URL.'asserts/images/'.$this->config['site_banner']);?>')">
    
</div>
<?php endif;?>
<div class="home_txt">
        <?php echo (empty($this->config['site_welcome']) ?'@site_welcome':$this->config['site_welcome']); ?>
</div>

<!--    <div class="carousel slide" data-ride="carousel" id="meuCarousel">
<!--        <ol class="carousel-indicators" >
<!--            <li data-target="#meuCarousel" data-slide-to="1" class="active"></li>
<!--            <li data-target="#meuCarousel" data-slide-to="2" ></li>
<!--            <li data-target="#meuCarousel" data-slide-to="3" ></li>
<!--        </ol>
<!--        <div class="carousel-inner" rolr="listbox">
<!--            <div class="item active">
<!--                <img src="<?php echo(BASE_URL);?>asserts/images/depositphotos_44853021-stock-photo-cute-girl-winning-money.jpg" border="0" height="800px" width="1024px">
<!--            </div>
<!--            <div class="item">
<!--                <img src="<?php echo(BASE_URL);?>asserts/images/depositphotos_47910699-stock-photo-smiling-girl-with-dollar-cash.jpg" border="0" height="800px" width="1024px">
<!--            </div>
<!--            <div class="item">
<!--                <img src="<?php echo(BASE_URL);?>asserts/images/depositphotos_74956557-stock-photo-currency-women-savings.jpg" border="0" height="800px" width="1024px">
<!--            </div>
<!--        </div>
<!--        <a class="left center-block carousel-control" role="button" data-slide="prev" href="#meuCarousel">
<!--            <span><i class="icon icon-prev"></i></span>
<!--        </a>
<!--        <a class="right center-block carousel-control" role="button" data-slide="next" href="#meuCarousel">
<!--            <span><i class="icon icon-next"></i></span>
<!--        </a>
<!--    </div>
-->

<!--<div class="home_depo">
<!--    <h3>Depoimentos de Clientes</h3>
<!--    <?php foreach ($depoimentos as $item) :?>
<!--    <strong><?php echo(utf8_encode($item['nome'])); ?></strong><br>
<!--    <?php echo(utf8_encode($item['texto'])); ?>
<!--    <hr>
<!--    <?php endforeach; ?>
<!--</div>
-->
<!--    <div class="home_depo">-->
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>News</h2>
                    <ul>
                        <li>
                            <a href="#">
                                <span class="post-date">September 10, 2016</span>
                                <h3>Manila Bridge Re-construction</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus placerat enim et urna sagittis, rhoncus euismod...</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="post-date">September 10, 2016</span>
                                <h3>Manila Bridge Re-construction</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus placerat enim et urna sagittis, rhoncus euismod...</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="post-date">September 10, 2016</span>
                                <h3>Manila Bridge Re-construction</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus placerat enim et urna sagittis, rhoncus euismod...</p>
                            </a>
                        </li>
                    </ul>
                    <p><a href="#" class="btn btn-sm btn-special">More News</a></p>
                </div>
                <!-- END News -->
                <div class="col-md-5 col-md-push-1">
                    <h2>Testimonials</h2>
                    <?php foreach ($depoimentos as $item) :?>
                    <blockquote>
                        <p>&ldquo;<?php echo(utf8_encode($item['texto'])); ?>. &ldquo;</p>
                        <p class="author"><cite>&mdash; <?php echo($item['nome']); ?></cite></p>
                    </blockquote>
                    <?php endforeach; ?>
                    <!--	<blockquote>
                    <!--		<p>&ldquo;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus placerat enim et urna sagittis, rhoncus euismod erat tincidunt. Donec tincidunt volutpat erat.&ldquo;</p>
                    <!--		<p class="author"><cite>&mdash; John Doe Dueller</cite></p>
                    <!--	</blockquote>
                    -->
                </div>
            </div>
        </div>
<!--    </div>-->
    <!-- END  -->
<div class="home_cta">
    Deseja conferir nossos serviços?<br/>
    <div class="home_cta_button">
        <a href="<?php echo(BASE_URL.'servicos');?>">Servicos Oferecidos</a>
    </div>
</div>
        
