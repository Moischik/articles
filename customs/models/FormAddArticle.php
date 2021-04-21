<?php

namespace app\customs\models;

use yii\base\Model;


/**
 * Model form adding new articles
 *
 * Class FormAddArticle
 * @package app\models
 */
class FormAddArticle extends Model
{
    public $name;
    public $categorie;
    public $text;
    public $title;
    public $verifyCode;


    /**
     * Validates fields form for adding new articles
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['categorie', 'title', 'text'], 'required', 'message' => 'Обязательное поле'],
            [['title', 'text'], 'trim'],
            ['verifyCode', 'captcha', 'message' => 'Капча не введена'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'categorie' => 'Категория',
            'title' => 'Название',
            'text' => 'Текст',
            'verifyCode' => 'Капча',
        ];
    }
}
