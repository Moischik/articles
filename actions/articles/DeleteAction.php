<?php

namespace app\actions\articles;

use \app\customs\models\Articles;
use yii\base\Action;

class DeleteAction extends Action
{
    public function run($id)
    {
        if ($this->controller->whoAreyou()== false) {
            $this->controller->redirect('/site/index');
        }
        Articles::findModel($id)->delete();

        return $this->controller->redirect(['index']);
    }
}
