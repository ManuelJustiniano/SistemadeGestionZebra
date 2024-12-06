<?php
namespace app\components;

use app\models\Proyectos;

interface InterfaceAsignacion
{
    public function obtenerUsuariosesion();
    public function prepararModeloAsignacion($idproyecto);
    public function procesarAsignacionTarea($model, $datosPost);
    public function procesarEdicionAsignacion($id, $datosPost);
    public function obtenerAsignacionPorId($id);

}


