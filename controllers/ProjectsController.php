<?php

namespace app\controllers;

use app\models\FindingTeamMembers;
use app\models\Projects;
use app\models\RequestToTeam;
use app\models\TeamMembers;
use app\models\User;
use app\models\Likes;
use PHPUnit\Util\Log\TeamCity;
use yii\web\NotFoundHttpException;

class ProjectsController extends \yii\web\Controller
{
    public function actionIndex($status = false)
    {
        if ($status)
        {
            $model = Projects::find()->where(['status'=>$status, 'moderation'=>1]);
        }else{
            $model = Projects::find()->where(['moderation'=>1])->orderBy('project_id desc');
        }
        
        return $this->render('index', [
            'model'=>$model,
        ]);
    }

    public function actionViewVacancy($vacancy_id)
    {
        $model = FindingTeamMembers::findOne(['id' =>$vacancy_id]);
        if ($model)
        {
            return $this->render('view-vacancy', [
                'model'=>$model,
            ]); 
        }
        return $this->redirect('index');
    }
    
    public function actionCreateProject()
    {
        $model = new Projects();

        if ($this->request->isPost) 
        {
            if ($model->load($this->request->post())) 
            {
                $model->date = date('Y-m-d');
                $model->description = str_replace("\n","<br>", $model->description);

                if ($model->save())
                {
                    $team = new TeamMembers();
                    $team->project_id = $model->project_id;
                    $team->user_id = \Yii::$app->user->identity->user_id;
                    $team->role = 'Создатель';
                    $team->post = $model->post;
                    if ($team->save())
                    {
                        return $this->redirect(['view', 'id' => $model->project_id]);
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }
    
        return $this->render('create-project', [
            'model' => $model,
        ]);
    }


    public function actionDeleteProject($project_id)
    {
        $model = $this->findModel($project_id);
        $creator = TeamMembers::findOne(['project_id'=>$model->project_id, 'role'=>'Создатель']);
        if(\Yii::$app->user->identity->user_id == $creator->user_id)
        {
            $model->delete();
        }

        return $this->redirect(['index']);
    }


    public function actionLikeProject($project_id, $action)
    {
        $model = Projects::findOne(['project_id'=>$project_id]);
        if($model && \Yii::$app->request->isPjax)
        {
            if ($action == 'like')
            {
                $likes = new Likes();
                $likes->project_id = $project_id;
                $likes->user_id = \Yii::$app->user->identity->user_id;
                $model->like = count($model->likes) + 1;
                $model->post = 'Заполнил';
                if($likes->save() && $model->save())
                {
                    return $this->render('view', [
                        'model' => $model,
                    ]);
                }
            } 
            elseif ($action == 'dislike')
            {
                $likes = Likes::findOne(['user_id'=>\Yii::$app->user->identity->user_id]);
                $model->like = count($model->likes)-1;
                $model->post = 'Заполнил';
                if($likes->delete() && $model->save())
                {
                    return $this->render('view', [
                        'model' => $model,
                    ]);
                }
            }
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }


    public function actionAddTeamMember($request_id, $action)
    {
        $team = new TeamMembers();
        $request = RequestToTeam::findOne(['id'=>$request_id]);
        if ($request)
        {
            if ($action == 'del')
            {
                $team->project_id = $request->vacancy->project_id;
                $team->user_id = $request->user_id;
                $team->post = $request->vacancy->post;
                if ($team->save() &&  $request->vacancy->delete())
                {
                    return $this->redirect(['view', 'id'=>$team->project_id]);
                }
            }
            elseif($action == 'add')
            {
                $team->project_id = $request->vacancy->project_id;
                $team->user_id = $request->user_id;
                $team->post = $request->vacancy->post;
                if ($team->save() && $request->delete())
                {
                    return $this->redirect(['view', 'id'=>$team->project_id]);
                }
                
            }
        }
        return $this->render('add-team-member', [
            'model' => $team,
        ]);
    }


    public function actionDeleteTeamMember($id)
    {
        $member = TeamMembers::findOne(['id'=>$id]);
        $creator = TeamMembers::findOne([
            'project_id'=>$member->project_id, 
            'user_id'=>\Yii::$app->user->identity->user_id, 
            'role'=>'Создатель'
        ]);
        if ($member && $creator && $member->id != $creator->id && $member->delete())
        {
            return $this->redirect(['view', 'id'=>$member->project_id]);
        }elseif(\Yii::$app->user->identity->user_id == $member->user_id && $member->id != $creator->id && $member->delete())
        {
            return $this->redirect(['view', 'id'=>$member->project_id]);
        }
    }

    public function actionFindTeamMember($project_id)
    {
        $team = new FindingTeamMembers();
        $team->project_id = $project_id;
        $model = Projects::findOne(['project_id' => $team->project_id]);
        $creator = TeamMembers::findOne(['project_id'=>$model->project_id, 'role'=>'Создатель']);
        if(\Yii::$app->user->identity->user_id != $creator->user_id)
        {
            return $this->redirect('index');
        }
        if ($this->request->isPost && $team->load($this->request->post())) {
            if ($team->save())
            {
                return $this->redirect(['view', 'id' => $team->project_id]);  
            }
        }

        return $this->render('find-team-members', [
            'model' => $team,
        ]);
    }


    public function actionRequestToTeam($vacancy_id)
    {
        $vacancy = FindingTeamMembers::findOne(['id' => $vacancy_id]);
        $team = TeamMembers::findOne(['project_id' => $vacancy->project_id, 'user_id'=>\Yii::$app->user->identity->user_id]);
        $model = new RequestToTeam();
        if ($vacancy && !$team && !RequestToTeam::findOne(['vacancy_id' => $vacancy_id, 'user_id'=>\Yii::$app->user->identity->user_id])){

            if ($this->request->isPost && $model->load($this->request->post())) {
                if ( $model->save())
                {
                    return $this->redirect(['view', 'id' => $vacancy->project_id]);  
                }
            }
            $model->user_id = \Yii::$app->user->identity->user_id;
            $model->vacancy_id = $vacancy_id;
            return $this->render('request-to-team', [
                'model' => $model,
                'vacancy'=>$vacancy
            ]);
        }
        return $this->redirect('index');
    }


    public function actionUpdateProject($project_id)
    {
        $model = $this->findModel($project_id);
        $creator = TeamMembers::findOne(['project_id'=>$model->project_id, 'role'=>'Создатель']);
        if(\Yii::$app->user->identity->user_id != $creator->user_id)
        {
            return $this->redirect('index');
        }

        if ($this->request->isPost && $model->load($this->request->post()) ) {
            $model->description = str_replace("\n","<br>", $model->description);
            if ($model->save())
            {
                return $this->redirect(['view', 'id' => $model->project_id]);

            }
        }
        $model->description = str_replace("<br>","", $model->description);
        
        return $this->render('update-project', [
            'model' => $model,
        ]);
    }

    public function actionView()
    {
        if (\Yii::$app->request->get('id'))
        {
            $model = Projects::findOne(['project_id'=>\Yii::$app->request->get('id')]);
            if ($model) {
                $creator = TeamMembers::findOne(['project_id'=>$model->project_id, 'role'=>'Создатель']);
                return $this->render('view', [
                    'model'=>$model,
                    'creator'=>$creator
                ]);
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $project_id Project ID
     * @return Projects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($project_id)
    {
        if (($model = Projects::findOne(['project_id' => $project_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    
    public function actionTest()
    {
        $model = new Projects();
        return 'Pjax это клево';
    }
}
