<?php
namespace app\models;

use app\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $displayname;
    public $phone;
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'phone'=> Yii::t('app', 'Số điện thoại'),
            'username' => Yii::t('app', 'Tên tài khoản'),
            'email' => Yii::t('app', 'Địa chỉ Email'),
            'password' => Yii::t('app', 'Mật khẩu'),
            'password_repeat' => Yii::t('app', 'Lặp lại mật khẩu của bạn một lần nữa'),
            'displayname'=> Yii::t('app', 'Tên của bạn(hoặc bút danh)'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => Yii::t('app','This username has already been taken.')],
            ['username', 'string', 'min' => 4, 'max' => 20],
            ['displayname','required'],
            ['phone','required'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => Yii::t('app','This email address has already been taken.')],

            [['password','password_repeat'], 'required'],
            [['password','password_repeat'], 'string', 'min' => 6],
            [['password'], 'in', 'range'=>['password','Password','Password123','123456','12345678','letmein','monkey'] ,'not'=>true, 'message'=>Yii::t('app', 'You cannot use any really obvious passwords')],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message' => Yii::t("app", "The passwords must match")],
        ];
    }
    
    

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->displayname = $this->displayname;
            $user->username = $this->username;
            $user->phone = $this->phone;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
           
            return $user;
        }

        return null;
    }
    
           
}
