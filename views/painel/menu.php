<ul class="list-group">
    <?php foreach ($menu as $menuItem) :?>
        <li class="list-group-item-text media-left media-right">
			<a href="<?php echo(BASE.'painel/'.$menuItem['url']);?>"><?php echo ($menuItem['nome']); ?></a>
		</li>
    <?php endforeach; ?>
</ul>
