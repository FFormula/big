<?php

namespace app\models\user;
use Yii;
use yii\base\Model;

class UserPasswordChangeForm extends Model
{
    public $oldPassword;
    public $newPassword;

    /** @User */
    private $_user = null;

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

    public function errorIfPasswordWrong($attr)
    {
        if ($this->hasErrors()) return;
        /** @var User $user */
        $user = $this->getUser();
        if ($user == null)
            $this->addError($attr, 'Please re-login');
        else
        if ($user->validatePassword ($this->oldPassword))
            $this->addError($attr, 'Password incorrect');
    }

    public function changePassword()
    {
        if (!$this->validate()) return false;
        /** @var User $user */
        $user = $this->getUser();
        $user->setPassword($this->newPassword);
        $user->save();
        return true;
    }

    protected function getUser()
    {
        if ($this->_user === null)
            return $this->_user = Yii::$app->user->getIdentity();
        return $this->_user;
    }

}