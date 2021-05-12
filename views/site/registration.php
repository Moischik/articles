<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $regModel app\models\RegistrationModel */

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;

?>

<h4>Регистрация</h4>

<?php $formReg = ActiveForm::begin(); ?>
<?= $formReg->field($regModel, 'username') ?>
<?= $formReg->field($regModel, 'password')->passwordInput(); ?>
<?= Html::submitButton('Зарегистрироваться', ['/site/registration-successful']) ?>
<?php ActiveForm::end() ?>

<?= Alert::widget() ?>
