<?php

namespace app\controllers;

use app\components\InterfaceCuenta;
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

class CuentaController extends Controller
{

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


    public function __construct($id, $module, InterfaceCuenta $cuentaService, $config = [])
    {
        $this->cuentaService = $cuentaService;
        parent::__construct($id, $module, $config);
    }


      public function actionUpdateperfil()
    {

        if ($model->load(Yii::$app->request->post())) {
            if ($this->cuentaService->actualizarUsuario($model)) {
                Yii::$app->session->setFlash('mensaje', ['message' => 'Tu perfil ha sido actualizado correctamente.', 'type' => 'success']);
                return $this->redirect(['cuenta']);
            }
        }
        return $this->render('cuenta', [
            'model' => $model,
            'render' => 'updateperfil',
        ]);
    }


    public function actionForget()
    {
        $this->layout = "login";
        $model = new Forget();
        if ($model->load(Yii::$app->request->post())) {
            $resultadoRecuperacion = $this->cuentaService->recuperacionCuenta($model->email);
            if ($resultadoRecuperacion['exito']) {
                Yii::$app->session->setFlash('success', ['message' => $resultadoRecuperacion['mensaje'], 'type' => 'success']);
            } else {
                Yii::$app->session->setFlash('error', ['message' => $resultadoRecuperacion['mensaje']]);

            }
            return $this->refresh();

        }

        return $this->render('forget', [
            'model' => $model,
        ]);
    }




    public function actionUpdatepasswordperfil()
    {
        $model = $this->cuentaService->obtenerUsuarioSesion();
        if ($model === null) {
            return $this->redirect(['site/login']);
        }

        $changePasswordForm = new ChangePasswordForm();
        if ($changePasswordForm->load(Yii::$app->request->post()) && $changePasswordForm->validate()) {
            if ($this->cuentaService->cambiarPassword($model, $changePasswordForm->newPassword)) {
                Yii::$app->session->setFlash('mensaje', ['message' => 'Tu contraseña ha sido actualizada correctamente1222.', 'type' => 'success']);
                return $this->redirect(['cuenta']);
            }
        }

        return $this->render('cuenta', [
            'model' => $changePasswordForm,
            'render' => 'updatepasswordperfil',
        ]);
    }






}
