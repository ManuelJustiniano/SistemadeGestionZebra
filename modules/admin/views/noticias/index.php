<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NoticiasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Noticias';
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

$dias = date("Y").'-'.date("m").'-'.date("d");


?>
    <section class="content-header">

        <h1><?= Html::encode($this->title) ?> </h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php echo $dias ?>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-header">
                        <?= Html::a('Nueva Noticia', ['create'], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('<i class="fa fa-download"></i> Exportar', ['export'], ['class' => 'btn btn-default']) ?>

                    </div>

                    <div class="box-body ">
                        <?php Pjax::begin(['id' => 'table']); ?>
                        <div class="table-responsive">
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],

                                    //'idnoticia',
                                    [
                                        'header' => 'categoria',
                                        'value' => function ($model) {
                                            if (!empty($model->idcategoria))
                                                return $model->categoria['nombre'];
                                            return '';
                                        },
                                        'filter' => \kartik\widgets\Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'idcategoria',
                                            'data' => \app\models\Categoria::getSelectMenu('noticias'),
                                            'language' => 'es',
                                            'options' => [
                                                'placeholder' => 'Categorias',
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
                                    'titulo',
                                    //'resumen:ntext',
                                    // 'fuente',
                                    // 'url:url',
                                    // 'fecha_registro',
                                    // 'fecha_noticia',
                                    [
                                        'header' => 'Foto',
                                        'format' => 'raw',
                                        'value' => function ($model) {
                                            $img = \yii\helpers\Url::to($model->foto_portada);
                                            return "<img src='{$img}' class='img-thumbnail'>";
                                        },
                                        'contentOptions' => ['class' => 'col-md-3']
                                    ],
                                    /*[
                                        'class' => 'yii\grid\ActionColumn',
                                        'header' => 'Posicion',
                                        'template' => '<div class="btn-group btn-group-justified" role="group">{up}{down}</div>',
                                        'buttons' => [
                                            'up' => function ($url, $model, $key) {
                                                if ($model->idnoticia > 1) {
                                                    return Html::a('<i class="fa fa-chevron-up toggle"></i>', "#", ['class' => 'btn btn-info','onclick'=>"action('{$url}'); return false;", "title"=>"Arriba"]);
                                                }
                                                return Html::a('<i class="fa fa-chevron-up"></i>', '#', ['class' => 'btn btn-info disable']);
                                            },
                                            'down' => function ($url, $model, $key) {
                                                return Html::a('<i class="fa fa-chevron-down toggle"></i>', "#", ['class' => 'btn btn-info','onclick'=>"action('{$url}'); return false;","title"=>"Abajo"]);
                                            },
                                        ],
                                        'contentOptions' => ['class' => 'col-sm-1']
                                    ],*/
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'header' => 'Estado',
                                        'template' => '<div class="btn-group btn-group-justified" role="group">{estado}{destacado}</div>',
                                        'buttons' => [
                                            'estado' => function ($url, $model, $key) {
                                                return Html::a('<i class="toggle fa fa-eye"></i>', "#", ['class' => 'btn btn-' . (($model->estado) ? 'success' : 'default'), 'onclick' => "action('{$url}'); return false;", "title" => "Visible"]);
                                            },
                                            'destacado' => function ($url, $model, $key) {
                                                return Html::a('<i class="fa fa-star"></i>', "#", ['class' => 'btn btn-' . (($model->destacado) ? 'success' : 'default'), 'onclick' => "action('{$url}'); return false;", "title" => "Destacado"]);
                                            },
                                        ],
                                        'contentOptions' => ['class' => 'col-sm-1']
                                    ],
                                    /*[
                                        'class' => 'yii\grid\ActionColumn',
                                        'header' => 'Operaciones',
                                        'template' => '<div class="btn-group btn-group-justified" role="group">{galeria}{update}{delete}</div>',
                                        'buttons' => [
                                            'galeria' => function ($url, $model, $key) {
                                                return Html::a('<i class="fa fa-picture-o"></i>', $url, ['class' => 'btn btn-primary',"title"=>"Galeria"]);
                                            },
                                            'update' => function ($url, $model, $key) {
                                                return Html::a('<i class="fa fa-pencil"></i>', $url, ['class' => 'btn btn-info',"title"=>"Editar"]);
                                            },
                                            'delete' => function ($url, $model, $key) {

                                                return Html::a('<i class="fa fa-trash"></i>', $url, ['class' => 'btn btn-danger', 'data' => [
                                                    'confirm' => 'Esta seguro?.'
                                                ], "title"=>"Eliminar"]);
                                            },
                                        ],
                                        'contentOptions' => ['class' => 'col-sm-2']
                                    ],*/
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'header' => 'Operaciones',
                                        'template' => '<div class="btn-group btn-justified" role="group">{galeria}{all}</div>',
                                        'buttons' => [
                                            'all' => function ($url, $model, $key) {
                                                return \yii\bootstrap\ButtonDropdown::widget([
                                                    'encodeLabel' => false,
                                                    'label' => '<i class="glyphicon glyphicon-menu-hamburger"></i>',   // if you're going to use html on the button label
                                                    'dropdown' => [
                                                        'encodeLabels' => false, // if you're going to use html on the items' labels
                                                        'items' => [
                                                            [
                                                                'label' => \Yii::t('yii', '<i class="fa fa-picture-o"></i>Galeria'),
                                                                'url' => ['galeria', 'id' => $key],
                                                                'visible' => true,  // if you want to hide an item based on a condition, use this
                                                            ],
                                                            [
                                                                'label' => \Yii::t('yii', '<i class="fa fa-pencil"></i>Editar'),
                                                                'url' => ['update', 'id' => $key],
                                                                'visible' => true,  // if you want to hide an item based on a condition, use this
                                                            ],
                                                            [
                                                                'icon' => 'fa fa-trash',
                                                                'label' => \Yii::t('yii', '<i class="fa fa-trash"></i>Eliminar'),
                                                                'linkOptions' => [
                                                                    'data' => [
                                                                        'method' => 'post',
                                                                        'confirm' => \Yii::t('yii', 'Esta seguro?'),
                                                                    ],
                                                                ],
                                                                'url' => ['delete', 'id' => $key],
                                                                'visible' => true,   // same as above
                                                            ],

                                                        ],
                                                    ],
                                                    'options' => [
                                                        'class' => 'btn-default',
                                                        // btn-success, btn-info, et cetera
                                                    ],
                                                ]);
                                            },


                                        ],
                                        'contentOptions' => ['class' => 'col-sm-2']
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
