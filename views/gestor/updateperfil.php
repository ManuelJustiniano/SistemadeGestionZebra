<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
$this->title = 'ACTUALIZAR CUENTA';
?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Actualizar mis datos</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">

            <div class="col-12">
                <div class="app-card app-card-settings shadow-sm p-4">

                    <div class="app-card-body">

                            <?php $form = ActiveForm::begin([
                                'id' => 'frmContact',
                                'class' => 'settings-form',
                                'action' => ['gestor/updateperfil'],
                                'method' => 'post'
                            ]); ?>
                        <div class="col-12 col-lg-6  " style="padding-left: 0">
                            <div class="mb-3">
                                <?= $form->field($model, 'nombrecompleto')->textInput(['class' => 'form-control', 'placeholder' => 'Nombre']) ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6  " style="padding-left: 0">
                            <div class="mb-3">
                                <?= $form->field($model, 'usuario')->textInput(['class' => 'form-control', 'placeholder' => 'Usuario']) ?>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6  " style="padding-left: 0">
                            <div class="mb-3">
                                <?= $form->field($model, 'email')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Correo electronico']) ?>

                            </div>
                        </div>

                        <div class="col-12 col-lg-6  " style="padding-left: 0">
                            <div class="mb-3">
                                <?= $form->field($model, 'telefono')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Telefono']) ?>

                            </div>
                        </div>

                        <div class="col-12 col-lg-6  " style="padding-left: 0">
                            <div class="mb-3">
                                <?= $form->field($model, 'movil')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Celular']) ?>

                            </div>
                        </div>


                        <div class="col-12 col-lg-6  " style="padding-left: 0">
                            <div class="mb-3">
                                <?= $form->field($model, 'sexo')->dropDownList(
                                    [
                                        'Hombre' => 'Hombre',
                                        'Mujer' => 'Mujer',
                                    ],
                                    [
                                        'prompt' => 'Sexo',
                                    ]
                                ) ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6  " style="padding-left: 0">
                            <div class="mb-3">


                        <?= $form->field($model, 'fecha_nacimiento')->widget(
                            \kartik\widgets\DatePicker::className(), [
                            // modify template for custom rendering
                            'language' => 'es',
                            'removeButton' => false,
                            'options' => ['class' => 'form-control input-lg', 'placeholder' => 'Fecha de Naciemiento'],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd',
                                'todayBtn' => "linked",
                                //'keyboardNavigation' => false,
                                //'forceParse' => false
                            ]
                        ])->label(false); ?>

                            </div>
                        </div>



                        <div class="col-12 col-lg-6  " style="padding-left: 0">
                            <div class="mb-3">
                                <?= $form->field($model, 'empresa')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Empresa']) ?>

                            </div>
                        </div>


                        <div class="col-12 col-lg-6  " style="padding-left: 0">
                            <div class="mb-3">
                                <?= $form->field($model, 'cargo')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Cargo']) ?>

                            </div>
                        </div>

                        <div class="col-12 col-lg-6  " style="padding-left: 0">
                            <div class="mb-3">
                                <?= $form->field($model, 'pais')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Pais']) ?>

                            </div>
                        </div>


                        <div class="col-12 col-lg-6  " style="padding-left: 0">
                            <div class="mb-3">
                                <?= $form->field($model, 'ciudad')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Ciudad']) ?>

                            </div>
                        </div>

                        <div class="col-12 col-lg-6  " style="padding-left: 0">
                            <div class="mb-3">
                                <?= $form->field($model, 'direccion')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Ciudad']) ?>

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





