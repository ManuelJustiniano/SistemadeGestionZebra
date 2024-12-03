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
    <div class="col-12 " >
        <div class="mb-3">
            <?= $form->field($model, 'titulo')->textInput(['class' => 'form-control','maxlength' => true]) ?>
        </div>
    </div>

<div class="col-12 " >
    <div class="mb-3">
        <?php echo $form->field($model, 'idcliente')->widget(Select2::classname(), [
            'data' => \app\models\Usuarios::getSelectCliente(),
            'language' => 'es',
            'options' => [
                'placeholder' => 'Cliente',
                'disabled' => !$model->isNewRecord, // Deshabilitar si el modelo ya existe (es una actualización)
                //'multiple' => true,
            ],
            'pluginOptions' => [
                'templateResult' => new \yii\web\JsExpression('format'),
                'templateSelection' => new \yii\web\JsExpression('format'),
                'escapeMarkup' => $escape,
                'allowClear' => true
            ],
        ]); ?>
    </div>
</div>

<div class="col-12 " >
    <div class="mb-3">

        <?php echo $form->field($model, 'prioridad')->widget(Select2::classname(), [

            'data' => \app\models\Proyectos::getPrioridad(),
            'language' => 'es',
            'options' => [
                'placeholder' => 'Prioridad',
                //'multiple' => true,
            ],
            'pluginOptions' => [
                'templateResult' => new \yii\web\JsExpression('format'),
                'templateSelection' => new \yii\web\JsExpression('format'),
                'escapeMarkup' => $escape,
                'allowClear' => true
            ],
        ]); ?>
    </div>
</div>
<div class="col-12 " >
    <div class="mb-3">
<?= $form->field($model, 'fecha_inicio')->widget(
    DatePicker::className(), [
    // modify template for custom rendering
    'language' => 'es',
    'pluginOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
        'todayBtn' => "linked",
        'keyboardNavigation' => false,
        'forceParse' => false
    ]
]); ?>
    </div>
</div>



<div class="col-12 " >
    <div class="mb-3">
        <?= $form->field($model, 'fecha_fin')->widget(
            DatePicker::className(), [
            // modify template for custom rendering
            'language' => 'es',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'todayBtn' => "linked",
                'keyboardNavigation' => false,
                'forceParse' => false
            ]
        ]); ?>
    </div>
</div>


<div class="col-12 " >
    <div class="mb-3">
        <?= $form->field($model, 'descripcion')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => [
                'allowedContent'=> true,
                'extraAllowedContent' => 'div',
            ]
        ]) ?>
    </div>
</div>



    <div class="form-group clsgua" >
        <?= Html::submitButton('Guardar proyecto', ['class' => $model->isNewRecord ? 'btn app-btn-primary' : 'btn app-btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

