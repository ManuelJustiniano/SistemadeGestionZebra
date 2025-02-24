<?php

use app\assets_b\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

$data = new \app\models\Categoria();


?>


<?php $banners23232DSS = \app\models\Banner::find()->where(['estado' => '1', 'idcategoria' => 44])->orderBy('idbanner')->all() ?>


    <div class="banners-group">
        <div class="row">
            <?php foreach ($banners23232DSS

                           as $item): ?>



                <div class="col-md-6">
                    <div class="banner banner-image">
                        <a href="<?php  echo $item['url'] ?>">
                            <img src="<?= Url::to('@web/imagen/banners/' . $item['foto']) ?>" alt="banner">
                        </a>
                    </div><!-- End .banner -->


                </div><!-- End .col-md-4 -->

            <?php endforeach; ?>





        </div><!-- End .row -->
    </div><!-- End .banners-group -->




