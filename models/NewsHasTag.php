<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news_has_tag".
 *
 * @property string $news_news_id
 * @property string $tag_id
 *
 * @property News $newsNews
 * @property Tag $tag
 */
class NewsHasTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_has_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_news_id', 'tag_id'], 'required'],
            [['news_news_id', 'tag_id'], 'integer'],
            [['news_news_id', 'tag_id'], 'unique', 'targetAttribute' => ['news_news_id', 'tag_id']],
            [['news_news_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['news_news_id' => 'news_id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'news_news_id' => 'News News ID',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsNews()
    {
        return $this->hasOne(News::className(), ['news_id' => 'news_news_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\NewsHasTagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\NewsHasTagQuery(get_called_class());
    }
}
