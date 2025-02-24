<?php

use app\assets_b\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

$data = new \app\models\Categoria();


?>


<?php $banners = \app\models\Banner::find()->where(['estado' => '1', 'idcategoria' => 1])->orderBy('idbanner')->all() ?>
<?php $bannerspromo = \app\models\Banner::find()->where(['estado' => '1', 'idcategoria' => 3])->orderBy('idbanner')->limit(3)->all() ?>


    <div class="home-top-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="home-slider owl-carousel owl-carousel-lazy">
                        <?php foreach ($banners as $row_banner): ?>

                            <div class="home-slide">
                                <img class="owl-lazy" src="<?= Url::to(['assets_b/images/lazy.png']) ?>"
                                     data-src="<?= Url::to('@web/imagen/banners/' . $row_banner['foto']) ?>"
                                     alt="Decoraciones Party globoso">
                                <div class="home-slide-content">

                                    <?php if ($row_banner['titulo']): ?>
                                        <h1> <?php echo $row_banner['titulo'] ?></h1>
                                    <?php endif; ?>
                                    <?php if ($row_banner['resumen']): ?>
                                        <h3><?php echo  $row_banner['resumen'] ?></h3>
                                    <?php endif; ?>
                                    <?php if ($row_banner['resumen2']): ?>

                                        <a href="<?php  echo $row_banner['url'] ?>"
                                           class="btn btn-primary"><?php echo $row_banner['resumen2'] ?></a>
                                    <?php endif; ?>


                                </div><!-- End .home-slide-content -->
                            </div><!-- End .home-slide -->
                        <?php endforeach; ?>

                    </div><!-- End .home-slider -->
                </div><!-- End .col-lg-8 -->

                <div class="col-lg-3 top-banners bananekn" >

                    <div class="row">


<?php foreach ($bannerspromo as $row_banner): ?>

    <div class="col-md-4 col-sm-4 col-lg-12" >
    <div class="banner banner-image">
                        <a href="<?php  echo $row_banner['url'] ?>" target="_blank">
                            <img src="<?= Url::to('@web/imagen/banners/' . $row_banner['foto']) ?>" alt="Party Globoso promociones decoraciones">
                        </a>
                    </div><!-- End .banner -->
    </div>
<?php endforeach; ?>
                    </div>

                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .home-top-container -->


<?php
/*
$script = <<<JS

      var tpj=jQuery;               // MAKE JQUERY PLUGIN CONFLICTFREE
    tpj.noConflict();

    tpj(document).ready(function() {
        if (tpj.fn.cssOriginal!=undefined)   // CHECK IF fn.css already extended
            tpj.fn.css = tpj.fn.cssOriginal;

        tpj('.fullwidthbanner').revolution(
            {
                delay:3000,
                startwidth:1920,
                startheight:655,

                onHoverStop:"on",						// Stop Banner Timet at Hover on Slide on/off

                thumbWidth:100,							// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
                thumbHeight:50,
                thumbAmount:6,

                hideThumbs:200,
                navigationType:"both",					//bullet, thumb, none, both	 (No Shadow in Fullwidth Version !)
                navigationArrows:"none",		//nexttobullets, verticalcentered, none
                navigationStyle:"round",				//round,square,navbar

                touchenabled:"on",						// Enable Swipe Function : on/off

                navOffsetHorizontal:0,
                navOffsetVertical:30,
                fullWidth:"on",

                shadow:0

            });

    });

JS;*/
//$this->registerJs($script, \yii\web\View::POS_END);?>