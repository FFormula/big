<?php

namespace app\models;
use yii\base\Model;

class UserSignupForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'errorIfNotUsed']
        ];
    }

    public function errorIfNotUsed()
    {

    }
}