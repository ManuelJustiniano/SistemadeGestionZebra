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
        $this->gestionProyectAService->verificarAccesoAdmingestor();
        $resultadoBusqueda = $this->gestionProyectAService->listarProyectos(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $resultadoBusqueda['searchModel'],
            'dataProvider' => $resultadoBusqueda['dataProvider'],
            'render' => 'listap',
        ]);
    }


    /**
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $this->gestionProyectAService->verificarAccesoAdmingestor();
        $model = $this->gestionProyectAService->obtenerProyecto($id);
        return $this->render('index', [
            'model' => $model,
            'render' => 'view',
        ]);
    }


    public function actionViewproyect($id)
    {

        $model = $this->gestionProyectAService->obtenerProyectoasignado($id);
        return $this->render('index', [
            'model' => $model,
            'render' => 'view',
        ]);
    }

    public function actionCreate()
    {
       $this->gestionProyectAService->verificarAccesoAdmingestor();
        $resultado = $this->gestionProyectAService->nuevoProyecto(Yii::$app->request->post());
        if ($resultado['exito']) {
            return $this->redirect(['index']);
        }
        return $this->render('index', [
            'model' => $resultado['model'],
            'render' => 'create',

        ]);
    }


    public function actionAsignaciondetareas($idproyecto)
    {

        $this->gestionProyectAService->verificarAccesoAdmingestor();
        $model = $this->gestionProyectAService->prepararModeloAsignacion($idproyecto);
        if (Yii::$app->request->isPost) {
            $resultado = $this->gestionProyectAService->procesarAsignacionTarea($model, Yii::$app->request->post());
            if ($resultado['exito']) {
                return $this->redirect(['view', 'id' => $idproyecto]);
            } else {
                Yii::$app->session->setFlash('error', 'Error al asginar. Inténtelo más tarde.');
            }
        }
        return $this->render('index', [
            'model' => $model,
            'render' => 'asignar',
        ]);
    }



    public function actionEditasignaciondetareas($id)
    {
        $this->gestionProyectAService->verificarAccesoAdmingestor();
        $model = $this->gestionProyectAService->obtenerAsignacionPorId($id);
        if (Yii::$app->request->isPost) {
            $resultado = $this->gestionProyectAService->procesarEdicionAsignacion($id, Yii::$app->request->post());
            if ($resultado['exito']) {
                return $this->redirect(['view', 'id' => $model->idproyecto]);
            } else {

                Yii::$app->session->setFlash('error', 'Error al editar la asginacion');
            }
        }
        return $this->render('index', [
            'model' => $model,
            'render' => 'editasignar',
        ]);
    }





    /**
     */
    public function actionUpdate($id)
    {
        $this->gestionProyectAService->verificarAccesoAdmingestor();
        $resultado = $this->gestionProyectAService->actualizarProyecto(Yii::$app->request->post(), $id);
        if ($resultado['exito']) {
            return $this->redirect(['index']);
        }
        return $this->render('index', [
            'model' => $resultado['model'],
            'render' => 'update',

        ]);
    }

    public function actionEstado($id)
    {
        $model = $this->gestionProyectAService->verificarAccesoAdmingestor();
        $resultado = $this->gestionProyectAService->cambiarEstadoproyecto($id);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'exito' => $resultado['exito'],
            'mensaje' => $resultado['mensaje'],
        ];
    }


    public function actionProgreso($id)
    {
        $this->gestionProyectAService->verificarAccesoAdmingestor();
        $resultado = $this->gestionProyectAService->cambiarEstadoproyecto($id);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'exito' => $resultado['exito'],
            'mensaje' => $resultado['mensaje'],
        ];
    }
    /**
     * @throws StaleObjectException
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $modelu = $this->gestionProyectAService->verificarAccesoAdmingestor();
        //$this->gestionProyectAService->eliminarProyecto($id);
       // return $this->redirect(['index']);
    }




/*CONSULTOR*/
        public function actionMisproyectos()
        {


            $this->gestionProyectAService->verificarAccesoCons();
            $resultadoBusqueda = $this->gestionProyectAService->listarmisProyectos(Yii::$app->request->queryParams);
            return $this->render('index', [
                'searchModel' => $resultadoBusqueda['searchModel'],
                'dataProvider' => $resultadoBusqueda['dataProvider'],
                'render' => 'milista',
            ]);
        }


}
