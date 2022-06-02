<?php
use yii\bootstrap4\Html;


// echo '<div class="card col-md-4">';
// echo Html::a(Html::encode($model->name), ['view', 'id' => $model->project_id]);
// echo $model->name;
// echo '</div>';
?>
<div class="card-body">
    <h5 class="card-title"><?= $model->name ?><br> <small><?= $model->status ?></small></h5>
    <p class="card-text">
        <?php 
        if (strlen($model->st_description)>100)
        {
            echo substr(Html::encode($model->st_description), 0, 200) . '...';
        }else{
            echo $model->st_description;
        }  ?>
    </p>
    <? echo Html::a(Html::encode("Подробнее"), ['/projects/view', 'id' => $model->project_id], ['class'=>'btn btn-primary']); ?>
    <!-- <a href="#" class="btn btn-primary">Переход куда-нибудь</a> -->
  </div>