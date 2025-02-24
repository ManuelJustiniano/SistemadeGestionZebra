<?php

use yii\helpers\Url;

$meses2 = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
$meses = array('', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');

$script = <<<CSS
CSS;
$this->registerCss($script);
//$this->registerjsFile('@web/assets_b/web/js/jquery.min.js', ['position' => \yii\web\View::POS_READY]);


?>


<?= $this->render('../banners/fijo', ['titulo' => 'Noticias']) ?>



<div class="container">
    <div class="row">
        <div class="col-lg-9">








            <?php foreach ($model as $item): ?>
                <?php

                $dia = date("d", strtotime($item['fecha_noticia']));
                $mes = date("m", strtotime($item['fecha_noticia']));
                $alo = date("Y", strtotime($item['fecha_noticia']));
                ?>




                <article class="entry">
                    <div class="entry-media">


                        <a href="<?= Url::to(['noticia/' . $item['idnoticia']]) ?>">
                                <img src="<?= Url::to($item['foto_portada']) ?>" alt="<?= $item['titulo'] ?>"
                                     class="img-responsive">



                        </a>

                    </div><!-- End .entry-media -->

                    <div class="entry-body">
                        <div class="entry-date">
                            <span class="day"><?= $dia ?></span>
                            <span class="month"><?= $meses[$mes * 1] ?></span>
                        </div><!-- End .entry-date -->

                        <h2 class="entry-title">
                            <a href="<?= Url::to(['noticia/' . $item['idnoticia']]) ?>"><?= $item['titulo'] ?></a>
                        </h2>

                        <div class="entry-content">
                            <p>

                                <?= \yii\helpers\StringHelper::truncate($item['resumen'], 100) ?>
                            </p>

                            <a href="<?= Url::to(['noticia/' . $item['idnoticia']]) ?>" class="read-more">Leer más <i class="icon-angle-double-right"></i></a>
                        </div><!-- End .entry-content -->

                        <div class="entry-meta">
                            <span><i class="icon-calendar"></i><?= $meses[$mes * 1] ?> <?= $dia ?>, <?= $alo ?></span>
                            <span><i class="icon-user"></i>Por <a href="#"><?= $item['fuente'] ?></a></span>

                        </div><!-- End .entry-meta -->
                    </div><!-- End .entry-body -->
                </article><!-- End .entry -->




            <?php endforeach; ?>




            <nav class="toolbox toolbox-pagination">
                <ul class="pagination">
                    <?= \yii\widgets\LinkPager::widget([
                        'pagination' => $data->pagination,
                    ]); ?>
                </ul>
            </nav>



        </div><!-- End .col-lg-9 -->

        <aside class="sidebar col-lg-3">


            <div class="sidebar-wrapper">
                <div class="widget widget-search">


                    <form  method="get" class="search-form" action="<?= Url::to('noticias') ?>">
                        <input type="search" class="form-control" placeholder="Buscar noticia..." name="s" required>
                        <button type="submit" class="search-submit" title="Buscar">
                            <i class="icon-search"></i>
                            <span class="sr-only">Buscar</span>
                        </button>
                    </form>
                </div><!-- End .widget -->

                <div class="widget widget-categories">

                    <?= $this->render('sidebar') ?>



                </div><!-- End .widget -->




            </div><!-- End .sidebar-wrapper -->
        </aside><!-- End .col-lg-3 -->
    </div><!-- End .row -->
</div><!-- End .container -->

<div class="mb-6"></div><!-- margin -->




