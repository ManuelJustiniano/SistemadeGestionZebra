<?php
namespace app\components;

interface InterfaceCorreos
{
    public function enviarCorreoBienvenida($model, $password);
}