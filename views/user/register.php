<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h1 class="panel-title"><?= Yii::t('app', 'Register') ?></h1>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'id' => 'user-register-form'
        ]); ?>
        <div class="form-group">
            <?= $form->field($userRegisterForm, 'email')
                     ->input('text', ['readonly' => 1]) ?>
            <?= $form->field($userRegisterForm, 'nickname') ?>
            <?= $form->field($userRegisterForm, 'password') ?>
            <?= Html::submitButton(Yii::t('app', 'Next'),
                ['class' => 'btn btn-danger']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>