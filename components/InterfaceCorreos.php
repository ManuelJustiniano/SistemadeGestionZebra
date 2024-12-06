<?php
namespace app\components;

interface InterfaceCorreos
{
    public function enviarCorreodeBienvenida($model);
    public function enviarCorreodeEditar($model);
    public function enviarCorreoDeBloqueo($model);
    public function enviarCorreoDedesBloqueo($model);
    public function enviarCorreodeCreacionproyecto($model, $correoCliente);
    public function enviarCorreodeEdicionproyecto($model, $correoCliente);
    public function enviarCorreodeAsignacionproyecto($model, $correoConsultor);
    public function enviarCorreodeActualizacionAsignacion($id, $correoConsultor);
    public function enviarCorreoRecuperacion($id, $password);
}