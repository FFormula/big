<?php

namespace app\controllers;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'captcha' => 'yii\captcha\CaptchaAction'
        ];
    }

    public function actionIndex ()
    {
        return $this->render('index');
    }

    public function actionAbout ()
    {
        return $this->render('about');
    }
}