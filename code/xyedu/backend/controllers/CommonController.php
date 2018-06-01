<?php
namespace backend\controllers;

use yii\web\Controller;
use Yii;

class CommonController extends Controller
{
    public function beforeAction($action)
    {
        //如果未登录，则直接返回
        if(Yii::$app->user->isGuest){
            return $this->goHome();
        }

            return true;

    }
}