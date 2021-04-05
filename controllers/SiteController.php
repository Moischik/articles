<?php

namespace app\controllers;


use app\models\Articles;
use app\customs\models\FormAddArticle;
use Yii;
use app\models\Comments;
use app\models\RegistrationModel;
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
     * Display reviews about supermarkets
     *
     * @return string
     */
    public function actionArticle()
    {
        $this->view->title = 'статья';
        $articlesProvider = new ActiveDataProvider([
            'query' => Articles::find(),
            'pagination' => [
                'pageSize' => '10'
            ],
        ]);

        return $this->render('article', ['articlesProvider' => $articlesProvider]);
    }

    /**
     * Add new review action
     *
     * @return string
     */
    public function actionAddArticle()
    {
        $this->view->title = 'Опубликовать статью';
        $formarticlemodel = new FormAddArticle();


        if ($formarticlemodel->load(Yii::$app->request->post()) && $formarticlemodel->validate()) {

            $user = User::findOne(['username' => $formarticlemodel->name]);
            if (!$user) {
                Yii::$app->session->setFlash('error', "Пользователь не найден.");
                //$this->refresh();
                return $this->render('addarticle', ['formarticlemodel' => $formarticlemodel]);
            }
            $articles = new Articles();
            $articles->author = $user->getId();
            $articles->text = $formarticlemodel->text;
            $articles->title = $formarticlemodel->title;
            $articles->categorie_id = $formarticlemodel->categorie;
            $articles->pub_date = date('Y-m-d H:i:s');
            if ($articles->save()) {
                $this->refresh();
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
}
