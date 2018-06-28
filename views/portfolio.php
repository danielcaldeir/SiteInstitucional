<div class="home-portfolio">
    <h1>Portfolio</h1>
    <?php foreach ($portfolio as $item): ?>
    <div class="portfolio-item">
        <img src="<?php echo BASE; ?>imagem/portfolio/<?php echo($item['imagem']); ?>" border="0" width="200" height="150">
    </div>
    <?php endforeach; ?>
    <div style="clear: both"></div>
</div>
