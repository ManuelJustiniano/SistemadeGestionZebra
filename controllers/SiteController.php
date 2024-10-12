<?php

namespace app\controllers;
use app\components\AuthService;
use app\components\InterfaceAuth;
use app\models\LoginWeb;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\components\InterfaceComponents;

class SiteController extends BaseController
{
    private $authService;
    public function init()
    {
        parent::init();
        $this->authService = Yii::$container->get('app\components\InterfaceAuth');
    }
    public function behaviors()
    {
        return [];
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */

    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $model = new LoginWeb();
        if ($this->authService->login($model)) {
            return $this->redirect(['cuenta/cuenta']);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        $this->authService->logout();
        return $this->redirect(['login']);
    }

}



