<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;


$script = <<<CSS
.border-prod {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #f1f0f1;
    height: 417px;
    overflow: hidden;
    text-align: center;
}

.ch_element{

    display: block;
    margin: 0 auto;
}

@media (min-width: 992px) and (max-width: 1199px) {

.contenthover {
  
    width: 100%;
}
}

@media (min-width: 768px) and (max-width: 991px) {

.contenthover {
  
    width: 100%;
}
}

.sidebar-shop .widget-body {
   
    padding-left: 0;
}

.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
    z-index: 3;
    color: #fff;
    cursor: default;
    background-color: #000000;
    border-color: #000000;
}
.pagination > li > a, .pagination > li > span{
 color: #000000;
}
CSS;
$this->registerCss($script);

?>






<div class="container">
    <div class="row">
        <div class="col-lg-9">

            <div class="row row-sm">




                <?php foreach ($model as $value) : ?>


                <div class="col-6 col-md-4">

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


                </div><!-- End .col-xl-3 -->

                <?php endforeach; ?>












            </div><!-- End .row -->

            <nav class="toolbox toolbox-pagination">


                <ul class="pagination">
                    <?= \yii\widgets\LinkPager::widget([
                        'pagination' => $data->pagination,
                    ]); ?>
                </ul>
            </nav>
        </div><!-- End .col-lg-9 -->

        <aside class="sidebar-shop col-lg-3 order-lg-first">
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
        </aside><!-- End .col-lg-3 -->
    </div><!-- End .row -->
</div><!-- End .container -->

<div class="mb-5"></div><!-- margin -->









<?php
$script = <<<JS
JS;
$this->registerJs($script, \yii\web\View::POS_READY); ?>
