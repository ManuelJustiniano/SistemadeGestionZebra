<?php
use yii\helpers\Url;
$user = Yii::$app->session->get('user');
$originalDatefechan = $model->fecha_nacimiento ?? null;
$newDatefn = date("d/m/Y", strtotime($originalDatefechan));
$tiposUsuario = \app\models\Usuarios::getTipoUsuario();
$originalDatefechreg = $model->fecha_registro ?? null;
$newDatefreg = date("d/m/Y", strtotime($originalDatefechreg));
?>




<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="col-12 col-sm-6">
            <h1 class="app-page-title">Mi cuenta</h1>

        </div>
        <div class="col-12 col-sm-6">
            <div class="app-card-footer p-4 mt-auto">
                <a class="btn app-btn-secondary" href="<?= Url::to(['consultor/updateperfil']) ?>">Editar Perfil</a>
                <a class="btn app-btn-secondary" href="<?= Url::to(['consultor/updatepasswordperfil']) ?>">Editar contraseña</a>
            </div><!--//app-card-footer-->
        </div>
        <div class="row gy-4">
            <div class="col-12">
                <div class="app-card-account shadow-sm d-flex flex-column align-items-start">
                    <div class="app-card-body px-4 w-100">
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Nombre Completo', 'datos' =>  $model['nombrecompleto']]) ?>

                        <?= $this->render('../widgets/appcuenta', ['label' => 'Usuario', 'datos' =>  $model['usuario']]) ?>


                        <?= $this->render('../widgets/appcuenta', ['label' => 'Tipo usuario', 'datos' =>  $tiposUsuario[$model->tipo_usuario]]) ?>

                        <?= $this->render('../widgets/appcuenta', ['label' => 'Email', 'datos' =>  $model['email']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Telefono', 'datos' =>  $model['telefono']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Movil', 'datos' =>  $model['movil']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Sexo', 'datos' =>  $model['sexo']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'fecha de nacimiento', 'datos' =>  $newDatefn]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'fecha registro', 'datos' =>  $newDatefreg]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Empresa', 'datos' =>  $model['nombrecompleto']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Cargo', 'datos' =>  $model['cargo']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Pais', 'datos' =>  $model['pais']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Ciudad', 'datos' =>  $model['ciudad']]) ?>
                        <?= $this->render('../widgets/appcuenta', ['label' => 'Direccion', 'datos' =>  $model['direccion']]) ?>
                    </div><!--//app-card-body-->


                </div><!--//app-card-->
            </div><!--//col-->



        </div><!--//row-->

    </div><!--//container-fluid-->
</div><!--//app-content-->


