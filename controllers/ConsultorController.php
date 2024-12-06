<?php

namespace app\controllers;

use app\components\InterfaceAdmin;
use app\components\InterfaceConsultor;
use app\components\InterfaceCuenta;
use app\components\InterfaceGestor;
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

class ConsultorController extends Controller
{

    private $consultorService;
    private $cuentaService;
    private $paisesService;
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



    public function __construct($id, $module, InterfaceConsultor $consultorService, InterfaceLib $paisesService,  InterfaceCuenta $cuentaService,$config = [])
    {
        $this->consultorService = $consultorService;
        $this->cuentaService = $cuentaService;
        $this->paisesService = $paisesService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        return $this->redirect(['consultor/cuenta']);
    }
    public function actionCuenta()
    {
        $model = $this->consultorService->verificarAccesoAdmin();
        return $this->render('cuenta', [
            'model' => $model,
            'render' => 'perfil',
        ]);
    }


    public function actionUpdateperfil()
    {
        $model = $this->consultorService->verificarAccesoAdmin();
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
        $model = $this->consultorService->verificarAccesoAdmin();
        $resultado = $this->cuentaService->procesarFormularioCambioPassword($model, Yii::$app->request->post());
        if ($resultado['exito']) {
            return $this->redirect(['cuenta']);
        }
        return $this->render('cuenta', [
            'model' => $resultado['formModel'] ?? new ChangePasswordForm(),
            'render' => 'updatepasswordperfil',
        ]);
    }

    public function actionGetPaises()
    {
        $paises = $this->paisesService->obtenerPaises();
        return json_encode($paises);
    }



}
