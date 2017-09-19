<?php

namespace app\models\user;
use Yii;
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

    public static function existsNickname($nickname)
    {
        return static::find()->where(['nickname' => $nickname])->count() > 0;
    }

    public function setUserRegisterForm(UserRegisterForm $userRegisterForm)
    {
        $this->email = $userRegisterForm->email;
        $this->nickname = $userRegisterForm->nickname;
        $this->setPassword ($userRegisterForm->password);
    }

    public function setPassword($password)
    {
        $this->passhash = Yii::$app->security->generatePasswordHash($password);
        $this->authokey = Yii::$app->security->generateRandomString(32);
    }

}

?>