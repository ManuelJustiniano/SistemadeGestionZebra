<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tareas */

$this->title = 'Tarea: ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idproyecto, 'url' => ['view', 'id' => $model->idproyecto]];
$this->params['breadcrumbs'][] = 'Update';
?>




<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title"><?= Html::encode($this->title) ?></h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        <?= $this->render('_form', [
                            'model' => $model,
                        ]) ?>

                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->

        <hr class="my-4">
    </div><!--//container-fluid-->
</div><!--//app-content-->


