
<?php
use yii\helpers\Url;

/* @var $this yii\web\View */

$configuracion = \app\models\Configuracion::find()->one();
$this->render('../widgets/metatags', ['model' => $configuracion]);

$script = <<<CSS
CSS;
$this->registerCss($script, ['depends' => \app\assets_b\AppAsset::class]);

?>






<?php


?>



<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="home-product-tabs">


                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="featured-products-tab" data-toggle="tab" href="#featured-products" role="tab" aria-controls="featured-products" aria-selected="true">Últimos productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="latest-products-tab" data-toggle="tab" href="#latest-products" role="tab" aria-controls="latest-products" aria-selected="false">Productos mas vistos</a>
                    </li>
                </ul>


                <div class="tab-content">
                    <div class="tab-pane  show active" id="featured-products" role="tabpanel" aria-labelledby="featured-products-tab">
                        <div class="row row-sm">







                        </div><!-- End .row -->
                    </div><!-- End .tab-pane -->
                    <div class="tab-pane " id="latest-products" role="tabpanel" aria-labelledby="latest-products-tab">
                        <div class="row row-sm">






                        </div><!-- End .row -->
                    </div><!-- End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .home-product-tabs -->



        </div><!-- End .col-lg-9 -->





        <aside class="sidebar-home col-lg-3">


        </aside><!-- End .col-lg-3 -->
    </div><!-- End .row -->
</div><!-- End .container -->

<div class="mb-4"></div><!-- margin -->






