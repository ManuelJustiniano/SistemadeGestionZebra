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

                $this->notiService->setFlashMensaje($mensajec, 'success');
                return [
                    'exito' => true,
                    'mensaje' => $mensajec,
                ];
            }
        }
        $this->notiService->setFlashMensaje($mensajem, 'danger');
        return [
            'exito' => false,
            'mensaje' => $mensajem,
        ];


    }


    public function recuperacionCuenta($email)
    {
        // Buscar el usuario por correo electrónico y estado.
        $usuario = Usuarios::findOne(['email' => $email, 'estado' => '1']);
        if (!$usuario) {
            return ['exito' => false, 'mensaje' => 'Correo no registrado'];
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


        $mensajeExito = 'Tu contraseña ha sido actualizada correctamente.';
        $mensajeError = 'Error al actualizar la contraseña. Verifica los datos ingresados.';


        $usuario->contrasena = md5($newPassword);

        if ($usuario->save()) {
            Yii::$app->session->set('user', $usuario);
            $this->notiService->setFlashMensaje($mensajeExito, 'success');
            return [
                'exito' => true,
                'mensaje' => $mensajeExito,
            ];
        }

        $this->notiService->setFlashMensaje($mensajeError, 'danger');
        return [
            'exito' => false,
            'mensaje' => $mensajeError,
        ];
    }


    public function procesarFormularioCambioPassword($usuario,  $datosPost)
    {
        $changePasswordForm = new ChangePasswordForm();

        if ($changePasswordForm->load($datosPost) && $changePasswordForm->validate()) {
            return $this->cambiarPassword($usuario, $changePasswordForm->newPassword);
        }

        $mensajeErrorValidacion = 'Error al validar el formulario. Verifica los datos ingresados.';
        $this->notiService->setFlashMensaje($mensajeErrorValidacion, 'danger');

        return [
            'exito' => false,
            'mensaje' => $mensajeErrorValidacion,
            'formModel' => $changePasswordForm,
        ];
    }


}