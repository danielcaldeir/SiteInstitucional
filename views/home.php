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

<div class="home-portfolio">
    <h4>Meu portfolio</h4>
    <?php foreach ($portfolio as $item): ?>
    <div class="portfolio-item">
        <img src="<?php echo BASE; ?>imagem/portfolio/<?php echo($item['imagem']); ?>" border="0" width="200" height="150">
    </div>
    <?php endforeach; ?>
    <div style="clear: both"></div>
</div>

        
