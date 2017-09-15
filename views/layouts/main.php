<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\bootstrap\Html;
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
        'brandLabel' => Yii::t('app', 'VideoSchool'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top'
        ]
    ]);
    $items = [
        ['label' => Yii::t('app', 'About'),
         'url' => ['/site/about']]
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items
    ]);
    NavBar::end();
?>
    <div class="container" style="margin-top: 80px">
        <?= $content ?>
    </div>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right">
                <?= (\Yii::$app->language == 'en') ?
                        '<b>English</b>'
                    :
                        Html::a('English', array_merge(
                         Yii::$app->request->get(),
                        [Yii::$app->controller->route, 'language' => 'en'])) ?>
                |
                <?= (\Yii::$app->language == 'ru') ?
                        '<b>Русский</b>'
                    :
                        Html::a('Русский', array_merge(
                         Yii::$app->request->get(),
                        [Yii::$app->controller->route, 'language' => 'ru'])) ?>
            </p>
        </div>
    </footer>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>