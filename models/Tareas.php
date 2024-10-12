<?php

namespace app\models;

use sadovojav\cutter\behaviors\CutterBehavior;

class Tareas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    var $file;

    public static function tableName()
    {
        return 'tareas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['titulo', 'descripcion', 'fechainicio', 'fechavencimiento', 'titulo', 'descripcion', 'prioridad','idproyecto', 'idusuario'], 'required'],
            [['descripcion', 'titulo', 'fechainicio', 'fechavencimiento'], 'string'],
            [['fecha_registro'], 'safe'],
            [['estado', 'idproyecto'], 'string', 'max' => 1],


        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

        ];
    }


}
