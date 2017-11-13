<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\news\News */

$this->title = $model->news_id;
$this->params['breadcrumbs'][] = ['label' => 'ADMIN', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => 'ADMIN_NEWS', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<main role="main" class="container">

<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <? echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]);?>


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->news_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->news_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'news_id',
            'news_name',
            'news_text:ntext',
            'news_photo',
            'category_id',
            'category',
            'publ_date',
            'analytics',
        ],
    ]) ?>

</div>
</main>