<?php

namespace app\models\user;
use Yii;
use yii\base\Model;

class UserPasswordNewForm extends Model
{
    public $newPassword;

    public function rules ()
    {
        return [
            ['newPassword', 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'newPassword' => Yii::t('app', 'New password:')
        ];
    }
}