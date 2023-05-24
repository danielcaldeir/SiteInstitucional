    <?php foreach ($menu as $menuItem) :?>
    <li class="list-group-item-text media-left media-right">
        <a href="<?php echo(BASE_URL.$menuItem['url']);?>"><?php echo ($menuItem['nome']); ?></a>
    </li>
    <?php endforeach; ?>

