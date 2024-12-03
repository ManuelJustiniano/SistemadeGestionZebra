<?php

namespace app\components;

use app\models\Configuracion;
use app\models\Usuarios;
use Yii;
use yii\base\Component;
use yii\helpers\Html;
use yii\helpers\Url;

class CorreoService implements InterfaceCorreos
{


    public function enviarCorreodeBienvenida($model)
    {
        $conf = Configuracion::find()->one();
        $mensaje = Html::tag('h1', '¡Te damos la bienvenida, ' . $model->nombrecompleto . '!');
        $mensaje .= Html::tag('p', 'Gracias por ser parte de Zebra Brand Consulting');
        $mensaje .= Html::tag('h5', 'Sus datos son:');
        $mensaje .= Html::tag('p', Html::tag('strong', 'Usuario:') . ' ' . $model->usuario);
        $mensaje .= Html::tag('p', 'Puedes entrar al sistema dando <a target="_blank" href="' . Url::to(['site/login'], true) . '">clic aquí</a>');

        $result = Yii::$app->mailer->compose('layouts/template2', [
            'content' => $mensaje,
            'config' => $conf,
        ])
            ->setTo($model->email)
            ->setFrom([$conf->email => $conf->titulo_pagina])
            ->setSubject($conf->titulo_pagina . ' - Registro completo')
            ->setHtmlBody($mensaje)
            ->send();
        if ($result) {
            return true; // Retorna true si el envío fue exitoso.
        } else {
            Yii::error("El correo no pudo ser enviado por razones desconocidas.", __METHOD__);
            return false;
        }
    }


    public function enviarCorreodeEditar($model)
    {
        $conf = Configuracion::find()->one();
        $mensaje = Html::tag('h1', '¡Estimado: ' . $model->nombrecompleto . '!');
        $mensaje .= Html::tag('p', 'Comentarle que sus datos personales fueron editados');
        $mensaje .= Html::tag('p', 'Entrar al a su perfil ');

        $result = Yii::$app->mailer->compose('layouts/template2', [
            'content' => $mensaje,
            'config' => $conf,
        ])
            ->setTo($model->email)
            ->setFrom([$conf->email => $conf->titulo_pagina])
            ->setSubject($conf->titulo_pagina . ' - Edicion de cuenta')
            ->setHtmlBody($mensaje)
            ->send();
        if ($result) {
            return true; // Retorna true si el envío fue exitoso.
        } else {
            Yii::error("El correo no pudo ser enviado por razones desconocidas.", __METHOD__);
            return false;
        }
    }


    public function enviarCorreoDeBloqueo($model)
    {
        $conf = Configuracion::find()->one();
        $mensaje = Html::tag('h1', '¡Estimado: ' . $model->nombrecompleto . '!');
        $mensaje .= Html::tag('p', 'Comentarle que su cuenta ha sido Bloqueada');
        $mensaje .= Html::tag('p', 'Entrar al a su perfil');

        $result = Yii::$app->mailer->compose('layouts/template2', [
            'content' => $mensaje,
            'config' => $conf,
        ])
            ->setTo($model->email)
            ->setFrom([$conf->email => $conf->titulo_pagina])
            ->setSubject($conf->titulo_pagina . ' - Bloqueo de cuenta')
            ->setHtmlBody($mensaje)
            ->send();
        if ($result) {
            return true; // Retorna true si el envío fue exitoso.
        } else {
            Yii::error("El correo no pudo ser enviado por razones desconocidas.", __METHOD__);
            return false;
        }
    }
    public function enviarCorreoDedesBloqueo($model)
    {
        $conf = Configuracion::find()->one();
        $mensaje = Html::tag('h1', '¡Estimado: ' . $model->nombrecompleto . '!');
        $mensaje .= Html::tag('p', 'Comentarle que su cuenta ha sido Activada nuevamente');
        $mensaje .= Html::tag('p', 'Entrar al a su perfil');

        $result = Yii::$app->mailer->compose('layouts/template2', [
            'content' => $mensaje,
            'config' => $conf,
        ])
            ->setTo($model->email)
            ->setFrom([$conf->email => $conf->titulo_pagina])
            ->setSubject($conf->titulo_pagina . ' - Activacion de cuenta')
            ->setHtmlBody($mensaje)
            ->send();
        if ($result) {
            return true; // Retorna true si el envío fue exitoso.
        } else {
            Yii::error("El correo no pudo ser enviado por razones desconocidas.", __METHOD__);
            return false;
        }
    }


    public function enviarCorreoRecuperacion($id, $password)
    {
        $pass = Usuarios::findOne(['idusuario' => $id]);
        $conf = Configuracion::find()->one();
        $mensaje = Html::tag('h1', '¡Recuperacion de contraseña!');
        $mensaje .= Html::tag('p', 'Estimado Usuario se reinicio su contraseña a una nueva.');
        $mensaje .= Html::tag('h5', 'Sus datos de accesos son:');
        $mensaje .= Html::tag('p', Html::tag('strong', 'Usuario:') . ' ' . $pass->usuario);
        $mensaje .= Html::tag('p', Html::tag('strong', 'Contraseña:') . ' ' . $password);

        $result = Yii::$app->mailer->compose('layouts/template2', [
            'content' => $mensaje,
            'config' => $conf,
        ])
            ->setTo($pass->email)
            ->setFrom([$conf->email => $conf->titulo_pagina])
            ->setSubject($conf->titulo_pagina . ' - Recuperacion de contraseña')
            ->send();

        if ($result) {
            return true; // Retorna true si el envío fue exitoso.
        } else {
            Yii::error("El correo no pudo ser enviado por razones desconocidas.", __METHOD__);
            return false;
        }

    }



    public function enviarCorreodeCreacionproyecto($model, $correoCliente)
    {
        $conf = Configuracion::find()->one();
        $mensaje = Html::tag('h1', '¡Estimado: cliente');
        $mensaje .= Html::tag('p', 'Comentarle que su proyecto fue creado exitosamente!');
        $mensaje .= Html::tag('p', 'Entrar al a su perfil ');

        $result = Yii::$app->mailer->compose('layouts/template2', [
            'content' => $mensaje,
            'config' => $conf,
        ])
            ->setTo($correoCliente)
            ->setFrom([$conf->email => $conf->titulo_pagina])
            ->setSubject($conf->titulo_pagina . ' - Creacion de Proyecto - Zebra Brand Consulting')
            ->setHtmlBody($mensaje)
            ->send();
        if ($result) {
            return true; // Retorna true si el envío fue exitoso.
        } else {
            Yii::error("El correo no pudo ser enviado por razones desconocidas.", __METHOD__);
            return false;
        }

    }


    public function enviarCorreodeEdicionproyecto($model, $correoCliente)
    {
        $conf = Configuracion::find()->one();
        $mensaje = Html::tag('h1', '¡Estimado: cliente');
        $mensaje .= Html::tag('p', 'Comentarle que su proyecto fue editado!');
        $mensaje .= Html::tag('p', 'Consultar');

        $result = Yii::$app->mailer->compose('layouts/template2', [
            'content' => $mensaje,
            'config' => $conf,
        ])
            ->setTo($correoCliente)
            ->setFrom([$conf->email => $conf->titulo_pagina])
            ->setSubject($conf->titulo_pagina . ' - Edicion de Proyecto - Zebra Brand Consulting')
            ->setHtmlBody($mensaje)
            ->send();
        if ($result) {
            return true; // Retorna true si el envío fue exitoso.
        } else {
            Yii::error("El correo no pudo ser enviado por razones desconocidas.", __METHOD__);
            return false;
        }

    }





    public function enviarCorreodeAsignacionproyecto($model, $correoConsultor)
    {
        $conf = Configuracion::find()->one();
        $mensaje = Html::tag('h1', '¡Estimado: Consultor');
        $mensaje .= Html::tag('p', 'Comentarle que se le asigno una tarea del proyecto');
        $mensaje .= Html::tag('p', 'Entrar al a su perfil ');

        $result = Yii::$app->mailer->compose('layouts/template2', [
            'content' => $mensaje,
            'config' => $conf,
        ])
            ->setTo($correoConsultor)
            ->setFrom([$conf->email => $conf->titulo_pagina])
            ->setSubject($conf->titulo_pagina . ' - Asignacion de proyecto  ')
            ->setHtmlBody($mensaje)
            ->send();
        if ($result) {
            return true; // Retorna true si el envío fue exitoso.
        } else {
            Yii::error("El correo no pudo ser enviado por razones desconocidas.", __METHOD__);
            return false;
        }

    }


}