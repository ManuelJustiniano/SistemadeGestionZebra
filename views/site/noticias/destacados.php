<?php

use yii\helpers\Url;
$noticias = \app\models\Noticias::find()->where(['destacado' => '1', 'estado' => '1'])->orderBy(['idnoticia' => SORT_DESC])->all();
$meses = array('', 'ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC');

?>

<BR>
<BR>
<div class="widget">
    <div class="banner banner-image eee">
        <h3 class="widget-title">Noticias destacadas</h3>


        <div class="noticia-slider owl-carousel owl-theme">
            <?php foreach ($noticias


                           as $item):


                $dia = date("d", strtotime($item['fecha_noticia']));
                $mes = date("m", strtotime($item['fecha_noticia']));
                $año = date("Y", strtotime($item['fecha_noticia']));
                ?>
            <div class="testimonial">
                <article class="entry">
                    <div class="entry-media">
                        <a href="<?= Url::to(['noticia/' . $item['idnoticia']]) ?>">
                            <img src="<?= Url::to($item['foto_portada']) ?>" alt="<?= $item['titulo'] ?>">
                        </a>
                        <div class="entry-date">
                            <?= $dia ?>
                            <span><?= $meses[$mes * 1] ?></span>
                        </div><!-- End .entry-date -->
                    </div><!-- End .entry-media -->

                    <div class="entry-body">

                        <h2 class="entry-title">
                            <a href="<?= Url::to(['noticia/' . $item['idnoticia']]) ?>"> <?= \yii\helpers\StringHelper::truncate($item['titulo'], 65) ?></a>
                        </h2>

                        <div class="entry-content">
                            <p><?= \yii\helpers\StringHelper::truncate($item['resumen'], 100) ?></p>

                            <a href="<?= Url::to(['noticia/' . $item['idnoticia']]) ?>" class="read-more">(LEER MÁS)</a>
                        </div><!-- End .entry-content -->
                    </div><!-- End .entry-body -->
                </article><!-- End .entry -->
            </div>



            <?php endforeach; ?>


        </div><!-- End .testimonials-slider -->





    </div>
</div>




