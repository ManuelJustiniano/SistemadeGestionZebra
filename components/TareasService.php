<?php
namespace app\components;

use app\models\Tareas;
use app\models\TareasSearch;
use app\models\Usuarios;
use Yii;
use yii\base\ExitException;
use yii\web\NotFoundHttpException;

class TareasService implements InterfaceTarea
{
    private $alertService;


    public function __construct(InterfaceAlert $alertService)
    {
        $this->alertService = $alertService;
    }

     public function obtenerUsuarioSesion()
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

    /**
     * @throws ExitException
     */
    public function verificarAccesoAdmin()
    {
        $usuario = $this->obtenerUsuarioSesion();
        if ($usuario === null) {
            Yii::$app->session->setFlash('error', 'No tienes permiso para acceder a esta sección.');
            Yii::$app->controller->redirect(Yii::$app->request->referrer ?: ['site/login']);
            Yii::$app->end();
        }
        return $usuario;
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
        if ($model->load($queryParams) && $model->validate()) {
            if ($model->save()) {
                    $this->alertService->agregarMensajeExito('La tarea ha sido creado correctamente.');
                    return ['exito' => true];
                } else {
                    $this->alertService->agregarMensajeError('Error al crear tarea, inténtelo más tarde.');
                    return ['exito' => false, 'model' => $model];
                }
            }
        return ['exito' => false, 'model' => $model];


       }



    public function actualizarTarea($dates, $id)
    {
        $model = $this->findModel($id);
        if ($model->load($dates) && $model->validate()) {
            if ($model->save()) {
                    $this->alertService->agregarMensajeExito('La Tarea ha sido actualizada correctamente.');
                    return ['exito' => true];
                } else {
                    $this->alertService->agregarMensajeError('Error al actualizar tarea, inténtelo más tarde.');
                    return ['exito' => false, 'model' => $model];
                }
            }
                    return ['exito' => false, 'model' => $model];
        }




    public function cambiarEstadoTarea($id)
    {
        $model = $this->findModel($id);
        if ($model === null) {
            return [
                'exito' => false,
                'mensaje' => 'Tarea no encontrado.',
            ];
        }
        $estadoAnterior = $model->estado;
        $model->estado = (string)!$model->estado;
        if ($model->save()) {
            if ($estadoAnterior == '1') {
                $mensaje = 'El estado de la tarea ha sido cambiado a bloqueada';
            } else {
                $mensaje = 'El estado de la tarea ha sido cambiado a activada';
            }
            return [
                'exito' => true,
                'mensaje' => $mensaje,
            ];
        } else {
            return [
                'exito' => false,
                'mensaje' => 'Hubo un error al actualizar el estado de la tarea.',
            ];
        }
    }



    /**
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = TareasSearch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}