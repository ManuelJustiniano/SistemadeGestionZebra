<?php
namespace app\components;

interface InterfaceTarea
{
    public function verificarAccesoAdmin();
    public function listTareas($queryParams);
    public function nuevaTarea($queryParams);
    public function actualizarTarea($dates, $id);
    public function findModel($id);
    public function cambiarEstadoTarea($id);

}


