<?php
namespace app\components;

use app\models\Tareas;
use app\models\TareasSearch;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use Yii;

class AdminService implements InterfaceAdmin
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

        // Verificar si el usuario existe y si su tipo de usuario es '1'
        if ($usuario !== null && $usuario->tipo_usuario == '1') {
            return $usuario;
        }

        return null;

    }


    public function listUsuarios($queryParams)
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search($queryParams);
        $dataProvider->setSort([
            'defaultOrder' => ['idusuario' => SORT_DESC]
        ]);
        return [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ];

    }

    public function nuevoUsuario($model, $password)
    {
      $mensajeExito = 'El usuario ha sido creado correctamente.';
      $mensajeError = 'El usuario no se ha sido podido crear correctamente.';
      $model = new Usuarios();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->correoService->enviarCorreodeBienvenida($model, $password);
            $this->notiService->setFlashMensaje($mensajeExito, 'success');
            return [
                'exito' => true,
                'mensaje' => $mensajeExito,
                'model' => $model,
            ];
        }
        $this->notiService->setFlashMensaje($mensajeError, 'danger');
        return [
            'exito' => false,
            'mensaje' => $mensajeError,
            'model' => $model,
        ];



    }

}