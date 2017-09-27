<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h1 class="panel-title"><?= Yii::t('app', 'Reset password') ?></h1>
    </div>
    <div class="panel-body">
        <?= Yii::t('app', 'Password changed. You can use it for login') ?>
        <big>
            <?= Html::a(Yii::t('app', 'Go to login page'), '/user/login'); ?>
        </big>
    </div>
</div>