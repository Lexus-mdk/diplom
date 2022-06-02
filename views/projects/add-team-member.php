<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TeamMembers */
/* @var $form ActiveForm */
?>
<div class="projects-add-team-members">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'project_id') ?>
        <?= $form->field($model, 'user_id') ?>
        <?= $form->field($model, 'post') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- projects-add-team-members -->
