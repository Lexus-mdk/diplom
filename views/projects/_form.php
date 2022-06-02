<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Projects */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="projects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'st_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'links')->textInput(['doubleEncode'=>true]) ?>


    <?= $form->field($model, 'status')->dropDownList([
            'Прототип/идея' => 'Прототип/идея',            
            'Поиск команды' => 'Поиск команды',
            'Сбор средств' => 'Сбор средств',
            'В разработке'=> 'В разработке',
            'Завершен'=>'Завершен'
        ]); ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
