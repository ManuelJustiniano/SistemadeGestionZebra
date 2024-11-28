<?php
namespace app\components;

use app\models\Tareas;
use app\models\TareasSearch;
use app\models\Usuarios;
use Yii;
use yii\web\NotFoundHttpException;

class TareasService implements InterfaceTarea
{
    private $notiService;


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

    public function __construct(InterfaceNoti $notiService)
    {
        $this->notiService = $notiService;
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
                    $this->notiService->agregarMensajeExito('La tarea ha sido creado correctamente.');
                    return ['exito' => true];
                } else {
                    $this->notiService->agregarMensajeError('Error al crear tarea, inténtelo más tarde.');
                    return ['exito' => false, 'model' => $model];
                }
            } else {
                $this->notiService->agregarMensajeError('Error al crear usuario. Inténtelo más tarde.');
                return ['exito' => false, 'model' => $model];
            }
        //$this->notiService->agregarMensajeError('Error al validar usuario.');
        return ['exito' => false, 'model' => $model];


       }



    public function actualizarTarea($dates, $id)
    {

        $model = $this->findModel($id);
        if ($model->load($dates) && $model->validate()) {
            if ($model->save()) {
                    $this->notiService->agregarMensajeExito('La ha sido Actualizado correctamente.');
                    return ['exito' => true];
                } else {
                    $this->notiService->agregarMensajeError('Error al actualizar tarea, inténtelo más tarde.');
                    return ['exito' => false, 'model' => $model];
                }

            } else {
                $this->notiService->agregarMensajeError('Error al actualizar la tarea. Inténtelo más tarde.');
                return [
                    'exito' => false,
                    'model' => $model
                ];
            }
        }





    public function cambiarEstadoTarea($id)
    {

        $model = $this->findModel($id);

        if ($model === null) {
            return [
                'exito' => false,
                'mensaje' => 'Usuario no encontrado.',
            ];
        }

        // Cambiamos el estado del usuario
        $model->estado = (string)!$model->estado;
        if ($model->save()) {
            return [
                'exito' => true,
                'mensaje' => 'El estado del usuario ha sido actualizado correctamente.',
            ];
        } else {
            return [
                'exito' => false,
                'mensaje' => 'Hubo un error al actualizar el estado del usuario.',
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