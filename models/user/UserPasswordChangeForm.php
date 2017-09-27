<?php

namespace app\models\user;
use Yii;
use yii\base\Model;

class UserPasswordChangeForm extends Model
{
    public $oldPassword;
    public $newPassword;

    /** @UserRecord */
    private $userRecord;

    public function rules () : array
    {
        return [
            [['oldPassword', 'newPassword'], 'required'],
            ['newPassword', 'string', 'min' => 4, 'max' => 50],
            ['oldPassword', 'errorIfPasswordWrong']
        ];
    }

    public function attributeLabels() : array
    {
        return [
            'oldPassword' => Yii::t('app', 'Your current password:'),
            'newPassword' => Yii::t('app', 'Enter new password:')
        ];
    }

    public function errorIfPasswordWrong()
    {
        if ($this->hasErrors()) return;
        $this->userRecord = Yii::$app->user->getIdentity();
        if ($this->userRecord == null) {
            $this->addError('oldPassword', 'Please re-login');
            return;
        }
        if (!$this->userRecord->validatePassword ($this->oldPassword))
            $this->addError('oldPassword', 'Password incorrect');
    }

    public function changePassword()
    {
        if ($this->hasErrors()) return;
        $this->userRecord->setPassword($this->newPassword);
        $this->userRecord->save();
    }

}