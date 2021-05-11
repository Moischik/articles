<?php

use app\customs\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $user = new User();
    $model->User_id = Yii::$app->user->identity->id;
    $model->pub_date = date('Y-m-d H:i:s');
    //$idClient = Yii::$app->user->identity->id;?>

    <?= $form->field($model, 'text')->textarea(['rows' => 10, 'cols' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
