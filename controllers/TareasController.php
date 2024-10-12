<?php

namespace app\controllers;

use app\models\Configuracion;
use app\models\Forget;
use app\components\TareasService;
use app\models\TareasSearch;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TareasController extends Controller
{
    private $tareasService;
    /**
     * @inheritdoc
     */

    public function init()
    {
        parent::init();
        // Obtenemos el servicio del contenedor de Yii
        $this->tareasService = Yii::$container->get('app\components\InterfaceTarea');
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],

        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionObtener()
    {

        $dataProvider = $this->tareasService->obtener();
        return $this->render('cuenta/tareas/view', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate($id)
    {
        // Aquí puedes manejar la actualización de una tarea
    }


    public function actionUpdate($id)
    {
        // Aquí puedes manejar la actualización de una tarea
    }
    /**
     * Login action.
     *
     * @return string
     */




}
