<?php

namespace app\models\user;
use app\models\common\ConfirmRecord;
use app\models\common\Email;
use Yii;
use yii\base\Model;

class UserSignupForm extends Model
{
    public $email;
    const SIGNUP_EMAIL = 'signup.email';

    public function rules() : array
    {
        return [
            ['email', 'required','message' => Yii::t('app', '{attribute} must be filled')],
            ['email', 'email', 'message' => Yii::t('app', 'Invalid e-mail address')],
            ['email', 'errorIfEmailUsed']
        ];
    }

    public function errorIfEmailUsed()
    {
        if ($this->hasErrors()) return;
        if (UserRecord::existsEmail($this->email))
            $this->addError('email', Yii::t('app', 'This e-mail already registered'));
    }

    public function attributeLabels() : array

    {
        return [
            'email' => Yii::t('app', 'E-mail:'),
        ];
    }

    public function signup()
    {
        $confirmRecord = ConfirmRecord::create(UserSignupForm::SIGNUP_EMAIL,
            $this->email,'/user/register');
        $email = new Email();
        $email->sendConfirmLink($this->email, $confirmRecord->getConfirmLink());
    }

}