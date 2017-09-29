<?php

namespace app\models\user;
use app\models\common\ConfirmRecord;
use Yii;
use yii\base\Model;

class UserPasswordNewForm extends Model
{
    public $newPassword;

    /** @var User */
    private $_user;

    public function rules () : array
    {
        return [
            ['newPassword', 'required'],
            ['newPassword', 'string', 'min' => 3, 'max' => 50],
            ['newPassword', 'errorIfUserNotFound']
        ];
    }

    public function attributeLabels() : array
    {
        return [
            'newPassword' => Yii::t('app', 'New password:')
        ];
    }

    public function errorIfUserNotFound($attr)
    {
        if ($this->hasErrors()) return;
        if ($this->getUser() == null)
            $this->addError($attr, 'Password cannot be changed - session expired');
    }

    public function setNewPassword ()
    {
        if (!$this->validate()) return false;
        $user = $this->getUser();
        $user->setPassword($this->newPassword);
        $user->save();
        ConfirmRecord::clear(UserPasswordResetForm::RESET_EMAIL);
        return true;
    }

    protected function getUser () : ?User
    {
        if ($this->_user === null) {
            $email = Yii::$app->session->get(UserPasswordResetForm::RESET_EMAIL);
            return $this->_user = User::findByEmail($email);
        }
        return $this->_user;
    }
}