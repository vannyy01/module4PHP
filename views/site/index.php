<?php

/* @var $this yii\web\View */

/* @var $model app\controllers\SiteController */
/* @var $economics app\controllers\SiteController */
/* @var $police app\controllers\SiteController */
/* @var $sport app\controllers\SiteController */
/* @var $society app\controllers\SiteController */
/* @var $science app\controllers\SiteController */
/* @var $analytics app\controllers\SiteController */
/* @var $top_comments app\controllers\SiteController */
/* @var $top_news app\controllers\SiteController */

/* @var $comments_pagination app\controllers\SiteController */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Головна';
?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <? foreach ($model as $key => $news): ?>
            <? if ($key === 0): ?>
                <div class="item active">
                    <div class="item">
                        <img class="slide-photo" src="./public/img/<?= $news['news_photo'] ?>" alt="Los Angeles"
                             style="width:100%;">
                        <div class="carousel-caption">
                            <h3><b><?= $news['category'] ?></b></h3>
                            <p><?= $news['news_name'] ?></p>
                        </div>
                    </div>
                </div>
            <? else: ?>
                <div class="item">
                    <img class="slide-photo" src="./public/img/<?= $news['news_photo'] ?>" alt="Los Angeles"
                         style="width:100%;">
                    <div class="carousel-caption">
                        <h3><b><?= $news['category'] ?></b></h3>
                        <p><?= $news['news_name'] ?></p>
                    </div>
                </div>
            <? endif; ?>
        <? endforeach; ?>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<main role="main" class="container">
    <div class="row">
        <div class="col-6 col-lg-4">
            <h2><a href="category/1">Економіка</a></h2>
            <? foreach ($economics as $news): ?>
                <p><?= $news['news_name'] ?></p>
                <p><a class="btn btn-secondary" href="/view/<?= $news['news_id'] ?>" role="button">View details
                        &raquo;</a></p>
            <? endforeach; ?>
            <hr class="featurette-divider">
        </div><!--/span-->

        <div class="col-6 col-lg-4">
            <h2><a href="category/2">Політика</a></h2>
            <? foreach ($police as $news): ?>
                <p><?= $news['news_name'] ?></p>
                <p><a class="btn btn-secondary" href="/view/<?= $news['news_id'] ?>" role="button">View details
                        &raquo;</a></p>
            <? endforeach; ?>
            <hr class="featurette-divider">
        </div><!--/span-->

        <div class="col-6 col-lg-4">
            <h2><a href="category/3">Спорт</a></h2>
            <? foreach ($sport as $news): ?>
                <p><?= $news['news_name'] ?></p>
                <p><a class="btn btn-secondary" href="/view/<?= $news['news_id'] ?>" role="button">View details
                        &raquo;</a></p>
            <? endforeach; ?>
            <hr class="featurette-divider">
        </div><!--/span-->
        <div class="col-6 col-lg-4">
            <h2><a href="category/4">Суспільство</a></h2>
            <? foreach ($society as $news): ?>
                <p><?= $news['news_name'] ?></p>
                <p><a class="btn btn-secondary" href="/view/<?= $news['news_id'] ?>" role="button">View details
                        &raquo;</a></p>
            <? endforeach; ?>
            <hr class="featurette-divider">
        </div><!--/span-->
        <div class="col-6 col-lg-4">
            <h2><a href="category/5">Наука і Техніка</a></h2>
            <? foreach ($science as $news): ?>
                <p><?= $news['news_name'] ?></p>
                <p><a class="btn btn-secondary" href="/view/<?= $news['news_id'] ?>" role="button">View details
                        &raquo;</a></p>
            <? endforeach; ?>
            <hr class="featurette-divider">
        </div><!--/span-->
        <div class="col-6 col-lg-4">
            <h2><a href="category/0">Аналітика</a></h2>
            <? foreach ($analytics as $news): ?>
                <p><?= $news['news_name'] ?></p>
                <p><a class="btn btn-secondary" href="/view/<?= $news['news_id'] ?>" role="button">View details
                        &raquo;</a></p>
            <? endforeach; ?>
            <hr class="featurette-divider">
        </div><!--/span-->
        <div class="col-6 col-lg-4">
            <h2>Топ коментатори</h2>
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Користувач</th>
                    <th scope="col">Коментарі</th>
                </tr>
                </thead>
                <tbody>
                <? foreach ($top_comments as $key => $comment): ?>
                    <? if ($key == 0): ?>
                        <tr>
                            <th scope="row">1</th>
                            <td><a href="/author/<?= $comment['user_id'] ?>"><?= $comment['user_name'] ?></a></td>
                            <td><?= $comment['comments'] ?></td>
                        </tr>
                    <? else: ?>
                        <tr>
                            <th scope="row"><?= $key + 1 ?></th>
                            <td><a href="/author/<?= $comment['user_id'] ?>"><?= $comment['user_name'] ?></a></td>
                            <td><?= $comment['comments'] ?></td>
                        </tr>
                    <? endif; ?>
                <? endforeach; ?>
                </tbody>
            </table>
            <?= LinkPager::widget(['pagination' => $comments_pagination]) ?>
            <hr class="featurette-divider">
        </div><!--/span-->
    <div class="col-6 col-lg-4">
        <h2>Топ теми</h2>
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Новина</th>
                <th scope="col">Коментарі</th>
            </tr>
            </thead>
            <tbody>
            <? foreach ($top_news as $key => $news): ?>
                <? if ($key == 0): ?>
                    <tr>
                        <th scope="row">1</th>
                        <td><a href="/view/<?= $news['news_id'] ?>"><?= $news['news_name'] ?></a></td>
                        <td><?= $news['comments'] ?></td>
                    </tr>
                <? else: ?>
                    <tr>
                        <th scope="row"><?= $key + 1 ?></th>
                        <td><a href="/view/<?= $news['news_id'] ?>"><?= $news['news_name'] ?></a></td>
                        <td><?= $news['comments'] ?></td>
                    </tr>
                <? endif; ?>
            <? endforeach; ?>
            </tbody>
        </table>
    </div><!--/row-->

</main>