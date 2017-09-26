<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h1 class="panel-title"><?= Yii::t('app', 'Reset password') ?></h1>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'id' => 'user-password-new-form'
        ]); ?>
        <div class="form-group">
            <?= $form->field($userPasswordNewForm, 'newPassword') ?>
            <?= Html::submitButton(Yii::t('app', 'Set new password'),
                ['class' => 'btn btn-danger']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>