<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\funnel\Funnel */

$this->title = Yii::t('app', 'Create Funnel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Funnels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funnel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
