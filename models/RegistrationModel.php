<?php

namespace app\models;

use yii\base\Model;
use app\customs\models\User;

/**
 * Registration new user model
 *
 * Class RegistrationModel
 * @package app\models
 */
class RegistrationModel extends Model
{
    public $username;
    public $password;

    /**
     * Validates fields username and password just latin letters and length password
     * @return array
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required', 'message' => 'Поле не должно быть пустым'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'Этот логин уже занят'],
            ['password', 'match', 'pattern' => '#^\w+$#ius', 'message' => 'Только латинсике буквы и цифры'],
            [
                'password',
                'match',
                'pattern' => '#\d.*\d#s',
                'message' => 'Пароль должен содержать минимум 2 буквы и 2 цифры.'
            ],
            [
                'password',
                'match',
                'pattern' => '#[a-z].*[a-z]#is',
                'message' => 'Пароль	 должен содержать минимум 2 буквы и 2 цифры.'
            ],
            ['username', 'match', 'pattern' => '#^\w+$#ius', 'message' => 'Только латинсике буквы и цифры'],
        ];
    }

    /**
     * Array customized attribute labels
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'password' => 'Пароль'
        ];
    }
}
