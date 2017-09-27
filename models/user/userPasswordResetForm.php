<?php

namespace app\models\user;
use app\models\common\ConfirmRecord;
use app\models\common\SendEmail;
use Yii;
use yii\base\Model;

class UserPasswordResetForm extends Model
{
    public $email;

    /** @var UserRecord */
    private $userRecord;

    const RESET_EMAIL = 'reset.email';

    public function rules () : array
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'errorIfEmailNotFound']
        ];
    }

    public function attributeLabels() : array
    {
        return [
            'email' => Yii::t('app', 'E-mail:')
        ];
    }

    public function errorIfEmailNotFound()
    {
        if ($this->hasErrors()) return;
        $this->userRecord = UserRecord::findByEmail($this->email);
        if ($this->userRecord == null)
            $this->addError('email', 'This e-mail not found');
    }

    public function reset ()
    {
        $confirmRecord = ConfirmRecord::create(UserPasswordResetForm::RESET_EMAIL,
            $this->email,'/user/password-new');
        $sendEmail = new SendEmail();
        $sendEmail->sendConfirmLink($this->email, $confirmRecord->getConfirmLink());
    }

}