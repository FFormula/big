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
            ['email', 'required','message' => Yii::t('app', '{attribute} must be filled')],
            ['email', 'email', 'message' => Yii::t('app', 'Invalid e-mail address')],
            ['email', 'errorIfNotUsed']
        ];
    }

    public function errorIfNotUsed()
    {
        if ($this->hasErrors()) return;
        if (UserRecord::existsEmail($this->email))
            $this->addError('email', Yii::t('app', 'This e-mail already registered'));
    }

    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'E-mail:'),
        ];
    }

}