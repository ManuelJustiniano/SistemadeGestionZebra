<?php
namespace app\components;

use app\models\Proyectos;

interface InterfaceProyectos
{
    public function verificarAccesoAdmingestor();
    public function verificarAccesoCons();
    public function listarProyectos($queryParams);
    public function listarmisProyectos($params);
    public function nuevoProyecto($queryParams);
    public function obtenerProyecto($id);

    public function obtenerProyectoasignado($id);
    public function actualizarProyecto($dates, $id);
    public function cambiarEstadoproyecto($id);



}


