<?php

use yii\helpers\Url;

\app\assets_b\SliderAsset::register($this);

?>

<?php $banners2 = \app\models\Banner::find()->where(['estado' => '1', 'idcategoria' => 2])->limit(4)->orderBy('idbanner')->all() ?>
<?php $banners3 = \app\models\Banner::find()->where(['estado' => '1', 'idcategoria' => 2])->limit(2)->orderBy('idbanner')->all() ?>
<?php $banners4 = \app\models\Banner::find()->where(['estado' => '1', 'idcategoria' => 2])->limit(1)->orderBy('idbanner')->all() ?>

<div id="banners">
    <div class="container">
        <div class="row">
            <?php foreach ($banners2 as $row_banner2): ?>

                <div class="col-md-3 hidden-xs hidden-sm " style="margin-bottom: 10px"><a href="#"><img
                                src="<?= Url::to('@web/imagen/banners/' . $row_banner2['foto']) ?>" alt="Banner 1"
                                class="img-responsive center-block"></a></div>
            <?php endforeach; ?>
        </div>


        <div class="row hidden-md hidden-lg hidden-xs">
            <?php foreach ($banners3 as $row_banner3): ?>

                <div class="col-sm-6" style="margin-bottom: 10px"><a href="#"><img
                                src="<?= Url::to('@web/imagen/banners/' . $row_banner3['foto']) ?>" alt="Banner 1"
                                class="img-responsive center-block"></a></div>
            <?php endforeach; ?>
        </div>


        <div class="row hidden-md hidden-lg hidden-sm">
            <?php foreach ($banners4 as $row_banner4): ?>

                <div class="col-xs-12" style="margin-bottom: 10px"><a href="#"><img
                                src="<?= Url::to('@web/imagen/banners/' . $row_banner4['foto']) ?>" alt="Banner 1"
                                class="img-responsive center-block"></a></div>
            <?php endforeach; ?>
        </div>


    </div>
</div>