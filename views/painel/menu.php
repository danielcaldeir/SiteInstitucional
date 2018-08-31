<ul >
    <?php foreach ($menu as $menuItem) :?>
        <a href="<?php echo(BASE.'painel/'.$menuItem['url']);?>">
			<li ><?php echo utf8_encode($menuItem['nome']); ?></li>
		</a>
    <?php endforeach; ?>
</ul>
