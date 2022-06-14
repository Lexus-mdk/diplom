<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequestToTeam */
/* @var $form ActiveForm */
?>
<div class="projects-request-to-team">
    <h2>Отклик на вакансию</h2>
    <p>Должность - <?= $vacancy->post ?></p>
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'user_id', ['template'=>'{input}'])->hiddenInput() ?>
        <?= $form->field($model, 'vacancy_id', ['template'=>'{input}'])->hiddenInput() ?>
        <?= $form->field($model, 'message')->textarea() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- projects-request-to-team -->
