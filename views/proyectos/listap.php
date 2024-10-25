<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
$this->title = 'PROYECTOS';
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


<?php foreach (Yii::$app->session->getAllFlashes() as $message): ?>
    <?php /*= \kartik\widgets\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? \yii\helpers\Html::encode($message['message']) : 'Message Not Set!',
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 5000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);*/
    \yii2mod\alert\Alert::widget([
        'useSessionFlash' => false,
        'options' => [
            'type' => (!empty($message['type'])) ? $message['type'] : 'error',
            'title' => (!empty($message['message'])) ? \yii\helpers\Html::encode($message['message']) : 'Message Not Set!',
            'animation' => "slide-from-top",
        ],
    ]); ?>
<?php endforeach; ?>

<?php
if ($tipo_usuario == '1') {
    echo $this->render('../widgets/menu', [
        'lista' => [
            'items' => [
                ['label' => 'Mi cuenta', 'url' => ['administrador/cuenta'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Proyectos', 'url' => ['/proyectos/index'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Tareas', 'url' => ['/tareas/index'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Mensajes', 'url' => ['/cuenta/perfil'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Materiales', 'url' => ['/cuenta/perfil'], 'options' => ['class' => 'nav-item']],
            ],
        ], 'tipousuario' => 'administrador',
    ]);
} elseif ($tipo_usuario == '2') {
    echo $this->render('../widgets/menu', [
        'lista' => [
            'items' => [
                ['label' => 'Mi cuenta', 'url' => ['gestor/cuenta'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Proyectos', 'url' => ['/proyectos/index'], 'options' => ['class' => 'nav-item']],
                ['label' => 'Tareas', 'url' => ['/tareas/index'], 'options' => ['class' => 'nav-item']],
            ],
        ], 'tipousuario' => 'gestor',
    ]);
}
?>

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-12 optionstable">
                        <h1><?= Html::encode($this->title) ?> </h1>
                        <?= Html::a('Nuevo Proyecto', ['create'], ['class' => 'btn btn-success btncreate']) ?>

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



                                                //'resumen:ntext',
                                                // 'fuente',
                                                // 'url:url',
                                                // 'fecha_registro',
                                                // 'fecha_noticia',

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
                                                    'header' => 'Operaciones',
                                                    'template' => '<div class="btn-group btn-group-justified" role="group">{view}{update}{asignaciondetareas}{delete}</div>',
                                                    'buttons' => [
                                                        'view' => function ($url, $model, $key) {
                                                            return Html::a('<i class="toggle fa fa-eye"></i>', $url, ['class' => 'btn btn-primary',"title"=>"Ver"]);
                                                        },
                                                        'asignaciondetareas' => function ($url, $model, $key) {
                                                            return Html::a('<i class="toggle fa fa-list"></i>',  ['proyectos/asignaciondetareas', 'idproyecto' => $model->idproyecto], ['class' => 'btn btn-primary',"title"=>"Ver"]);
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
</div>
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