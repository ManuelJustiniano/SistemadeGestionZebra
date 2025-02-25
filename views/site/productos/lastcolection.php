<?php

use app\models\Productos;
use yii\helpers\Url;

$data = Productos::find()
    ->where(['estado' => 1])
    ->orderBy(['fecha_registro' => SORT_DESC])
    ->all();

$script = <<<CSS

CSS;
//$this->registerCss($script, ['depends' => \app\assets_b\AppAsset::class]);
?>

    <div id="consorcios">
        <div class="container">
            <div class="row top-spacing5">
                <div class="col-md-5 col-xs-1">
                    <div class="slick-arrow next" id="slickPrev"><img class="pull-left izquiedares"
                                                                      src="<?= Url::to('@web/assets_b/web/images/arrow_left.png') ?>"/>
                    </div>
                    <hr>
                </div>
                <div class="col-md-2 col-xs-10 text-center no-padding" id="titulo">
                    <h2 class="text-myriadpror21">ULTIMA COLECCIÓN</h2>
                </div>
                <div class="col-md-5 col-xs-1">
                    <div class="slick-arrow prev" id="slickNext"><img class="pull-right derecharesp"
                                                                      src="<?= Url::to('@web/assets_b/web/images/arrow_right.png') ?>"/>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="row top-spacing4">
                <div class="col-md-12">
                    <div class="slider1 bottom-spacing3">
                        <!-- FILA -->
                        <?php
                        $controw = 1;
                        $contcol = 1;
                        $contreg = 1;
                        $num = count($data);
                        foreach ($data

                        as $key => $value) {
                        ?>
                        <?php if ($controw == 1): ?>
                        <div class="row full-width-row"><!-- FILA A -->
                            <?php endif; ?>
                            <?php if (($contcol > 4) || ($contcol == 1)): ?>
                            <div><!-- FILA COLUMNA -->
                                <?php endif; ?>

                                <?= $this->render('prototipo', ['value' => $value]); ?>


                                <?php if ($contreg == $num): ?>
                            </div> <!-- /FILA COLUMNA -->
                        </div><!--  /FILA A -->
                        <?php else: ?>
                        <?php if (($contcol == 4)): ?>
                    </div><!-- /FILA COLUMNA -->
                    <?php $contcol = 0; ?>
                    <?php if ($contreg == $num): ?>
                </div><!--  /FILA A -->
                <?php endif; ?>
                <?php endif; ?>
                <?php if (($controw == 8)): ?>
            </div><!--  /FILA A -->
            <?php $controw = 0; ?>
            <?php endif; ?>
            <?php endif; ?>


            <?php $contcol += 1;
            $contreg += 1;
            $controw += 1; ?>
            <?php } ?>
            <!-- FILA -->
        </div>
    </div>
    </div>
    </div>
    </div>
<?php
$script = <<< JS
    jQuery('.slider1').slick({                        
        slidesToShow: 1,
        slidesToScroll: 1,        
        prevArrow: '#slickPrev',
        nextArrow: '#slickNext'       
    }); 
JS;
$this->registerJs($script, \yii\web\View::POS_READY);
$script = <<< JS
    jQuery('#boxcuadro img').contenthover({
        overlay_x_position: 'left',
        overlay_y_position: 'bottom',
        effect: 'fade'
    }); 
JS;
$this->registerJs($script, \yii\web\View::POS_LOAD);

?>