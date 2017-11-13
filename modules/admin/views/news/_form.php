<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\news\News */
/* @var $form yii\widgets\ActiveForm */
/* @var $img yii\widgets\ActiveForm */

?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'news_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'news_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($img, 'imageFile')->fileInput() ?>
    <?= $form->field($model, 'news_photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->dropDownList(\app\models\category\Category::getCategories()) ?>
    <?= $form->field($model, 'analytics')->checkbox(['value' => 1, 'uncheck' => '0']) ?>
    <?= $form->field($model, 'publ_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
