<?php
/* @var $this yii\web\View */

use yii\bootstrap4\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;

Pjax::begin(['enablePushState' => true, 'timeout' => 5000]);

$dataProvider = new ActiveDataProvider([
    'query' => $model,
    'pagination' => [
        'pageSize' => 9,
    ],
]);
?>
<h1 class="d-flex justify-content-center">Каталог студенческих проектов</h1>
<div class="row flex-xl-nowrap">
<nav class="col-md-3 col-xl-2 bd-sidebar pt-md-5" style="border-right: 1px solid grey">
<nav class="bd-links">
    <h4>Категории</h4>
    <div class="bd-toc-item ">
        <?= Html::a('Все проекты', [''], ['class'=>'bd-toc-link']) ?>
    </div>
    <div class="bd-toc-item ">
        <?= Html::a('Идея/задумка', ['', 'status'=>'Идея/задумка'], ['class'=>'bd-toc-link']) ?>
    </div>
    <div class="bd-toc-item ">
        <?= Html::a('Набор в команду', ['', 'status'=>'Набор в команду'], ['class'=>'bd-toc-link']) ?>
    </div>
    <div class="bd-toc-item ">
        <?= Html::a('В разработке', ['', 'status'=>'В разработке'], ['class'=>'bd-toc-link']) ?>
    </div>
    <div class="bd-toc-item ">
        <?= Html::a('Сбор средств', ['', 'status'=>'Сбор средств'], ['class'=>'bd-toc-link']) ?>
    </div>
    <div class="bd-toc-item ">
        <?= Html::a('Завершен', ['', 'status'=>'Завершен'], ['class'=>'bd-toc-link']) ?>
    </div>
</nav>
</nav>
<main class="col-md-9 col-xl-10 py-md-3 pl-md-5 bd-content">
<?

if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role != 'Физ/юр лицо')
{
    echo '<div class="row justify-content-end">';
    echo Html::a(Html::encode("Создать проект"), ['create-project'], ['class'=>'  btn btn-primary']) . '</div>';
}
// echo Html::dropDownList('Фитр', null, [
//     'Идея/задумка' => 'Идея/задумка',            
//     'Набор+в+команду' => 'Набор в команду',
//     'Сбор+средств' => 'Сбор средств',
//     'В+разработке'=> 'В разработке',
//     'Завершен'=>'Завершен'
// ], ['id'=>'filter']);

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_project-view',
    'itemOptions' => ['class' => 'card col-md-4',
    'tag' => 'div',
    ],
    'summary' => 'Показаны проекты <strong>{begin}-{end}</strong> из <strong>{totalCount}</strong>.',
    'layout' => '{summary}<div class="row ">{items}</div>{pager}',
    'pager' => ['class' => \yii\bootstrap4\LinkPager::class],
    // 'options' => [
    //     'class' => 'row ',
    // ]
]);

?>

<?php 
Pjax::end(); 
// Pjax::begin(['enablePushState' => false, 'timeout' => 5000]);
// echo Html::a(Html::encode("Создать проект"), ['test'], ['class'=>'btn btn-primary']);
// Pjax::end();
?>
</main>
</div>
<? 
$js = <<<JS
    $('#filter').on('input', function(){
        var data = $(this).val();
        window.location.href = 'index?filter=' + data;
        console.log(data);       
    }
    );
    
JS;
$this->registerJs($js);
?>