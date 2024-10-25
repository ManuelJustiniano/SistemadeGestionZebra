<?php

namespace app\controllers;

use app\components\InterfaceAdmin;
use app\components\InterfaceCuenta;
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

class AdministradorController extends Controller
{

    private $adminService;
    private $cuentaService;
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



    public function __construct($id, $module, InterfaceAdmin $adminService, InterfaceCuenta $cuentaService, $config = [])
    {
        $this->adminService = $adminService;
        $this->cuentaService = $cuentaService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        return $this->redirect(['administrador/cuenta']);
    }
    public function actionCuenta()
    {

        $model = $this->adminService->obtenerUsuarioSesion();
        if ($model === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }

        return $this->render('cuenta', [
            'model' => $model,
            'render' => 'perfil',
        ]);
    }


    public function actionUsuarioslist()
    {
        $modelu = $this->adminService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }


        $resultadoBusqueda = $this->adminService->listUsuarios(Yii::$app->request->queryParams);
        return $this->render('listau', [
            'searchModel' => $resultadoBusqueda['searchModel'],
            'dataProvider' => $resultadoBusqueda['dataProvider'],
            'render' => 'listau',
        ]);

    }


    public function actionCreate()
    {
        $modelu = $this->adminService->obtenerUsuarioSesion();
        if ($modelu === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/login']);
        }
        $model = new Usuarios();  // Crear un nuevo usuario
        // Obtener la contraseña desde el POST
        $password = Yii::$app->request->post('password');


        $resultado = $this->adminService->nuevoUsuario($model, $password);
        if ($resultado['success']) {
            return $this->redirect(['index']);
        }
        return $this->render('cuenta', [
            'model' => $resultado['model'],
            'render' => 'createusuario',

        ]);
    }

    public function actionUpdateperfil()
    {
        $model = $this->adminService->obtenerUsuarioSesion();
        if ($model === null) {
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
        $model = $this->adminService->obtenerUsuarioSesion();
        if ($model === null) {
            return $this->redirect(['site/login']);       }
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
