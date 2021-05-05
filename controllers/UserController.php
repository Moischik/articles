<?php

namespace app\controllers;

use app\actions\user\CreateAction;
use app\actions\user\DeleteAction;
use app\actions\user\IndexAction;
use app\actions\user\UpdateAction;
use app\actions\user\ViewAction;
use app\models\WhoIsClass;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends WhoIsClass
{
    public $layout = 'admin';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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
            'index' => IndexAction::class,
            'view' => ViewAction::class,
            'create' => CreateAction::class,
            'update' => UpdateAction::class,
            'delete' => DeleteAction::class,

        ];
    }
}
