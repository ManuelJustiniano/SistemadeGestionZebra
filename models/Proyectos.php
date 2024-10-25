<?php

namespace app\models;

use sadovojav\cutter\behaviors\CutterBehavior;

class Proyectos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'proyectos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['titulo', 'descripcion', 'fecha_inicio', 'fecha_fin',  'prioridad','idcliente'], 'required'],
            [['descripcion', 'titulo', 'fecha_inicio', 'fecha_fin'], 'string'],
            [['fecha_registro'], 'safe'],
            [['estado'], 'string', 'max' => 1],


        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'titulo' => 'Titulo del Proyecto',
            'Descripcion' => 'Descripcion General',
            'Fecha_inicio' => 'Fecha inicio',
            'Fecha_fin' => 'Fecha fin',
            'prioridad' => 'Prioridad',
            'idcliente' => 'Cliente',
            'idgestor' => 'Gestor Asignado',

        ];
    }

    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['idusuario' => 'idcliente']);
    }

    public function getGestor()
    {
        return $this->hasOne(Usuarios::className(), ['idusuario' => 'idgestor']);
    }


    public static function getPrioridad()
    {
        $result =[];
        $prioridad = [
            'Alta' =>'Alta',
            'Media' => 'Media',
            'Baja' => 'Baja'
        ];
        $result = $prioridad;
        return $result;
    }


}
