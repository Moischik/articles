<?php

namespace app\models;

use Yii;
use yii\web\Controller;
use app\customs\models\User;

/**
 * Class is not model. Just checks user is admin or not, shows admin panel or close it
 *
 * Class WhoIsClass
 * @package app\models
 */
class WhoIsClass extends Controller
{
    /**
     * Method checks user is admin or not, if is admin and authorized return true
     * @return bool
     */
    public function whoAreYou()
    {
        if (!Yii::$app->user->isGuest) {
            $whois = Yii::$app->user->identity->username;
            $whoisModel = User::find()->where('username = :username', [':username' => $whois])->one();
            if ($whoisModel->role == 100) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
