<?php
use yii\helpers\Url;

/* @var $this yii\web\View */

$configuracion = \app\models\Configuracion::find()->one();

$script = <<<CSS
CSS;
$this->registerCss($script, ['depends' => \app\assets_b\AppAsset::class]);

?>


<div class="info-boxes-container">
    <div class="container">
        <div class="info-box">
            <i class="icon-shipping"></i>

            <div class="info-box-content">
                <h4>DELIVERY</h4>
                <p><?php echo $configuracion['delivery']?> </p>
            </div><!-- End .info-box-content -->
        </div><!-- End .info-box -->

        <div class="info-box">
            <i class="icon-clock"></i>

            <div class="info-box-content">
                <h4>HORARIO DE ATENCIÓN</h4>
                <p><?php echo $configuracion['horarios']?></p>
            </div><!-- End .info-box-content -->
        </div><!-- End .info-box -->

        <div class="info-box">
            <i class="icon-direction"></i>

            <div class="info-box-content">
                <h4>DIRECCION</h4>
                <p><?php echo $configuracion['direccion_empresa']?></p>
            </div><!-- End .info-box-content -->
        </div><!-- End .info-box -->
    </div><!-- End .container -->
</div><!-- End .info-boxes-container -->