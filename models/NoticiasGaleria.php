<?php

namespace app\models;

/**
 * This is the model class for table "noticias_galeria".
 *
 * @property integer $idgaleria
 * @property integer $idnoticia
 * @property string $archivo
 * @property string $fecha_registro
 */
class NoticiasGaleria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    var $file;

    public static function tableName()
    {
        return 'noticias_galeria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idnoticia'], 'integer'],
            [['fecha_registro'], 'safe'],
            [['archivo'], 'string', 'max' => 255],
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
            'idgaleria' => 'Idgaleria',
            'idnoticia' => 'Idnoticia',
            'archivo' => 'Archivo',
            'fecha_registro' => 'Fecha Registro',
        ];
    }

    public function upload($name)
    {
        if ($this->validate()) {
            if (!empty($this->file)) {
                $path = './imagen/noticias/' . $name . '.' . $this->file->extension;
                if ($this->file->saveAs($path))
                    return true;
            }
        }
        return false;
    }
}
