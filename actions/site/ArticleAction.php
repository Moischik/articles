<?php


namespace app\actions\site;


use app\models\Articles;
use yii\base\Action;
use yii\data\ActiveDataProvider;

class ArticleAction extends Action
{
    public function run()
    {
        $this->controller->view->title = 'статья';
        $articlesProvider = new ActiveDataProvider([
            'query' => Articles::find()->with('user'),
            'pagination' => [
                'pageSize' => '10'
            ],
        ]);

        return $this->controller->render('article', ['articlesProvider' => $articlesProvider]);
    }

}
