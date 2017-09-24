<?php

namespace app\controllers;
use app\models\common\ConfirmRecord;
use app\models\user\UserLoginForm;
use app\models\user\UserPasswordChangeForm;
use app\models\user\UserRecord;
use app\models\user\UserRegisterForm;
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
                $userSignupForm->signup();
                return $this->redirect('/user/signup-confirm');
            }
        return $this->render('signup', compact('userSignupForm'));
    }

    public function actionRegister ()
    {
        if (Yii::$app->request->isPost)
            return $this->actionRegisterPost();
        $userRegisterForm = new UserRegisterForm();
        if (!$userRegisterForm->email)
            return $this->redirect('/user/signup');
        return $this->render('register', compact('userRegisterForm'));
    }

    public function actionRegisterPost()
    {
        $userRegisterForm = new UserRegisterForm();

        if ($userRegisterForm->load(Yii::$app->request->post()))
            if ($userRegisterForm->validate()) {
                $userRegisterForm->register();
                $this->redirect('/user/login');
            }
        return $this->render('register', compact('userRegisterForm'));
    }

    public function actionSignupConfirm ()
    {
        return $this->render('signup-confirm');
    }

    public function actionLogin()
    {
        if (Yii::$app->request->isPost)
            return $this->actionLoginPost();
        $userLoginForm = new UserLoginForm();
        return $this->render('login', compact('userLoginForm'));
    }

    public function actionLoginPost()
    {
        $userLoginForm = new UserLoginForm();
        if ($userLoginForm->load(Yii::$app->request->post()))
            if ($userLoginForm->validate())
            {
                $userLoginForm->login();
                $this->redirect('/user/index');
            }
        return $this->render('login', compact('userLoginForm'));
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogout()
    {
        $userRecord = Yii::$app->user->getIdentity();
        if ($userRecord != null)
            $userRecord->logout();
        return $this->redirect('/');
    }

    public function actionPasswordChange()
    {
        if (Yii::$app->request->isPost)
            return $this->actionPasswordChangePost();
        $userPasswordChangeForm = new UserPasswordChangeForm();
        return $this->render('password-change', compact('userPasswordChangeForm'));
    }

    public function actionPasswordChangePost()
    {
        $userPasswordChangeForm = new UserPasswordChangeForm();
        if ($userPasswordChangeForm->load(Yii::$app->request->post()))
            if ($userPasswordChangeForm->validate())
            {
                $userPasswordChangeForm->changePassword();
                return $this->redirect('/user/index');
            }
        //$userPasswordChangeForm->oldPassword = '';
        //$userPasswordChangeForm->newPassword = '';
        return $this->render('password-change', compact('userPasswordChangeForm'));
    }

    public function actionProfile()
    {
        return $this->render('profile');
    }

    public function actionSettings()
    {
        return $this->render('settings');
    }
}