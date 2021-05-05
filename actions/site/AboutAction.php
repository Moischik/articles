<?php


namespace app\actions\site;


use yii\base\Action;

class AboutAction extends Action
{
    public function run()
    {
        return $this->controller->render('about');
    }

}
