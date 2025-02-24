<?php

namespace app\controllers;
use app\components\Correos;
use app\models\ContactForm;
use app\models\Diseño;
use app\models\LoginWeb;
use app\models\Noticias;
use app\models\Noticias_Search;
use Yii;
use yii\web\Controller;
use app\services\InterfaceService;

class SiteController extends Controller
{
    private $eventService;
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


    public function __construct($id, $module, InterfaceService $eventService, $config = [])
    {
        $this->eventoService = $eventService;
        parent::__construct($id, $module, $config);
    }


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
        if (!empty(Yii::$app->session->get('user'))) {
            return $this->goHome();
        }
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Yii::$app->request->referre0opr);
        }
        return $this->render('login', ['model' => $model]);
    }


    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        $sess = Yii::$app->session;
        if ($sess->has('user')) {
            $sess->remove('user');
            //unset($sess['user']);
        }
        return $this->goHome();
    }


    public function actionEventos()
    {
        //return $this->refresh();
        return $this->render('eventos');
    }

    public function actionRegistrareventos()
    {
        $model = new Diseño();
        $this->eventoService->nuevosEventos($model);
        return $this->render('registrareventos', ['model' => $model]);
    }

}



