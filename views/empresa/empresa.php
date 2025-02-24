<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\ContactForm */

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

$configuracion = \app\models\Configuracion::find()->one();
$this->render('../widgets/metatags', ['model' => $configuracion]);
 ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="light-title">Formulario <strong> de Registro </strong></h2>

            <?php $form = ActiveForm::begin([
                'options'=>['class'=>'', 'id' => '', 'enctype' => 'multipart/form-data'],
                'action'=>['site/eventos'],'method'=>'post',
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"\">{input}</div>\n<div class=\"\">{error}</div>",
                ],
                //'options'=>['class'=>'col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2']
            ]); ?>


                <div class="form-group required-field">
                    <label for="contact-name">Nombre</label>
                    <?= $form->field($model, 'nombre')->label(false)->textInput(['autofocus' => true, 'placeholder' => '', 'class' => 'form-control', 'required' => true]) ?>

                </div><!-- End .form-group -->

                <div class="form-group required-field">
                    <label for="contact-email">Email:</label>

                    <?= $form->field($model, 'email')->textInput(['placeholder' => '', 'class' => 'form-control', 'required' => true]) ?>


                </div><!-- End .form-group -->

                <div class="form-group">
                    <label for="contact-phone">Teléfono:</label>
                    <?= $form->field($model, 'telefono')->textInput(['placeholder' => '', 'class' => 'form-control', 'required' => true]) ?>

                </div><!-- End .form-group -->

                <div class="form-group required-field">
                    <label for="contact-message">Consulta:</label>

                    <?= $form->field($model, 'mensaje')->textarea(['class' => 'form-control', 'rows' => 5, 'placeholder' => '']) ?>

                </div><!-- End .form-group -->

                <div class="form-footer">

                    <?= Html::submitButton('Enviar mensaje', ['class' => 'btn btn-primary', 'name' => 'contact-button ']) ?>

                </div><!-- End .form-footer -->

            <?php ActiveForm::end(); ?>

        </div><!-- End .col-md-8 -->

    </div><!-- End .row -->
</div><!-- End .container -->







