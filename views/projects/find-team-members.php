<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FindingTeamMembers */
/* @var $form ActiveForm */
?>
<div class="projects-find-team-members">
    <h2>Создание вакансии на вступление в команду </h2>

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'project_id')->hiddenInput() ?>
        <?= $form->field($model, 'description')->textarea() ?>
        <?= $form->field($model, 'post') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- projects-find-team-members -->
