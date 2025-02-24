<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */
use yii\bootstrap\ActiveForm;
//use kartik\widgets\TimePicker;
use yii\helpers\Url;
//use kartik\widgets\DatePicker;
use yii\helpers\Html;
$configuracion = \app\models\Configuracion::find()->one();
$this->render('../widgets/metatags', ['model' => $configuracion]);

 ?>



<div class="container">
    <div class="row ">
        <div class="col-md-12 spacitop">
            <h2 class="light-title">Formulario <strong> de registro de evento </strong></h2>

            <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
                'action'=>['site/registrareventos'],'method'=>'post',
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"\">{input}</div>\n<div class=\"\">{error}</div>",
                ],
            ]); ?>

                <div class="form-group required-field">
                    <?= $form->field($model, 'titulo')->textInput(['placeholder' => '', 'class' => 'form-control']) ?>

                </div><!-- End .form-group -->
            <div class="form-group required-field">
                <?= $form->field($model, 'fecha_evento')->textInput(['placeholder' => '', 'class' => 'form-control']) ?>

            </div><!-- End .form-group -->

            <div class="form-group required-field">
                <?= $form->field($model, 'hora_evento')->textInput(['placeholder' => '', 'class' => 'form-control']) ?>

            </div><!-- End .form-group -->

            <input type="hidden" id="evento-idusuario" value="1" class="form-control" name="Evento[idusuario]" placeholder="">
            <input type="hidden" id="evento-email" value="manueljustinia@gmail.com" class="form-control" name="Evento[email]" placeholder="">
                <div class="form-group">
                    <?= $form->field($model, 'ubicacion')->textInput(['placeholder' => '', 'class' => 'form-control']) ?>

                </div><!-- End .form-group -->


            <div class="form-group">
                <?= $form->field($model, 'honorarios')->textInput(['placeholder' => '', 'class' => 'form-control']) ?>

            </div><!-- End .form-group -->



                <div class="form-group required-field">

                    <?= $form->field($model, 'descripcion')->textarea(['class' => 'form-control', 'rows' => 5, 'placeholder' => '']) ?>

                </div><!-- End .form-group -->

            <div class="form-group required-field">

                <?= $form->field($model, 'requisitos')->textarea(['class' => 'form-control', 'rows' => 5, 'placeholder' => '']) ?>

            </div><!-- End .form-group -->

                <div class="form-footer">

                    <?= Html::submitButton('Enviar mensaje', ['class' => 'btn btn-primary', 'name' => 'contact-button ']) ?>

                </div><!-- End .form-footer -->

            <?php ActiveForm::end(); ?>

        </div><!-- End .col-md-8 -->

    </div><!-- End .row -->
</div><!-- End .container -->






