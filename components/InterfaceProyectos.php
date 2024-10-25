<?php
namespace app\components;

use app\models\Proyectos;

interface InterfaceProyectos
{
    public function obtenerUsuariosesion();
    public function listarProyectos($queryParams);
    public function nuevoProyecto($queryParams);
    public function prepararModeloAsignacion($idproyecto);
    public function procesarAsignacionTarea($model, $datosPost);
}


