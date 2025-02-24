<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$configuracion = \app\models\Configuracion::find()->one();
$configuracion['titulo_pagina'] = $model['titulo'];
$configuracion['meta_descripcion'] = strip_tags($model['descripcion']);
$this->render('../../widgets/metatags', ['model' => $configuracion, 'foto' => Url::to($model['foto'])]);



$script = <<<CSS
.form-control{
color: #000 !important;
}

.add-carrito span {
    background: #080707;
    padding: 15px 10px;
    color: #fff;
    text-align: center;
        font-size: 12px;
            width: 100%;
}

.btn-addcarrito {
    float: right;
    padding-left: 40px;
}

img.imgadd{
    margin-top: 15px;
    float: left;
    position: absolute;
    padding-left: 15px;

}

.input-group-addon, .input-group-btn {
    width: auto;
    white-space: nowrap;
    vertical-align: middle;
}
.nav-link:hover,
.nav-link:focus,
.nav-link:active{
    background-color: transparent;
}

CSS;


$this->registerCss($script, ['depends' => \app\assets_b\AppAsset::class]);

?>









<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="product-single-container product-single-default">
                <div class="row">
                    <div class="col-lg-7 col-md-6 product-single-gallery">




                        <?php if ($model->galeria): ?>

                            <div class="product-slider-container product-item">
                                <div class="product-single-carousel owl-carousel owl-theme">





                                <?php foreach ($model->galeria as $value): ?>


                                    <div class="product-item">
                                        <img class="product-single-image" src="<?= Url::to("@web/imagen/productos/{$value['archivo']}") ?>" data-zoom-image="<?= Url::to("@web/imagen/productos/{$value['archivo']}") ?>" alt="<?= $model['titulo'] ?>"/>
                                    </div>




                                <?php endforeach; ?>

                                </div>
                                <!-- End .product-single-carousel -->
                                <span class="prod-full-screen">
                                            <i class="icon-plus"></i>
                                        </span>
                            </div>

                            <div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>



                            <?php foreach ($model->galeria2 as $value): ?>


                                <div class="col-3 owl-dot">
                                    <img src="<?= Url::to("@web/imagen/productos/{$value['archivo']}") ?>" alt="<?= $model['titulo'] ?>"/>
                                </div>

                            <?php endforeach; ?>

                            </div>


                        <?php else: ?>
                            <img src="<?= empty($model->foto) ? Url::to($model->foto) : Url::to($model->foto); ?>" alt="<?= $model['titulo'] ?>" class="img-responsive">

                        <?php endif; ?>







                    </div><!-- End .col-lg-7 -->








                    <div class="col-lg-5 col-md-6">
                        <div class="product-single-details">
                            <h1 class="product-title"><?= $model['titulo'] ?></h1>


                            <div class="price-box">


                                <?php if($model['preciooferta']) :?>

                                    <span class="old-price">Bs. <?= $model['preciooferta'] ?></span>
                                    <span class="product-price">Bs. <?= $model['precio'] ?></span>
                                <?php else:?>
                                    <span class="product-price">Bs. <?= $model['precio'] ?></span>
                                <?php endif;?>



                            </div><!-- End .price-box -->

                            <div class="product-desc">

                                <p>
                                    <?= $model['resumen'] ?>

                                </p>

                                <BR>


                                <?php
                                $host= $_SERVER["HTTP_HOST"];
                                $url= $_SERVER["REQUEST_URI"];
                                $ulrlo = "https://" . $host . $url;

                                ?>

                                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
                                      integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">




                                <a  href="https://api.whatsapp.com/send?phone=591<?= $configuracion['fax_empresa']; ?>&text=Hola,%20quiero%20comprar%20este%20producto:%0A<?= $model->titulo; ?>.%0APrecio:%20<?= $model->precio; ?>Bs.%0AEnlace:%20<?= $ulrlo ?>" class="whasapa" target="_blank">
                                    <i class="fab fa-whatsapp"></i>


                                    <span>  Pedir por Whatsapp  </span> </a>







                            </div><!-- End .product-desc -->



                            <div class="product-action product-all-icons">


                                <?php $form = ActiveForm::begin(['id' => 'frmContact', 'options' => ['class' => ''], 'action' => ['carrito/add'], 'method' => 'get']); ?>



                                <div class="product-single-qty">
                                    <input type="number" class="horizontal-quantity form-control" value="<?= Yii::$app->request->get('cantidad')?>"  name="cantidad"
                                           style="width: 43%" placeholder="0"  max="<?//php echo $totaldets ?>" min="1" required>

                                    <input type="hidden" value="<?= $model['idproducto'] ?> " name="id">



                                </div><!-- End .product-single-qty -->



                                <input type="submit" name="enviar" id="submit_contact" class="paction add-cart carlet"
                                       value="Añadir al Carrito">

                                <?php ActiveForm::end(); ?>


                            </div><!-- End .product-action -->

                            <div class="product-single-share">
                                <label>Compartir:</label>
                                <!-- www.addthis.com share plugin-->
                                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f0cabeb3cbc3e81"></script>
                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <div class="sociales top-spacing3 bottom-spacing3">
                                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                    <script type="text/javascript"
                                            src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54f678625eb57483"
                                            async="async"></script>
                                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                    <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                                        <a class="addthis_button_preferred_1"></a>
                                        <a class="addthis_button_preferred_2"></a>
                                        <a class="addthis_button_preferred_3"></a>
                                        <a class="addthis_button_preferred_4"></a>
                                        <a class="addthis_button_compact"></a>
                                    </div>

                                </div>
                            </div><!-- End .product single-share -->
                        </div><!-- End .product-single-details -->
                    </div><!-- End .col-lg-5 -->
                </div><!-- End .row -->
            </div><!-- End .product-single-container -->

            <div class="product-single-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Descripcion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content" role="tab" aria-controls="product-tags-content" aria-selected="false">Otras Características</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                        <div class="product-desc-content">
                            <?= $model['descripcion'] ?>

                      </div><!-- End .product-desc-content -->
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="product-tags-content" role="tabpanel" aria-labelledby="product-tab-tags">
                        <div class="product-tags-content">

                            <?//= $model['otradescripcion'] ?>
                        </div><!-- End .product-tags-content -->
                    </div><!-- End .tab-pane -->


                </div><!-- End .tab-content -->
            </div><!-- End .product-single-tabs -->
        </div><!-- End .col-lg-9 -->

        <div class="sidebar-overlay"></div>
        <div class="sidebar-toggle"><i class="icon-sliders"></i></div>
        <aside class="sidebar-product col-lg-3 padding-left-lg mobile-sidebar">



            <div class="sidebar-wrapper">
                <div class="widget widget-search">
                    <h3 class="widget-title">
                        <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">Buscar</a>
                    </h3>

                    <div class="collapse show" id="widget-body-3">
                        <div class="widget-body">


                            <form  method="get" class="search-form" action="<?= Url::to('productos') ?>">
                                <input type="search" class="form-control" placeholder="Buscar producto..." name="s" required>
                                <button type="submit" class="search-submit" title="Buscar">
                                    <i class="icon-search"></i>
                                    <span class="sr-only">Buscar</span>
                                </button>
                            </form>



                        </div><!-- End .widget-body -->
                    </div><!-- End .collapse -->
                </div><!-- End .widget -->



                <div class="widget">
                    <h3 class="widget-title">
                        <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">Categorias</a>
                    </h3>



                    <?= $this->render('sidebar') ?>



                </div><!-- End .widget -->







                <div class="widget">
                    <h3 class="widget-title">
                        <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true" aria-controls="widget-body-4">Últimos productos</a>
                    </h3>


                    <?php $proulti = \app\models\Productos::find()->where(['estado' => '1'])->orderBy(['idproducto' => SORT_DESC])->limit('6')->all() ?>

                    <ul class="simple-entry-list">
                        <br>

                        <?php


                        foreach ($proulti

                                 as $item):



                            ?>

                            <li>


                                <div class="entry-media">
                                    <a href="<?= Url::to(['producto/' . $item['idproducto']]) ?>">
                                        <img src="<?= Url::to($item['foto']) ?>" alt="Post">
                                    </a>
                                </div><!-- End .entry-media -->
                                <div class="entry-info">
                                    <a href="<?= Url::to(['producto/' . $item['idproducto']]) ?>"> <?= \yii\helpers\StringHelper::truncate($item['titulo'], 50) ?></a>

                                    <br>   <?php if($item['preciooferta']) :?>

                                        <span class="old-price">Bs. <?= $item['preciooferta'] ?></span>
                                        <span class="product-price">Bs. <?= $item['precio'] ?></span>
                                    <?php else:?>
                                        <span class="product-price">Bs. <?= $item['precio'] ?></span>
                                    <?php endif;?>
                                </div><!-- End .entry-info -->
                            </li>
                        <?php endforeach; ?>


                    </ul>



                </div><!-- End .widget -->




            </div><!-- End .sidebar-wrapper -->



        </aside><!-- End .col-md-3 -->
    </div><!-- End .row -->
</div><!-- End .container -->

<div class="featured-section">
    <div class="container">
        <h2 class="carousel-title">Productos Relacionados</h2>


        <?php $proultirelaci = \app\models\Productos::find()->where(['estado' => '1', 'idcategoria' => $model['idcategoria']])->orderBy(['idproducto' => SORT_DESC])->limit('9')->all() ?>



        <div class="featured-products owl-carousel owl-theme owl-dots-top">


            <?php foreach ($proultirelaci as $value) : ?>

            <div class="product">
                <figure class="product-image-container">
                    <a href="<?= Url::to(["producto/{$value['idproducto']}"]) ?>" class="product-image">
                        <img src="<?= Url::to($value['foto']) ?>" alt="<?php echo $value['titulo'] ?>">
                    </a>
                    <a href="<?= Url::to(["producto/{$value['idproducto']}"]) ?>" class="btn-quickviewlow">Ver producto</a>
                </figure>


                <div class="product-details">

                    <h2 class="product-title">
                        <a href="<?= Url::to(["producto/{$value['idproducto']}"]) ?>">
                            <?= \yii\helpers\StringHelper::truncate($value['titulo'], 60) ?></a>
                    </h2>

                    <div class="price-box">



                        <?php if($value['preciooferta']) :?>

                            <span class="old-price">Bs. <?= $value['preciooferta'] ?></span>
                            <span class="product-price">Bs. <?= $value['precio'] ?></span>
                        <?php else:?>
                            <span class="product-price">Bs. <?= $value['precio'] ?></span>
                        <?php endif;?>


                    </div>



                    <div class="product-action">
                        <a href="<?= Url::to(["producto/{$value['idproducto']}"]) ?>" class="paction add-wishlist" title="Add to Wishlist">
                            <span>Ver producto</span>
                        </a>




                        <?php $form = ActiveForm::begin(['id' => 'frmContact', 'options' => ['class' => 'dealsd'], 'action' => ['carrito/add'], 'method' => 'get']); ?>






                            <input type="hidden" value="<?= $value['idproducto'] ?> " name="id">






                        <input type="submit" name="enviar" id="submit_contact" class="paction add-cart carlet"
                               value="Añadir al Carrito">

                        <?php ActiveForm::end(); ?>




                        <a href="<?= Url::to(["producto/{$value['idproducto']}"]) ?>" class="paction add-compare" title="Add to Compare">
                            <span>Ver producto</span>
                        </a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-details -->


            </div><!-- End .product -->


            <?php endforeach; ?>




        </div><!-- End .featured-proucts -->
    </div><!-- End .container -->
</div><!-- End .featured-section -->













