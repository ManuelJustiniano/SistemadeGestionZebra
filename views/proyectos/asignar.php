<?php

use yii\helpers\Html;
$this->title = 'Asignar a : '. $model->proyecto->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Asignar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>




<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title"><?= Html::encode($this->title) ?></h1>
        <hp class=""> <strong>Cliente:</strong> <?=  $model->proyecto->cliente->nombrecompleto;?> - <?=  $model->proyecto->cliente->empresa;?></hp>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
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





