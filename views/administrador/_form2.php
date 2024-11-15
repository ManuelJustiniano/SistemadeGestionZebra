<?php


use dosamigos\ckeditor\CKEditor;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use yii\helpers\Html;

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
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL
        ] // important
    ]); ?>




<div class="col-12 col-lg-6 col-md-6 col-sm-12 mspeo">
    <div class="mb-3">
        <?= $form->field($model, 'nombrecompleto')->textInput(['class' => 'form-control', 'placeholder' => 'Nombre']) ?>



        <?= $form->field($model, 'email')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Correo electronico']) ?>





        <?= $form->field($model, 'usuario')->textInput(['class' => 'form-control', 'placeholder' => 'Usuario']) ?>















        <?= $form->field($model, 'telefono')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Telefono']) ?>




        <?= $form->field($model, 'movil')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Celular']) ?>


        <?= $form->field($model, 'direccion')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Ciudad']) ?>





        <?= $form->field($model, 'sexo')->widget(Select2::classname(), [
            'data' => [
                'Hombre' => 'Hombre',
                'Mujer' => 'Mujer',
            ],
            'options' => [
                'placeholder' => 'Seleccione Sexo...',
            ],
            'pluginOptions' => [
                'allowClear' => true, // Permitir limpiar la selección
            ],
        ]) ?>

    </div>
</div>

<div class="col-12 col-lg-6 col-md-6 col-sm-12 ">
    <div class="mb-3">
        <?php echo $form->field($model, 'tipo_usuario')->widget(Select2::classname(), [

            'data' => \app\models\UsuariosSearch::getTipoUsuario(),
            'language' => 'es',
            'options' => [
                'placeholder' => 'Tipo Usuario',
                //'multiple' => true,
            ],
            'pluginOptions' => [
                'templateResult' => new \yii\web\JsExpression('format'),
                'templateSelection' => new \yii\web\JsExpression('format'),
                'escapeMarkup' => $escape,
                'allowClear' => true
            ],
        ]); ?>


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





        <?= $form->field($model, 'empresa')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Empresa']) ?>





        <?= $form->field($model, 'cargo')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Cargo']) ?>



        <?= $form->field($model, 'pais')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Pais']) ?>





        <?= $form->field($model, 'ciudad')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Ciudad']) ?>




    </div>
</div>


<div class="form-group clsgua" >

    <div class="col-12 col-sm-12 col-md-12 col-lg-12" align="center">

    <div class="mb-3">
        <?= Html::submitButton($model->isNewRecord ? 'GUARDAR' : 'ACTUALIZAR',    ['class' => 'btn app-btn-primary btform']
        ) ?>
    </div>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

