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
use app\actions\site\RegistrationSuccessfulAction;
use app\actions\site\SaveCommentAction;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

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
            'registration-successful' => RegistrationSuccessfulAction::class,
            'concrete-article' => ConcreteArticleAction::class,
            'save-comment' => SaveCommentAction::class,
            'logout' => LogoutAction::class,
        ];
    }
}
