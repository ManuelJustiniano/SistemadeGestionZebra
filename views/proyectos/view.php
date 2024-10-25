<?php
use yii\helpers\Url;
$user = Yii::$app->session->get('user');
$originalDateini = $model->fecha_inicio ?? null;


    $newDatei = date("d/m/Y", strtotime($originalDateini));


$originalDatefin = $model->fecha_fin ?? null;

    $newDatef = date("d/m/Y", strtotime($originalDatefin));




$this->title = 'MI CUENTA';
?>


<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="col-12 col-sm-6">
            <h1 class="app-page-title">PROYECTOS</h1>

        </div>
        <div class="col-12 col-sm-6">
            <div class="app-card-footer p-4 mt-auto">
                <a class="btn app-btn-secondary" href="<?= Url::to(['proyectos/create']) ?>">Crar nuevo proyecto</a>
                <a class="btn app-btn-secondary" href="<?= Url::to(['proyectos/update']) ?>">Editar Proyecto</a>
                <a class="btn app-btn-secondary" href="<?= Url::to(['proyectos/asignaciondetareas', 'idproyecto' => $model['idproyecto']]) ?>">Asignar Proyecto</a>
            </div><!--//app-card-footer-->
        </div>

        <div class="row gy-4">
            <div class="col-12">
                <div class="app-card-account shadow-sm d-flex flex-column align-items-start">
                    <div class="app-card-body px-4 w-100">
                        <?= $this->render('widgets/appcuenta', ['label' => 'Titulo del Proyecto', 'datos' =>  $model['titulo']]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Descripcion', 'datos' =>   strip_tags($model['descripcion'])]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Cliente', 'datos' =>   strip_tags($model['descripcion'])]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Prioridad', 'datos' =>   strip_tags($model['prioridad'])]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Fecha Inicio', 'datos' =>   $newDatei]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Fecha Fin', 'datos' =>   $newDatef]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Cliente', 'datos' =>   $model->usuario['nombrecompleto']]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Gestor encargado', 'datos' =>   $model->gestor['nombrecompleto']]) ?>


                    </div><!--//app-card-body-->


                </div><!--//app-card-->
            </div><!--//col-->



        </div><!--//row-->

    </div><!--//container-fluid-->
</div><!--//app-content-->


