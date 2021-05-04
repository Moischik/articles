<?php


namespace app\actions\articles;


use app\models\Articles;
use Yii;
use yii\base\Action;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

class UpdateAction extends Action
{
    public function run($id)
    {
        if ($this->controller->whoAreyou() == false) {
            $this->controller->redirect('/site/index');
        }
        $model = $this->findModel($id);

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


    protected function findModel($id)
    {
        if (($model = Articles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}