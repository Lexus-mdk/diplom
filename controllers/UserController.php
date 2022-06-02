<?php

namespace app\controllers;

use app\models\RegistrationForm;
use app\models\User;

class UserController extends \yii\web\Controller
{
    public function actionProfile()
    {
        if (\Yii::$app->request->get('login'))
        {
            $user = User::findOne(['username'=>\Yii::$app->request->get('login')]);
            if($user && $user->user_id == \Yii::$app->user->identity->user_id)
            {
                return $this->render('profile-trust', [
                    'model'=>$user
                ]);
            }
            return $this->render('profile', [
                'model'=>$user
            ]);
        }
        return $this->redirect('/projects/index');
    }

    public function actionProjects()
    {
        return $this->render('projects');
    }

    public function actionUpdateUser()
    {
        
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new RegistrationForm();
        $user = User::findOne(['user_id'=>\Yii::$app->user->identity->user_id]);
        if ($model->load(\Yii::$app->request->post()) && $user) {
            if ($model->validate()) {
                // $user->username = $model->username;
                $user->name = $model->name;
                // $user->email = $model->email;
                $user->surename = $model->surename;
                $user->patronymic = $model->patronymic;
                $user->gender = $model->gender;
                $user->date_of_birth = $model->date_of_birth;
                $user->organisation = $model->organisation;
                $user->role = $model->role;
                $user->password = \Yii::$app->security->generatePasswordHash($model->password);
                
                if ($user->save())
                {
                    return $this->goBack();
                }
            }
        }
        $user->password = '';
        return $this->render('update-user', [
            'model' => $user,
        ]);
    }

}
