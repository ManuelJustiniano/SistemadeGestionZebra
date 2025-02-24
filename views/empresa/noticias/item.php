<?php

use yii\helpers\Url;

$configuracion = \app\models\Configuracion::find()->one();
$meses2 = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
$meses = array('', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');

$dia = date("d", strtotime($model['fecha_noticia']));
$mes = date("m", strtotime($model['fecha_noticia']));
$año = date("Y", strtotime($model['fecha_noticia']));
$horass = date("H:i", strtotime($model['fecha_noticia']));


//$this->registerCssFile('@web/assets_b/web/plugin/galeria/thumbrigth/css/examples.css', ['depends'=>\app\assets_b\AppAsset::class, 'media' => 'screen','']);
$configuracion = \app\models\Configuracion::find()->one();
$configuracion['titulo_pagina'] = $model['titulo'];
$configuracion['meta_descripcion'] = strip_tags($model['descripcion']);

$this->render('../../widgets/metatags', ['model' => $configuracion, 'foto' => Url::to($model['foto_portada'])]);



\app\assets_b\AppAsset::register($this);

?>

<?= $this->render('../banners/fijo', ['titulo' => 'Noticias']) ?>

<style>
    .embed-responsive-16by9 {
        padding-bottom: 56.25%;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <article class="entry single">
                <div class="entry-media">

                    <?php if ($model->galeria): ?>
                    <div class="entry-slider owl-carousel owl-theme">
                        <?php foreach ($model->galeria as $value): ?>




                            <img src="<?= Url::to("@web/imagen/noticias/{$value['archivo']}") ?>" alt=" <?= $model['titulo'] ?>" class="img-responsive">
                        <?php endforeach; ?>

                    </div><!-- End .entry-slider -->
                    <?php else: ?>
                        <img src="<?= empty($model->foto_contenido) ? Url::to($model->foto_portada) : Url::to($model->foto_contenido); ?>" alt=" <?= $model['titulo'] ?>" class="img-responsive">

                    <?php endif; ?>




                </div><!-- End .entry-media -->

                <div class="entry-body">
                    <div class="entry-date">
                        <span class="day"><?= $dia ?></span>
                        <span class="month"><?= $meses[$mes * 1] ?></span>
                    </div><!-- End .entry-date -->

                    <h2 class="entry-title">
                        <?= $model['titulo'] ?>
                    </h2>

                    <div class="entry-meta">
                        <span><i class="icon-calendar"></i><?= $meses[$mes * 1] ?> <?= $dia ?>, <?= $año ?></span>
                        <span><i class="icon-user"></i>Por <a href="#"><?= $model['fuente'] ?></a></span>

                    </div><!-- End .entry-meta -->

                    <div class="entry-content">


                        <?= $model['descripcion'] ?>


                  </div><!-- End .entry-content -->


                    <?php if ($model['video']):

                        $idvideo = $model['video']

                        ?>


                        <br>
                        <div class="video">

                          <div class="video">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <!--  <? /*= VideoEmbed::widget([
                        'url' => 'http://www.youtube.com/watch?v=NMjA5N7kbEQ',
                        'container_id' => 'yourCustomId',
                        'container_class' => 'your-custom-class a-second-custom-class',
                    ]); */ ?>-->


                                        <iframe class="embed-responsive-item"  src="https://www.youtube.com/embed/<?= $model['video'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>


                                    </div>
                                </div>


                        </div>
                    <?php endif; ?>




                    <div class="entry-share">
                        <h3>
                            <i class="icon-forward"></i>
                           Comparte esta noticia:
                        </h3>




                        <div class="social-icons">
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
                        </div><!-- End .social-icons -->
                    </div><!-- End .entry-share -->




                </div><!-- End .entry-body -->
            </article><!-- End .entry -->


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




                <div class="widget">
                    <h4 class="widget-title">Noticias Recientes</h4>

                    <?php $noticiasul = \app\models\Noticias::find()->where(['estado' => '1'])->orderBy(['idnoticia' => SORT_DESC])->limit('6')->all() ?>

                    <ul class="simple-entry-list">

                        <?php

                        $meses2 = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
                        $meses = array('', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');


                        foreach ($noticiasul

                                       as $item):


                            $dia = date("d", strtotime($item['fecha_noticia']));
                            $mes = date("m", strtotime($item['fecha_noticia']));
                            $alo = date("Y", strtotime($item['fecha_noticia']));
                            ?>

                            <li>



                            <div class="entry-media">
                                <a href="<?= Url::to(['noticia/' . $item['idnoticia']]) ?>">
                                    <img src="<?= Url::to($item['foto_portada']) ?>" alt="Post">
                                </a>
                            </div><!-- End .entry-media -->
                            <div class="entry-info">
                                <a href="<?= Url::to(['noticia/' . $item['idnoticia']]) ?>"> <?= \yii\helpers\StringHelper::truncate($item['titulo'], 50) ?></a>
                                <div class="entry-meta">
                                    <?= $meses[$mes * 1] ?> <?= $dia ?>, <?= $alo ?>
                                </div><!-- End .entry-meta -->
                            </div><!-- End .entry-info -->
                            </li>
                        <?php endforeach; ?>


                    </ul>
                </div><!-- End .widget -->





            </div><!-- End .sidebar-wrapper -->
        </aside><!-- End .col-lg-3 -->
    </div><!-- End .row -->
</div><!-- End .container -->

<div class="mb-6"></div><!-- margin -->
















