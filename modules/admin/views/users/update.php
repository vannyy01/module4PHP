<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\user\User */

$this->title = 'Update User: ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN_USERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_name, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <? echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]);?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
