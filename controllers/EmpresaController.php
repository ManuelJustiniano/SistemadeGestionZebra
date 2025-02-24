<?php

namespace app\controllers;
use app\components\Correos;
use app\models\Categoria;
use app\models\ContactForm;
use app\models\Diseño;
use app\models\LoginWeb;
use app\models\Noticias;
use app\models\Noticias_Search;
use app\models\Productos;
use app\models\ProductosSearch;
use app\models\Reclamos;
use Yii;
use yii\web\Controller;

class EmpresaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            /*'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],*/
        ];
    }

    /**
     * @inheritdoc
     */
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
        if (!empty(Yii::$app->session->get('user'))) {
            return $this->goHome();
        }

        $model = new LoginWeb();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Yii::$app->request->referrer);
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
        $model = new Diseño();
        if ($model->load(Yii::$app->request->post())) {
            $model->fecha_registro = date('Y-m-d H:i:s');
            if ($model->validate()) {
                if ($model->save(false)) {
                    Correos::nuevoEvento($model);
                    Yii::$app->session->setFlash('success',['message'=>'Diseño registrado! Se revisara la informacion proporcionada y se le notificara si el evento fue aprobado o denegado y si tiene alguna observacion.','type'=>'success']);
                    return $this->refresh();
                } else {
                    Yii::$app->session->setFlash('error', ['message' => 'Se encontro algun error en el formulario']);
                }
            }


        }
        return $this->render('eventos', [
            'model' => $model,
        ]);
    }





    public function actionNoticias()
    {
        $searchModel = New Noticias_Search();
        Yii::$app->getRequest()->getQueryParam('cat');
        $seach = ['Noticias_Search' => ['estado' => '1']];
        if (!empty(Yii::$app->getRequest()->getQueryParam('cat')))
            $seach['Noticias_Search']['idcategoria'] = Yii::$app->getRequest()->getQueryParam('cat');
        if (!empty(Yii::$app->getRequest()->getQueryParam('s')))
            $seach['Noticias_Search']['titulo'] = Yii::$app->getRequest()->getQueryParam('s');

        $dataProvider = $searchModel->search($seach);
        $dataProvider->setSort([
            'defaultOrder' => ['idnoticia' => SORT_DESC]]);
        $dataProvider->pagination->pageSize = 4;
        $dataProvider->pagination->forcePageParam = false;
        return $this->render('noticias', ['model' => $dataProvider, 'all' => true]);
    }

    public function actionNoticia($id = null)
    {
        $model = Noticias::findOne(['idnoticia' => $id]);
        return $this->render('noticias', ['model' => $model]);
    }

    public function actionNosotros()
    {
        return $this->render('nosotros');
    }

    public function actionFormas()
    {
        return $this->render('formas');
    }

    public function actionEnvios()
    {
        return $this->render('envios');
    }

    public function actionCambios()
    {
        return $this->render('cambios');
    }

    public function actionContacto()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success',
                    ['mensaje' => 'Gracias por contactarse con nosotros. Le responderemos lo mas antes posible.']);
            } else {
                Yii::$app->session->setFlash('error', ['mensaje' => 'Hubo un error al enviar el correo, intentelo mas tarde.']);
            }
            return $this->refresh();
        } else {
            return $this->render('contacto', ['model' => $model,]);
        }
    }


    public function actionProductos($id = null, $categ=null,$categ2=null)
    {



        $cat = Categoria::findOne(['idcategoria' => $categ]);

        $searchModel = New ProductosSearch();
        Yii::$app->getRequest()->getQueryParam('cat');
        $seach = ['ProductosSearch'=>['estado'=>'1']];
        //$seach = ['NoticiasSearch'=>['estado'=>'1', '>','idpadre', 0]];


        if(!empty(Yii::$app->getRequest()->getQueryParam('cat')))
            $seach['ProductosSearch']['idcategoria']=Yii::$app->getRequest()->getQueryParam('cat');
        if(!empty(Yii::$app->getRequest()->getQueryParam('s')))
            $seach['ProductosSearch']['titulo']=Yii::$app->getRequest()->getQueryParam('s');

        $dataProvider = $searchModel->search($seach);
        $dataProvider->setSort([
            'defaultOrder' => ['idproducto' => SORT_DESC]]);
        $dataProvider->pagination->pageSize=12;
        $dataProvider->pagination->forcePageParam = false;
        return $this->render('productos', ['model' => $dataProvider, 'all' => true]);














    }

    public function actionProducto($id = null)

    {


        $model = Productos::findOne(['idproducto' => $id]);
        $model->visitas = (int)$model->visitas + 1;
        $model->save(false);
        return $this->render('productos', ['model' => $model]);
    }

}
