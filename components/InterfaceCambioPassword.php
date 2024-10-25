<?php
namespace app\components;

interface InterfaceCambioPassword
{
    public function cambiarPassword($usuario, $newPassword);
    public function procesarFormularioCambioPassword($usuario, $datosPost);

}