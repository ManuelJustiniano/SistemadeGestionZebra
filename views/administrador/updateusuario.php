<?php

use yii\helpers\Html;
$this->title = 'Actualizar : ' . $model->nombrecompleto;
$this->params['breadcrumbs'][] = ['label' => 'Actualizar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombrecompleto, 'url' => ['view', 'id' => $model->idusuario]];
$this->params['breadcrumbs'][] = 'Update';
?>




<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title"><?= Html::encode($this->title) ?></h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12">
                <div class="app-card app-card-settings shadow-sm p-5">
                    <div class="app-card-body labellefto">
                        <?= $this->render('_form2', [
                            'model' => $model,
                        ]) ?>

                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->

        <hr class="my-4">
    </div><!--//container-fluid-->
</div><!--//app-content-->





