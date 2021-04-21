<?php

use app\customs\models\User;
use app\models\Articles;
use app\models\Comments;
use app\models\ArticlesCategories;
use app\customs\models\FormAddComments;
use yii\web\View;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var View $this
 * @var Articles $model
 * @var Comments $comments
 * @var app\customs\models\FormAddComments $formcommentsmodel
 * @var string $username
 * @var string $categorietitle
 * @var datetime $pub_date
 * @var string $comment
 * @var string $compub_date
 * @var integer $user_id
 */
?>

<div class="news-item">
    <h2><?= 'Опубликовал: ' . Html::encode($username) ?></h2>
    <h3><?= 'в категории: ' . Html::encode($categorietitle) ?></h3>
    <h3><?= 'когда:' . Html::encode($pub_date) ?> </h3>
    <h2> <?= Html::encode($model->title) ?></h2>
    <br>
    <h3> <?= Html::encode($model->text) ?></h3>
    <h3><?= 'Комментарии: ' ?></h3><br>

    <?php
    foreach ($comments as $val) {
        $user = User::find()->where(['id' => $val->User_id])->one();
        $usercomname = $user->username; ?>
        <h4><?= Html::encode($usercomname) ?></h4> <!--author of comment-->
        <p><?= Html::encode($compub_date = $val->pub_date) ?></p> <!--ub date of comment-->
        <h4><?= Html::encode($comment = $val->text) ?></h4><!-- comments text-->
        <hr>
    <?php }
    ?><br>

    <?php if (Yii::$app->user->isGuest) {
        echo '<h2>Чтобы оставить комментарий, нужно ' . Html::a('зарегистрироваться', ['site/registration']) . ' на сайте или ' . Html::a('войти', ['site/login']) . '</h2>';
    } else {
        $form = ActiveForm::begin([
            'method' => 'post',
            'action' => '/site/save-comment',
        ]); ?>

        <?php $formcommentsmodel->user_id = Yii::$app->user->identity->id; ?>
        <?= $form->field($formcommentsmodel, 'user_id')->hiddenInput()->label(false) ?>
        <?php $formcommentsmodel->articles_id = $model->id; ?>
        <?= $form->field($formcommentsmodel, 'articles_id')->hiddenInput()->label(false) ?>
        <?= $form->field($formcommentsmodel, 'text')->textarea(['rows' => 10, 'cols' => 6]) ?>
        <?= Html::submitButton('Отправить', ['url' => ['site/save-comment']]); ?>
        <?php ActiveForm::end();
    } ?>


</div>