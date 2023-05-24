    <?php foreach ($menu as $menuItem) :?>
    <li class="active">
        <a href="<?php echo(BASE_URL.$menuItem['url']);?>">
            <i class="fa fa-link"></i>
            <span><?php echo ($menuItem['nome']); ?></span>
        </a>
    </li>
    <?php endforeach; ?>
