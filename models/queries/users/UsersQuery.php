<?php

namespace app\models\queries\users;

/**
 * This is the ActiveQuery class for [[\app\models\user\Users]].
 *
 * @see \app\models\user\Users
 */
class UsersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\user\Users[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\user\Users|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
