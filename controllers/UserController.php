<?php

namespace app\controllers;
use app\models\user\UserLoginForm;
use app\models\user\UserPasswordChangeForm;
use app\models\user\UserPasswordNewForm;
use app\models\user\UserPasswordResetForm;
use app\models\user\User;
use app\models\user\UserRegisterForm;
use app\models\user\UserSignupForm;
use Yii;
use yii\base\Model;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionSignup()
    {
        $userSignupForm = new UserSignupForm();
        if ($userSignupForm->load(Yii::$app->request->post()))
            if ($userSignupForm->signup())
                return $this->redirect('/user/signup-confirm');
        return $this->render('signup', compact('userSignupForm'));
    }

    public function actionRegister()
    {
        $userRegisterForm = new UserRegisterForm();
        if ($userRegisterForm->load(Yii::$app->request->post()))
            if ($userRegisterForm->register())
                return $this->redirect('/user/login?email=' . $userRegisterForm->getEmail());
        return $this->render('register', compact('userRegisterForm'));
    }

    public function actionSignupConfirm()
    {
        return $this->render('signup-confirm');
    }

    public function actionLogin(string $email = '')
    {
        $userLoginForm = new UserLoginForm();
        $userLoginForm->email = $email;
        if ($userLoginForm->load(Yii::$app->request->post()))
        	if ($userLoginForm->login())
            	return $this->redirect('/user/index');
        return $this->render('login', compact('userLoginForm'));
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogout()
    {
        User::logout();
        return $this->redirect('/');
    }

    public function actionPasswordChange()
    {
        $userPasswordChangeForm = new UserPasswordChangeForm();
        if ($userPasswordChangeForm->load(Yii::$app->request->post()))
            if ($userPasswordChangeForm->changePassword())
                return $this->redirect('/user/index');
        return $this->render('password-change', compact('userPasswordChangeForm'));
    }

    public function actionPasswordReset()
    {
        $userPasswordResetForm = new UserPasswordResetForm ();
        if ($userPasswordResetForm->load(Yii::$app->request->post()))
            if ($userPasswordResetForm->sendResetLink())
                return $this->redirect('/user/password-new-check-email');
        return $this->render('password-reset', compact('userPasswordResetForm'));
    }

    public function actionPasswordNew()
    {
        $userPasswordNewForm = new UserPasswordNewForm ();
        if ($userPasswordNewForm->load(Yii::$app->request->post()))
            if ($userPasswordNewForm->setNewPassword())
                return $this->render('/user/password-new-done');
        return $this->render('password-new', compact('userPasswordNewForm'));
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