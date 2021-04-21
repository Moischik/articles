<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $regmodel app\models\RegistrationModel */

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;

?>

<h4>Регистрация</h4>

<?php $formreg = ActiveForm::begin(); ?>
<?= $formreg->field($regmodel, 'username') ?>
<?= $formreg->field($regmodel, 'password')->passwordInput(); ?>
<?= Html::submitButton('Зарегистрироваться', ['/site/registrationsuccessful']) ?>
<?php ActiveForm::end() ?>

<?= Alert::widget() ?>
