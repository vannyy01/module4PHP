<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\comments\Comments */

$this->title = 'Update Comments: '. $model->comment_id;
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->comment_id, 'url' => ['view', 'comment_id' => $model->comment_id, 'news_id' => $model->news_id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
