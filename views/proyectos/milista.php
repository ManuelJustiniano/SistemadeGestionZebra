<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
$this->title = 'PROYECTOS';
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
                        <h1><?= Html::encode($this->title);
                           echo Yii::$app->session->get('user')['id'];
                            ?> </h1>

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

                                                //'idnoticia',
                                                [
                                                    'header' => 'cliente',
                                                    'value' => function ($model) {
                                                        if (!empty($model->idcliente))
                                                            return $model->usuario['nombrecompleto'];
                                                        return '';
                                                    },
                                                     'filter' => \kartik\widgets\Select2::widget([
                                                         'model' => $searchModel,
                                                         'attribute' => 'idcliente',
                                                         'data' => \app\models\Usuarios::getSelectCliente(),
                                                         'language' => 'es',
                                                         'options' => [
                                                             'placeholder' => 'Clientes',
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
                                                    'header' => 'prioridad',
                                                    'value' => function ($model) {
                                                        if (!empty($model->prioridad))
                                                            return $model->prioridad;
                                                        return '';
                                                    },
                                                    'filter' => \kartik\widgets\Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'prioridad',
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
                                                    ])
                                                ],

                                                [
                                                    'header' => 'Fecha inicial',
                                                    'filter' =>  \kartik\date\DatePicker::widget([
                                                        'model' => $searchModel,
                                                        'language' => 'es',
                                                        'attribute' => 'fecha_inicio',
                                                        //'data' => \yii\helpers\ArrayHelper::map(Modulos::findAll(['estado' => '1']), 'idmodulo', 'nombre'),
                                                        'options' => ['placeholder' => ''],
                                                        'pluginOptions' => [
                                                            'autoclose' => true,
                                                            'format' => 'yyyy-mm-dd',
                                                            'todayBtn' => "linked",
                                                            'keyboardNavigation' => false,
                                                            'forceParse' => false,
                                                            'allowClear' => true

                                                        ],
                                                    ]),
                                                    'value' => 'fecha_inicio'
                                                ],

                                                [
                                                    'header' => 'Fecha final',
                                                    'filter' =>  \kartik\date\DatePicker::widget([
                                                        'model' => $searchModel,
                                                        'language' => 'es',
                                                        'attribute' => 'fecha_fin',
                                                        //'data' => \yii\helpers\ArrayHelper::map(Modulos::findAll(['estado' => '1']), 'idmodulo', 'nombre'),
                                                        'options' => ['placeholder' => ''],
                                                        'pluginOptions' => [
                                                            'autoclose' => true,
                                                            'format' => 'yyyy-mm-dd',
                                                            'todayBtn' => "linked",
                                                            'keyboardNavigation' => false,
                                                            'forceParse' => false,
                                                            'allowClear' => true

                                                        ],
                                                    ]),
                                                    'value' => 'fecha_fin'
                                                ],



                                                [
                                                    'class' => 'yii\grid\ActionColumn',
                                                    'header' => 'Operaciones',
                                                    'template' => '<div class="btn-group btn-group-justified" role="group">{viewproyect}</div>',
                                                    'buttons' => [
                                                        'viewproyect' => function ($url, $model, $key) {
                                                            return Html::a('<i class="toggle fa fa-eye"></i>', $url, ['class' => 'btn btn-primary',"title"=>"Ver"]);
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
                </div>
            </div>
        </div>
<?php
$this->registerJsFile(
    '@web/assets_b/js/estadosc.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>

