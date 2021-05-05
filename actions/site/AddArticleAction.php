<?php


namespace app\actions\site;


use app\customs\models\FormAddArticle;
use app\models\Articles;
use Yii;
use yii\base\Action;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;

class AddArticleAction extends Action
{
    public function run()
    {
        $this->controller->view->title = 'Опубликовать статью';
        $formarticlemodel = new FormAddArticle();
        $articlesProvider = new ActiveDataProvider([
            'query' => Articles::find()->with('user'),
            'pagination' => [
                'pageSize' => '10'
            ],
        ]);

        if ($formarticlemodel->load(Yii::$app->request->post()) && $formarticlemodel->validate()) {

            $articles = new Articles();
            $articles->User_id =Yii::$app->user->identity->id;
            $articles->text = $formarticlemodel->text;
            $articles->title = $formarticlemodel->title;
            $articles->categorie_id = $formarticlemodel->categorie;
            $articles->pub_date = date('Y-m-d H:i:s');
            if ($articles->save()) {
                return $this->controller->render('article', ['articlesProvider' => $articlesProvider]);
            } else {
                Yii::$app->session->setFlash('error', Json::encode($articles->getErrors()));
            }

        }

        return $this->controller->render('addarticle', ['formarticlemodel' => $formarticlemodel]);
    }

}
