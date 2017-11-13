<?php
/* @var $category app\controllers\SiteController */
?>
<main role="main" class="container">
    <div class="list-group">
        <? foreach ($category as  $value): ?>
            <a href="/category/<?=$value['id']?>" class="list-group-item list-group-item-action"><?= $value['name'] ?></a>
        <? endforeach; ?>
    </div>
</main>