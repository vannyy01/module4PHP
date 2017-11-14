<?php

namespace app\models\queries\themes;

/**
 * This is the ActiveQuery class for [[\app\models\themes\Themes]].
 *
 * @see \app\models\themes\Themes
 */
class ThemesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\themes\Themes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\themes\Themes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
