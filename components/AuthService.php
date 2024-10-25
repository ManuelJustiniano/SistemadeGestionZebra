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

    public function getUser()
    {
        return Yii::$app->session->get('user');
    }

    public function logout()
    {

        $sess = Yii::$app->session;
        if ($sess->has('user')) {
            $sess->remove('user');
        }
    }

    public function getRedirectRoute($user)
    {
        $routes = [
            '1' => ['administrador/index'],
            '2' => ['gestor/index'],
            '3' => ['consultor/index'],
            '4' => ['cliente/index']
        ];

        return $routes[$user['tipo_usuario']] ?? ['site/login'];


}
}