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

    public static function create ($param, $value, $urlCorrect, $urlInvalid)
    {
        $confirmRecord = new ConfirmRecord();
        $confirmRecord->param = $param;
        $confirmRecord->value = $value; // todo: check (param,value) for unique and drop old
        $confirmRecord->url_correct = $urlCorrect;
        $confirmRecord->url_invalid = $urlInvalid;
        $confirmRecord->code = Yii::$app->security->generateRandomString(32);
        $confirmRecord->insert_date = time();
        $confirmRecord->save();
        return $confirmRecord;
    }

    public function checkCode ()
    {

    }
}