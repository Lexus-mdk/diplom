<?php
/* @var $this yii\web\View */

use yii\bootstrap4\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;


$dataProvider = new ActiveDataProvider([
    'query' => $model::find(),
    'pagination' => [
        'pageSize' => 9,
    ],
]);
if (!Yii::$app->user->isGuest)
{
    echo Html::a(Html::encode("Создать проект"), ['create-project'], ['class'=>'btn btn-primary']);
}
Pjax::begin(['enablePushState' => true, 'timeout' => 5000]);

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_project-view',
    'itemOptions' => ['class' => 'card col-lg-4',
    'tag' => 'div',
    ],
    'summary' => 'Показаны записи <strong>{begin}-{end}</strong> из <strong>{totalCount}</strong>.',
    'layout' => '{summary}<div class="row">{items}</div>{pager}',
    'pager' => ['class' => \yii\bootstrap4\LinkPager::class],
    // 'options' => [
    //     'class' => 'row ',
    // ]
]);

?>

<?php 
Pjax::end(); 
?>
