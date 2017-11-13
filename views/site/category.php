<?php

/* @var $this yii\web\View */

/* @var $category app\controllers\SiteController */

/* @var $pagination app\controllers\SiteController */
/* @var $name app\controllers\SiteController */


use yii\helpers\Html;
use yii\widgets\LinkPager;

?>
<main role="main" class="container" style="margin-top: 10%">
    <div class="col-6 col-lg-4">
        <?$this->title =$name ;?>
        <h2><?=$this->title?></h2>
        <? foreach ($category as $key => $news): ?>
            <p><?= $news['news_name'] ?></p>
            <p><a class="btn btn-secondary" href="/view/<?= $news['news_id'] ?>" role="button">View details
                    &raquo;</a></p>
        <? endforeach; ?>
        <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div><!--/span-->
</main>