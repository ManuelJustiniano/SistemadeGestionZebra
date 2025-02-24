<?php

namespace app\models;

/**
 * This is the model class for table "usuarios".
 *
 * @property integer $idusuario
 * @property string $nombre
 * @property string $apellidos
 * @property string $direccion
 * @property string $telefono
 * @property string $pais
 * @property string $ciudad
 * @property string $email
 * @property string $contrasena
 * @property string $fecha_nacimiento
 * @property string $celular
 * @property string $fecha_registro
 * @property string $estado
 * @property string $sexo
 */
class Pagosnet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    var $factura;
    var $nit;

    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['factura', 'nit'], 'required'],
            [['nit'], 'safe'],
            [['factura'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'factura' => 'Nombre de la Factura',
            'nit' => 'NIT/CI',
        ];
    }


}
