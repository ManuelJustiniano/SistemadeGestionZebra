<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

?>
<div class="panel panel-default carw">

    <div class="panel-heading">
        <h3 class="panel-title"><strong>Datos de Cuenta</strong></h3>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'id' => 'frmContact',
            'action' => [($model->isNewRecord) ? 'cuenta/register' : 'cuenta/datos'],
            'method' => 'post'
        ]); ?>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group as">
                    <?= $form->field($model, 'nombrecompleto')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Nombre'])->label(false) ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group as">
                    <?= $form->field($model, 'usuario')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Apellido'])->label(false) ?>
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
            <div class="col-xs-12 ">

                <?= Html::submitButton('Actualizar', ['class' => 'btn btn-success btn-lg center-block', 'name' => 'contact-button']) ?>

            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
