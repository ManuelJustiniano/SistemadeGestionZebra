<?php
namespace app\controllers;
use app\models\LoginWeb;
use Yii;
use yii\web\Controller;

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
        $this->checkUserAuthentication();
        return $this->render('index');
    }
    /**
     * Login action.
     *
     * @return \yii\web\Response
     */
    public function actionLogin()
    {

        $this->layout = "login";
        $model = new LoginWeb();


        if ($model->load(Yii::$app->request->post()) && $this->authService->login($model)) {
            $user = Yii::$app->session->get('user');
            return $this->redirect($this->authService->getRedirectRoute($user));
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        $this->authService->logout();
        return $this->redirect(['login']);
    }


}



