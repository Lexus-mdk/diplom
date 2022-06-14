<?php

use app\models\TeamMembers;
use yii\bootstrap4\Html;

$creator = TeamMembers::findOne(['project_id'=>$model->project_id, 'role'=>'Создатель']);
?>
<div class="row">
<div class="col-sm-8">
<?
echo Html::a($model->user->name . ' ' . $model->user->patronymic . ' ' . $model->user->surename, ['/user/profile', 'login'=>$model->user->username], [ 'data-pjax'=>0]);
echo  '<h6 class="text-muted">' . $model->post . '</h6>';
?>
</div>
<? if (\Yii::$app->user->identity->user_id == $creator->user_id && $creator->user_id != $model->user->user_id): ?>
<div class="col-sm-4">
    <?= Html::a('<i class="fa fa-ban" style="color:red !important"></i>', ['delete-team-member', 'id'=>$model->id], ['class' => ' px-5', 'alt'=>'Удалить']) ?>
</div>
<?elseif(\Yii::$app->user->identity->user_id == $model->user->user_id && $creator->user_id != $model->user->user_id):?>
<div class="col-sm-4">
    <?= Html::a('Покинуть команду', ['delete-team-member', 'id'=>$model->id], ['class' => 'btn btn-danger px-2', 'alt'=>'Удалить']) ?>
</div>
<? endif ?>
</div>