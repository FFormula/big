<?php

namespace app\models\profile;
use yii\base\Model;

class ProfileEditForm extends Model
{
    public $user_id;
    public $first_name;
    public $last_name;
    public $birthdate;
    public $gender;
    public $country;
    public $city;

    public function rules ()
    {
        return [

        ];
    }

    public function attributeLabels()
    {
        return [

        ];
    }
}