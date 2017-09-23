<?php

namespace app\models\user;
use Yii;
use yii\base\Model;

class UserLoginForm extends Model
{
    public $email;
    public $password;
    public $remember;

    /** @UserRecord */
    private $userRecord;

    public function rules() : array
    {
        return [
            [['email', 'password'], 'required'],
            ['remember', 'boolean'],
            ['email', 'errorIfEmailNotFound'],
            ['password', 'errorIfPasswordWrong']
        ];
    }

    public function attributeLabels() : array
    {
        return [
            'email' => Yii::t('app', 'E-mail:'),
            'password' => Yii::t('app', 'Password:'),
            'remember' => Yii::t('app', 'Remember me')
        ];
    }

    public function errorIfEmailNotFound()
    {
        if ($this->hasErrors()) return;
        $this->userRecord = UserRecord::findByEmail($this->email);
        if ($this->userRecord == null)
            $this->addError('email', 'This e-mail not found');
    }

    public function errorIfPasswordWrong()
    {
        if ($this->hasErrors()) return;
        if (!$this->userRecord->validatePassword ($this->password))
            $this->addError('password', 'Password incorrect');
    }

    public function login()
    {
        if ($this->hasErrors()) return;
        $this->userRecord->login($this->remember ? 3600 * 24 * 30 : 0);
    }
}