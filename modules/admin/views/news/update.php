<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\news\News */

$this->title = 'Update News: ' . $model->news_id;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->news_id, 'url' => ['view', 'id' => $model->news_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<main role="main" class="container">

    <div class="news-update">

        <h1><?= Html::encode($this->title) ?></h1>
        <? echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]);?>


        <?= $this->render('_form', [
            'img' => $img,
            'model' => $model,
        ]) ?>

    </div>
</main>
