<?php
namespace app\components;

use app\models\Tareas;
use app\models\TareasSearch;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use Yii;
use yii\web\NotFoundHttpException;

class AdminService implements InterfaceAdmin
{

    private $correoService;
    private $notiService;

    public function __construct(InterfaceCorreos $correoService, InterfaceNoti $notiService)
    {
        $this->correoService = $correoService;
        $this->notiService = $notiService;
    }

    public function obtenerUsuarioSesion()
    {
        $user = Yii::$app->session->get('user');
        if (empty($user)) {
            return null;
        }

        $usuario = Usuarios::findOne(['idusuario' => $user['id']]);

        // Verificar si el usuario existe y si su tipo de usuario es '1'
        if ($usuario !== null && $usuario->tipo_usuario == '1') {
            return $usuario;
        }

        return null;

    }


    public function listUsuarios($queryParams)
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search($queryParams);
        $dataProvider->setSort([
            'defaultOrder' => ['idusuario' => SORT_DESC]
        ]);
        return [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ];

    }

    public function obtenerCliente($id)
    {
        return $this->findModel($id);
    }

    public function nuevoUsuario($postData)
    {

        $model = new Usuarios();
        if ($model->load($postData) && $model->validate()) {
            $password = $postData['contrasena'] ?? '';
            $model->contrasena = Yii::$app->security->generatePasswordHash($password);
            if ($model->save()) {
                $correoEnviado = $this->correoService->enviarCorreodeBienvenida($model);
                if ($correoEnviado) {
                    $this->notiService->agregarMensajeExito('El usuario ha sido creado correctamente.');
                    return ['exito' => true];
                } else {
                    $this->notiService->agregarMensajeError('Error en el envío de correo, inténtelo más tarde.');
                    return ['exito' => false, 'model' => $model];
                }
            } else {
                $this->notiService->agregarMensajeError('Error al crear usuario. Inténtelo más tarde.');
                return ['exito' => false, 'model' => $model];
            }
        }
        //$this->notiService->agregarMensajeError('Error al validar usuario.');
        return ['exito' => false, 'model' => $model];



    }



    public function actualizarUsuario($dates, $id)
    {
        $model = $this->findModel($id);
        if ($model->load($dates) && $model->validate()) {
            if ($model->save()) {
                $this->notiService->agregarMensajeExito('El cliente ha sido actualizado correctamente.');
                return [
                    'exito' => true,
                    'model' => $model
                ];
            } else {
                $this->notiService->agregarMensajeError('Error al actualizar el cliente. Inténtelo más tarde.');
                return [
                    'exito' => false,
                    'model' => $model
                ];
            }
        }
       /* $this->notiService->agregarMensajeError('Error al validar los datos del cliente.');
        return [
            'exito' => false,
            'model' => $model
        ];*/
    }


    public function findModel($id)
    {
        if (($model = Usuarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }


}