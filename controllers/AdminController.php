<?php

namespace app\controllers;

use app\models\WhoIsClass;

/**
 * Admin panel controller
 */
class AdminController extends WhoIsClass
{
    public $layout = 'admin';

    /**
     * Index main page
     * @return string
     */
    public function actionIndex()
    {
        if (parent::whoAreYou() == false) {
            $this -> redirect('http://62.109.20.176/');
        }
        return $this -> render('index');
    }
}
