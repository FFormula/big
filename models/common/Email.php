<?php

namespace app\models\common;
use yii;

class Email
{
    private $email;
    private $subject;
    private $textBody;

    private function send ()
    {
        Yii::beginProfile('email');
        Yii::$app->mailer->compose()
            ->setTo($this->email)
            ->setSubject($this->subject)
            ->setTextBody($this->textBody)
            ->send();
        Yii::endProfile('email');
    }

    public function sendRegisterEmail(string $email, string $nickname)
    {
        $this->email = $email;
        $this->subject = Yii::t('mail', 'You succesfully registered!');
        $this->textBody = Yii::t('mail',
            'Hello, {nickname}! Thank you for register',
            compact('nickname'));
        $this->send();
    }

    public function sendConfirmLink (string $email, string $link)
    {
        $this->email = $email;
        $this->subject = Yii::t('mail', 'Confirm your action');
        $this->textBody = Yii::t(
            'mail',
            'Press this link to confirm your action: {link}',
            ['link' => $link]);
        $this->send();
    }
}