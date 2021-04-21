<?php

use app\customs\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Articles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $user = new User();
    $model->User_id = Yii::$app->user->identity->id;
    $model->pub_date = date('Y-m-d H:i:s');
    //$idClient = Yii::$app->user->identity->id;?>

    <?= $form->field($model, 'User_id')->textInput() ?>
    <?= $form->field($model, 'pub_date')->textInput() ?>
    <?= $form->field($model, 'categorie_id')->dropDownList([
        1 => 'Литература',
        2 => 'Спорт',
        3 => 'Музыка',
        4 => 'Кино',
    ]); ?>
    <?= $form->field($model, 'title')->textInput() ?>
    <?= $form->field($model, 'text')->textarea(['rows' => 10, 'cols' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
