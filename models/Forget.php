<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Forget extends Model
{
    public $email;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email'], 'required', 'message' => 'El correo electrónico no puede estar vacío.'],
            [['email'], 'email', 'message' => 'Por favor, introduce un correo electrónico válido.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Correo Electronico',
        ];
    }


}
