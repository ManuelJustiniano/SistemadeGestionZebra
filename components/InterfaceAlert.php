<?php
namespace app\components;

interface InterfaceAlert
{
    public function agregarMensajeExito($mensaje);
    public function agregarMensajeError($mensaje);

}