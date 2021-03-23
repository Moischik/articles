<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property string|null $author
 * @property string $text
 * @property string $pub_date
 * @property int|null $articles_id
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'pub_date'], 'required'],
            [['text'], 'string'],
            [['pub_date'], 'safe'],
            [['articles_id'], 'integer'],
            [['author'], 'string', 'max' => 255],
            [['author'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author' => 'Author',
            'text' => 'Text',
            'pub_date' => 'Pub Date',
            'articles_id' => 'Articles ID',
        ];
    }
}
