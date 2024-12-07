<?php
namespace app\components;

interface InterfaceGestionProyecto
{
    public function listarProyectos($queryParams);
    public function listarmisProyectos($params);
    public function verificarAccesoAdmingestor();
    public function verificarAccesoCons();
    public function nuevoProyecto($queryParams);
    public function aceptarTarea($id);
    public function confirmarAceptacion($idTarea, $estadoTarea, $comentarioTarea);
    public function actualizarProyecto($dates, $id);
    public function prepararModeloAsignacion($idproyecto);
    public function procesarEdicionAsignacion($id, $datosPost);
    public function obtenerProyecto($id);
    public function obtenerProyectoasignado($id);
    public function obtenerAsignacionPorId($id);
}