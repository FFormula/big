<?php

namespace app\models\user;
use Yii;
use yii\base\Model;

class UserLoginForm extends Model
{
    public $email;
    public $password;
    public $remember;

    /** @User */
    private $_user = null;

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

    public function errorIfEmailNotFound(string $attr)
    {
        if ($this->hasErrors()) return;
        if ($this->getUser())
            return;
        $this->addError($attr, 'This e-mail not found');
    }

    public function errorIfPasswordWrong(string $attr)
    {
        if ($this->hasErrors()) return;
        $user = $this->getUser();
        if ($user && $user->validatePassword ($this->password))
                return;
        $this->addError($attr, 'Password incorrect');
    }

    public function login()
    {
        if ($this->validate()) 
            return Yii::$app->user->login(
                $this->getUser(), $this->remember ? 3600 * 24 * 30 : 0);
        return false;
    }

    protected function getUser () : ?User
    {
        if ($this->_user === null)
            return $this->_user = User::findByEmail($this->email);
        return $this->_user;
    }
}