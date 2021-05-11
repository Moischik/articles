<?php

namespace app\actions\user;

use app\customs\models\User;
use yii\base\Action;

class DeleteAction extends Action
{
    public function run($id)
    {
        if ($this->controller->whoAreyou()== false) {
            $this->controller->redirect('/site/index');
        }

        User::findModel($id)->delete();

        return $this->controller->redirect(['index']);
    }
}
