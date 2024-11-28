<?php
namespace app\components;

use app\models\Asignacion;
use app\models\Proyectos;
use app\models\ProyectosSearch;
use app\models\Tareas;
use app\models\TareasSearch;
use app\models\Usuarios;
use Yii;
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
                    $correoCliente = $cliente->email; // Obtener el correo del cliente
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
        //$this->notiService->agregarMensajeError('Error al validar usuario.');
        return ['exito' => false, 'model' => $model];
    }





    public function obtenerProyectoPorId($proyectoId)
    {
        return Proyectos::findOne(['idproyecto' => $proyectoId]);
    }


    public function actualizarProyecto($dates, $id)
    {

        $model = $this->findModel($id);

        if ($model->load($dates) && $model->validate()) {
            if ($model->save()) {
                $this->notiService->agregarMensajeExito('El proyecto ha sido Actualizado correctamente.');
                return ['exito' => true];
            } else {
                $this->notiService->agregarMensajeError('Error al actualizar el proyecto, inténtelo más tarde.');
                return ['exito' => false, 'model' => $model];
            }

        } else {
            $this->notiService->agregarMensajeError('Error al actualizar el proyecto. Inténtelo más tarde.');
            return [
                'exito' => false,
                'model' => $model
            ];
        }

        return ['exito' => false, 'model' => $model];
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