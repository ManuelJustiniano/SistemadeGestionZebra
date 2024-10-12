<?php
namespace app\components;
use Yii;

class ComponentsService implements InterfaceComponents
{

    public function login($model)
    {
        if (!empty(Yii::$app->session->get('user'))) {
            return true;
        }
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return true;
        }
        return false;
    }

    public function logout()
    {

        $sess = Yii::$app->session;
        if ($sess->has('user')) {
            $sess->remove('user');
        }
    }
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