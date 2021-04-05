<?php

use yii\helpers\Html;

?>

<div class="news-item">
    <h2><?='Опубликовал пользователь' . Html::encode($model->author) ?></h2>
    <?=  Html::encode($model->title) ?>
    <br>
    <?= Html::encode($model->text) ?>
</div>
