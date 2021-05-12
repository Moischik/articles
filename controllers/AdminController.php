<?php

namespace app\controllers;

use app\actions\admin\IndexAction;
use app\models\WhoIsClass;

/**
 * Admin panel controller
 */
class AdminController extends WhoIsClass
{
    public $layout = 'admin';

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return ['index' => IndexAction::class];
    }
}
