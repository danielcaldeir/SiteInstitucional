<ul class="list-group">
    <?php foreach ($menu as $menuItem) :?>
        <a href="<?php echo(BASE.$menuItem['url']);?>">
			<li class="list-group-item-text media-left media-right">
			<?php echo utf8_encode($menuItem['nome']); ?>
			</li>
		</a>
    <?php endforeach; ?>
</ul>
