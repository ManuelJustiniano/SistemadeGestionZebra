<?php
namespace app\components;

interface InterfaceTarea
{
    public function obtenerUsuariosesion();
    public function listTareas($queryParams);
    public function nuevaTarea($queryParams);
    public function actualizarTarea($id);
    public function findModel($id);
}


