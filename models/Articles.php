<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $title
 * @property int $User_id
 * @property string $text
 * @property int $categorie_id
 * @property string $pub_date
 * @property int|null $views
 *
 * @property User $user
 * @property ArticlesCategories $categorie
 * @property Comments[] $comments
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
            [['title', 'User_id', 'text', 'categorie_id', 'pub_date'], 'required'],
            [['User_id', 'categorie_id', 'views'], 'integer'],
            [['text'], 'string'],
            [['pub_date'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['User_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['User_id' => 'id']],
            [['categorie_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArticlesCategories::className(), 'targetAttribute' => ['categorie_id' => 'id']],
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
            'User_id' => 'User ID',
            'text' => 'Text',
            'categorie_id' => 'Categorie ID',
            'pub_date' => 'Pub Date',
            'views' => 'Views',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'User_id']);
    }

    /**
     * Gets query for [[Categorie]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategorie()
    {
        return $this->hasOne(ArticlesCategories::className(), ['id' => 'categorie_id']);
    }

    /**
     * Gets query for [[FormAddComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['articles_id' => 'id']);
    }
}
