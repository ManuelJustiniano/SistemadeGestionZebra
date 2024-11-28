<?php
namespace app\components;

use app\models\Proyectos;

interface InterfaceProyectos
{
    public function obtenerUsuariosesion();
    public function listarProyectos($queryParams);
    public function nuevoProyecto($queryParams);
    public function obtenerProyecto($id);
    public function actualizarProyecto($dates, $id);
}


