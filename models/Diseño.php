<?php

namespace app\models;

use sadovojav\cutter\behaviors\CutterBehavior;

class Diseño extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    var $file;

    public static function tableName()
    {
        return 'eventos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['titulo', 'descripcion', 'fecha_evento', 'hora_evento', 'honorarios'], 'required'],
            [['descripcion', 'ubicacion', 'titulo', 'requisitos', 'email'], 'string'],
            [['fecha_registro', 'foto'], 'safe'],
            [['estado', 'idusuario'], 'string', 'max' => 1],
            ['file', 'file', 'extensions' => 'jpg, gif, png', 'mimeTypes' => 'image/jpeg, image/gif, image/png'],
            [['file'], 'file', 'maxSize' => '2000000'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idevento' => 'ID',
            'titulo' => 'Nombre del evento',
            'descripcion' => 'Descripcion',
            'ubicacion' => 'Ubicacion del Diseño',
            'fecha_evento' => 'Fecha del evento',
            'hora_evento' => 'Hora del evento',
            'honorarios' => 'Honorarios por el evento',
            'estado' => 'Status del evento',
            'requisitos' => 'Requisistos especificos para el trabajo',
        ];
    }

    public function upload($name)
    {
        if ($this->validate()) {
            if (!empty($this->file)) {
                $path = 'imagen/eventos/' . $name . '.' . $this->file->extension;
                if ($this->file->saveAs($path))
                    return true;
            }
        }
        return false;
    }

}
