<?php

use \yii\widgets\ActiveForm;
use yii\helpers\Html;


$this->title = 'Sign Up';
$this->params['breadcrumbs'][] = $this->title;
?>
<main role="main" class="container">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $form = ActiveForm::begin(['class' => 'form-horizontal']);
    ?>
    <?= $form->field($model, 'user_name')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput() ?>


    <div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

    <?php
    ActiveForm::end();
    ?>
</main>
