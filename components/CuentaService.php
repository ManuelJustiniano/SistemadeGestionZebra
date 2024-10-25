<?php



namespace app\components;

use app\models\ChangePasswordForm;
use app\models\Usuarios;
use Yii;

class CuentaService implements InterfaceCuenta
{
    private $notiService;
    private $correos;

    public function __construct(InterfaceNoti $notiService, InterfaceCorreos $correos)
    {
        $this->notiService = $notiService;
        $this->correos = $correos;
    }

       public function actualizarUsuario($model, $datosPost)
    {


        $mensajec = 'Tu perfil ha sido actualizado correctamente.';
        $mensajem = 'Error al actualizar el perfil. Verifica los datos ingresados.';
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