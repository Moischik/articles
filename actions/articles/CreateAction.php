<?php


namespace app\actions\articles;


use app\models\Articles;
use Yii;
use yii\base\Action;
use yii\helpers\Json;

class CreateAction extends Action
{
    public function run()
    {
        if ($this->controller->whoAreyou() == false) {
            $this->controller->redirect('/site/index');
        }
        $model = new Articles();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                return $this->controller->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', Json::encode($model->getErrors()));
            }
        }

        return $this->controller->render('create', [
            'model' => $model,

        ]);
    }

}