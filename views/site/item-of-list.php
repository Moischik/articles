<?php

use app\models\Articles;
use yii\helpers\Html;
use yii\web\View;
use app\models\ArticlesCategories;

/**
 * @var View $this
 * @var Articles $model
 * @var string $userName
 */
?>

<div class="news-item">
    <?php
    $categorieId = $model->categorie_id;
    $articlesId = $model->id;

    $categorie = ArticlesCategories::find()->where(['id' => $categorieId])->one();
    $categorieTitle = $categorie->title;
    ?>
    <h3><?= 'Опубликовал: ' . Html::encode($model->user->username) . '  в категории: ' . Html::encode($categorieTitle) ?></h3>

    <h2> <?= Html::encode($model->title) ?></h2>

    <h3> <?= Html::encode(mb_strimwidth($model->text, 0, 300, '...')) . Html::a('(Читать дальше...)', ['site/concrete-article?articleId=' . $model->id]) ?></h3>
    <br><br><br>

</div>
