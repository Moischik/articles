<?php

namespace app\actions\admin;

use yii\base\Action;

class IndexAction extends Action
{
    public function run()
    {
        if ($this->controller->whoAreyou()== false) {
            $this->controller->redirect('/site/index');
        }
        return $this->controller->render('index');
    }

}