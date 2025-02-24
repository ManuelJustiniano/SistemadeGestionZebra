<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InventarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventarios';
$this->params['breadcrumbs'][] = $this->title;
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
    <section class="content-header">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-header">
                        <?= Html::a('Nuevo Inventario', ['create'], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('<i class="fa fa-download"></i> Exportar', ['export'], ['class' => 'btn btn-default']) ?>
                        <?= Html::a('<i class="fa fa fa-file"></i> Importar', ['export'], ['class' => 'btn btn-default']) ?>

                    </div>


                    <div class="box-body ">

                        <?php Pjax::begin(['id' => 'table']); ?>
                        <div class="table-responsive">
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    //'idinventario',
                                    [
                                        'header' => 'Producto',
                                        'value' => function ($model) {
                                            if ($model->producto) {
                                                return $model->producto['titulo'];
                                            }
                                            return '';
                                        },
                                        'filter' => \kartik\widgets\Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'idproducto',
                                            'data' => \yii\helpers\ArrayHelper::map(\app\models\Productos::find()->all(),'idproducto','titulo'),
                                            'language' => 'es',
                                            'options' => [
                                                'placeholder' => 'Productos',
                                                //'multiple' => true,
                                            ],
                                            'pluginOptions' => [
                                                'templateResult' => new \yii\web\JsExpression('format'),
                                                'templateSelection' => new \yii\web\JsExpression('format'),
                                                'escapeMarkup' => $escape,
                                                'allowClear' => true
                                            ],
                                        ])
                                    ],
                                    'movimiento',
                                    'saldo',
                                    'fecha_registro',
                                    // 'estado',
                                    // 'detalle:ntext',
                                    [
                                        'header' => 'Talla',
                                        'value' => function ($model) {
                                            if ($model->talla) {
                                                return $model->talla['valor'];
                                            }
                                            return '';
                                        },
                                    ],
                                ],
                            ]); ?>
                        </div>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
$script = <<<JS
    function action(url)
    {
    $.get(url, function(data) {
      $.pjax.reload({container:"#table"});
    });
    }

JS;
$this->registerJs($script, \yii\web\View::POS_HEAD);