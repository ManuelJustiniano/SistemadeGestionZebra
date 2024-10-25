<?php

use dosamigos\ckeditor\CKEditor;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use yii\helpers\Html;

?>
<?php
$format = <<< SCRIPT
function format(state) {
if (!state.id) return state.text; // optgroup
return state.text;
}
SCRIPT;
$escape = new \yii\web\JsExpression("function(m) { return m; }");
$this->registerJs($format, \yii\web\View::POS_HEAD);
?>
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'class' => 'settings-form',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL
        ] // important
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
        ]) ?>

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




<div class="form-group clsgua" >
        <?= Html::submitButton('GUARDAR', ['class' => $model->isNewRecord ? 'btn app-btn-primary' : 'btn app-btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

