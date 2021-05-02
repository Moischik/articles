<?php


namespace app\actions\site;


use app\customs\models\User;
use app\models\RegistrationModel;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class RegistrationAction extends Action
{
    public function run()
    {
        $regmodel = new RegistrationModel();
        $newuser = new User();

        if ($regmodel->load(Yii::$app->request->post()) && $regmodel->validate()) {
            $newuser->username = $regmodel->username;
            $newuser->password_hash = Yii::$app->security->generatePasswordHash($regmodel->password);
            $newuser->password_reset_token = $newuser->generateAuthKey();
            $newuser->save();
            $this->controller->refresh();
            $this->controller->redirect(Url::base() . '/site/registrationsuccessful');
        }
        return $this->controller->render('registration', ['regmodel' => $regmodel]);
    }

}