<?php

namespace app\controllers;
use app\models\user\UserSignupForm;
use Yii;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionSignup()
    {
        if (Yii::$app->request->isPost)
            return $this->actionSignupPost();
        $userSignupForm = new UserSignupForm();
        return $this->render('signup', compact('userSignupForm'));
    }

    public function actionSignupPost()
    {
        $userSignupForm = new UserSignupForm();
        if ($userSignupForm->load(Yii::$app->request->post()))
            if ($userSignupForm->validate())
            {
                return;
            }
        return $this->render('signup', compact('userSignupForm'));
    }

    public function actionLogin()
    {
        return $this->render('login');
    }
}