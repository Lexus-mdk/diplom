<?php
use yii\bootstrap4\Html;

?>
<h2>Вакансия на должность "<?= $model->post ?>" в проект "<?= $model->project->name?>"</h2>
<h4>Описание</h4>
<p><?= $model->description?></p>
<?= Html::a('Откликнуться', ['request-to-team', 'vacancy_id'=>$model->id], ['class'=> 'btn btn-info', 'data-pjax'=>0]);?>
