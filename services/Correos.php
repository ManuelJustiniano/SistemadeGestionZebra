<?php

namespace app\components;

use app\models\Configuracion;
use Yii;
use yii\base\Component;
use yii\helpers\Html;
use yii\helpers\Url;

class Correos extends Component
{


    static public function nuevoEvento($model)
    {
        $conf = Configuracion::find()->one();
        // Verifica si la configuración fue encontrada
        if (!$conf) {
            Yii::error('No se encontró la configuración.');
            return false;
        }

        $mensaje2 = Html::tag('h1', '¡Se Registró un nuevo Diseño!');
        $mensaje2 .= Html::tag('h5', 'Los datos principales son:');
        $mensaje2 .= Html::tag('p', Html::tag('strong', 'Nombre:') . ' ' . Html::encode($model->titulo));
        $mensaje2 .= Html::tag('p', Html::tag('strong', 'Email:') . ' ' . Html::encode($model->email));


        /*/$mensaje2 .= Html::tag('p', 'sigue el link para ver el recalamo completo <a target="_blank" href="' . Url::to(['admin/reclamos/view?id='.$model->idreclamo], true) . '">clic aquí</a>');
*/
                   // Asegúrate de que el correo electrónico está definido

                  return Yii::$app->mailer->compose('layouts/template2', [
                    'content' => $mensaje2,
                    'config' => $conf,
                ])
                    ->setTo('jose_manuel3000@hotmail.com')
                    ->setFrom(['manueljustinia@gmail.com' => $conf->titulo_pagina])
                    ->setSubject($conf->titulo_pagina . ' - Se Registró un nuevo Diseño')
                    ->send();


    }

}