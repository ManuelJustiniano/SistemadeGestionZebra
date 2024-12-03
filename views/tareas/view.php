<?php
use yii\helpers\Url;

$this->title = 'MI CUENTA';
?>


<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="col-12 col-sm-6">
            <h1 class="app-page-title">TAREAS</h1>

        </div>
        <div class="col-12 col-sm-6">
            <div class="app-card-footer p-4 mt-auto">
                <a class="btn app-btn-secondary" href="<?= Url::to(['tareas/create']) ?>">Crar nueva tarea</a>
                <a class="btn app-btn-secondary" href="<?= Url::to(['tareas/update?id='.$model['idtarea']]) ?>">Editar Tarea</a>
            </div><!--//app-card-footer-->
        </div>

        <div class="row gy-4">
            <div class="col-12">
                <div class="app-card-account shadow-sm d-flex flex-column align-items-start">
                    <div class="app-card-body px-4 w-100">
                        <?= $this->render('widgets/appcuenta', ['label' => 'Titulo de la tarea', 'datos' =>  $model['titulo']]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Descripcion', 'datos' =>   strip_tags($model['descripcion'])]) ?>
                        <?= $this->render('widgets/appcuenta', ['label' => 'Modulo', 'datos' =>    $model->modulos['nombre']]) ?>


                    </div><!--//app-card-body-->


                </div><!--//app-card-->
            </div><!--//col-->



        </div><!--//row-->

    </div><!--//container-fluid-->
</div><!--//app-content-->


