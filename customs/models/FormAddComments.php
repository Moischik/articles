<?php

namespace app\customs\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "comments".
 * @property integer $user_id
 * @property string $text
 * @property integer $articles_id
 */
class FormAddComments extends Model
{
    public $user_id;
    public $text;
    public $articles_id;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'user_id'], 'required'],
            [['text'], 'string'],
            [['articles_id'], 'integer'],
            [['user_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User_id',
            'text' => 'Текст вашего комментария',
            'articles_id' => 'Articles ID',
        ];
    }
}
