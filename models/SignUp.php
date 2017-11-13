<?php
namespace app\models;

use app\models\user\User;
use yii\base\Model;

class Signup extends Model
{
    public $email;
    public $password;
    public $user_name;
    public $phone;

    public function rules()
    {
        return [
            [['email','password', 'user_name'],'required'],
            ['email','email'],
            ['phone','string'],
            ['user_name', 'string', 'min'=>3, 'max'=>30],
            ['email','unique','targetClass'=>'app\models\user\User'],
            ['password','string','min'=>2,'max'=>30]
        ];
    }
    public function signup()
    {
        $user = new User();
        $user->user_name = htmlspecialchars(trim($this->user_name));
        $user->phone = htmlspecialchars(trim($this->phone));
        $user->email = htmlspecialchars(trim($this->email));
        $user->setPassword(htmlspecialchars(trim($this->password)));
        return $user->save(); //вернет true или false
    }
}