<?php

namespace app\controllers;
use app\models\user\UserLoginForm;
use app\models\user\UserPasswordChangeForm;
use app\models\user\UserPasswordNewForm;
use app\models\user\UserPasswordResetForm;
use app\models\user\UserRecord;
use app\models\user\UserRegisterForm;
use app\models\user\UserSignupForm;
use Yii;
use yii\base\Model;
use yii\web\Controller;

class UserController extends Controller
{
    private function loadPost (Model $modelForm)
    {
        if (Yii::$app->request->isPost)
            if ($modelForm->load(Yii::$app->request->post()))
                if ($modelForm->validate())
                    return true;
        return false;
    }

    public function actionSignup()
    {
        $userSignupForm = new UserSignupForm();
        if ($this->loadPost($userSignupForm))
        {
            $userSignupForm->signup();
            return $this->redirect('/user/signup-confirm');
        }
        return $this->render('signup', compact('userSignupForm'));
    }

    public function actionRegister()
    {
        $userRegisterForm = new UserRegisterForm();
        if (!$userRegisterForm->email)
            return $this->redirect('/user/signup');
        if ($this->loadPost($userRegisterForm))
        {
            $userRegisterForm->register();
            return $this->redirect('/user/login');
        }
        return $this->render('register', compact('userRegisterForm'));
    }

    public function actionSignupConfirm()
    {
        return $this->render('signup-confirm');
    }

    public function actionLogin()
    {
        $userLoginForm = new UserLoginForm();
        if ($this->loadPost($userLoginForm))
        {
            $userLoginForm->login();
            return $this->redirect('/user/index');
        }
        return $this->render('login', compact('userLoginForm'));
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogout()
    {
        UserRecord::logout();
        return $this->redirect('/');
    }

    public function actionPasswordChange()
    {
        $userPasswordChangeForm = new UserPasswordChangeForm();
        if ($this->loadPost($userPasswordChangeForm))
        {
            $userPasswordChangeForm->changePassword();
            return $this->redirect('/user/index');
        }
        return $this->render('password-change', compact('userPasswordChangeForm'));
    }

    public function actionPasswordReset()
    {
        $userPasswordResetForm = new UserPasswordResetForm ();
        if ($this->loadPost($userPasswordResetForm))
        {
            $userPasswordResetForm->reset();
            return $this->redirect('/user/password-new');
        }
        return $this->render('password-reset', compact('userPasswordResetForm'));
    }

    public function actionPasswordNew()
    {
        $userPasswordNewForm = new UserPasswordNewForm ();

        if (!$userPasswordNewForm->email)
            return $this->render('password-new-check-email');

        if ($this->loadPost($userPasswordNewForm))
        {
            $userPasswordNewForm->setNewPassword();
            return $this->render('/user/password-new-done');
        }

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