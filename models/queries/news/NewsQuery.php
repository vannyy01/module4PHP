<?php

namespace app\models\queries\news;

/**
 * This is the ActiveQuery class for [[\app\models\news\News]].
 *
 * @see \app\models\news\News
 */
class NewsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\news\News[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\news\News|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
