<?php

namespace app\components;

use app\models\Configuracion;
use Yii;
use yii\base\Component;
use yii\helpers\Html;
use yii\helpers\Url;

class Correos implements InterfaceCorreos
{



    public function enviarCorreoBienvenida($model, $password)
    {
        $conf = Configuracion::find()->one();
        $mensaje = Html::tag('h1', '¡Te damos la bienvenida, ' . $model->nombrecompleto . '!');
        $mensaje .= Html::tag('p', 'Gracias por ser parte de Zebra Brand Consulting');
        $mensaje .= Html::tag('h5', 'Tus datos de acceso son:');
        $mensaje .= Html::tag('p', Html::tag('strong', 'Usuario:') . ' ' . $model->usuario);
        $mensaje .= Html::tag('p', Html::tag('strong', 'Contraseña:') . ' ' . $password);
        $mensaje .= Html::tag('p', 'Puedes entrar a tu perfil <a target="_blank" href="' . Url::to(['cliente/cuenta'], true) . '">clic aquí</a>');

        Yii::$app->mailer->compose()
            ->setTo($model->email)
            ->setFrom([$conf->email => $conf->titulo_pagina])
            ->setSubject($conf->titulo_pagina . ' - Registro completo')
            ->setHtmlBody($mensaje)
            ->send();
    }



    static public function nuevoEvento($model)
    {
        $conf = Configuracion::find()->one();
        // Verifica si la configuración fue encontrada
        if (!$conf) {
            Yii::error('No se encontró la configuración.');
            return false;
        }


        $mensaje2 = Html::tag('h1', '¡Se Registró un nuevo Evento!');
        $mensaje2 .= Html::tag('h5', 'Los datos principales son:');
        $mensaje2 .= Html::tag('p', Html::tag('strong', 'Nombre:') . ' ' . Html::encode($model->titulo));
        $mensaje2 .= Html::tag('p', Html::tag('strong', 'Email:') . ' ' . Html::encode($model->email));




                  return Yii::$app->mailer->compose('layouts/template2', [
                    'content' => $mensaje2,
                    'config' => $conf,
                ])
                    ->setTo('jose_manuel3000@hotmail.com')
                    ->setFrom(['manueljustinia@gmail.com' => $conf->titulo_pagina])
                    ->setSubject($conf->titulo_pagina . ' - Se Registró un nuevo Evento')
                    ->send();


    }

}