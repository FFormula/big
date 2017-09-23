<?php

namespace app\models\user;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class UserRecord extends ActiveRecord implements IdentityInterface
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

    public function login($duration = 0)
    {
        Yii::$app->user->login($this, $duration);
    }

    public function logout()
    {
        Yii::$app->user->logout();
    }

    // interface methods
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getAuthKey() : string
    {
        return $this->authokey;
    }

    public function validateAuthKey($authKey) : bool
    {
        return $this->getAuthKey() == $authKey;
    }

}

?>