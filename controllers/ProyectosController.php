<?php

namespace app\controllers;

use app\components\InterfaceCuenta;
use app\components\InterfaceProyectos;
use app\models\ChangePasswordForm;
use app\models\Configuracion;
use app\models\Forget;
use app\models\Proyectos;
use app\models\ProyectosSearch;
use app\models\Usuarios;
use app\models\Usuariosperfil;
use app\models\UsuariosSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ProyectosController extends Controller
{

    private $proyectosService;
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],

        ];
    }
    public function __construct($id, $module, InterfaceProyectos $proyectosService, $config = [])
    {
        $this->proyectosService = $proyectosService;
        parent::__construct($id, $module, $config);
    }


    public function actionIndex()
    {
        $modelu = $this->proyectosService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }


        $resultadoBusqueda = $this->proyectosService->listarProyectos(Yii::$app->request->queryParams);
        return $this->render('listap', [
            'searchModel' => $resultadoBusqueda['searchModel'],
            'dataProvider' => $resultadoBusqueda['dataProvider'],
            'render' => 'listap',
            'tipo_usuario' => $modelu->tipo_usuario,
        ]);





    }


    /**
     * @throws NotFoundHttpException
     */
    public function actionView($id): string
    {
        $modelu = $this->proyectosService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }

        $model = $this->proyectosService->findModel($id);
        return $this->render('index', [
            'model' => $model,
            'render' => 'view',
            'tipo_usuario' => $modelu->tipo_usuario,
        ]);
    }

    public function actionCreate()
    {
        $modelu = $this->proyectosService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }
        $resultado = $this->proyectosService->nuevoProyecto(Yii::$app->request);
        if ($resultado['success']) {
            return $this->redirect(['index']);
        }
        return $this->render('index', [
            'model' => $resultado['model'],
            'render' => 'create',
            'tipo_usuario' => $modelu->tipo_usuario,

        ]);
    }


    public function actionAsignaciondetareas($idproyecto)
    {

        $modelu = $this->proyectosService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }


        $model = $this->proyectosService->prepararModeloAsignacion($idproyecto);
        if ($model === null) {
            Yii::$app->session->setFlash('error', 'El proyecto especificado no existe.');
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->isPost) {
            $resultado = $this->proyectosService->procesarAsignacionTarea($model, Yii::$app->request->post());




            if ($resultado['success']) {
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Error al asignar la tarea. Verifica los datos ingresados.');
            }
        }

        return $this->render('index', [
            'model' => $model,
            'render' => 'asignar',
            'tipo_usuario' => $modelu->tipo_usuario,
        ]);


    }







    /**
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $modelu = $this->proyectosService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }

        $resultado = $this->proyectosService->actualizarProyecto($id);
        if ($resultado['success']) {
            return $this->redirect(['index']);
        }
        return $this->render('index', [
            'model' => $resultado['model'],
            'render' => 'update',
            'tipo_usuario' => $modelu->tipo_usuario,

        ]);
    }

    /**
     * @throws StaleObjectException
     * @throws NotFoundHttpException
     */
    public function actionDelete($id): \yii\web\Response
    {
        $modelu = $this->proyectosService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }


    protected function findModel($id): Proyectos
    {
        if (($model = Proyectos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



}
