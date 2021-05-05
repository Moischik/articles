<?php


namespace app\actions\site;


use app\customs\models\FormAddComments;
use app\models\Comments;
use Yii;
use yii\base\Action;
use yii\helpers\Json;

class SaveCommentAction extends Action
{
    public function run()
    {
        $formcommentsmodel = new FormAddComments();


        if ($formcommentsmodel->load(Yii::$app->request->post()) && $formcommentsmodel->validate()) {

            $usercomment = new Comments();
            $usercomment->User_id = $formcommentsmodel->user_id;
            $usercomment->text = $formcommentsmodel->text;
            $usercomment->pub_date = date('Y-m-d H:i:s');
            $usercomment->articles_id = $formcommentsmodel->articles_id;
            if (!$usercomment->save()) {
                Yii::$app->session->setFlash('error', Json::encode($usercomment->getErrors()));
            }

        } else {
            Yii::$app->session->setFlash('error', Json::encode($formcommentsmodel->getErrors()));
        }
        return $this->controller->redirect(['site/concretearticle?articleId=' . $formcommentsmodel->articles_id]);
    }

}