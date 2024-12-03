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

        <?php // Top most parent
         echo $form->field($model, 'modulo')->widget(\kartik\widgets\Select2::classname(), [
             'data' => \yii\helpers\ArrayHelper::map(\app\models\Modulos::findAll(['estado' => '1']), 'idmodulo', 'nombre'),
             'language' => 'es',
             'options' => ['placeholder' => 'Modulos'],
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
        <?= Html::submitButton('GUARDAR', ['class' => $model->isNewRecord ? 'btn app-btn-primary' : 'btn app-btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

