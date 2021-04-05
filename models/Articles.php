<?php

namespace app\models;

use Yii;
use app\customs\models\User;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $title
 * @property int $author
 * @property string $text
 * @property int $categorie_id
 * @property string $pub_date
 * @property int|null $views
 *
 * @property User $author0
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
            [['title', 'author', 'text', 'categorie_id', 'pub_date'], 'required'],
            [['author', 'categorie_id', 'views'], 'integer'],
            [['text'], 'string'],
            [['pub_date'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['author'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author' => 'id']],
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
            'author' => 'Author',
            'text' => 'Text',
            'categorie_id' => 'Categorie ID',
            'pub_date' => 'Pub Date',
            'views' => 'Views',
        ];
    }

    /**
     * Gets query for [[Author0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor0()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
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
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['articles_id' => 'id']);
    }
}
