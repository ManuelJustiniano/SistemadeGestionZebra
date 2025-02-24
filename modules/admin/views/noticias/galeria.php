<?php

use kartik\widgets\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Productos */

$this->title = 'Galeria';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <?= Html::a('Atras', Yii::$app->request->referrer, ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Actualizar', '#', ['class' => 'btn btn-success', 'onclick' => 'galeria();return false;']) ?>
                </div>
                <div class="box-body ">
                    <?php Pjax::begin(['id' => 'galeria']) ?>
                    <?php
                    $initial = [];
                    $config = [];
                    foreach ($galeria as $item) {
                        array_push($initial, Html::img(\yii\helpers\Url::to('@web/imagen/noticias/' . $item->archivo), ['class' => 'kv-preview-data krajee-init-preview file-preview-image', 'style' => 'max-height:160px']));
                        array_push($config, ["previewAsData" => false, "caption" => $item->archivo, "url" => Url::to(['erase']), "key" => $item->idgaleria]);
                    }
                    $form = ActiveForm::begin([
                        'options' => ['enctype' => 'multipart/form-data']]); // important
                    echo $form->field($model, 'file')->widget(FileInput::classname(), [
                        'options' => [
                            'multiple' => true,
                            'accept' => 'image/*',

                        ],
                        'pluginOptions' => [
                            'uploadUrl' => Url::to(['noticias/upload']),
                            'uploadExtraData' => [
                                'id' => $id,
                            ],
                            'initialPreviewFileType' => 'image',
                            //'maxFileCount' => 10,
                            'allowedFileExtensions' => ['jpg', 'png', 'gif'],
                            'initialPreview' => $initial,
                            'initialPreviewConfig' => $config,
                            "language" => "es"
                        ]
                    ]);
                    ActiveForm::end();
                    ?>

                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>

    </div>
</section>

<?php
$script = <<<JS
function galeria() {
  $.pjax.reload({container:'#galeria'}); //refresh the grid
}
JS;
$this->registerJs($script, \yii\web\View::POS_HEAD)
?>
