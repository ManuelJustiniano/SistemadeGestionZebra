<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
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
                        <?= Html::a('Nuevo Usuario', ['create'], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('<i class="fa fa-download"></i> Exportar', ['export'], ['class' => 'btn btn-default']) ?>
                    </div>

                    <div class="box-body ">

                        <?php Pjax::begin(['id' => 'table']); ?>
                        <div class="table-responsive">   <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],

                                    //'idusuario',
                                    'nombre',
                                    'apellido',
                                    'direccion',
                                    'telefono',
                                    // 'pais',
                                    // 'ciudad',
                                    'email:email',
                                    // 'contrasena',
                                    // 'fecha_nacimiento',
                                    // 'movil',
                                    // 'fecha_registro',
                                    // 'estado',
                                    // 'sexo',
                                    // 'activo',

                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'header' => 'Operaciones',
                                        'template' => '<div class="btn-group btn-group-justified" role="group">{view}{delete}</div>',
                                        'buttons' => [
                                            'view' => function ($url, $model, $key) {
                                                return Html::a('<i class="fa fa-eye"></i>', $url, ['class' => 'btn btn-info', "title" => "Editar"]);
                                            },
                                            'delete' => function ($url, $model, $key) {
                                                return Html::a('<i class="fa fa-trash"></i>', $url, ['class' => 'btn btn-danger', 'data' => [
                                                    'confirm' => 'Esta seguro?.'
                                                ], "title" => "Eliminar"]);
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

