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

    <!-- <?= $form->field($model, 'links')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'like')->textInput() ?> -->

    <?= $form->field($model, 'status')->dropDownList([
    'Идея/задумка' => 'Идея/задумка',            
    'Набор+в+команду' => 'Набор в команду',
    'Сбор+средств' => 'Сбор средств',
    'В+разработке'=> 'В разработке',
    'Завершен'=>'Завершен'
]); ?>

<?= $form->field($model, 'moderation')->dropDownList([
    0=>'Модерация',
    1=>'Допущен',
    2=>'Требуются исправления',
    3=>'Заблокирован'
]); ?>

    <!-- <?= Html::dropDownList('moderation', [], [
    0=>'Модерация',
    1=>'Допущен',
    2=>'Требуются исправления',
    3=>'Заблокирован'
], ['label'=>'Статус модерирования']); ?> -->

<?= $form->field($model, 'm_message')->textarea(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
