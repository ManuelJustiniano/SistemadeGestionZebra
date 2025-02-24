<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$model = new \app\models\Suscribe();

?>

<div id="solicitud">
    <div class="container">
        <div class="row vcenter-top">
            <div class="col-md-12 text-center">
                <h1 class="text-white text-aileroul34">¿DESEAS CONOCER LAS ULTIMAS COLECCIONES?</h1>
                <p class="text-white text-aileroul16">Deja tus datos personales en los campos subcritos abajo y comienza
                    recibir nuestras ultimas promos y colecciones para que estes siempre informado</p>
            </div>
        </div>
        <div class="row vcenter-bottom">

            <?php $form = ActiveForm::begin(['id' => 'frmContact1', 'class' => 'form-horizontal top-spacing2']); ?>

            <div class="col-md-8 col-md-offset-2">
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12 ">
                        <?= $form->field($model, 'nombre')->textInput(['placeholder' => 'Nombre Completo', 'required' => true]) ?>
                        <!-- <input class="form-control text-center" id="vf_nombre" name="vf_nombre" placeholder="" required/>
                     -->
                    </div>
                    <div class="col-sm-6 col-xs-12 ">
                        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Correo Electronico', 'required' => true]) ?>

                        <!-- <input class="form-control text-center" id="vf_correo" name="vf_correo" placeholder="" required/>
                         -->
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12 col-sm-4  col-sm-offset-4 col-xs-offset-0  text-center">

                        <?= Html::submitButton('SUSCRIBIRSE', ['class' => 'fsSubmitButton', 'name' => 'contact-button']) ?>

                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>


        </div>
    </div>
</div>