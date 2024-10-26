<?php
namespace app\components;

interface InterfaceCorreos
{
    public function enviarCorreodeBienvenida($model, $password);
}