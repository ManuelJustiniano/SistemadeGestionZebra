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
    private $alertService;

    public function __construct(InterfaceCorreos $correoService, InterfaceAlert $alertService)
    {
        $this->correoService = $correoService;
        $this->alertService = $alertService;
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

    public function verificarAccesoAdmin()
    {
        $usuario = $this->obtenerUsuarioSesion();
        if ($usuario === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            Yii::$app->controller->redirect(Yii::$app->request->referrer ?: ['site/login']);
            Yii::$app->end(); // Termina la ejecución del script, ya que la redirección se realizará aquí
        }
        return $usuario;
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

    public function obtenerUsuario($id)
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
                    $this->alertService->agregarMensajeExito('El usuario ha sido creado correctamente.');
                    return ['exito' => true];
                } else {
                    $this->alertService->agregarMensajeError('Error en el envío de correo, inténtelo más tarde.');
                    return ['exito' => false, 'model' => $model];
                }
            } else {
                $this->alertService->agregarMensajeError('Error al crear usuario. Inténtelo más tarde.');
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
                $correoEnviado = $this->correoService->enviarCorreodeEditar($model);
                if ($correoEnviado) {
                    $this->alertService->agregarMensajeExito('El usuario ha sido Actualizado correctamente.');
                    return ['exito' => true];
                } else {
                    $this->alertService->agregarMensajeError('Error en el envío de correo, inténtelo más tarde.');
                    return ['exito' => false, 'model' => $model];
                }

            } else {
                $this->alertService->agregarMensajeError('Error al actualizar el cliente. Inténtelo más tarde.');
                return [
                    'exito' => false,
                    'model' => $model
                ];
            }
        }

    }

    public function cambiarEstadoUsuario($id)
    {


        $model = $this->findModel($id);
        if ($model === null) {
            return [
                'exito' => false,
                'mensaje' => 'Usuario no encontrado.',
            ];
        }

        $estadoAnterior = $model->estado;
        $model->estado = (string)!$model->estado;

        if ($model->save()) {
            if ($estadoAnterior == '1') {
                $correoEnviado = $this->correoService->enviarCorreoDeBloqueo($model);
                $mensaje = 'El estado del usuario ha sido cambiado a bloqueado y se ha enviado el correo de notificación.';
            } else {
                $correoEnviado = $this->correoService->enviarCorreoDedesBloqueo($model);
                $mensaje = 'El estado del usuario ha sido cambiado a activado.';
            }

            return [
                'exito' => true,
                'mensaje' => $mensaje,
            ];
        } else {
            return [
                'exito' => false,
                'mensaje' => 'Hubo un error al actualizar el estado del usuario.',
            ];
        }
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