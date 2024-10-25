<?php
namespace app\components;

use app\models\Tareas;
use app\models\TareasSearch;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use Yii;

class AdminService implements InterfaceAdmin
{

    private $correos;

    public function __construct(InterfaceCorreos $correos)
    {
        $this->correos = $correos;
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

      $model = new Usuarios();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $this->correos->enviarCorreoBienvenida($model, $password);

            Yii::$app->session->setFlash('mensaje', [
                'message' => 'Se creó el usuario correctamente.',
                'type' => 'success'
            ]);
            return [
                'success' => true,
                'model' => $model,
            ];
        }
        return [
            'success' => false,
            'model' => $model,
        ];



    }

}