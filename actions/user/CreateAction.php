<?php


namespace app\actions\user;


use app\models\User;
use Yii;
use yii\base\Action;

class CreateAction extends Action
{
    public function run()
    {
        if ($this->controller->whoAreyou()== false) {
            $this->controller->redirect('/site/index');
        }

        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->controller->redirect(['view', 'id' => $model->id]);
        }

        return $this->controller->render('create', [
            'model' => $model,
        ]);

    }

}