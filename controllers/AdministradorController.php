<?php

namespace app\controllers;

use app\components\InterfaceAdmin;
use app\components\InterfaceCuenta;
use app\components\InterfaceLib;
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
    private $libService;
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



    public function __construct($id, $module, InterfaceAdmin $adminService, InterfaceLib $libService,  InterfaceCuenta $cuentaService,$config = [])
    {
        $this->adminService = $adminService;
        $this->cuentaService = $cuentaService;
        $this->libService = $libService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        return $this->redirect(['administrador/cuenta']);
    }
    public function actionCuenta()
    {
        $model = $this->adminService->verificarAccesoAdmin();
        return $this->render('cuenta', [
            'model' => $model,
            'render' => 'perfil',
        ]);
    }

    public function actionUpdateperfil()
    {
        $model = $this->adminService->verificarAccesoAdmin();
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
        $model = $this->adminService->verificarAccesoAdmin();
        $resultado = $this->cuentaService->procesarFormularioCambioPassword($model, Yii::$app->request->post());
        if ($resultado['exito']) {
            return $this->redirect(['cuenta']);
        }
        return $this->render('cuenta', [
            'model' => $resultado['formModel'] ?? new ChangePasswordForm(),
            'render' => 'updatepasswordperfil',
        ]);
    }




    public function actionUsuarioslist()
    {
        $this->adminService->verificarAccesoAdmin();
        $resultadoBusqueda = $this->adminService->listUsuarios(Yii::$app->request->queryParams);
        return $this->render('cuenta', [

            'searchModel' => $resultadoBusqueda['searchModel'],
            'dataProvider' => $resultadoBusqueda['dataProvider'],
            'render' => 'listau',
        ]);

    }
    public function actionCreate()
    {
        $this->adminService->verificarAccesoAdmin();
        $resultado = $this->adminService->nuevoUsuario(Yii::$app->request->post());
        if ($resultado['exito']) {
            return $this->redirect(['usuarioslist']);
        }
        return $this->render('cuenta', [
            'model' => $resultado['model'] ?? new Usuarios(),
            'render' => 'createusuario',

        ]);
    }

    public function actionView($id)
    {
        $this->adminService->verificarAccesoAdmin();
        $model = $this->adminService->obtenerUsuario($id);
        return $this->render('cuenta', [
            'model' => $model,
            'render' => 'verusuario',

        ]);
    }

    public function actionUpdate($id)
    {
        $this->adminService->verificarAccesoAdmin();
        $model = $this->adminService->findModel($id);
        $resultado = $this->adminService->actualizarUsuario(Yii::$app->request->post(), $id);
        if ($resultado['exito']) {
            return $this->redirect(['view', 'id' => $id]);
        }
        return $this->render('cuenta', [
            'model' => $model,
            'render' => 'updateusuario',

        ]);
    }


    public function actionEstado($id)
    {

        $this->adminService->verificarAccesoAdmin();
        $resultado = $this->adminService->cambiarEstadoUsuario($id);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'exito' => $resultado['exito'],
            'mensaje' => $resultado['mensaje'],
        ];
    }

    public function actionGetPaises()
    {
        $paises = $this->libService->obtenerPaises();
        return json_encode($paises);
    }


}
