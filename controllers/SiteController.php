<?php

namespace app\controllers;


use app\models\Articles;
use app\customs\models\FormAddArticle;
use app\models\ArticlesCategories;
use Yii;
use app\customs\models\FormAddComments;
use app\models\RegistrationModel;
use app\models\Comments;
use app\customs\models\User;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Display all articles
     *
     * @return string
     */
    public function actionArticle()
    {
        $this->view->title = 'статья';
        $articlesProvider = new ActiveDataProvider([
            'query' => Articles::find()->with('user'),
            'pagination' => [
                'pageSize' => '10'
            ],
        ]);


        return $this->render('article', ['articlesProvider' => $articlesProvider]);

    }

    /**
     * Add new article action
     *
     * @return string
     */
    public function actionAddArticle()
    {
        $this->view->title = 'Опубликовать статью';
        $formarticlemodel = new FormAddArticle();
        $articlesProvider = new ActiveDataProvider([
            'query' => Articles::find()->with('user'),
            'pagination' => [
                'pageSize' => '10'
            ],
        ]);

        if ($formarticlemodel->load(Yii::$app->request->post()) && $formarticlemodel->validate()) {

            /*$user = User::findOne(['username' => $formarticlemodel->name]);
            if (!$user) {
                Yii::$app->session->setFlash('error', "Пользователь не найден.");
                //$this->refresh();
                return $this->render('addarticle', ['formarticlemodel' => $formarticlemodel]);
            }*/
            $articles = new Articles();
            $articles->User_id =Yii::$app->user->identity->id;
            $articles->text = $formarticlemodel->text;
            $articles->title = $formarticlemodel->title;
            $articles->categorie_id = $formarticlemodel->categorie;
            $articles->pub_date = date('Y-m-d H:i:s');
            if ($articles->save()) {
                return $this->render('article', ['articlesProvider' => $articlesProvider]);
            } else {
                Yii::$app->session->setFlash('error', Json::encode($articles->getErrors()));
            }

        }

        return $this->render('addarticle', ['formarticlemodel' => $formarticlemodel]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Registration new user action
     *
     * @return string
     * @throws \yii\base\Exception
     */
    public function actionRegistration()
    {
        $regmodel = new RegistrationModel();
        $newuser = new User();

        if ($regmodel->load(Yii::$app->request->post()) && $regmodel->validate()) {
            $newuser->username = $regmodel->username;
            $newuser->password_hash = Yii::$app->security->generatePasswordHash($regmodel->password);
            $newuser->password_reset_token = $newuser->generateAuthKey();
            $newuser->save();
            $this->refresh();
            $this->redirect('http://articles.com/site/registrationsuccessful');
        }
        return $this->render('registration', compact('regmodel'));
    }

    /**
     * Successful registration page
     *
     * @return string
     */
    public function actionRegistrationsuccessful()
    {
        return $this->render('registrationsuccessful');
    }

    /**
     * Concrete article page
     *
     * @return string
     */
    public function actionConcretearticle()
    {
        $articleId = Yii::$app->request->get('articleId');
        $this->view->title = 'статья';
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


        return $this->render('concretearticle', [
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

    public function actionSaveComment()
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
        return $this->redirect(['site/concretearticle?articleId=' . $formcommentsmodel->articles_id]);
    }
}
