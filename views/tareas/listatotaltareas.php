<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
$this->title = 'TAREAS';
?>


        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-12 optionstable">
                        <h1><?= Html::encode($this->title) ?> </h1>
                        <?= Html::a('Nueva Tarea', ['create'], ['class' => 'btn btn-success btncreate']) ?>

                    </div>
                    <div class="tab-content" id="orders-table-tab-content">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="box-body ">
                                    <?php Pjax::begin(['id' => 'table']); ?>
                                    <div class="table-responsive">
                                        <?= GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],
                                                'titulo',
                                                [
                                                    'attribute' => 'descripcion',
                                                    'value' => function ($model) {
                                                        return \yii\helpers\StringHelper::truncate(html_entity_decode(strip_tags($model->descripcion)), 100);
                                                    },
                                                ],
                                                [
                                                    'header' => 'Modulo',
                                                    'filter' => \kartik\widgets\Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'modulo',
                                                        'data' => \yii\helpers\ArrayHelper::map(\app\models\Modulos::findAll(['estado' => '1']), 'idmodulo', 'nombre'),
                                                        'options' => ['placeholder' => ''],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]),
                                                    'value' => function ($model) {
                                                        if (!empty($model->modulos))
                                                            return $model->modulos['nombre'];
                                                        return '';
                                                    },
                                                ],


                                                [
                                                    'class' => 'yii\grid\ActionColumn',
                                                    'header' => 'Operaciones',
                                                    'template' => '<div class="btn-group btn-group-justified" role="group">{view}{update}</div>',
                                                    'buttons' => [
                                                        'view' => function ($url, $model, $key) {
                                                            return Html::a('<i class="toggle fa fa-eye"></i>', $url, ['class' => 'btn btn-primary',"title"=>"Ver"]);
                                                        },
                                                        'update' => function ($url, $model, $key) {
                                                            return Html::a('<i class="fa fa-pencil"></i>', $url, ['class' => 'btn btn-info',"title"=>"Editar"]);
                                                        },

                                                    ],
                                                    'contentOptions' => ['class' => 'col-sm-2']
                                                ],

                                                [
                                                    'class' => 'yii\grid\ActionColumn',
                                                    'header' => 'Estado',
                                                    'template' => '<div class="btn-group btn-group-justified" role="group">{estado}</div>',
                                                    'buttons' => [
                                                        'estado' => function ($url, $model, $key) {
                                                            $iconClass = $model->estado ? 'fa fa-unlock' : 'fa fa-lock'; // Cambia el icono según el estado
                                                            $btnClass = $model->estado ? 'btn btn-success sep' : 'btn btn-danger'; // Cambia el color del botón según el estado

                                                            return Html::a("<i class='$iconClass'></i>", "#", [
                                                                'class' => $btnClass,
                                                                'title' => 'Estado',
                                                                'onclick' => "cambiarEstadoTarea('{$url}'); return false;"
                                                            ]);
                                                        },

                                                    ],
                                                    'contentOptions' => ['class' => 'col-sm-1']
                                                ],

                                            ],
                                        ]); ?>
                                    </div>
                                    <?php Pjax::end(); ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
$this->registerJsFile(
    '@web/assets_b/js/estadosc.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
