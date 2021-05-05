<?php

namespace app\controllers;


use app\actions\site\AboutAction;
use app\actions\site\AddArticleAction;
use app\actions\site\ArticleAction;
use app\actions\site\ConcreteArticleAction;
use app\actions\site\ContactAction;
use app\actions\site\IndexAction;
use app\actions\site\LoginAction;
use app\actions\site\LogoutAction;
use app\actions\site\RegistrationAction;
use app\actions\site\RegistrationsuccessfulAction;
use app\actions\site\SaveCommentAction;
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
use yii\helpers\Url;
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
            'index' => IndexAction::class,
            'article' => ArticleAction::class,
            'add-article' => AddArticleAction::class,
            'login' => LoginAction::class,
            'contact' => ContactAction::class,
            'about' => AboutAction::class,
            'registration' => RegistrationAction::class,
            'registrationsuccessful' => RegistrationsuccessfulAction::class,
            'concretearticle' => ConcreteArticleAction::class,
            'save-comment' => SaveCommentAction::class,
            'logout' => LogoutAction::class,
        ];
    }
}
