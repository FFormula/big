<?php

namespace app\models\user;
use Yii;
use yii\db\ActiveRecord;

class UserRecord extends ActiveRecord
{
    public static function tableName() : string
    {
        return "user";
    }

    public static function existsEmail (string $email) : bool
    {
        return static::find()->where(['email' => $email])->count() > 0;
    }

    public static function existsNickname(string $nickname) : bool
    {
        return static::find()->where(['nickname' => $nickname])->count() > 0;
    }

    public static function findByEmail(string $email) : ?UserRecord
    {
        return static::findOne(['email' => $email]);
    }

    public function setUserRegisterForm(UserRegisterForm $userRegisterForm)
    {
        $this->email = $userRegisterForm->email;
        $this->nickname = $userRegisterForm->nickname;
        $this->setPassword ($userRegisterForm->password);
    }

    public function setPassword(string $password)
    {
        $this->passhash = Yii::$app->security->generatePasswordHash($password);
        $this->authokey = Yii::$app->security->generateRandomString(32);
    }

    public function validatePassword(string $password) : bool
    {
        return Yii::$app->security->validatePassword($password, $this->passhash);
    }

}

?>