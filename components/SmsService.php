<?php

namespace app\components;

use app\models\Configuracion;
use app\models\Usuarios;
use Yii;
use yii\base\Component;
use yii\helpers\Html;
use yii\helpers\Url;

class SmsService implements InterfaceSms
{


    public function enviarMensajebienvenida($to, $mensaje)
    {

    }
        public function enviarCorreoRecuperacion($id, $password)
    {

    }


}