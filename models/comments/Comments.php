<?php

namespace app\models\comments;

use app\models\news\News;
use app\models\user\User;
use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property string $comment_id
 * @property string $news_id
 * @property string $user_id
 * @property string $user_name
 * @property string $comm_text
 * @property int $category_id
 * @property int $is_good
 * @property int $raiting
 * @property string $date
 *
 * @property News $news
 * @property User $user
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_id', 'user_id', 'comm_text', 'category_id', 'user_name'], 'required'],
            [['news_id', 'user_id', 'category_id', 'is_good', 'raiting'], 'integer'],
            [['date'], 'safe'],
            [['comm_text'], 'string', 'max' => 255],
            [['user_name'], 'string', 'max' => 45],
            [['news_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['news_id' => 'news_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comment_id' => 'Comment ID',
            'news_id' => 'News ID',
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'comm_text' => 'Comm Text',
            'category_id' => 'Category ID',
            'is_good' => 'Is Good',
            'raiting' => 'Raiting',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::className(), ['news_id' => 'news_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\comments\CommentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\comments\CommentsQuery(get_called_class());
    }
}
