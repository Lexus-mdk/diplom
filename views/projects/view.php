<?php
/* @var $this yii\web\View */
/* @var $model app\models\Projects */
use yii\bootstrap4\Html;
echo '';
if ($model->creator_id == \Yii::$app->user->identity->user_id)
{
    echo Html::a('Редактировать', ['update-project', 'project_id'=>$model->project_id], ['class'=> 'btn btn-info']);
}
echo '<h1>' . $model->name . '<span class="badge badge-secondary">' . $model->status . '</span></h1>';
echo '<h6 class="text-muted">' . $model->st_description . '<h6><br>';
// echo $model->description . '<br>';
// echo $model->like . '<br>';
// echo $model->subscription . '<br>';
// echo $model->status . '<br>';
// echo $model->date . '<br>';

?>
<h3>Описание</h3>
<p>
    <?= Html::decode($model->description) ?>
</p>
<h6>Дата создания: <?= $model->date  ?></h6>
<p>
    Понравилось <?= $model->like ?> пользователю/ям.
</p>
<p>
    Подписано <?= $model->subscription ?> пользователя/ей.
</p>

