<?php

namespace app\models;

/**
 * This is the model class for table "videos".
 *
 * @property integer $idvideo
 * @property string $titulo
 * @property string $descripcion
 * @property string $url
 * @property integer $idcategoria
 * @property integer $posicion
 * @property string $fecha_video
 * @property string $fecha_registro
 * @property string $estado
 */
class Videos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'videos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'descripcion', 'url', 'idcategoria', 'posicion'], 'required'],
            [['descripcion'], 'string'],
            [['idcategoria', 'posicion'], 'integer'],
            [['fecha_video', 'fecha_registro'], 'safe'],
            [['titulo'], 'string', 'max' => 250],
            [['url'], 'string', 'max' => 200],
            [['estado'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idvideo' => 'Idvideo',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'url' => 'Url',
            'idcategoria' => 'Idcategoria',
            'posicion' => 'Posicion',
            'fecha_video' => 'Fecha Video',
            'fecha_registro' => 'Fecha Registro',
            'estado' => 'Estado',
        ];
    }
}
