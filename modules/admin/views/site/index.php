<?php

use app\models\Projects;
use app\models\User;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

$this->title = 'Панель администратора';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Всего пользователей',
                'number' => User::find()->count(),
                'icon' => 'fas fa-cog',
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Всего проектов',
                'number' => Projects::find()->count(),
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Допущенные',
                'number' => Projects::find()->where(['moderation'=>1])->count(),
                'theme' => 'success',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Ожидают модерации',
                'number' => Projects::find()->where(['moderation'=> 0 ])->count(),
                'theme' => 'gradient-warning',
                'icon' => 'far fa-copy',
            ]) ?>
        </div>
    </div>

    
</div>