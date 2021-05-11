<?php

namespace app\actions\site;

use yii\base\Action;

class RegistrationSuccessfulAction extends Action
{
    public function run()
    {
        return $this->controller->render('registration-successful');
    }
}
