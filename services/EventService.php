<?php
namespace app\services;

use app\components\Validaciones;
use app\models\Diseño;
use Yii;

class EventService implements InterfaceService
{
    public function nuevosEventos($model)
    {
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                return Validaciones::Validacionevent($model); // Lógica de validación
            } else {
                Yii::$app->session->setFlash('error', ['message' => 'Datos no válidos']);
            }
        }
        return $model;
    }
}