<?php

namespace app\models\user;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property string $user_id
 * @property string $user_name
 * @property string $email
 * @property string $phone
 * @property string $pass_hash
 * @property int $role
 *
 * @property Comments[] $comments
 */
class User extends ActiveRecord implements IdentityInterface
{
    const ROLE_ADMIN = 20;
    const ROLE_USER = 10;
    public function setPassword($password)
    {
        $this->pass_hash = sha1($password);
    }

    public function validatePassword($password)
    {
        return $this->pass_hash === sha1($password);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['role', 'in', 'range' => [self::ROLE_USER, self::ROLE_ADMIN]],
            [['user_name', 'email', 'phone', 'pass_hash'], 'required'],
            [['role'], 'integer'],
            [['user_name'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 30],
            [['pass_hash'], 'string', 'max' => 100],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'pass_hash' => 'Pass Hash',
            'role' => 'Role',
        ];
    }

    public static function isUserAdmin($email)
    {
        if (static::findOne(['email' => $email, 'role' => self::ROLE_ADMIN])) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['user_id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\users\UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\users\UsersQuery(get_called_class());
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public function getId()
    {
        return $this->user_id;
    }

    public function getStatusName()
    {
        return $this->role;
    }

    public static function getStatusesArray()
    {
        return [ 0,10, 20 ];
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    public function getAuthKey()
    {
    }

    public function validateAuthKey($authKey)
    {

    }
}