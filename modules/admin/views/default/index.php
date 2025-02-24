<?php

/* @var $this yii\web\View */

$this->title = 'SISTEMA';
date_default_timezone_set('America/La_Paz');
$time = new \DateTime('now');
$today = $time->format('Ymd');
$mesii = $time->format('m');
$mani = $time->format('Y');

?>

<style>
    .bg-red, .callout.callout-danger, .alert-danger, .alert-error, .label-danger, .modal-danger .modal-body {
        background-color: #2196f3 !important;
    }

    .tsno{
        text-transform: uppercase;
        padding-bottom: 10px;
        padding-top: 9px;
        font-weight: 600;
    }
</style>


<section class="content">
    <div class="row">






        <h3 class="text-center tsno">
            Datos registrados totales
        </h3>

        <div class="col-xs-12">

        <div class="col-sm-4 col-md-4">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-red"><i class="fa fa-archive"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ventas Realizadas</span>

                    <span class="info-box-number"> </span>

                    <span class="info-box-number">
                    <?php echo \app\models\Carrito::find()->count() ?>

                </span>
                </div>

                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-sm-4 col-md-4">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-red"><i class="fa fa-archive"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Recaudado</span>

                    <span class="info-box-number"> </span>

                    <span class="info-box-number">
                    <?php echo \app\models\Carrito::find()->sum('monto_total') ?> Bs.

                </span>
                </div>

                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-sm-4 col-md-4">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-red"><i class="fa fa-archive"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Cantidad vendida</span>

                    <span class="info-box-number"> </span>

                    <span class="info-box-number">
                    <?php echo \app\models\Detallecarrito::find()->sum('cantidad') ?>

                </span>
                </div>

                <!-- /.info-box-content -->
            </div>
        </div>
        </div>


        <div class="col-xs-12">
            <h3 class="text-center tsno">
                Datos registrados hoy
            </h3>

            <div class="col-sm-4 col-md-4">
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-red"><i class="fa fa-archive"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Ventas Realizadas</span>

                        <span class="info-box-number"> </span>

                    <span class="info-box-number">
                    <?php echo \app\models\Carrito::find()->where(['fecha_ventai' => $today])->count() ?>
                    <?php // echo \app\models\Carrito::find()->where(['fecha_ventai' >= INTER])->count() ?>

                </span>
                    </div>

                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-sm-4 col-md-4">
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-red"><i class="fa fa-archive"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Recaudado</span>

                        <span class="info-box-number"> </span>

                    <span class="info-box-number">
                    <?php echo \app\models\Carrito::find()->where(['fecha_ventai' => $today])->sum('monto_total') ?> Bs.

                </span>
                    </div>

                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-sm-4 col-md-4">
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-red"><i class="fa fa-archive"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Cantidad vendida</span>

                        <span class="info-box-number"> </span>

                    <span class="info-box-number">
                    <?php echo \app\models\Detallecarrito::find()->where(['fecha_ventas' => $today])->sum('cantidad') ?>

                </span>
                    </div>

                    <!-- /.info-box-content -->
                </div>
            </div>

        </div>

        <div class="col-xs-12">
            <h3 class="text-center tsno">
                Datos registrados del mes
            </h3>

            <div class="col-sm-4 col-md-4">
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-red"><i class="fa fa-archive"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Ventas Realizadas</span>

                        <span class="info-box-number">
</span>
                    <span class="info-box-number">
                    <?php echo \app\models\Carrito::find()->where(['mes' => $mesii ])->count() ?>
                    <?php // echo \app\models\Carrito::find()->where(['fecha_ventai' >= INTER])->count() ?>

                </span>
                    </div>

                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-sm-4 col-md-4">
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-red"><i class="fa fa-archive"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Recaudado</span>

                        <span class="info-box-number"> </span>

                    <span class="info-box-number">
                    <?php echo \app\models\Carrito::find()->where(['mes' => $mesii, 'ano' => $mani])->sum('monto_total') ?> Bs.

                </span>
                    </div>

                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-sm-4 col-md-4">
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-red"><i class="fa fa-archive"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Cantidad vendida</span>

                        <span class="info-box-number">
</span>
                    <span class="info-box-number">
                    <?php echo \app\models\Detallecarrito::find()->where(['mesi' => $mesii, 'ani' => $mani])->sum('cantidad') ?>

                </span>
                    </div>

                    <!-- /.info-box-content -->
                </div>
            </div>

        </div>



      <div class="col-xs-12">

      <div class="col-xs-12">
<br>
                           


            

      </div>




    </div>
</section>




