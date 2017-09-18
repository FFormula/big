<?php

namespace app\models\user;
use Yii;
use yii\base\Model;

class UserSignupForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'errorIfNotUsed']
        ];
    }

    public function errorIfNotUsed()
    {
        if ($this->hasErrors()) return;
        if (UserRecord::existsEmail($this->email))
            $this->addError('email', Yii::t('app', 'This e-mail already registered'));
    }
}