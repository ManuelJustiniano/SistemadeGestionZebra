<?php

namespace app\models;

/**
 * This is the model class for table "configuracion".
 *
 * @property integer $idconfig
 * @property string $titulo_pagina
 * @property string $nombre_empresa
 * @property string $logo
 * @property string $meta_descripcion
 * @property string $meta_palabrasclaves
 * @property string $email
 * @property string $direccion_empresa
 * @property string $telefono_empresa
 * @property string $fax_empresa
 * @property string $facebook
 * @property string $twitter
 * @property string $youtube
 * @property string $googleplus
 * @property string $instagram
 * @property string $LinkedIn
 * @property string $tipo_moneda
 * @property string $coordgoogle
 */
class Configuracion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'configuracion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meta_descripcion', 'telefono_empresa', 'coordgoogle','titulo_pagina','nombre_empresa'], 'required'],
            [['meta_descripcion', 'meta_palabrasclaves'], 'string'],
            [['titulo_pagina', 'nombre_empresa', 'horarios', 'delivery'], 'string', 'max' => 500],
            [['logo', 'email', 'email_web','facebook', 'twitter', 'youtube', 'googleplus', 'instagram', 'LinkedIn'], 'string', 'max' => 100],
            [['direccion_empresa', 'telefono_empresa', 'coordgoogle'], 'string', 'max' => 500],
            [['fax_empresa'], 'string', 'max' => 150],
            [['tipo_moneda'], 'string', 'max' => 10],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idconfig' => 'Idconfig',
            'titulo_pagina' => 'Titulo Pagina',
            'nombre_empresa' => 'Nombre Empresa',
            'logo' => 'Logo',
            'meta_descripcion' => 'Meta Descripcion',
            'meta_palabrasclaves' => 'Meta Palabrasclaves',
            'email' => 'Email',
            'email_web' => 'Email web',
            'delivery' => 'Texto delivery',
            'direccion_empresa' => 'Direccion Empresa',
            'telefono_empresa' => 'Telefono Empresa',
            'fax_empresa' => 'Celular whatsapp',
            'facebook' => 'Facebook',
            'horarios' => 'Horarios',
            'twitter' => 'Twitter',
            'youtube' => 'Youtube',
            'googleplus' => 'Googleplus',
            'instagram' => 'Instagram',
            'LinkedIn' => 'Linked In',
            'tipo_moneda' => 'Tipo Moneda',
            'coordgoogle' => 'Coordgoogle',
        ];
    }
}
