<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\ButtonDropdown;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Проекты', 'url' => ['/projects/index']],
            // ['label' => 'Конкурсы', 'url' => ['/site/contact']],
            // ['label' => 'Работа', 'url' => ['/site/contact']],
            ('<div class="dropdown btn-group"><button id="w1-button" class="btn nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">О нас</button>

            <div id="w2" class="dropdown-menu"><a class="dropdown-item" href="/site/about">О проекте</a>
            <a class="dropdown-item" href="/site/contact">Контакты</a></div></div>'),
            // (ButtonDropdown::widget([
            //     'label' => 'О сайте',
                
            //     'dropdown' => [
            //         'items' => [
            //             ['label' => 'О проекте', 'url' => ['/site/about']],
            //             ['label' => 'Контакты', 'url' => ['/site/contact']]
            //         ],
            //     ],
            // ])),
            Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
            Yii::$app->user->isGuest ? (
                ['label' => 'Регистрация', 'url' => ['/site/registration']]
            ) : (['label' => 'Личный кабинет', 'url' => ['/user/profile', 'login' => Yii::$app->user->identity->username]])
        ],
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; Студенческие проекты <?= date('Y') ?></p>
        <p class="float-right"><?= '' ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
