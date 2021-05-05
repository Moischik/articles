<?php


namespace app\actions\user;


use app\customs\models\User;
use yii\base\Action;

class ViewAction extends Action
{
    public function run($id)
    {
        if ($this->controller->whoAreyou()== false) {
            $this->controller->redirect('/site/index');
        }

        return $this->controller->render('view', [
            'model' => User::findModel($id),
        ]);
    }

}
