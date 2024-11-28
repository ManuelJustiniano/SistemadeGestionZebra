<?php
namespace app\components;

interface InterfaceCorreos
{
    public function enviarCorreodeBienvenida($model);
    public function enviarCorreodeEditar($model);
    public function enviarCorreodeCreacionproyecto($model, $correoCliente);
    public function enviarCorreoRecuperacion($id, $password);
}