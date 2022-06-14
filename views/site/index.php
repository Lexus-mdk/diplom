<?php

/** @var yii\web\View $this */

use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;


$dataProvider = new ActiveDataProvider([
    'query' => $model::find()->where(['moderation'=>1])->orderBy('like desc')->limit(3),
    'pagination' => [
        'pageSize' => 3,
    ],
]);

$this->title = 'Студенческие проекты';
?>
    <div class="row align-items-center flex-column justify-content-center" style="background-image: url(../img/header-bg.jpg); color: white; height: 400px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <h6>Реализуй свой проект вместе с нами!</h6>
    <? if (Yii::$app->user->isGuest): ?>
    <?= Html::a('Войти на сайт', ['login'], ['class'=> 'btn btn-primary', 'data-pjax'=>0]);?>
    <?= Html::a('Регистрация', ['registration'], ['class'=> 'btn btn-success', 'data-pjax'=>0]);?>
    <? endif;?>
    </div>
    <h2 class="row justify-content-center pt-2 pb-2">Больше всего оценок на сегодня</h2>
<?
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_project-view',
    'itemOptions' => ['class' => 'card col-lg-4',
    'tag' => 'div',
    ],
    'summary' => 'Показаны записи <strong>{begin}-{end}</strong> из <strong>{totalCount}</strong>.',
    'layout' => '<div class="card-deck">{items}</div>',
    'pager' => ['class' => \yii\bootstrap4\LinkPager::class],
]);
?>
