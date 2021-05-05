<?php


namespace app\actions\site;


use app\customs\models\FormAddComments;
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
        $username = $user->username;

        $pub_date = $model->pub_date;

        $categorie = ArticlesCategories::find()->where(['id' => $model->categorie_id])->one();
        $categorietitle = $categorie->title;

        $comments = Comments::find()->where(['articles_id' => $articleId])->all();
        /* $comment = $comments->text;
          $compub_date = $comments->pub_date;
          $author = $comments->author;*/
        $formcommentsmodel = new FormAddComments();


        return $this->controller->render('concretearticle', [
            'model' => $model,
            'username' => $username,
            'categorietitle' => $categorietitle,
            'pub_date' => $pub_date,
            'comments' => $comments,
            /*'comment' => $comment,
            'compub_date' => $compub_date,
            'author' => $author,*/
            'formcommentsmodel' => $formcommentsmodel
        ]);
    }

}
