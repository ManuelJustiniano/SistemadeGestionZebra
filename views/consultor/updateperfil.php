<?php

use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'ACTUALIZAR CUENTA';
$format = <<< SCRIPT
function format(state) {
if (!state.id) return state.text; // optgroup
return state.text;
}
SCRIPT;
$escape = new \yii\web\JsExpression("function(m) { return m; }");
$this->registerJs($format, \yii\web\View::POS_HEAD);
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
                            'options' => ['enctype' => 'multipart/form-data'],
                            'class' => 'settings-form',
                            'action' => ['consultor/updateperfil'],

                            'type' => ActiveForm::TYPE_HORIZONTAL,
                            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL
                            ] // important
                        ]); ?>



                        <div class="col-12 col-lg-6 col-md-6 col-sm-12 mspeo">
                            <div class="mb-3">
                                <?= $form->field($model, 'nombrecompleto')->textInput(['class' => 'form-control', 'placeholder' => '']) ?>



                                <?= $form->field($model, 'email')->textInput(['class' => 'form-control input-lg', 'placeholder' => ' ']) ?>





                                <?= $form->field($model, 'usuario')->textInput(['class' => 'form-control', 'placeholder' => '']) ?>






                                <?= $form->field($model, 'telefono')->textInput(['class' => 'form-control input-lg', 'placeholder' => '']) ?>




                                <?= $form->field($model, 'movil')->textInput(['class' => 'form-control input-lg', 'placeholder' => '']) ?>


                                <?= $form->field($model, 'direccion')->textInput(['class' => 'form-control input-lg', 'placeholder' => '']) ?>





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
                                        'placeholder' => 'Seleccion el tipo de usuario',
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
                                    'options' => ['class' => 'form-control input-lg', 'placeholder' => ''],
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd',
                                        'todayBtn' => "linked",
                                        //'keyboardNavigation' => false,
                                        //'forceParse' => false
                                    ]
                                ]) ?>





                                <?= $form->field($model, 'empresa')->textInput(['class' => 'form-control input-lg', 'placeholder' => '']) ?>





                                <?= $form->field($model, 'cargo')->textInput(['class' => 'form-control input-lg', 'placeholder' => '']) ?>



                                <?= $form->field($model, 'pais')->widget(Select2::classname(), [
                                    'options' => [
                                        'placeholder' => 'Seleccione un pais',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true, // Permitir limpiar la selección
                                    ],
                                ]) ?>

                                <?= $form->field($model, 'ciudad')->widget(Select2::classname(), [
                                    'options' => [
                                        'placeholder' => 'Seleccione una ciudad',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true, // Permitir limpiar la selección
                                    ],
                                ]) ?>

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

                        <script>
                            // Definir la URL generada por Yii2 en una variable JavaScript global
                            var urlGetPaises = '<?= Url::to(['administrador/get-paises']) ?>';
                        </script>



                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->


        <hr class="my-4">
    </div><!--//container-fluid-->
</div><!--//app-content-->





<script src="../assets_b/js/paisciud.js"></script>