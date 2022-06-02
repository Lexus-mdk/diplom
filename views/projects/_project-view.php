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
        <?= $model->st_description  ?>
    </p>
    <? echo Html::a(Html::encode("Подробнее"), ['view', 'id' => $model->project_id], ['class'=>'btn btn-primary']); ?>
    <!-- <a href="#" class="btn btn-primary">Переход куда-нибудь</a> -->
  </div>