<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
$this->title = 'ACTUALIZAR PASSWORD';
?>


<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Cambiar contraseña usuario</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">

            <div class="col-12">
                <div class="app-card app-card-settings shadow-sm p-4">

                    <div class="app-card-body">


                        <?php $form = ActiveForm::begin([
                            'id' => 'frmContact',
                            'class' => 'settings-form',
                            'method' => 'post'
                        ]); ?>
                        <div class="col-12 col-lg-12">
                            <div class="mb-3">
                                <?= $form->field($model, 'currentPassword')->passwordInput(['class' => 'form-control', 'placeholder' => '']) ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12  " >
                            <div class="mb-3">
                                <?= $form->field($model, 'newPassword')->passwordInput(['class' => 'form-control', 'placeholder' => '']) ?>
                            </div>
                        </div>


                        <div class="col-12 col-lg-12  " >
                            <div class="mb-3">
                                <?= $form->field($model, 'confirmPassword')->passwordInput(['class' => 'form-control', 'placeholder' => '']) ?>
                            </div>
                        </div>



                        <?= Html::submitButton('Actualizar', ['class' => 'btn app-btn-primary', 'name' => 'contact-button']) ?>




                        <?php ActiveForm::end(); ?>


                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->


        <hr class="my-4">
    </div><!--//container-fluid-->
</div><!--//app-content-->





