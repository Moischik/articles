<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $title
 * @property string $username
 * @property string $text
 * @property int|null $categorie
 * @property string $pub_date
 * @property int|null $views
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'username', 'text', 'pub_date'], 'required'],
            [['text'], 'string'],
            [['categorie', 'views'], 'integer'],
            [['pub_date'], 'safe'],
            [['title', 'username'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'username' => 'Username',
            'text' => 'Text',
            'categorie' => 'Categorie',
            'pub_date' => 'Pub Date',
            'views' => 'Views',
        ];
    }
}
