<?php

namespace app\controllers;
use app\models\UserSignupForm;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionSignup()
    {
        $userSignupForm = new UserSignupForm();
        return $this->render('signup', compact('userSignupForm'));
    }

    public function actionLogin()
    {
        return $this->render('login');
    }
}