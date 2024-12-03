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

    public function obtenerAsignacionPorId($asignacionId)
    {
        return Asignacion::findOne(['idasignacion' => $asignacionId]);
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