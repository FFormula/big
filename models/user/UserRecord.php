<?php

namespace app\models\user;
use yii\db\ActiveRecord;

class UserRecord extends ActiveRecord
{
    public static function tableName()
    {
        return "user";
    }

    public static function existsEmail ($email)
    {
        return static::find()->where(['email' => $email])->count() > 0;
    }

}

?>