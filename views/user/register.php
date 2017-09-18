<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h1 class="panel-title"><?= Yii::t('app', 'Complete Registration') ?></h1>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'id' => 'user-register-form'
        ]); ?>
        <div class="form-group">

        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>