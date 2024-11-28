<?php
namespace app\components;

interface InterfaceAdmin
{
    public function obtenerUsuarioSesion();

    public function listUsuarios($queryParams);

    public function nuevoUsuario($postData);
    public function actualizarUsuario($dates, $id);
    public function cambiarEstadoUsuario($id);

}