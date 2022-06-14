<?php
/* @var $this yii\web\View */
use yii\bootstrap4\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;

$dataProvider = new ActiveDataProvider([
    'query' => $model->getTeamMembers(),
    'pagination' => [
        'pageSize' => 3,
    ],
]);
?>
<h1><?= $model->name?> <?=$model->patronymic?> <?=$model->surename ?></h1>
Логин: <?= $model->username ?><br>
Почта: <?= $model->email ?><br>
Пол: <?= $model->gender ?><br>
Дата рождения: <?= $model->date_of_birth ?><br>
Организация: <?= $model->organisation ?><br>
Тип пользователя: <?= $model->role ?><br>

<p>
    <? echo Html::a(Html::encode("Редактировать информацию о пользователе"), ['update-user'], ['class'=>'btn btn-primary']);?>
    
</p>
<h2>Мои проекты</h2>
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
    'layout' => '{summary}<div class="card-deck">{items}</div>{pager}',
    'pager' => ['class' => \yii\bootstrap4\LinkPager::class],
]);
Pjax::end(); 
?>
</p>