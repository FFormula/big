<?php

namespace app\models\user;
use app\models\common\ConfirmRecord;
use Yii;
use yii\base\Model;

class UserPasswordNewForm extends Model
{
    public $email;
    public $newPassword;

    /** @var UserRecord */
    private $userRecord;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->email = Yii::$app->session->get(UserPasswordResetForm::RESET_EMAIL);
    }

    public function rules ()
    {
        return [
            [['email', 'newPassword'], 'required'],
            ['password', 'string', 'min' => 3, 'max' => 50],
            ['email', 'errorIfEmailNoSession'],
            ['email', 'errorIfEmailNotFound']
        ];
    }

    public function attributeLabels()
    {
        return [
            'newPassword' => Yii::t('app', 'New password:')
        ];
    }

    public function errorIfEmailNoSession()
    {
        if ($this->hasErrors()) return;
        if ($this->email != Yii::$app->session->get(UserPasswordResetForm::RESET_EMAIL))
            $this->addError('email',
                Yii::t('app', 'E-mail must be filled on signup page'));
    }

    public function errorIfEmailNotFound()
    {
        if ($this->hasErrors()) return;
        $this->userRecord = UserRecord::findByEmail($this->email);
        if ($this->userRecord == null)
            $this->addError('email', 'This e-mail not found');
    }

    public function setNewPassword ()
    {
        if ($this->hasErrors()) return;
        $this->userRecord->setPassword($this->newPassword);
        $this->userRecord->save();
        ConfirmRecord::clear(UserPasswordResetForm::RESET_EMAIL);
    }


}