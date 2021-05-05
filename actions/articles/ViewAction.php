<?php


namespace app\actions\articles;


use \app\customs\models\Articles;
use yii\base\Action;
use yii\web\NotFoundHttpException;

class ViewAction extends Action
{
    public function run($id)
    {
        if ($this->controller->whoAreyou()== false) {
            $this->controller->redirect('/site/index');
        }

        return $this->controller->render('view', [
            'model' => Articles::findModel($id),
        ]);
    }
}
