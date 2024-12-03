<?php
namespace app\components;

use app\models\Asignacion;
use app\models\Proyectos;
use app\models\ProyectosSearch;
use app\models\Usuarios;
use Yii;
use yii\base\ExitException;
use yii\web\NotFoundHttpException;

class ProyectosService implements InterfaceProyectos
{
    private $correoService;
    private $notiService;
    public function __construct(InterfaceCorreos $correoService, InterfaceNoti $notiService)
    {
        $this->correoService = $correoService;
        $this->notiService = $notiService;
    }


    public function obtenerUsuarioSesionadmingestor()
    {
        $user = Yii::$app->session->get('user');
        if (empty($user)) {
            return null;
        }
        $usuario = Usuarios::findOne(['idusuario' => $user['id']]);
        if ($usuario !== null && in_array($usuario->tipo_usuario, ['1', '2'])) {
            return $usuario;
        }
        return null;
    }

    /**
     * @throws ExitException
     */
    public function verificarAccesoAdmingestor()
    {
        $usuario = $this->obtenerUsuarioSesionadmingestor();
        if ($usuario === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            Yii::$app->controller->redirect(Yii::$app->request->referrer ?: ['site/login']);
            Yii::$app->end();
        }
        return $usuario;
    }


    public function listarProyectos($queryParams)
    {
        $searchModel = new ProyectosSearch();
        $dataProvider = $searchModel->search($queryParams);
        $dataProvider->setSort([
            'defaultOrder' => ['idproyecto' => SORT_DESC]
        ]);
        return [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ];

    }
    public function obtenerProyecto($id)
    {
        return $this->findModel($id);
    }


    public function nuevoProyecto($queryParams)
    {

        $model = new Proyectos();
        $user = Yii::$app->session->get('user');
        $usuario = Usuarios::findOne(['idusuario' => $user['id']]);
        $model->idgestor =  $usuario->idusuario;
        if ($model->load($queryParams) && $model->validate()) {
            if ($model->save()) {
                $cliente = $model->cliente;
                if ($cliente !== null) {
                    $correoCliente = $cliente->email;
                    $correoEnviado = $this->correoService->enviarCorreodeCreacionproyecto($model, $correoCliente);
                    if (!$correoEnviado) {
                        $this->notiService->agregarMensajeError('Error al enviar el correo al cliente. Inténtelo más tarde.');
                    }
                }
                if ($correoEnviado) {
                    $this->notiService->agregarMensajeExito('Se creó el proyecto correctamente');
                    return ['exito' => true];
                } else {
                    $this->notiService->agregarMensajeError('Error en el envío de correo, inténtelo más tarde.');

                    return ['exito' => false, 'model' => $model];
                }

        } else {
            $this->notiService->agregarMensajeError('Error al crear proyecto. Inténtelo más tarde.');
            return ['exito' => false, 'model' => $model];
        }
        }
        return ['exito' => false, 'model' => $model];
    }





    public function obtenerProyectoPorId($proyectoId)
    {
        return Proyectos::findOne(['idproyecto' => $proyectoId]);
    }


    public function actualizarProyecto($dates, $id)
    {

        $model = $this->findModel($id);
        $clienteOriginal = $model->getOldAttribute('idcliente');
        if ($model->load($dates) && $model->validate()) {
            if ($model->idcliente != $clienteOriginal) {
                $this->notiService->agregarMensajeError('El cliente no puede ser cambiado durante la actualización del proyecto.');
                return ['exito' => false, 'model' => $model];
            }

            if ($model->save()) {
                $cliente = $model->cliente;
                if ($cliente !== null) {
                    $correoCliente = $cliente->email;
                    $correoEnviado = $this->correoService->enviarCorreodeEdicionproyecto($model, $correoCliente);
                    if (!$correoEnviado) {
                        $this->notiService->agregarMensajeError('Error al enviar el correo al cliente. Inténtelo más tarde.');
                    }
                }
                if ($correoEnviado) {
                    $this->notiService->agregarMensajeExito('El proyecto ha sido Actualizado correctamente.');
                    return ['exito' => true];
                } else {
                    $this->notiService->agregarMensajeError('Error al actualizar el proyecto, inténtelo más tarde.');
                    return ['exito' => false, 'model' => $model];
                }

            } else {
                $this->notiService->agregarMensajeError('Error al actualizar el proyecto, inténtelo más tarde.');
                return ['exito' => false, 'model' => $model];
            }

        }
        return ['exito' => false, 'model' => $model];
    }



    public function cambiarEstadoproyecto($id)
    {
        $model = $this->findModel($id);
        $estadoAnterior = $model->estado;
        $model->estado = (string)!$model->estado;
        if ($model->save()) {
            if ($estadoAnterior == '1') {
                $mensaje = 'El estado del proyecto ha sido cambiado a bloqueado';
            } else {
                $mensaje = 'El estado del proyecto ha sido cambiado a activado';
            }
            return [
                'exito' => true,
                'mensaje' => $mensaje,
            ];
        } else {
            return [
                'exito' => false,
                'mensaje' => 'Hubo un error al actualizar el estado del proyecto.',
            ];
        }
    }


    /**
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = ProyectosSearch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}