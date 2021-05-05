<?php

namespace app\controllers;

use app\actions\articles\CreateAction;
use app\actions\articles\DeleteAction;
use app\actions\articles\IndexAction;
use app\actions\articles\UpdateAction;
use app\actions\articles\ViewAction;
use app\models\WhoIsClass;
use yii\filters\VerbFilter;

/**
 * ArticlesController implements the CRUD actions for Articles model.
 */
class ArticlesController extends WhoIsClass
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
