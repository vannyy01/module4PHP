<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $header;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::a('ADMIN START PAGE', ['/admin/default'], ['class' => 'btn btn-success']) ?>
    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Comments', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a( 'All comments', ['index'], ['class' => 'btn btn-secondary']) ?>
        <?= Html::a('Police comments check', ['police'], ['class' => 'btn btn-primary'])?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'comment_id',
            'news_id',
            'user_id',
            'comm_text',
            'category_id',
            [
                'header' => 'Is Good',
                'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function ($model) {
                return ($model->is_good == 1) ? ['checked' => "checked"] : [];
            }
            ],
            //'raiting',
            'date',
            'user_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
