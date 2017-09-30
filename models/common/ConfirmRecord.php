<?php

namespace app\models\common;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * Class ConfirmRecord
 * @package app\models\common
 * @property string $param
 * @property string $value
 * @property string $code
 * @property string $redirect
 * @property int $insert_date
 */
class ConfirmRecord extends ActiveRecord
{
    const TESTER_CONFIRM_CODE = '0123456789ABCDEF0123456789ABCDEF';

    public static function tableName() : string
    {
        return 'confirm';
    }

    public static function create (string $param, string $value, string $redirect)
    {
        static::deleteAll(['param' => $param, 'value' => $value]);
        $confirmRecord = new ConfirmRecord();
        if (strpos ($value, 'tester_') === 0) // Yii::$app->params['tester_suffix']) === 0)
            $confirmRecord->code = static::TESTER_CONFIRM_CODE;
        else
            $confirmRecord->code = Yii::$app->security->generateRandomString(32);
        $confirmRecord->param = $param;
        $confirmRecord->value = $value;
        $confirmRecord->redirect = $redirect;
        $confirmRecord->insert_date = time();
        $confirmRecord->save();
        return $confirmRecord;
    }

    public static function check (string $code) : string
    {
        $confirmRecord = static::findOne(['code' => $code]);
        if ($confirmRecord == null)
            return '/confirm/error';
        Yii::$app->session->set($confirmRecord->param, $confirmRecord->value);
        $redirect = $confirmRecord->redirect;
        $confirmRecord->delete();
        return $redirect;
    }

    public function getConfirmLink () : string
    {
        return Url::to(['/confirm', 'code' => $this->code],true);
    }

    public static function clear (string $param)
    {
        Yii::$app->session->remove($param);
    }
}