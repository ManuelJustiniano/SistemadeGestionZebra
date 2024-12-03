<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\Security;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuarios".
 *
 * @property integer $idusuario
 * @property string $nombre
 * @property string $apellido
 * @property string $direccion
 * @property string $telefono
 * @property string $pais
 * @property string $ciudad
 * @property string $email
 * @property string $contrasena
 * @property string $fecha_nacimiento
 * @property string $movil
 * @property string $fecha_registro
 * @property string $estado
 * @property string $sexo
 */
class ChangePasswordForm extends Model
{
    /**
     * @inheritdoc
     */

    public $currentPassword;
    public $newPassword;
    public $confirmPassword;

    // Reglas de validación
    public function rules()
    {
        return [
            [['currentPassword', 'newPassword', 'confirmPassword'], 'required'],
            ['currentPassword', 'validateCurrentPassword'],
            [['newPassword'], 'string', 'min' => 8, 'message' => 'La contraseña debe tener al menos 8 caracteres.'],
            ['newPassword', 'match', 'pattern' => '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#]).{8,}$/', 'message' => 'La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula, un número y un símbolo.'],

            ['confirmPassword', 'compare', 'compareAttribute' => 'newPassword', 'message' => 'La nueva contraseña y la confirmación deben coincidir.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'currentPassword' => 'Anterior contraseña',
            'newPassword' => 'Nueva contraseña',
            'confirmPassword' => 'Confirmar contraseña',


        ];
    }

    public function validateCurrentPassword($attribute, $params)
    {
        // Validar que la contraseña actual sea correcta
        $user = Yii::$app->session->get('user');

        if ($user) {
            $usuario = Usuarios::findOne(['idusuario' => $user['id']]); // Obtener el modelo de usuario para acceder a la contraseña hasheada

            if (!$usuario || !password_verify($this->currentPassword, $usuario->contrasena)) {
                $this->addError($attribute, 'La contraseña actual no es correcta.');
            }
        }


           }
}
