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
        $regmodel = new RegistrationModel();
        $newuser = new User();

        if ($regmodel->load(Yii::$app->request->post())) {
            $newuser->username = $regmodel->username;
            $newuser->password_hash = Yii::$app->security->generatePasswordHash($regmodel->password);
            $newuser->password_reset_token = $newuser->generateAuthKey();

            if ($newuser->save()) {
                $this->controller->refresh();
                return $this->controller->redirect(['view', 'id' => $newuser->id]);
            } else {
                Yii::$app->session->setFlash('error', Json::encode($newuser->getErrors()));
            }
        }

        return $this->controller->render('create', [
            'regmodel' => $regmodel,
        ]);

    }
}
