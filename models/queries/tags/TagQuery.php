<?php

namespace app\models\queries\tags;

/**
 * This is the ActiveQuery class for [[\app\models\tags\Tag]].
 *
 * @see \app\models\tags\Tag
 */
class TagQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\tags\Tag[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\tags\Tag|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
