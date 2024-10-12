<?php

namespace app\controllers;

use app\models\Tareas;
use app\models\TareasSearch;
use app\models\Noticias;
use app\models\NoticiasGaleria;
use app\models\NoticiasSearch;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * NoticiasController implements the CRUD actions for Noticias model.
 */
class DiseñoController extends Controller
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            /*'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],*/
            'access' => [
                'class' => AccessControl::className(),
                //'only'  => ['*'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Noticias models.

     */
    public function actionIndex()
    {
        $searchModel = new TareasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort([
            'defaultOrder' => ['idevento' => SORT_DESC]]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Noticias model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Noticias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tareas();

        if ($model->load(Yii::$app->request->post())) {
            $model->fecha_registro = date('Y-m-d H:i:s');
            $model->estado = '1';
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Noticias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Noticias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Noticias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Noticias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Noticias::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



     public function actionEstado($id)
    {
        if (!Yii::$app->request->isAjax)
            $this->redirect(['index']);
        $model = new Tareas();
        $model = $model->findOne(['idevento' => $id]);
        $model->estado = (string)!$model->estado;
        $model->save();
    }



  /*  public function actionExport()
    {

        //\moonland\phpexcel\Excel::widget([
        \moonland\phpexcel\Excel::export([
            'models' => Noticias::find()->all(),
            //'mode' => 'export', //default value as 'export'
            'columns' => ['idnoticia', 'idcategoria', 'titulo', 'resumen', 'descripcion', 'otradescripcion', 'fuente', 'video', 'foto_portada', 'foto_contenido', 'destacado', 'tags', 'estado', 'posicion', 'fecha_registro', 'fecha_noticia'], //without header working, because the header will be get label from attribute label.
            'headers' => ['Idnoticia' => 'idnoticia', 'Idcategoria' => 'idcategoria', 'Nombre' => 'titulo', 'Resumen' => 'resumen', 'Descripcion' => 'descripcion', 'Otradescripcion' => 'otradescripcion', 'Fuente' => 'fuente', 'Foto Portada' => 'foto_portada', 'Foto Contenido' => 'foto_contenido', 'Video' => 'video', 'Destacado' => 'destacado', 'Fecha noticia' => 'fecha_noticia', 'Tags' => 'tags', 'Estado' => 'estado', 'Posicion' => 'posicion', 'fecha_registro' => 'Fecha Registro'],
        ]);
    }*/

}
