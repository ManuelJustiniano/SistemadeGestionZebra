<?php
namespace app\components;

use app\models\Asignacion;
use app\models\AsignacionSearch;
use app\models\Proyectos;
use app\models\ProyectosSearch;
use app\models\Tareas;
use app\models\TareasSearch;
use app\models\Usuarios;
use Yii;
use yii\web\NotFoundHttpException;

class AsignacionService implements InterfaceAsignacion
{
    private $notiService;
    private $correoService;

    public function __construct(InterfaceCorreos $correoService, InterfaceNoti $notiService)
    {
        $this->correoService = $correoService;
        $this->notiService = $notiService;
    }

    public function obtenerUsuarioSesion(): ?Usuarios
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


    public function prepararModeloAsignacion($idproyecto)
    {
        $proyecto = Proyectos::findOne(['idproyecto' => $idproyecto]);
        if (!$proyecto) {
            return null;
        }
        $model = new Asignacion();
        $model->idproyecto = $idproyecto;
        return $model;
    }

    public function procesarAsignacionTarea($model, $datosPost)
    {


        if ($model->load($datosPost) && $model->validate()) {
            if ($model->save()) {
                $consultor = $model->consultor;
                if ($consultor !== null) {
                    $correoConsultor = $consultor->email;
                    $correoEnviado = $this->correoService->enviarCorreodeAsignacionproyecto($model, $correoConsultor);
                    if (!$correoEnviado) {
                        $this->notiService->agregarMensajeError('Error al enviar el correo al consultor. Inténtelo más tarde.');
                    }
                }
                if ($correoEnviado) {

                    $this->notiService->agregarMensajeExito('Se Asigno correctamente');
                    return ['exito' => true];
                } else {
                    $this->notiService->agregarMensajeError('Error en el envío de correo, inténtelo más tarde.');

                    return ['exito' => false, 'model' => $model];
                }


            }
            else {
                $this->notiService->agregarMensajeError('Error al asignar, inténtelo más tarde.');
                return ['exito' => false, 'model' => $model];
            }
        }

    }


    public function procesarEdicionAsignacion($id, $datosPost)
    {
        $model = $this->findModel($id);

        // Carga de datos y validación
        if ($model->load($datosPost) && $model->validate()) {
            try {
                if ($model->save()) {
                    $consultor = $model->consultor;
                    if ($consultor !== null) {
                        $correoConsultor = $consultor->email;
                        $correoEnviado = $this->correoService->enviarCorreodeActualizacionAsignacion($model, $correoConsultor);
                        if (!$correoEnviado) {
                            $this->notiService->agregarMensajeError('Error al enviar el correo al consultor. Inténtelo más tarde.');
                        }
                    }
                    $this->notiService->agregarMensajeExito('La asignación se actualizó correctamente.');
                    return ['exito' => true];
                } else {
                    $this->notiService->agregarMensajeError('Error al actualizar la asignación. Inténtelo más tarde.');
                }
            } catch (\yii\db\IntegrityException $e) {
                $model->addError('idconsultor', 'Esta combinación de tarea y consultor ya existe.');
                $model->addError('idtarea', 'Esta combinación de tarea y consultor ya existe.');
            }
        }
        Yii::$app->session->setFlash('error', 'Error al editar la asginacion, el consultor ya fue asginado a esta tarea');
        return ['exito' => false, 'model' => $model];
    }


    public function obtenerAsignacionPorId($asignacionId)
    {
        return $this->findModel($asignacionId);
    }


    public function aceptarTarea($id)
    {
        $model = $this->findModel($id); // Busca el modelo por ID
        $model->estado = 2; // Cambia el estado a 2
        if ($model->save()) {
            return [
                'success' => true,
                'message' => 'Tarea aceptada correctamente, en espera de confirmacion al admin.',
            ];
        } else {
            return [
                'success' => false,
                'message' => 'No se pudo aceptar la tarea.',
            ];
        }
    }


    public function confirmarAceptacion($idTarea, $estadoTarea, $comentarioTarea)
    {
        $model = $this->findModel($idTarea);
        $model->aceptacionadmin = $estadoTarea;
        $model->comentario = $comentarioTarea;
        if ($model->save()) {
            return [
                'success' => true,
                'message' => 'Tarea gestionada correctamente.',
            ];
        }
        return [
            'success' => false,
            'message' => 'No se pudo gestionar la tarea.',
        ];
    }


    /**
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = AsignacionSearch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}