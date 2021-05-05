<?php

use app\models\Articles;
use yii\helpers\Html;
use yii\web\View;


/**
 * @var View $this
 * @var Articles $model
 * @var string $username
 */
?>

<div class="news-item">
    <?php
    $categorie_id = $model->categorie_id;
    $articles_id = $model->id;

    $categorie = \app\models\ArticlesCategories::find()->where(['id' => $categorie_id])->one();
    $categorietitle = $categorie->title;

    //$comments = \app\models\Comments::find()->where(['articles_id' => $articles_id])->one();
   // $comment = $comments->text;
    ?>
    <h3><?= 'Опубликовал: ' . Html::encode($model->user->username) . '  в категории: ' . Html::encode($categorietitle) ?></h3>


    <h2> <?= Html::encode($model->title) ?></h2>

    <h3> <?= Html::encode(mb_strimwidth($model->text, 0, 300, '...')) . Html::a('(Читать дальше...)', ['site/concretearticle?articleId=' . $model->id]) ?></h3>
    <br><br><br>


</div>
