<?php

use yii\bootstrap\Modal;
use yii\grid\GridView;

?>
    <div class="panel panel-default carw">

        <div class="panel-heading">
            <h3 class="panel-title"><strong>Historial de Compras</strong></h3>
        </div>
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $model,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'estado',
                    [
                        'header' => 'Codigo',
                        'attribute' => 'idcarrito',
                    ],
                    'fecha_registro',
                    'nit',
                    'razon_social',
                    // 'session',
                    'monto_total',
                    // 'fecha_pago',
                    //'tipo_pago',
                    // 'tipo_carro',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Operaciones',
                        'template' => '<div class="btn-group btn-group-justified" role="group">{view}</div>',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', "#", [
                                    'class' => 'btn btn-info',
                                    "title" => "Editar",
                                    "onClick" => "carrito('" . \yii\helpers\Url::to(['cuenta/carrito']) . "',{$key}); return false;"
                                ]);
                            },
                        ],
                        'contentOptions' => ['class' => 'col-sm-2']
                    ],//*/
                ],
            ]); ?>
        </div>
    </div>
<?php
Modal::begin([
    'header' => '<h2>Carrito</h2>',
    'id' => 'modal'
]);
echo "<div id='carrito'></div>";
Modal::end();
?>

<?php
$script = <<<JS
function carrito(url,id) {
  $.ajax({
  type: "GET",
  url: url,
  data: {id:id},
  success: function(data){
  $('#carrito').html(data);
  $('#modal').modal('show');
  },
  })
}
JS;
$this->registerJs($script, \yii\web\View::POS_HEAD);
