<?php
namespace app\components;
use Yii;
use yii\base\Component;

class Validaciones extends Component
{
    static public function Validacionevent($model)
    {
        if ($model->save(false)) {
            Correos::nuevoEvento($model);
            Yii::$app->session->setFlash('mensaje', [
                'type' => 'success',
                'message' => 'Diseño registrado! Se revisará la información proporcionada y se le notificará si el evento fue aprobado o denegado y si tiene alguna observación.',
            ]);
            return Yii::$app->response->refresh();
        } else {
            // Si hubo error, establecer el mensaje de error
            Yii::$app->session->setFlash('error', ['message' => 'Se encontró algún error en el formulario']);
        }

    }


}