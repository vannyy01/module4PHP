<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\user\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pass_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->dropDownList(\app\modules\admin\models\User::getStatusesArray()) ?>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? 'BUTTON_CREATE' : 'BUTTON_CREATE',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
