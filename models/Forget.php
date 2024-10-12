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
            [['email'], 'required'],
            ['email', 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Correo Electronico',
        ];
    }

    public function send($id)
    {
        $pass = Usuarios::findOne(['idusuario' => $id]);
        $conf = Configuracion::find()->one();
        $randomString = Yii::$app->getSecurity()->generateRandomString(6);
        $pass['contrasena'] = md5($randomString);

        if ($this->validate()) {
            Yii::$app->mailer->compose('layouts/template', [
                'titulo' => 'Recuperacion de contraseña',
                'titulo2' => 'Estimado Usuario se reinicio su contraseña a una nueva.',
                'contenido' => "<p><strong>Nombre: </strong>{$pass->nombrecompleto}</p>" .
                    "<p><strong>Correo: </strong>{$this->email}</p>" .
                    "<p><strong>Contraseña:</strong>{$randomString}</p>",
                'config' => Configuracion::find()->one(),
            ])
                ->setTo($this->email)
                ->setFrom([$conf->email => $conf->nombre_empresa])
                ->setSubject('Recuperacion de contraseña')
                ->send();
            $pass->save();
            return true;
        }
        return false;
    }
}
