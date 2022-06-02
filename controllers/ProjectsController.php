<?php

namespace app\controllers;

use app\models\FindingTeamMembers;
use app\models\Projects;
use app\models\RequestToTeam;
use app\models\TeamMembers;
use app\models\User;
use yii\web\NotFoundHttpException;

class ProjectsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Projects();
        return $this->render('index', [
            'model'=>$model,
        ]);
    }
    
    public function actionCreateProject()
    {
        $model = new Projects();

        if ($this->request->isPost) 
        {
            if ($model->load($this->request->post())) 
            {
                $model->creator_id = \Yii::$app->user->identity->user_id;
                $model->date = date('Y-m-d');
                if ($model->save())
                {
                    $team = new TeamMembers();
                    $team->project_id = $model->project_id;
                    $team->user_id = $model->creator_id;
                    $team->post = 'Создатель';
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
        if(\Yii::$app->user->identity->user_id == $model->creator_id)
        {
            $model->delete();
        }

        return $this->redirect(['index']);
    }


    public function actionLikeProject()
    {
        if(\Yii::$app->request->isAjax)
        {
            
        }
        return $this->render('like-project');
    }

    public function actionSubscribeProject()
    {
        if(\Yii::$app->request->isAjax)
        {

        }
        return $this->render('subscribe-project');
    }

    public function actionAddTeamMember($project_id)
    {
        $team = new TeamMembers();
        $team->project_id = $project_id;
        $model = Projects::findOne(['project_id' => $team->project_id]);
        if ($model->creator_id != \Yii::$app->user->identity->user_id )
        {
            return $this->redirect('index');
        }
        if ($this->request->isPost && $team->load($this->request->post())) {
            if ( $team->save())
            {
                return $this->redirect(['view', 'id' => $team->project_id]);  
            }
        }

        return $this->render('add-team-member', [
            'model' => $team,
        ]);
    }

    public function actionFindTeamMember($project_id)
    {
        $team = new FindingTeamMembers();
        $team->project_id = $project_id;
        $model = Projects::findOne(['project_id' => $team->project_id]);
        if ($model->creator_id != \Yii::$app->user->identity->user_id )
        {
            return $this->redirect('index');
        }
        if ($this->request->isPost && $team->load($this->request->post())) {
            if ( $team->save())
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
            ]);
        }
        return $this->redirect('index');
    }


    public function actionUpdateProject($project_id)
    {
        $model = $this->findModel($project_id);

        if ($model->creator_id != \Yii::$app->user->identity->user_id )
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
        $model->description = str_replace("<BR>","", $model->description);
        
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
                return $this->render('view', [
                    'model'=>$model,
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
}
