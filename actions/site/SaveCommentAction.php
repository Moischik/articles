<?php

namespace app\actions\site;

use app\customs\models\AddCommentsForm;
use app\models\Comments;
use Yii;
use yii\base\Action;
use yii\helpers\Json;

class SaveCommentAction extends Action
{
    public function run()
    {
        $addCommentsForm = new AddCommentsForm();

        if ($addCommentsForm->load(Yii::$app->request->post()) && $addCommentsForm->validate()) {

            $userComment = new Comments();
            $userComment->User_id = $addCommentsForm->user_id;
            $userComment->text = $addCommentsForm->text;
            $userComment->pub_date = date('Y-m-d H:i:s');
            $userComment->articles_id = $addCommentsForm->articles_id;
            if (!$userComment->save()) {
                Yii::$app->session->setFlash('error', Json::encode($userComment->getErrors()));
            }
        } else {
            Yii::$app->session->setFlash('error', Json::encode($addCommentsForm->getErrors()));
        }
        return $this->controller->redirect(['site/concrete-article?articleId=' . $addCommentsForm->articles_id]);
    }
}
