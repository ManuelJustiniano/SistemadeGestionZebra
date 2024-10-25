<?php
namespace app\components;

use app\models\Tareas;
use app\models\TareasSearch;
use app\models\Usuarios;
use Yii;
use yii\web\NotFoundHttpException;

class TareasService implements InterfaceTarea
{

        public function obtenerUsuarioSesion(): ?Usuarios
        {
            $user = Yii::$app->session->get('user');

            if (empty($user)) {
                return null;
            }
            $usuario = Usuarios::findOne(['idusuario' => $user['id']]);
            if ($usuario !== null && in_array($usuario->tipo_usuario, ['1', '2'])) {
                return $usuario;
            }

            return null;
    }

    public function listTareas($queryParams)
    {
        $searchModel = new TareasSearch();
        $dataProvider = $searchModel->search($queryParams);
        $dataProvider->setSort([
            'defaultOrder' => ['idtarea' => SORT_DESC]
        ]);
        return [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ];

    }

    public function nuevaTarea($queryParams)
    {

        $model = new Tareas();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('mensaje', [
                'message' => 'Se creó la tarea correctamente.',
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



    public function actualizarTarea($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('mensaje', [
                'message' => 'Se actualizo la tarea correctamente.',
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

    /**
     * @throws NotFoundHttpException
     */
    public function findModel($id): TareasSearch
    {
        if (($model = TareasSearch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}