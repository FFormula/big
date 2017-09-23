<?php

namespace app\models\user;


use app\models\common\Email;
use Yii;
use yii\base\Model;

class UserRegisterForm extends Model
{
    public $email;
    public $nickname;
    public $password;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->email = Yii::$app->session->get(UserSignupForm::SIGNUP_EMAIL);
    }

    public function rules() : array
    {
        return [
            [['email', 'nickname', 'password'], 'required'],
            ['email', 'email'],
            ['nickname', 'string', 'min' => 3, 'max' => 20],
            ['password', 'string', 'min' => 3, 'max' => 50],
            ['nickname', 'errorIfNicknameUsed'],
            ['email', 'errorIfEmailNoSession'],
            ['email', 'errorIfEmailUsed']
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

    public function errorIfNicknameUsed()
    {
        if ($this->hasErrors()) return;
        if (UserRecord::existsNickname($this->nickname))
            $this->addError('nickname',
                Yii::t('app', 'This Nickname already taken, choose another one.'));
    }

    public function errorIfEmailNoSession()
    {
        if ($this->hasErrors()) return;
        if ($this->email != Yii::$app->session->get(UserSignupForm::SIGNUP_EMAIL))
            $this->addError('email', 'E-mail must be filled on signup page');
    }

    public function errorIfEmailUsed()
    {
        if ($this->hasErrors()) return;
        if (UserRecord::existsEmail($this->email))
            $this->addError('email', Yii::t('app', 'This e-mail already registered'));
    }

    public function register ()
    {
        $userRecord = new UserRecord();
        $userRecord->setUserRegisterForm($this);
        $userRecord->save();
        Yii::$app->session->remove(UserSignupForm::SIGNUP_EMAIL);
        $email = new Email();
        $email->sendRegisterEmail($userRecord->email, $userRecord->nickname);
    }
}