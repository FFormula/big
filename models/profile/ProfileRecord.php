<?php

namespace app\models\profile;
use yii\db\ActiveRecord;

class ProfileRecord extends ActiveRecord
{
    public static function tableName()
    {
        return 'profile';
    }
}