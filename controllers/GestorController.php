<?php

namespace app\controllers;

use app\components\InterfaceAdmin;
use app\components\InterfaceCuenta;
use app\components\InterfaceGestor;
use app\components\InterfaceNoti;
use app\models\ChangePasswordForm;
use app\models\Configuracion;
use app\models\Forget;
use app\models\Usuarios;
use app\models\Usuariosperfil;
use app\models\UsuariosSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class GestorController extends Controller
{

    private $cuentaService;
    private $gestorService;
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



    public function __construct($id, $module, InterfaceGestor $gestorService, InterfaceCuenta $cuentaService, $config = [])
    {
        $this->gestorService = $gestorService;
        $this->cuentaService = $cuentaService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        return $this->redirect(['gestor/cuenta']);
    }
    public function actionCuenta()
    {
       
        $model = $this->gestorService->obtenerUsuarioSesion();
        if ($model === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }

        return $this->render('cuenta', [
            'model' => $model,
            'render' => 'perfil',
        ]);
    }


    public function actionUpdateperfil()
    {
        $model = $this->gestorService->obtenerUsuarioSesion();
        if ($model === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(['site/login']);
        }

        $resultado = $this->cuentaService->actualizarUsuario($model, Yii::$app->request->post());

        if ($resultado['exito']) {
            return $this->redirect(['cuenta']);
        }

        return $this->render('cuenta', [
            'model' => $model,
            'render' => 'updateperfil',
        ]);
    }



    public function actionUpdatepasswordperfil()
    {
        $model = $this->gestorService->obtenerUsuarioSesion();
        if ($model === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(['site/login']);
        }
                $resultado = $this->cuentaService->procesarFormularioCambioPassword($model, Yii::$app->request->post());
        if ($resultado['exito']) {
            return $this->redirect(['cuenta']);
        }

        return $this->render('cuenta', [
            'model' => $resultado['formModel'] ?? new ChangePasswordForm(),
            'render' => 'updatepasswordperfil',
        ]);
    }









}
