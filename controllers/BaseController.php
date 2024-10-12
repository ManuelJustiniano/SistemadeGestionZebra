<?php

namespace app\controllers;
use app\components\AuthService;
use app\models\LoginWeb;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\components\InterfaceComponents;

class BaseController extends Controller
{
    protected function checkUserAuthentication()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
    }

}



