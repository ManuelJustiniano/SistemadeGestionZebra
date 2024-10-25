<?php
namespace app\components;

use app\models\Usuarios;
use Yii;

class NotiService implements InterfaceNoti
{

    public function setFlashMensaje($mensaje, $tipo)
    {
        Yii::$app->session->setFlash('mensaje', ['message' => $mensaje, 'type' => $tipo]);
    }

}