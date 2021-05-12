<?php

namespace app\actions\user;

use app\models\RegistrationModel;
use app\customs\models\User;
use Yii;
use yii\base\Action;
use yii\helpers\Json;

class CreateAction extends Action
{
    public function run()
    {
        if ($this->controller->whoAreyou() == false) {
            $this->controller->redirect('/site/index');
        }
        $regModel = new RegistrationModel();
        $newUser = new User();

        if ($regModel->load(Yii::$app->request->post())) {
            $newUser->username = $regModel->username;
            $newUser->password_hash = Yii::$app->security->generatePasswordHash($regModel->password);
            $newUser->password_reset_token = $newUser->generateAuthKey();

            if ($newUser->save()) {
                $this->controller->refresh();
                return $this->controller->redirect(['view', 'id' => $newUser->id]);
            } else {
                Yii::$app->session->setFlash('error', Json::encode($newUser->getErrors()));
            }
        }

        return $this->controller->render('create', [
            'regModel' => $regModel,
        ]);
    }
}
