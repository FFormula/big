<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h1 class="panel-title"><?= Yii::t('app', 'Sign up') ?></h1>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'id' => 'user-signup-form'
        ]); ?>
        <div class="form-group">
            <?= $form->field($userLoginForm, 'email') ?>
            <?= $form->field($userLoginForm, 'password')->passwordInput() ?>
            <?= $form->field($userLoginForm, 'remember')->checkbox() ?>
            <?= Html::submitButton(Yii::t('app', 'Next'),
                ['class' => 'btn btn-danger']) ?>
        </div>
        <?= Html::a(Yii::t('app', 'Reset password'), '/user/password-reset') ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>