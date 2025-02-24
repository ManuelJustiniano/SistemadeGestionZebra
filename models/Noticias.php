<?php

namespace app\models;

use sadovojav\cutter\behaviors\CutterBehavior;

/**
 * This is the model class for table "noticias".
 *
 * @property integer $idnoticia
 * @property string $titulo
 * @property integer $idcategoria
 * @property string $resumen
 * @property string $descripcion
 * @property string $fuente
 * @property string $fecha_registro
 * @property string $fecha_noticia
 * @property string $foto
 * @property string $tumb
 * @property string $desc_foto
 * @property string $estado
 * @property string $disponible
 * @property integer $cantidad
 * @property string $tags
 * @property integer $posicion
 */
class Noticias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    var $file;

    public static function tableName()
    {
        return 'noticias';
    }


    public function behaviors()
    {
        return [
            'image' => [
                'class' => CutterBehavior::className(),
                'attributes' => ['foto_portada', 'foto_contenido'],
                'baseDir' => '/imagen/noticias',
                'basePath' => '@webroot',
                'baseWeb' => '@web',

            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcategoria', 'posicion'], 'integer'],
            [['resumen', 'descripcion', 'fuente', 'fecha_noticia'], 'required'],
            [['resumen', 'descripcion', 'tags'], 'string'],
            [['fecha_registro', 'fecha_noticia', 'foto'], 'safe'],
            [['titulo'], 'string', 'max' => 250],
            [['fuente', 'video'], 'string', 'max' => 255],
            [['foto_portada', 'foto_contenido'], 'string', 'max' => 100],
            [['estado'], 'string', 'max' => 1],
            ['file', 'file', 'extensions' => 'jpg, gif, png', 'mimeTypes' => 'image/jpeg, image/gif, image/png'],
            [['file'], 'file', 'maxSize' => '2000000'],
            ['foto_portada', 'file', 'extensions' => 'jpg, jpeg, png', 'mimeTypes' => 'image/jpeg, image/png'],
            ['foto_contenido', 'file', 'extensions' => 'jpg, jpeg, png', 'mimeTypes' => 'image/jpeg, image/png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idnoticia' => 'Idnoticia',
            'titulo' => 'Titulo',
            'idcategoria' => 'Categoria',
            'resumen' => 'Resumen',
            'descripcion' => 'Descripcion',
            'fuente' => 'Fuente',
            'fecha_registro' => 'Fecha Registro',
            'fecha_noticia' => 'Fecha Noticia',
            'foto_contenido' => 'Foto Contenido',
            'foto_portada' => 'Foto Portada',
            //'tumb' => 'Tumb',
            'desc_foto' => 'Desc Foto',
            'estado' => 'Estado',
            // 'disponible' => 'Disponible',
            //'cantidad' => 'Cantidad',
            'tags' => 'Tags',
            'video' => 'Id de Video',
            'posicion' => 'Posicion',
        ];
    }

    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['idcategoria' => 'idcategoria']);
    }

    public function getGaleria()
    {
        return $this->hasMany(NoticiasGaleria::className(), ['idnoticia' => 'idnoticia']);
    }


    public function upload($name)
    {
        if ($this->validate()) {
            if (!empty($this->file)) {
                $path = 'imagen/noticias/' . $name . '.' . $this->file->extension;
                if ($this->file->saveAs($path))
                    return true;
            }
        }
        return false;
    }


}
