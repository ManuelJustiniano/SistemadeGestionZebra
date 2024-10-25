<?php

namespace app\controllers;
use app\components\InterfaceTarea;
use app\models\Tareas;
use app\models\TareasSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TareasController extends Controller
{

    private $tareaService;
    /**
     * @inheritdoc
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],

        ];
    }
    public function __construct($id, $module, InterfaceTarea $tareaService, $config = [])
    {
        $this->tareaService = $tareaService;
        parent::__construct($id, $module, $config);
    }


    public function actionIndex()
    {
       $modelu = $this->tareaService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }


        $resultadoBusqueda = $this->tareaService->listTareas(Yii::$app->request->queryParams);
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
        $modelu = $this->tareaService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }

        $model = $this->tareaService->findModel($id);
        return $this->render('index', [
            'model' => $model,
            'render' => 'view',
            'tipo_usuario' => $modelu->tipo_usuario,
        ]);
    }

    public function actionCreate()
    {
        $modelu = $this->tareaService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }

        $resultado = $this->tareaService->nuevaTarea(Yii::$app->request);
        if ($resultado['success']) {
            return $this->redirect(['index']);
        }
        return $this->render('index', [
            'model' => $resultado['model'],
            'render' => 'create',
            'tipo_usuario' => $modelu->tipo_usuario,

        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $modelu = $this->tareaService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }

        $resultado = $this->tareaService->actualizarTarea($id);

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
        $modelu = $this->tareaService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }
        $this->findModel($id)->delete();
        return $this->redirect(['index']);

    }


        protected function findModel($id): Tareas
        {
            if (($model = Tareas::findOne($id)) !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }



}
