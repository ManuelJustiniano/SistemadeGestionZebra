<?php

use yii\helpers\Url;

$productos = \app\models\Productos::findAll(['destacado' => '1', 'estado' => '1', 'idpadre', $padre]);
?>

    <div class="container">

        <div class="row">

            <div class="col-md-12 col-sm-12 text-semibold25 text-gray2 top-spacing4 no-padding bottom-spacing1"><p
                        class="text-gray text-ralewaysemibold24 no-margin"><span
                            class="text-red text-ralewaylight24">PRODUCTOS</span>&nbsp;&nbsp;DESTACADOS</p>
                <p class="text-SourceSansLight16 text-gray">Conozca la más amplia gama de productos e insumos
                    médicos</p>
            </div>

            <div class="col-md-12 no-padding" id="sliderarrow">

                <div id="slickNext"><img class="pull-right"
                                         src="<?= Url::to('@web/assets_b/web/images/arrow_right.png') ?>"/>
                </div>

                <div class="slider">    <!-- slider -->
                    <?php $c = 1 ?>
                    <?php foreach ($productos as $item): ?>
                        <?php if (($c > 4) || ($c == 1)): ?>
                            <div class="row">
                        <?php endif; ?>
                        <div class="col-md-3 bottom-spacing2">

                            <?= $this->render('caja', ['value' => $item]); ?>

                        </div>
                        <?php if ($c == count($productos) || $c == 4): ?>

                            <br class="clearboth">
                            </div>
                            <?php if (($c == 4)) {
                                $c = 0;
                            } ?>
                        <?php endif; ?>
                        <?php $c += 1; ?>
                    <?php endforeach; ?>

                </div> <!-- /slider -->

                <div id="slickPrev"><img class="pull-right"
                                         src="<?= Url::to('@web/assets_b/web/images/arrow_left.png') ?>"/>
                </div>

            </div>

        </div>
    </div>

<?php
$script = <<<JS
       $('.slider2').slick({                        
        slidesToShow: 1,
        arrows: false,
        dots: true,
        slidesToScroll: 1,  
        auto:true
    });
JS;
$this->registerJs($script, \yii\web\View::POS_READY);
?>