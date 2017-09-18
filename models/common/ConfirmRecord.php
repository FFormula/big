<?php

namespace app\models\common;
use Yii;
use yii\db\ActiveRecord;

class ConfirmRecord extends ActiveRecord
{
    public static function tableName()
    {
        return 'confirm';
    }

    public static function create ($param, $value, $redirect)
    {
        $confirmRecord = new ConfirmRecord();
        $confirmRecord->code = Yii::$app->security->generateRandomString(32);
        $confirmRecord->param = $param;
        $confirmRecord->value = $value; // todo: check (param,value) for unique and drop old
        $confirmRecord->redirect = $redirect;
        $confirmRecord->insert_date = time();
        $confirmRecord->save();
        return $confirmRecord;
    }

    public static function check ($code)
    {
        $confirmRecord = static::findOne(['code' => $code]);
        if ($confirmRecord == null)
            return '/confirm/error';
        Yii::$app->session->set($confirmRecord->param, $confirmRecord->value);
        $redirect = $confirmRecord->redirect;
        $confirmRecord->delete();
        return $redirect;
    }
}