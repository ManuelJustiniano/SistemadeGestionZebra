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
        $this->tareaService->verificarAccesoAdmin();
        $resultadoBusqueda = $this->tareaService->listTareas(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $resultadoBusqueda['searchModel'],
            'dataProvider' => $resultadoBusqueda['dataProvider'],
            'render' => 'listatotaltareas',
        ]);

    }

    /**
     * @throws NotFoundHttpException
     */


    public function actionView($id)
    {
        $this->tareaService->verificarAccesoAdmin();
        $model = $this->tareaService->findModel($id);
        return $this->render('index', [
            'model' => $model,
            'render' => 'view',
        ]);
    }

    public function actionCreate()
    {
        $this->tareaService->verificarAccesoAdmin();
        $resultado = $this->tareaService->nuevaTarea(Yii::$app->request->post());
        if ($resultado['exito']) {
            return $this->redirect(['index']);
        }
        return $this->render('index', [
            'model' => $resultado['model'],
            'render' => 'create',

        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {

        $this->tareaService->verificarAccesoAdmin();
        $resultado = $this->tareaService->actualizarTarea(Yii::$app->request->post(), $id);
        if ($resultado['exito']) {
            return $this->redirect(['view', 'id' => $id]);
        }
        return $this->render('index', [
            'model' => $resultado['model'],
            'render' => 'update',
        ]);


    }



    public function actionEstado($id)
    {
        $this->tareaService->verificarAccesoAdmin();
        $resultado = $this->tareaService->cambiarEstadoTarea($id);
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
    public function actionDelete($id): \yii\web\Response
    {
        $this->tareaService->verificarAccesoAdmin();
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
