<?php


namespace app\actions\site;


use yii\base\Action;

class RegistrationsuccessfulAction extends Action
{
    public function run()
    {
        return $this->controller->render('registrationsuccessful');
    }

}
