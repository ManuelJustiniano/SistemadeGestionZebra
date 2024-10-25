<?php
namespace app\components;

use app\models\Tareas;
use app\models\TareasSearch;
use app\models\Usuarios;
use Yii;
use yii\db\Exception;
use yii\web\NotFoundHttpException;

class ProyectosValidacione extends ProyectosService
{

    public function crearProyecto($proyecto)
    {
        $this->validacionExtra($proyecto);
        parent::nuevoProyecto($proyecto);
    }

    private function validacionExtra( $proyecto)
    {
        if ($proyecto->fecha_fin <= $proyecto->fecha_inicio) {
                throw new Exception("Error: La fecha de fin debe ser posterior a la fecha de inicio.");
        }
    }

}