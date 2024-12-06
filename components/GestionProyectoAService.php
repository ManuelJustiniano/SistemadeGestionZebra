<?php
namespace app\components;
use app\models\Tareas;
use app\models\TareasSearch;
use app\models\Usuarios;
use Yii;
use yii\web\NotFoundHttpException;

class GestionProyectoAService implements InterfaceGestionProyecto
{
    private $proyectosService;
    private $asignacionService;


    public function __construct(InterfaceProyectos $proyectosService, InterfaceAsignacion $asignacionService)
    {
        $this->proyectosService = $proyectosService;
        $this->asignacionService = $asignacionService;
    }

    public function verificarAccesoAdmingestor()
    {
        return $this->proyectosService->verificarAccesoAdmingestor();
    }

    public function verificarAccesoCons()
    {
        return $this->proyectosService->verificarAccesoCons();
    }
        public function listarProyectos($queryParams)
    {
        return $this->proyectosService->listarProyectos($queryParams);
    }

    public function listarmisProyectos($params)
    {
        return $this->proyectosService->listarmisProyectos($params);
    }

    public function nuevoProyecto($queryParams)
    {
        return $this->proyectosService->nuevoProyecto($queryParams);
    }

    public function actualizarProyecto($dates, $id)
    {
        return $this->proyectosService->actualizarProyecto($dates, $id);
    }
    public function obtenerProyecto($id)
    {
        return $this->proyectosService->obtenerProyecto($id);
    }


    public function obtenerProyectoasignado($id)
    {
        return $this->proyectosService->obtenerProyectoasignado($id);
    }
    public function prepararModeloAsignacion($idproyecto)
    {

        return $this->asignacionService->prepararModeloAsignacion($idproyecto);
    }
    public function procesarAsignacionTarea($model, $datosPost)
    {
        return $this->asignacionService->procesarAsignacionTarea($model, $datosPost);
    }

    public function procesarEdicionAsignacion($id, $datosPost)
    {
        return $this->asignacionService->procesarEdicionAsignacion($id, $datosPost);
    }


    public function cambiarEstadoproyecto($id)
    {
        return $this->proyectosService->cambiarEstadoproyecto($id);
    }

    public function obtenerAsignacionPorId($id)
    {
        return $this->asignacionService->obtenerAsignacionPorId($id);
    }


    public function findModel($id)
    {
        return $this->proyectosService->obtenerProyecto($id);
    }

}