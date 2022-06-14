<?php
/* @var $this yii\web\View */
/* @var $model app\models\Projects */

use app\models\Likes;
use yii\bootstrap4\Html;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;


Pjax::begin(['enablePushState' => false, 'timeout' => 5000]);

$this->params['breadcrumbs'][] = ['label' => 'Проекты', 'url' => ['index']];
$likes = $model->likes;
if(\Yii::$app->user->identity->user_id == $creator->user_id)
{   
    echo 'Статус проверки: <strong style="color:' . $model->color[$model->moderation] . '">' . $model->arr[$model->moderation] . '</strong>';
    if ($model->moderation != 1)
    {
        echo '<p style="color:' . $model->color[$model->moderation] . '">' . $model->m_message . '</p>';
    }
    echo Html::a('Редактировать', ['update-project', 'project_id'=>$model->project_id], ['class'=> 'btn btn-info', 'data-pjax'=>0]);
    echo Html::a('Удалить', ['delete-project', 'project_id'=>$model->project_id], ['class'=> 'btn btn-danger', 'data-pjax'=>0]);
}elseif (!\Yii::$app->user->isGuest && Likes::findOne(['project_id'=>$model->project_id, 'user_id'=>\Yii::$app->user->identity->user_id])){
    echo Html::a('Не нравится', ['like-project', 'project_id'=>$model->project_id, 'action'=>'dislike'], ['class'=> 'btn btn-secondary']);
}elseif(!\Yii::$app->user->isGuest){
    echo Html::a('Нравится', ['like-project', 'project_id'=>$model->project_id, 'action'=>'like'], ['class'=> 'btn btn-danger']);
}
// echo $model->description . '<br>';
// echo $model->like . '<br>';
// echo $model->subscription . '<br>';
// echo $model->status . '<br>';
// echo $model->date . '<br>';

?>
<p>
<i class="fa fa-heart red" style="color:red !important"></i>Понравилось <?= $model->like ?> пользователю/ям.
</p>
<h1><?=$model->name ?> <span class="badge badge-secondary"><?=$model->status?></span></h1>
<h6 class="text-muted"><?= $model->st_description ?><h6>
<h3>Описание</h3>
<p>
    <?= Html::decode($model->description) ?>
</p>
<h6>Дата создания: <?= $model->date  ?></h6>

<h6>Участники</h6>
<?
$dataProvider = new ActiveDataProvider([
    'query' => $model->getTeamMembers(),
    'pagination' => [
        'pageSize' => 5,
    ],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_team',
    'itemOptions' => ['class' => 'card col-lg-5',
    'tag' => 'div',
    ],
    'layout' => '{items}{pager}',
    'pager' => ['class' => \yii\bootstrap4\LinkPager::class, 'options'=>['class'=>'pagination pagination-sm']],
]);
// if (\Yii::$app->user->identity->user_id == $creator->user_id)
// {
//     echo Html::a('Добавить', ['add-team-member', 'project_id'=>$model->project_id], ['class'=> 'btn btn-info', 'data-pjax'=>0]);
// }
?>

<?
$dataProvider2 = new ActiveDataProvider([
    'query' => $model->getFindingTeamMembers(),
    'pagination' => [
        'pageSize' => 5,
    ],
]);
echo '<h6>Ищем в команду</h6>';
echo ListView::widget([
    'dataProvider' => $dataProvider2,
    'itemView' => '_vacancy',
    'itemOptions' => ['class' => 'card col-lg-4',
    'tag' => 'div',
    ],
    'layout' => '{items}{pager}',
    'pager' => ['class' => \yii\bootstrap4\LinkPager::class, 'options'=>['class'=>'pagination pagination-sm']],
]);

if (\Yii::$app->user->identity->user_id == $creator->user_id)
{
    echo Html::a('Добавить', ['find-team-member', 'project_id'=>$model->project_id], ['class'=> 'btn btn-info', 'data-pjax'=>0]);
    $req = '';
    foreach($model->findingTeamMembers as $key=>$vacancy)
    {   
        foreach($vacancy->requestToTeams as $key=>$value)
        {
            $req .= '<div class="card col-lg-4">' . Html::a($value->user->username, ['/user/profile', 'login'=>$value->user->username], [ 'data-pjax'=>0]) . $vacancy['post'] . ' - ' . $value['message'];
            $req .= Html::a('Принять', ['add-team-member', 'request_id'=>$value->id, 'action'=>'add']) . Html::a('Принять и удалить вакансию', ['add-team-member', 'request_id'=>$value->id, 'action'=>'del']) . '</div>';
        }
    }
    if ($req && $req != '')
    {
        echo '<h6>Отклики на вакансию</h6>' . $req;
    }
}

if ($model->links && $model->links != "")
{
    echo '<h6>Ссылки</h6>';
    echo $model->links;
}
?>



<? 
Pjax::end(); 
?>

