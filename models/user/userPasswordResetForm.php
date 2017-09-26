<?php

namespace app\models\user;
use Yii;
use yii\base\Model;

class UserPasswordResetForm extends Model
{
    public $email;

    public function rules ()
    {
        return [
            ['email', 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'E-mail:')
        ];
    }
}