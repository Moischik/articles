<?php


namespace app\actions\articles;

use \app\customs\models\Articles;
use Yii;
use yii\base\Action;
use yii\helpers\Json;

class UpdateAction extends Action
{
    public function run($id)
    {
        if ($this->controller->whoAreyou() == false) {
            $this->controller->redirect('/site/index');
        }
        $model = Articles::findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->controller->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', Json::encode($model->getErrors()));
            }
        }

        return $this->controller->render('update', [
            'model' => $model,
        ]);
    }
}
