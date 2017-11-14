<?php

namespace app\models\themes;

use Yii;

/**
 * This is the model class for table "themes".
 *
 * @property int $id
 * @property string $site_color
 * @property string $navbar_color
 */
class Themes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'themes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_color', 'navbar_color'], 'required'],
            [['site_color', 'navbar_color'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site_color' => 'Site Color',
            'navbar_color' => 'Navbar Color',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\themes\ThemesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\themes\ThemesQuery(get_called_class());
    }
}
