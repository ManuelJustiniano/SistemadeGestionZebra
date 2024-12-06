<?php



namespace app\components;

use app\models\ChangePasswordForm;
use app\models\Forget;
use app\models\Usuarios;
use Yii;

class CuentaService implements InterfaceCuenta
{
    private $notiService;
    private $correoService;

    public function __construct(InterfaceNoti $notiService, InterfaceCorreos $correoService)
    {
        $this->notiService = $notiService;
        $this->correoService = $correoService;
    }

       public function actualizarUsuario($model, $datosPost)
    {
        if ($model->load($datosPost) && $model->validate()) {
            if ($model->save()) {
                    Yii::$app->session->set('user', $model);
                    $this->notiService->agregarMensajeExito('Datos actualizados correctamente!');
                    return ['exito' => true];
                } else {
                    $this->notiService->agregarMensajeError('Error al editar datos, inténtelo más tarde.');
                    return ['exito' => false, 'model' => $model];
                }        }

    }


    public function recuperacionCuenta($email)
    {
        // Buscar el usuario por correo electrónico y estado.
        $usuario = Usuarios::findOne(['email' => $email, 'estado' => '1']);
        if (!$usuario) {
            return ['exito' => false, 'mensaje' => 'Correo no registrado o cuenta bloqueada'];
        }
        $nuevaContrasena = $this->generarContrasenaAleatoria();
        $usuario->contrasena = Yii::$app->security->generatePasswordHash($nuevaContrasena);
        if ($usuario->save()) {
            $correoEnviado = $this->correoService->enviarCorreoRecuperacion($usuario->idusuario, $nuevaContrasena);

            if ($correoEnviado) {
                return ['exito' => true, 'mensaje' => 'Se envio a su correo los datos de ingreso temporales'];
            } else {
                return ['exito' => false, 'mensaje' => 'Error en el envío, inténtelo más tarde'];
            }
        } else {
            return ['exito' => false, 'mensaje' => 'Error al actualizar la contraseña. Inténtelo más tarde'];
        }
    }

    public function generarContrasenaAleatoria()
    {
        return Yii::$app->security->generateRandomString(8); // Genera una contraseña de 8 caracteres.
    }


    public function cambiarPassword($usuario, $newPassword)
    {

        $usuario->contrasena = Yii::$app->security->generatePasswordHash($newPassword);
        if ($usuario->save()) {
            Yii::$app->session->set('user', $usuario);
            $this->notiService->agregarMensajeExito('Contraseña cambiada correctamente!');
            return ['exito' => true];
        } else  {
        $this->notiService->agregarMensajeError('Error al validar el formulario. Verifica los datos ingresados');
        return ['exito' => false];
    }

    }


    public function procesarFormularioCambioPassword($usuario,  $datosPost)
    {
        $changePasswordForm = new ChangePasswordForm();

        if ($changePasswordForm->load($datosPost) && $changePasswordForm->validate()) {
            return $this->cambiarPassword($usuario, $changePasswordForm->newPassword);
        }



    }


}