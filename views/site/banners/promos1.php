<?php

use app\assets_b\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

$data = new \app\models\Categoria();


?>


<?php $banners23232 = \app\models\Banner::find()->where(['estado' => '1', 'idcategoria' => 43])->orderBy('idbanner')->all() ?>




    <div class="widget">
        <div class="banner banner-image eee">


    <div class="promo-slider owl-carousel owl-theme">
        <?php foreach ($banners23232

                       as $item): ?>
        <div class="testimonial">
            <a href="<?php  echo $item['url'] ?>">
                <img src="<?= Url::to('@web/imagen/banners/' . $item['foto']) ?>" alt="banner">
            </a>

            <?php if ($item['resumen2']): ?>

                <div align="center" style="margin-top: 10px;">
                <a href="<?php  echo $item['url'] ?>"
                   class="btn btn-primary"><?php echo $item['resumen2'] ?></a>
                </div>
            <?php endif; ?>
        </div>


        <?php endforeach; ?>


    </div><!-- End .testimonials-slider -->

        </div><!-- End .banner -->
    </div><!-- End .widget -->



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