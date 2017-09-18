<?php

namespace app\controllers;
use app\models\common\ConfirmRecord;
use yii\web\Controller;

class ConfirmController extends Controller
{
    public function actionIndex($code = "")
    {
        if ($code == "")
            return $this->redirect('/');
        $redirect = ConfirmRecord::check ($code);
        return $this->redirect($redirect);
    }

    public function actionError ()
    {
        return $this->render('error');
    }
}