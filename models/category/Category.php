<?php

namespace app\models\category;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
   public static function getCategories(){
        $db = Yii::$app->db;
        $categories = $db->createCommand('SELECT name FROM category')->queryAll();
        $cat = [];
        foreach ($categories as  $category){
            $cat[$category['name']] = $category['name'];
        }
        return $cat;
   }
    public static function getCatIDs(){
        $db = Yii::$app->db;
        $categories = $db->createCommand('SELECT id FROM category')->queryAll();
        $cat = [];
        foreach ($categories as  $category){
            $cat[$category['id']] = $category['id'];
        }
        return $cat;
    }
    /**
     * @inheritdoc
     * @return \app\models\queries\category\CategoryQuery the active query used by this AR class.
     */
    public static function getItems(){
        $categories = self::find()->asArray()->all();
        return $categories;
    }
    public static function find()
    {
        return new \app\models\queries\category\CategoryQuery(get_called_class());
    }
}
