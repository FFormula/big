<?php

namespace app\controllers;
use app\models\common\ConfirmRecord;
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
                ConfirmRecord::create(
                    'signup.email',
                    $userSignupForm->email,
                    '/user/register');
                return $this->redirect('/user/signup-confirm');
            }
        return $this->render('signup', compact('userSignupForm'));
    }

    public function actionRegister ()
    {
        return $this->render('register');
    }

    public function actionSignupConfirm ()
    {
        return $this->render('signup-confirm');
    }

    public function actionLogin()
    {
        return $this->render('login');
    }
}