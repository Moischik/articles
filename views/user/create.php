<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $regModel app\models\RegistrationModel */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('create-form', [
        'regModel' => $regModel,
    ]) ?>

</div>
