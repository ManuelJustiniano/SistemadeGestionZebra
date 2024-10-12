<?php
namespace app\components;
use app\models\TareasSearch;
use Yii;

class TareasService implements InterfaceTarea
{
    protected $tareasSearch;
    public function __construct(TareasSearch $tareasSearch)
    {
        $this->tareasSearch = $tareasSearch;
    }
    public function obtener($model)
    {
        $dataProvider = $this->tareasSearch->search(Yii::$app->request->queryParams);
        $dataProvider->setSort([
            'defaultOrder' => ['fecha_registro' => SORT_ASC],
        ]);

        return $dataProvider;

    }

    public function actualizar($tareaId, $data)
    {
        // Aquí iría la lógica para actualizar una tarea
    }
    public function create($data)
    {
        // Aquí iría la lógica para actualizar una tarea
    }

}