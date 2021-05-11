<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/**
 * @var app\customs\models\AddArticleForm $addArticleForm
 */

$this->title = 'Опубликовать статью';
$this->params['breadcrumbs'][] = $this->title;

if (Yii::$app->user->isGuest) {
    echo '<h2>Чтобы опубликовать свою статью ' . Html::a('зарегистрироваться', ['site/registration']) . ' на сайте или ' . Html::a('войти', ['site/login']) . '</h2>';
} else {
    $form = ActiveForm::begin();
    ?>

    <?= $form->field($addArticleForm, 'categorie')->dropDownList([
        1 => 'Литература',
        2 => 'Спорт',
        3 => 'Музыка',
        4 => 'Кино',
    ]); ?>
    <?= $form->field($addArticleForm, 'title')->textInput() ?>
    <?= $form->field($addArticleForm, 'text')->textarea(['rows' => 10, 'cols' => 6])?>

    <?= $form->field($addArticleForm, 'verifyCode')->widget(Captcha::className(), [
        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
    ]) ?>
    <?= Html::submitButton('Опубликовать статью'); ?>

    <?php ActiveForm::end();
}?>
