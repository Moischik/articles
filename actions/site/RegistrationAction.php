<?php

namespace app\actions\site;

use app\customs\models\User;
use app\models\RegistrationModel;
use Yii;
use yii\base\Action;
use yii\helpers\Json;
use yii\helpers\Url;

class RegistrationAction extends Action
{
    public function run()
    {
        $regModel = new RegistrationModel();
        $newUser = new User();

        if ($regModel->load(Yii::$app->request->post()) && $regModel->validate()) {
            $newUser->username = $regModel->username;
            $newUser->password_hash = Yii::$app->security->generatePasswordHash($regModel->password);
            $newUser->password_reset_token = $newUser->generateAuthKey();

            if ($newUser->save()) {
                $this->controller->refresh();
                return $this->controller->redirect(Url::base() . '/site/registration-successful');
            }
            else {
                Yii::$app->session->setFlash('error', Json::encode($newUser->getErrors()));
            }
        }
        return $this->controller->render('registration', ['regModel' => $regModel]);
    }
}
