<?php

namespace app\actions\site;

use app\customs\models\AddCommentsForm;
use app\customs\models\User;
use app\models\Articles;
use app\models\ArticlesCategories;
use app\models\Comments;
use Yii;
use yii\base\Action;

class ConcreteArticleAction extends Action
{
    public function run()
    {
        $articleId = Yii::$app->request->get('articleId');
        $this->controller->view->title = 'статья';
        $model = Articles::findOne($articleId);
        $user = User::find()->where(['id' => $model->User_id])->one();
        $userName = $user->username;
        $pubDate = $model->pub_date;
        $categorie = ArticlesCategories::find()->where(['id' => $model->categorie_id])->one();
        $categorieTitle = $categorie->title;
        $comments = Comments::find()->where(['articles_id' => $articleId])->all();
        $addCommentsForm = new AddCommentsForm();

        return $this->controller->render('concrete-article', [
            'model' => $model,
            'userName' => $userName,
            'categorieTitle' => $categorieTitle,
            'pubDate' => $pubDate,
            'comments' => $comments,
            'addCommentsForm' => $addCommentsForm
        ]);
    }
}
