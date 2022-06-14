<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class SiteController extends Controller
{
    public $layout = 'main';
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->is_admin == 1)
        {
            return $this->render('index');
        }
        return $this->redirect('/projects/index');
    }
}
