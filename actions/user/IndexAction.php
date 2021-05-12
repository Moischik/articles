<?php

namespace app\actions\user;

use app\models\User;
use yii\base\Action;
use yii\data\ActiveDataProvider;

class IndexAction extends Action
{
    public function run()
    {
       if ($this->controller->whoAreyou()== false) {
           $this->controller->redirect('/site/index');
       }

        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->controller->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
