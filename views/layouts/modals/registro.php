<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

?>
<!-- line modal REgistro -->
<div class="modal fade" id="squarespaceModal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                <h2 class="modal-title" id="lineModalLabel">Registrarse</h2>

                <div class="linea12"></div>
                <div class="linea13"></div>

            </div>
            <div class="modal-body">
                <?php
                $model = new \app\models\Usuarios();
                ?>
                <!-- content goes here -->

                <?php $form = ActiveForm::begin(['id' => 'frmContact', 'action' => ['cuenta/register'], 'method' => 'post']); ?>

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group as">
                            <?= $form->field($model, 'nombre')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Nombre'])->label(false) ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group as">
                            <?= $form->field($model, 'apellido')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Apellido'])->label(false) ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group as">
                            <?= $form->field($model, 'pais')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Pais'])->label(false) ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group as">
                            <?= $form->field($model, 'ciudad')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'ciudad'])->label(false) ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group as">
                            <?= $form->field($model, 'direccion')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Direccion'])->label(false) ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group as">
                            <?= $form->field($model, 'telefono')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Telefono'])->label(false) ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group as">
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
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group as">
                            <?= $form->field($model, 'email')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Correo electronico'])->label(false) ?>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group as">
                            <?= $form->field($model, 'contrasena')->passwordInput(['class' => 'form-control input-lg', 'placeholder' => 'Password'])->label(false) ?>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12 col-md-6">

                        <?= Html::submitButton('Registrar', ['class' => 'btn btn-success btn-block btn-lg', 'name' => 'contact-button']) ?>

                    </div>
                    <div class="col-xs-12 col-md-6">
                        <button type="button" class="btn btn-danger btn-block btn-lg" data-dismiss="modal"
                                role="button">Cancelar
                        </button>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>

            </div>

        </div>
    </div>
</div>