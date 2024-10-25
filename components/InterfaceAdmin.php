<?php
namespace app\components;

interface InterfaceAdmin
{
    public function obtenerUsuarioSesion();
    public function listUsuarios($queryParams);
    public function nuevoUsuario($model, $password);

}