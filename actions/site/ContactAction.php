<?php

namespace app\actions\site;

use app\models\ContactForm;
use Yii;
use yii\base\Action;

class ContactAction extends Action
{
    public function run()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->controller->refresh();
        }
        return $this->controller->render('contact', [
            'model' => $model,
        ]);
    }
}
