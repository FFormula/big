<?php

namespace app\models\user;
use app\models\common\ConfirmRecord;
use app\models\common\SendEmail;
use Yii;
use yii\base\Model;

class UserSignupForm extends Model
{
    public $email;
    const SIGNUP_EMAIL = 'signup.email';

    public function rules() : array
    {
        return [
            ['email', 'required',
                'message' => Yii::t('app', '{attribute} must be filled')],
            ['email', 'email',
                'message' => Yii::t('app', 'Invalid e-mail address')],
            ['email', 'errorIfEmailUsed']
        ];
    }

    public function attributeLabels() : array
    {
        return [
            'email' => Yii::t('app', 'E-mail:'),
        ];
    }

    public function errorIfEmailUsed()
    {
        if ($this->hasErrors()) return;
        if (User::existsEmail($this->email))
            $this->addError('email',
                Yii::t('app', 'This e-mail already registered'));
    }

    public function signup()
    {
        if (!$this->validate()) return false;
        $confirmRecord = ConfirmRecord::create(UserSignupForm::SIGNUP_EMAIL,
            $this->email,'/user/register');
        $sendEmail = new SendEmail();
        $sendEmail->sendConfirmLink($this->email, $confirmRecord->getConfirmLink());
        return true;
    }



}