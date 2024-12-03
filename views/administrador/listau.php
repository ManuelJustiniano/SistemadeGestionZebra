<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
$this->title = 'USUARIOS';
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




        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-12 optionstable">
                        <h1><?= Html::encode($this->title) ?> </h1>
                        <?= Html::a('Nuevo Usuario', ['create'], ['class' => 'btn btn-success btncreate']) ?>

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
                                                'nombrecompleto',
                                                'email',
                                                [
                                                    'header' => 'tipo usuario',
                                                    'value' => function ($model) {
                                                        $tiposUsuario = \app\models\Usuarios::getTipoUsuario();
                                                        if (!empty($model->tipo_usuario) && isset($tiposUsuario[$model->tipo_usuario])) {
                                                            return $tiposUsuario[$model->tipo_usuario];
                                                        }
                                                        return '';
                                                    },
                                                    'filter' => \kartik\widgets\Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'tipo_usuario',
                                                        'data' => \app\models\Usuarios::getTipoUsuario(),
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
                                                    ])
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
                                                                'onclick' => "cambiarEstadoUsuario('{$url}'); return false;"
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
