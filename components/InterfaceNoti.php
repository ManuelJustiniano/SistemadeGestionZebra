<?php
namespace app\components;

interface InterfaceNoti
{
    public function agregarMensajeExito($mensaje);
    public function agregarMensajeError($mensaje);

}