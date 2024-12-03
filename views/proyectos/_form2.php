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
        'action' => ['proyectos/asignaciondetareas', 'idproyecto' => $model->idproyecto],
        'class' => 'settings-form',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL
        ] // important
    ]); ?>


<div class="col-12 " >
    <div class="mb-3">

        <?php echo $form->field($model, 'idtarea')->widget(Select2::classname(), [

            'data' => \app\models\Tareas::getSelectTareas(),
            'language' => 'es',
            'options' => [
                'placeholder' => 'Tarea',
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

        <?php echo $form->field($model, 'idconsultor')->widget(Select2::classname(), [

            'data' => \app\models\Usuarios::getSelectConsultor(),
            'language' => 'es',
            'options' => [
                'placeholder' => 'Consultor',
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
<?= $form->field($model, 'fechainicio')->widget(
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
        <?= $form->field($model, 'fechafin')->widget(
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
        <?= Html::submitButton('Asignar', ['class' => $model->isNewRecord ? 'btn app-btn-primary' : 'btn app-btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

