<?php
namespace app\components;

interface InterfaceGestionProyecto
{
    public function listarProyectos($queryParams);
    public function obtenerUsuarioSesion();
    public function nuevoProyecto($queryParams);
    public function actualizarProyecto($dates, $id);
    public function prepararModeloAsignacion($idproyecto);
    public function procesarAsignacionTarea($model, $datosPost);
    public function obtenerProyecto($id);
}