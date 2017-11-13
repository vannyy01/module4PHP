<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;



/* @var $this yii\web\View */
/* @var $model app\models\news\News */

$this->title = 'Create News';
$this->params['breadcrumbs'][] = ['label' => 'ADMIN_NEWS', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<main role="main" class="container">
    <div class="news-create">

        <h1><?= Html::encode($this->title) ?></h1>
        <? echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]);?>


        <?= $this->render('_form', [
            'img' => $img,
            'model' => $model,
        ]) ?>

    </div>
</main>