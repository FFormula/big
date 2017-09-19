<?php

namespace app\models\user;


use Yii;
use yii\base\Model;

class UserRegisterForm extends Model
{
    public $email;
    public $nickname;
    public $password;

    public function rules()
    {
        return [
            [['nickname', 'password'], 'required'],
            ['nickname', 'string', 'min' => 3, 'max' => 20],
            ['password', 'string', 'min' => 3, 'max' => 50],
            ['nickname', 'errorIfNicknameUsed']
        ];
    }

    public function attributeLabels()
    {
        return [
            'nickname' => Yii::t('app', 'Your Nickname:'),
            'password' => Yii::t('app', 'Choose password:')
        ];
    }

    public function errorIfNicknameUsed()
    {
        if ($this->hasErrors()) return;
        if (UserRecord::existsNickname($this->nickname))
            $this->addError('nickname',
                Yii::t('app', 'This Nickname already taken, choose another one.'));
    }
}