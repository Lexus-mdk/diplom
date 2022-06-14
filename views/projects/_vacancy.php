<?php
use yii\bootstrap4\Html;

if ($model->isInTeam())
{
    echo Html::a($model->post, ['view-vacancy', 'vacancy_id'=>$model->id], [ 'data-pjax'=>0]);
    echo '<p class="text-muted"><small>' . trim(substr(Html::encode($model->description), 0, 100)) . '...' . '</small></p>';
}else{
    echo $model->post;
    echo '<p class="text-muted"><small>' . trim(substr(Html::encode($model->description), 0, 100)) . '...' . '</small></p>';
}