<?php

namespace app\controllers;

use app\components\InterfaceAsignacion;
use app\components\InterfaceCuenta;
use app\components\InterfaceGestionProyecto;
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

    private $gestionProyectAService;
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
    public function __construct($id, $module, InterfaceGestionProyecto $gestionProyectAService, $config = [])
    {
        $this->gestionProyectAService = $gestionProyectAService;

        parent::__construct($id, $module, $config);
    }


    public function actionIndex()
    {
        $modelu = $this->gestionProyectAService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }
        $resultadoBusqueda = $this->gestionProyectAService->listarProyectos(Yii::$app->request->queryParams);
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
    public function actionView($id)
    {
        $modelu = $this->gestionProyectAService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }

        $model = $this->gestionProyectAService->obtenerProyecto($id);

        return $this->render('index', [
            'model' => $model,
            'render' => 'view',
            'tipo_usuario' => $modelu->tipo_usuario,
        ]);
    }

    public function actionCreate()
    {
        $modelu = $this->gestionProyectAService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }
        $resultado = $this->gestionProyectAService->nuevoProyecto(Yii::$app->request->post());
        if ($resultado['exito']) {
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

        $modelu = $this->gestionProyectAService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }

        $model = $this->gestionProyectAService->prepararModeloAsignacion($idproyecto);

        if ($model === null) {
            Yii::$app->session->setFlash('error', 'El proyecto especificado no existe.');
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->isPost) {
            $resultado = $this->gestionProyectAService->procesarAsignacionTarea($model, Yii::$app->request->post());
            if ($resultado['exito']) {
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
     */
    public function actionUpdate($id)
    {
        $modelu = $this->gestionProyectAService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }

        $resultado = $this->gestionProyectAService->actualizarProyecto(Yii::$app->request->post(), $id);
        if ($resultado['exito']) {
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
    public function actionDelete($id)
    {
        $modelu = $this->gestionProyectAService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }
        //$this->gestionProyectAService->eliminarProyecto($id);
       // return $this->redirect(['index']);
    }

}
