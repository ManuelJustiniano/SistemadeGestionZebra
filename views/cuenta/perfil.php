<?php
use yii\helpers\Url;
$user = Yii::$app->session->get('user');
$originalDatepapa = $user->fecha_nacimiento ?? null;
if (!empty($originalDatepapa) && $originalDatepapa !== '0000-00-00') {
    $newDatepapa = date("d/m/Y", strtotime($originalDatepapa));

}
$this->title = 'MI CUENTA';
?>



<?php foreach (Yii::$app->session->getAllFlashes() as $message): ?>
    <?php /*= \kartik\widgets\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? \yii\helpers\Html::encode($message['message']) : 'Message Not Set!',
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 5000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);*/
    \yii2mod\alert\Alert::widget([
        'useSessionFlash' => false,
        'options' => [
            'type' => (!empty($message['type'])) ? $message['type'] : 'error',
            'title' => (!empty($message['message'])) ? \yii\helpers\Html::encode($message['message']) : 'Message Not Set!',
            'animation' => "slide-from-top",
        ],
    ]); ?>
<?php endforeach; ?>


<?= $this->render('widgets/menu') ?>




<div class="app-wrapper">


<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="col-12 col-sm-6">
            <h1 class="app-page-title">Mi cuenta</h1>

        </div>
        <div class="col-12 col-sm-6">
            <div class="app-card-footer p-4 mt-auto">
                <a class="btn app-btn-secondary" href="<?= Url::to(['cuenta/updateperfil']) ?>">Editar Perfil</a>
                <a class="btn app-btn-secondary" href="<?= Url::to(['cuenta/updatepasswordperfil']) ?>">Editar contraseña</a>
            </div><!--//app-card-footer-->
        </div>
        <div class="row gy-4">
            <div class="col-12">
                <div class="app-card-account shadow-sm d-flex flex-column align-items-start">
                    <div class="app-card-body px-4 w-100">
                        <?= $this->render('widgets/appcuenta', ['label' => 'Nombre Completo', 'datos' =>  $user['nombrecompleto']]) ?>

                        <?= $this->render('widgets/appcuenta', ['label' => 'Usuario', 'datos' =>  $user['usuario']]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Email', 'datos' =>  $user['email']]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Telefono', 'datos' =>  $user['telefono']]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Movil', 'datos' =>  $user['movil']]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Sexo', 'datos' =>  $user['sexo']]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'fecha de nacimiento', 'datos' =>  $newDatepapa]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Empresa', 'datos' =>  $user['nombrecompleto']]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Cargo', 'datos' =>  $user['cargo']]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Pais', 'datos' =>  $user['pais']]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Ciudad', 'datos' =>  $user['ciudad']]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Direccion', 'datos' =>  $user['direccion']]) ?>
                    </div><!--//app-card-body-->


                </div><!--//app-card-->
            </div><!--//col-->



        </div><!--//row-->

    </div><!--//container-fluid-->
</div><!--//app-content-->

</div><!--//app-content-->

