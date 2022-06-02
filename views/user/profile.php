<?php
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
$dataProvider = new ActiveDataProvider([
    'query' => $model->getProjects(),
    'pagination' => [
        'pageSize' => 3,
    ],
]);

if (Yii::$app->user->isGuest):
?>
<h1>Чтобы увидеть информацию об этом пользователе, необходимо авторизироваться на сайте!</h1>
<? else: ?>
<p>
<h1><?= $model->name?> <?=$model->patronymic?> <?=$model->surename ?></h1>
Логин: <?= $model->username ?><br>
<!-- Почта: <?= $model->email ?><br> -->
Пол: <?= $model->gender ?><br>
Дата рождения: <?= $model->date_of_birth ?><br>
Организация: <?= $model->organisation ?><br>
Тип пользователя: <?= $model->role ?><br>
</p>
<h2>Проекты пользователя</h2>
<p>
<?
Pjax::begin(['enablePushState' => false, 'timeout' => 5000]);

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_project-view',
    'itemOptions' => ['class' => 'card col-lg-4',
    'tag' => 'div',
    ],
    'summary' => 'Показаны записи <strong>{begin}-{end}</strong> из <strong>{totalCount}</strong>.',
    'layout' => '{summary}<div class="row">{items}</div>{pager}',
    'pager' => ['class' => \yii\bootstrap4\LinkPager::class],
]);
Pjax::end(); 
?>
</p>
<? endif; ?>
