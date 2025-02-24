<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $nombre;
    public $email;
    public $telefono;
    public $ciudad;
    public $subject;
    public $mensaje;
    public $reCaptcha;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // nombre, email, subject and mensaje are required
            [['nombre', 'email'], 'required'],
            [['telefono', 'mensaje'], 'safe'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' =>'6LfaTE4UAAAAAMfqfvMnKU1gARpKh5pizQ7q_9-f']

        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'nombre' => false,
            'apellido' => false,
            'email' => false,
            'mensaje' => false,
            'pais' => false,
            'ciudad' => false,
            'telefono' => false,
            'reCaptcha' => '',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setSubject('Formulario de Contacto Pagina web')
                ->setFrom([$this->email => $this->nombre])
                ->setHtmlBody("<h3> Formulario de Contacto </h3>".
                    "<p><strong>Nombre: </strong>{$this->nombre}</p>".
                    "<p><strong>Correo: </strong>{$this->email}</p>".
                    "<p><strong>Telefono: </strong>{$this->telefono}</p>".
                    "<p><strong>Mensaje: </strong>{$this->mensaje}</p>")
                ->send();

            return true;
        }
        return false;
    }
}
