<?php
namespace app\components;

interface InterfaceCorreos
{
    public function enviarCorreodeBienvenida($model);
    public function enviarCorreoRecuperacion($id, $password);
}