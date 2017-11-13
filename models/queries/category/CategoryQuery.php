<?php

namespace app\models\queries\category;

/**
 * This is the ActiveQuery class for [[\app\models\category\Category]].
 *
 * @see \app\models\category\Category
 */
class CategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\category\Category[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\category\Category|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
