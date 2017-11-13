<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'ADMIN_NEWS';
$this->params['breadcrumbs'][] = ['label' => 'ADMIN', 'url' => ['default/index']];

$this->params['breadcrumbs'][] = $this->title;
?>
<main role="main" class="container">
    <div class="news-index">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <? echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]);?>

        <p>
            <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'news_id',
                'news_name',
                'news_text:ntext',
                //'news_photo',
                'category_id',
                'category',
                'publ_date',
                [
                    'header' => 'Analytics',
                    'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function ($model) {
                    return ($model->analytics == 1) ? ['checked' => "checked"] : [];
                }
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>


    </div>
</main>
