<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ADMIN_USERS';
$this->params['breadcrumbs'][] = ['label' => 'ADMIN', 'url' => ['default/index']];

$this->params['breadcrumbs'][] = $this->title;
?>
<main role="main" class="container">
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::a('ADMIN START PAGE', ['/admin/default'], ['class' => 'btn btn-success']) ?>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <? echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]);?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'user_name',
            'email:email',
            'phone',
            'pass_hash',
            [
                'attribute' => 'role',
                'value' => $searchModel->getStatusName(),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</main>