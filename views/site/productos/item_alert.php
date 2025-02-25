<?php

use yii\helpers\Url;

$conf = \app\models\Configuracion::find()->one();


$script = <<<CSS
@media (min-width: 768px) and (max-width: 991px) {
    .img-thumbnail2 {
    max-width: 50%;
    height: auto;
    margin: 0 auto;
        margin-bottom: 10px;
    }
    }
    
    @media (max-width: 767px) {
    
    .sweet-alert {
   
    top: 50%!important;
    
     }
    .img-thumbnail2 {
    max-width: 40%;
    height: auto;
    margin: 0 auto;
        margin-bottom: 10px;
    }
    }

CSS;
$this->registerCss($script, ['depends' => \app\assets_b\AppAsset::class]);

?>


<div class="row top-spacing3">
    <div class="col-md-6 col-xs-12">

        <?php if ($model['foto']): ?>
            <img alt="Rodents" class="img-thumbnail img-thumbnail2" src="<?php echo Url::to($model['foto']) ?>">
        <?php else: ?>
            <img alt="Rodents" class="img-thumbnail img-thumbnail2""
            src="<?php echo Url::to('@web/assets_b/web/images/producto1.jpg') ?> ">
        <?php endif; ?>

    </div>

    <div class="col-md-6 col-xs-12 no-padding-right npadding2">
        <span class="text-aileronsb18"><?= $model['titulo'] ?></span>

        <div class="clearfix"></div>
        <p class="     text-justify; text-ailerol13 top-spacing1 bottom-spacing1" style="TEXT-ALIGN: justify;">
            <?= $model['resumen'] ?>
        </p>

        <p style="
    color: black;
    display: block;
    text-align: left;
">
            <?php if($model['preciooferta']) :?>

                <span class="old-price">Bs. <?= $model['preciooferta'] ?></span>
                <span class="product-price">Bs. <?= $model['precio'] ?></span>
            <?php else:?>
                <span class="product-price">Bs. <?= $model['precio'] ?></span>
            <?php endif;?>
        </p>
    </div>
</div>


