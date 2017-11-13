<?php

namespace app\models\news;

use app\models\category\Category;
use Yii;

/**
 * This is the model class for table "news".
 *
 * @property string $news_id
 * @property string $news_name
 * @property string $news_text
 * @property string $news_photo
 * @property int $category_id
 * @property string $category
 * @property string $publ_date
 * @property int $analytics
 *
 * @property Comments[] $comments
 * @property NewsHasTag[] $newsHasTags
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_name', 'news_text', 'news_photo', 'category_id', 'category'], 'required'],
            [['news_text'], 'string'],
            [['category_id', 'analytics'], 'integer'],
            [['publ_date'], 'safe'],
            [['news_name'], 'string', 'max' => 200],
            [['news_photo'], 'string', 'max' => 70],
            [['category'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'news_id' => 'News ID',
            'news_name' => 'News Name',
            'news_text' => 'News Text',
            'news_photo' => 'News Photo',
            'category_id' => 'Category ID',
            'category' => 'Category',
            'publ_date' => 'Publ Date',
            'analytics' => 'Analytics',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['news_id' => 'news_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsHasTags()
    {
        return $this->hasMany(NewsHasTag::className(), ['news_news_id' => 'news_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    /**public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('news_has_tag', ['news_news_id' => 'news_id']);
    }
     **/

    /**
     * @inheritdoc
     * @return \app\models\queries\news\NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\news\NewsQuery(get_called_class());
    }

    public function saveNews() {
        $this->category_id = Category::find()->select(['id'])->where("name = '$this->category'")->asArray()->one()['id'];
       return $this->save();
    }
}
