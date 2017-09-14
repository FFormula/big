<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\VarDumper;

$this->beginPage();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>VideoSchool</title>
        <?php $this->head() ?>

    </head>
    <body>
    <?php $this->beginBody() ?>
<?php
    NavBar::begin([
        'brandLabel' => 'VideoSchool',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top'
        ]
    ]);
    NavBar::end();
?>
    <div class="container" style="margin-top: 80px">
        <?= $content ?>
        <?php $this->endBody() ?>
    </div>

    </body>
</html>
<?php $this->endPage() ?>