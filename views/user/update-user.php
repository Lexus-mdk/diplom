<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model app\models\RegistrationForm */
/* @var $form ActiveForm */
Pjax::begin(['enablePushState' => false, 'timeout' => 5000]);

?>

<div class="site-registration">

    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'surename') ?>
        <?= $form->field($model, 'patronymic') ?>
        <?= $form->field($model, 'gender')->radioList([
            'Женский'=>'Женский',
            'Мужской'=>'Мужской'
        ]) ?>
        <?= $form->field($model, 'date_of_birth')->widget(
            \yii\widgets\MaskedInput::class, [
                'mask' => "y-2-1",
                'clientOptions' => [
                    'alias' => 'datetime',
                    "placeholder" => "yyyy-mm-dd",
                    "separator" => "-"
                ]
            ]
        ) ?>
        <?= $form->field($model, 'role')->radioList([
            'Студент'=>'Студент',
            'Физ/юр лицо'=>'Физ/юр лицо'
        ]) ?>
        <?= $form->field($model, 'organisation') ?>
        <?= $form->field($model, 'password')->input('password')->label('Пароль') ?>
        <?= $form->field($model, 'password_repeat')->input('password')->label('Повторите пароль')  ?>
    
        <div class="form-group">
            <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-registration -->
<?php Pjax::end() ?>
