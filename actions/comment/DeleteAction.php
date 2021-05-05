<?php


namespace app\actions\comment;


use app\customs\models\Comments;
use yii\base\Action;

class DeleteAction extends Action
{
    public function run($id)
    {
        if ($this->controller->whoAreyou()== false) {
            $this->controller->redirect('/site/index');
        }
        Comments::findModel($id)->delete();

        return $this->controller->redirect(['index']);
    }
}
