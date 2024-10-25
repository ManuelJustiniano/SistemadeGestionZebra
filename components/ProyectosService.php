<?php
namespace app\components;

use app\models\Asignacion;
use app\models\Proyectos;
use app\models\ProyectosSearch;
use app\models\Tareas;
use app\models\TareasSearch;
use app\models\Usuarios;
use Yii;
use yii\web\NotFoundHttpException;

class ProyectosService implements InterfaceProyectos
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

    public function listarProyectos($queryParams)
    {
        $searchModel = new ProyectosSearch();
        $dataProvider = $searchModel->search($queryParams);
        $dataProvider->setSort([
            'defaultOrder' => ['idproyecto' => SORT_DESC]
        ]);
        return [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ];

    }

    public function nuevoProyecto($queryParams)
    {

        $model = new Proyectos();
        $user = Yii::$app->session->get('user');
        $usuario = Usuarios::findOne(['idusuario' => $user['id']]);
        $model->idgestor =  $usuario->idusuario;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('mensaje', [
                'message' => 'Se creó el proyecto correctamente.',
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


    public function prepararModeloAsignacion($idproyecto)
    {
        $proyecto = Proyectos::findOne(['idproyecto' => $idproyecto]);
        if ($proyecto === null) {
            return null;
        }

        $model = new Asignacion();
        $model->idcliente = $proyecto->idcliente;
        $model->idproyecto = $idproyecto;

        return $model;
    }




    public function procesarAsignacionTarea($model, $datosPost)
    {







        if ($model->load($datosPost) && $model->validate()) {

            if ($model->save()) {
                Yii::$app->session->setFlash('mensaje', [
                    'message' => 'Se creó el proyecto correctamente.',
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






    public function obtenerProyectoPorId($proyectoId)
    {
        return Proyectos::findOne(['idproyecto' => $proyectoId]);
    }


    public function actualizarProyecto($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('mensaje', [
                'message' => 'Se actualizo el proyecto correctamente.',
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
    public function findModel($id): ProyectosSearch
    {
        if (($model = ProyectosSearch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}