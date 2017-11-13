<?php

namespace app\models\queries\comments;

/**
 * This is the ActiveQuery class for [[\app\models\comments\Comments]].
 *
 * @see \app\models\comments\Comments
 */
class CommentsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\comments\Comments[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\comments\Comments|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
