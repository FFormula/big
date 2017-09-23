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
    if (Yii::$app->user->isGuest)
        $items = [
            ['label' => Yii::t('app', 'About'),
               'url' => ['/site/about']],
            ['label' => Yii::t('app', 'Login'),
               'url' => ['user/login']],
            ['label' => Yii::t('app','Sign up'),
               'url' => ['user/signup']]
        ];
    else
        $items = [
            ['label' => Yii::t('app', 'Profile'),
                'url' => ['/user/profile']],
            ['label' => Yii::t('app', 'Settings'),
                'url' => ['user/settings']],
            ['label' => Yii::t('app','Logout'),
                'url' => ['user/logout']]
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
                <?= (Yii::$app->language == 'en') ?
                        '<b>English</b>'
                    :
                        Html::a('English', array_merge(
                         Yii::$app->request->get(),
                        [Yii::$app->controller->route, 'language' => 'en'])) ?>
                |
                <?= (Yii::$app->language == 'ru') ?
                    '<b>Русский</b>'
                    :
                    Html::a('Русский', array_merge(
                        Yii::$app->request->get(),
                        [Yii::$app->controller->route, 'language' => 'ru'])) ?>
                |
                <?= (Yii::$app->language == 'lt') ?
                        '<b>Lietuviu</b>'
                    :
                        Html::a('Lietuviu', array_merge(
                         Yii::$app->request->get(),
                        [Yii::$app->controller->route, 'language' => 'lt'])) ?>
            </p>
        </div>
    </footer>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>