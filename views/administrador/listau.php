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

<?= $this->render('../widgets/menu', [
    'lista' => [
        'items' => [
            ['label' => 'Mi cuenta', 'url' => ['administrador/cuenta'], 'options' => ['class' => 'nav-item']],
            ['label' => 'Proyectos', 'url' => ['/proyectos/index'], 'options' => ['class' => 'nav-item']],
            ['label' => 'Tareas', 'url' => ['/tareas/index'], 'options' => ['class' => 'nav-item']],
            ['label' => 'Mensajes', 'url' => ['/administrador/perfil'], 'options' => ['class' => 'nav-item']],
            ['label' => 'Materiales', 'url' => ['/administrador/perfil'], 'options' => ['class' => 'nav-item']],
            ['label' => 'Usuarios', 'url' => ['/administrador/usuarioslist'], 'options' => ['class' => 'nav-item']],
        ],
    ], 'tipousuario' => 'administrador',
]) ?>




    <div class="app-wrapper">
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
                                                    'template' => '<div class="btn-group btn-group-justified" role="group">{view}{update}{delete}</div>',
                                                    'buttons' => [
                                                        'view' => function ($url, $model, $key) {
                                                            return Html::a('<i class="toggle fa fa-eye"></i>', $url, ['class' => 'btn btn-primary',"title"=>"Ver"]);
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