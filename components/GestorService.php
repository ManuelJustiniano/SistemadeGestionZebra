<?php
namespace app\components;

use app\models\Usuarios;
use Yii;

class GestorService implements InterfaceGestor
{
    public function obtenerUsuarioSesion()
    {
        $user = Yii::$app->session->get('user');
        if (empty($user)) {
            return null;
        }

        $usuario = Usuarios::findOne(['idusuario' => $user['id']]);

        // Verificar si el usuario existe y si su tipo de usuario es '1'
        if ($usuario !== null && $usuario->tipo_usuario == '2') {
            return $usuario;
        }

        return null;

    }


}