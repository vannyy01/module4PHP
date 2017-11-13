<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\user\User */

$this->title = $model->user_name;
$this->params['breadcrumbs'][] = ['label' => 'ADMIN', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => 'ADMIN_USERS', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <? echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]);?>


    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'user_name',
            'email:email',
            'phone',
            'pass_hash',
            [
                'attribute' => 'role',
                'value' => $model->getStatusName(),
            ],
        ],
    ]) ?>

</div>
