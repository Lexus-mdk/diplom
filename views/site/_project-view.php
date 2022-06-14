<?php
use yii\bootstrap4\Html;


// echo '<div class="card col-md-4">';
// echo Html::a(Html::encode($model->name), ['view', 'id' => $model->project_id]);
// echo $model->name;
// echo '</div>';
?>
<div class="card-body">
    <h5 class="card-title"><?= $model->name ?> <small class="badge badge-secondary"><?= $model->status ?></small> <small><?= $model->like ?><i class="fa fa-heart" style="color:red !important"></i></small></h5>
    <p class="card-text">
    <?php 
        if (strlen(Html::decode($model->st_description))>150)
        {
            echo trim(substr(Html::encode($model->st_description), 0, 150)) . '...';
        }else{
            echo trim($model->st_description);
        }  ?>
    </p>
    <div class="align-self-end">
    <? echo Html::a(Html::encode("Подробнее"), ['projects/view', 'id' => $model->project_id], ['class'=>'btn btn-primary', 'data-pjax'=>0]); ?>
    <!-- <a href="#" class="btn btn-primary">Переход куда-нибудь</a> -->
    
    </div>
  </div>