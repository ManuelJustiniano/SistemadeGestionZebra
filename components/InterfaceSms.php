<?php
namespace app\components;

interface InterfaceSms
{
    public function enviarMensajebienvenida($to, $mensaje);
}