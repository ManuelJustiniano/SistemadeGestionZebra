<?php
namespace app\components;

use app\models\Proyectos;

interface InterfaceProyectos
{
    public function verificarAccesoAdmingestor();
    public function listarProyectos($queryParams);
    public function nuevoProyecto($queryParams);
    public function obtenerProyecto($id);
    public function actualizarProyecto($dates, $id);
    public function cambiarEstadoproyecto($id);



}


