<?php

namespace app\models\common;
use yii;

class Email
{

    public static function sendRegisterEmail($email, $nickname)
    {
        $subject = Yii::t('mail', 'You succesfully registered!');
        $textBody = Yii::t('mail',
            'Hello, {nickname}! Thank you for register',
            compact('nickname'));
        Yii::$app->mailer->compose()
            ->setTo($email)
            ->setSubject($subject)
            ->setTextBody($textBody)
            ->send();
    }

    public static function sendConfirmLink ($email, $link)
    {
        $subject = Yii::t('mail', 'Confirm your action');
        $textBody = Yii::t(
            'mail',
            'Press this link to confirm your action: {link}',
            ['link' => $link]);

        Yii::$app->mailer->compose()
            ->setTo($email)
            ->setSubject($subject)
            ->setTextBody($textBody)
            ->send();
    }
}