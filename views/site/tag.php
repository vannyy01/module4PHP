<?php
/* @var $tag app\controllers\SiteController */
/* @var $news app\controllers\SiteController */

?>
<main role="main" class="container">
    <div class="list-group">
        <h2>По тегу #<?= $tag ?> знайдено <?= count($news)?> записів:</h2>
        <? foreach ($news as  $value): ?>
            <a href="/view/<?= $value['news_id'] ?>" class="list-group-item list-group-item-action"><?= $value['news_name'] ?></a>
        <? endforeach; ?>
    </div>
</main>