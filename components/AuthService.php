<?php
namespace app\components;
use Yii;

class AuthService implements InterfaceAuth
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
}