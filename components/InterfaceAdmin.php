<?php
namespace app\components;

interface InterfaceAdmin
{
    public function verificarAccesoAdmin();
    public function listUsuarios($queryParams);
    public function obtenerUsuario($id);
    public function nuevoUsuario($postData);
    public function actualizarUsuario($dates, $id);
    public function cambiarEstadoUsuario($id);

}