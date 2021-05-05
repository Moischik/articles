<?php

namespace app\controllers;


use app\actions\comment\DeleteAction;
use app\actions\comment\IndexAction;
use app\actions\comment\UpdateAction;
use app\actions\comment\ViewAction;
use app\models\WhoIsClass;
use yii\filters\VerbFilter;

/**
 * ArticlesController implements the CRUD actions for Articles model.
 */
class CommentController extends WhoIsClass
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
            'update' => UpdateAction::class,
            'delete' => DeleteAction::class,

        ];
    }
}
