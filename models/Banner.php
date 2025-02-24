<?php

namespace app\models;

/**
 * This is the model class for table "banner".
 *
 * @property string $idbanner
 * @property integer $idcategoria
 * @property string $titulo
 * @property string $resumen
 * @property string $resumen2
 * @property string $resumen3
 * @property string $foto
 * @property string $fecha_registro
 * @property string $estado
 * @property string $url
 * @property string $destino
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    var $file;

    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcategoria',], 'required'],
            [['idcategoria'], 'integer'],
            [['fecha_registro'], 'safe'],
            [['titulo', 'foto'], 'string', 'max' => 120],
            [['resumen', 'resumen2'], 'string', 'max' => 350],
            [['resumen3', 'url'], 'string', 'max' => 150],
            [['estado'], 'string', 'max' => 1],
            [['destino'], 'string', 'max' => 20],
            ['file', 'file', 'extensions' => 'jpg, gif, png', 'mimeTypes' => 'image/jpeg, image/gif, image/png'],
            [['file'], 'file', 'maxSize' => '2000000']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idbanner' => 'Idbanner',
            'idcategoria' => 'Categoria',
            'titulo' => 'Titulo',
            'resumen' => 'Resumen',
            'resumen2' => 'Titulo del boton',
            'resumen3' => 'Resumen3',
            'foto' => 'Foto',
            'fecha_registro' => 'Fecha Registro',
            'estado' => 'Estado',
            'url' => 'Url',
            'destino' => 'Destino',
            'file' => 'Imagen',
        ];
    }

    public function upload($name)
    {
        if ($this->validate()) {
            if (!empty($this->file)) {
                $path = 'imagen/banners/' . $name . '.' . $this->file->extension;
                if ($this->file->saveAs($path))
                    return true;
            }
        }
        return false;
    }

    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['idcategoria' => 'idcategoria']);
    }


}
