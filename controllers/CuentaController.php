<?php

namespace app\controllers;

use app\models\Configuracion;
use app\models\Forget;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class CuentaController extends Controller
{
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


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionView()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort([
            'defaultOrder' => ['fecha_registro' => SORT_ASC]]);
        return $this->render('cuenta/view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */




    public function actionCuenta()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $userId = Yii::$app->user->identity->idusuario; // Usa la propiedad identity para obtener el usuario autenticado
        $model = Usuarios::findOne(['idusuario' => $userId]);
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->session->get('user')['contrasena'] != md5($model->contrasena)) {
                $model->contrasena = md5($model->contrasena);
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('mensaje', ['message' => 'Registro Realizado', 'type' => 'success']);
                $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->render('cuenta', [
            'model' => $model,
        ]);
    }





}
