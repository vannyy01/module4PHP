<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\NewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'news_id') ?>

    <?= $form->field($model, 'news_name') ?>

    <?= $form->field($model, 'news_text') ?>

    <?= $form->field($model, 'news_photo') ?>

    <?= $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'tags') ?>

    <?php // echo $form->field($model, 'publ_date') ?>

    <?php // echo $form->field($model, 'analytics') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
