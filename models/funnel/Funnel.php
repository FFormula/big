<?php

namespace app\models\funnel;

use Yii;
use yii\web\User;

/**
 * This is the model class for table "funnel".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 */
class Funnel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'funnel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }
}
