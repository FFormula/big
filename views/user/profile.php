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
            'id' => 'profile-edit-form'
        ]); ?>
        <div class="form-group">
            <?= $form->field($profileEditForm, 'first_name') ?>
            <?= $form->field($profileEditForm, 'last_name') ?>
            <?= $form->field($profileEditForm, 'birthday') ?>
            <?= $form->field($profileEditForm, 'gender') ?>
            <?= $form->field($profileEditForm, 'country') ?>
            <?= $form->field($profileEditForm, 'city') ?>
            <?= Html::submitButton(Yii::t('app', 'Save'),
                ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>