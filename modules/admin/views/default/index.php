<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model \app\models\user\User */

$this->title = 'ADMIN';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="admin-default-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <? echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]);?>

    <p>
        <?= Html::a( 'ADMIN_USERS', ['users/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a( 'ADMIN_COMMENTS', ['comments/index'], ['class' => 'btn btn-secondary']) ?>
        <?= Html::a('Police comments check', ['comments/police'], ['class' => 'btn btn-primary'])?>
        <?= Html::a( 'ADMIN_NEWS', ['news/index'], ['class' => 'btn btn-second']) ?>
        <?= Html::a( 'ADMIN_CATEGORIES', ['category/index'], ['class' => 'btn btn-second']) ?>
        <?= Html::a( 'ADMIN_SITE_THEMES', ['themes/index'], ['class' => 'btn btn-primary']) ?>
    </p>
</div>