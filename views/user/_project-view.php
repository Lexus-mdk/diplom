<?php

use app\models\Projects;
use yii\bootstrap4\Html;


// echo '<div class="card col-md-4">';
// echo Html::a(Html::encode($model->name), ['view', 'id' => $model->project_id]);
// echo $model->name;
// echo '</div>';
$model = Projects::findOne(['project_id'=>$model->project_id])
?>
<div class="card-body">
    <h5 class="card-title"><?= $model->name ?><br> <small><?= $model->status ?></small> <small><?= $model->like ?><i class="fa fa-heart" style="color:red !important"></i></small></h5>
    <p class="card-text">
        <?php 
        if (strlen(Html::decode($model->st_description))>100)
        {
            echo trim(substr(Html::encode($model->st_description), 0, 200)) . '...';
        }else{
            echo $model->st_description;
        }  ?>
    </p>
    <p style="color:<?= $model->color[$model->moderation] ?>">
        <?= $model->arr[$model->moderation] ?>
    
    <?
    if ($model->moderation != 3) {
        echo '<small>(Доп информацию смотрите на странице проекта.)</small></p>';
        echo Html::a(Html::encode("Подробнее"), ['/projects/view', 'id' => $model->project_id], ['class'=>'btn btn-primary', 'data-pjax'=>0]); 
    }else{
        echo '</p>';
    }
     ?>
    
    <!-- <a href="#" class="btn btn-primary">Переход куда-нибудь</a> -->
  </div>