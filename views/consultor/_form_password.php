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
        <div class="form-group password-wrapper">
            <?= $form->field($model, 'contrasena', [
                'template' => "{label}\n<div class=\"\">{input}
            <div class=\"input-group-append\">
                <button type=\"button\" id=\"toggle-password\" class=\"btn btn-secondary\">
                    <i class=\"fas fa-eye\"></i>
                </button>
            </div></div>\n{error}",
                'options' => ['class' => 'flex-grow-1 mb-0'] // Ajuste para ocupar espacio necesario
            ])->passwordInput(['class' => 'form-control']) ?>
        </div>



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

