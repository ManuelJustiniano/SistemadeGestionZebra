<?php

namespace app\components;

use app\models\Tareas;
use app\models\TareasSearch;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use Yii;
use yii\web\NotFoundHttpException;

class ConsultorService implements InterfaceConsultor
{

    private $correoService;
    private $notiService;

    public function __construct(InterfaceCorreos $correoService, InterfaceNoti $notiService)
    {
        $this->correoService = $correoService;
        $this->notiService = $notiService;
    }

    public function obtenerUsuarioSesion()
    {
        $user = Yii::$app->session->get('user');
        if (empty($user)) {
            return null;
        }
        $usuario = Usuarios::findOne(['idusuario' => $user['id']]);
        if ($usuario !== null && $usuario->tipo_usuario == '3') {
            return $usuario;
        }
        return null;
    }

    public function verificarAccesoAdmin()
    {
        $usuario = $this->obtenerUsuarioSesion();
        if ($usuario === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            Yii::$app->controller->redirect(Yii::$app->request->referrer ?: ['site/login']);
            Yii::$app->end(); // Termina la ejecución del script, ya que la redirección se realizará aquí
        }
        return $usuario;
    }













}