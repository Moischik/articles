<?php


namespace app\actions\user;


use app\models\User;
use yii\base\Action;
use yii\web\NotFoundHttpException;

class DeleteAction extends Action
{
    public function run($id)
    {
        if ($this->controller->whoAreyou()== false) {
            $this->controller->redirect('/site/index');
        }

        $this->findModel($id)->delete();

        return $this->controller->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}