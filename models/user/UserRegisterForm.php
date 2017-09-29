<?php

namespace app\models\user;
use app\models\common\ConfirmRecord;
use app\models\common\SendEmail;
use Yii;
use yii\base\Model;

class UserRegisterForm extends Model
{
    private $email;
    public $nickname;
    public $password;

    public function rules() : array
    {
        return [
            [['email', 'nickname', 'password'], 'required'],
            ['email', 'email'],
            ['nickname', 'string', 'min' => 3, 'max' => 20],
            ['password', 'string', 'min' => 3, 'max' => 50],
            ['email', 'errorIfEmailUsed'],
            ['nickname', 'errorIfNicknameUsed'],
        ];
    }

    public function attributeLabels() : array
    {
        return [
            'email' => Yii::t('app', 'E-mail:'),
            'nickname' => Yii::t('app', 'Your Nickname:'),
            'password' => Yii::t('app', 'Choose password:')
        ];
    }

    public function errorIfNicknameUsed($attr)
    {
        if ($this->hasErrors()) return;
        if (User::existsNickname($this->nickname))
            $this->addError($attr,
                Yii::t('app', 'This Nickname already taken, choose another one.'));
    }

    public function errorIfEmailUsed($attr)
    {
        if ($this->hasErrors()) return;
        if (User::existsEmail($this->getEmail()))
            $this->addError($attr,
                Yii::t('app', 'This e-mail already registered'));
    }

    public function register ()
    {
        if (!$this->validate()) return false;
        $user = new User();
        $user->setUserRegisterForm($this);
        $user->save();
        ConfirmRecord::clear(UserSignupForm::SIGNUP_EMAIL);
        $sendEmail = new SendEmail();
        $sendEmail->sendRegisterEmail($user->email, $user->nickname);
        return true;
    }

    public function setEmail()
    {

    }

    public function getEmail()
    {
        if ($this->email == null)
            return $this->email = Yii::$app->session->get(UserSignupForm::SIGNUP_EMAIL);
        return $this->email;
    }
}