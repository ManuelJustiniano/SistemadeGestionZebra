<?php
namespace app\components;

interface InterfaceCuenta
{
    public function actualizarUsuario($model, $datosPost);
    public function cambiarPassword($usuario, $newPassword);
    public function procesarFormularioCambioPassword($model, $datosPost);
}